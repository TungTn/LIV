<?php
/**
 * The template for displaying Restaurant List Page.
 * @package Miyatsu
 * Template Name: Restaurant List
**/ 
?> 
<?php get_header(); ?>
<?php 
	
 	$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
	$category = $wp_query->get_queried_object();
	$args = array(
		'post_type'			=>'restaurants', 
		'post_status'		=>'publish',
		'posts_per_page' 	=> -1,
		'offset'           => 0,
		'tax_query'        => array(
			array(
				'taxonomy'     => $category->taxonomy,
				'field'        => 'slug',
				'terms'        => $category->slug
			)
		),
		'orderby'          => 'date title',
		'order'            => 'DESC',
		
	);
	$post_query = new WP_Query($args);
	$average_vote = 1;
	$restaurants = array();
	if( $post_query->have_posts() ) {
		$current_month = date('m') - 1;
		if($current_month == 1 ){
			$current_month = 12;
		}
		foreach( $post_query->posts as $restaurant ) {
			$comment_args = array(
				'status' => 'approve',
				'type'  => 'comment',
				'post_type' => 'restaurants',
				'post_id' => $restaurant->ID,
				'date_query' => array(
					array(
						'year' => date( 'Y' ),
						'month' => $current_month,
					),
				),
			);
			$comments = get_comments($comment_args);
			if($comments){
				$comment_point = array();
				foreach($comments as $comment) {
					$rating = get_comment_meta( $comment->comment_ID, 'restaurant_rating', true );
					if($rating != ''){
						$comment_point[] = $rating;
					}
				}
				if($comment_point != null){
					$average_vote = array_sum($comment_point)/count($comment_point);
				}
			}
			$restaurants[$restaurant->ID] = $average_vote;
		}
	}
	if($restaurants){
		$max_value = max(array_values( $restaurants ) );
		$restaurants_of_month = array_keys( $restaurants, $max_value);
	}
	
	wp_reset_query();
?>
<div class="restaurantArea__list">
	<section class="mvArea">
		<div class="swiper-container mv" id="mv">
			<div class="swiper-wrapper">
				<?php if($restaurants_of_month):?>	
					<?php foreach( $restaurants_of_month as $key => $restaurant ):?>
						<?php if($key < 4):?>
							<div class="swiper-slide mv__item" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/mv_bg.png">
								<?php 
										$comment_count = wp_count_comments($restaurant);
									?>
								<div class="content">
									<h2 class="tit"><?php echo get_the_title($restaurant);?></h2>
									<p class="address">
										<span class="address__txt">
											<?php 
												if ( !empty(get_field('address', $restaurant)) ) { 
													echo get_field('address', $restaurant);
												}
											?>
										</span>
										<?php if($comment_count->approved == 0):?>
											<span block-sc-sp>0 Reviews</span>
										<?php else: ?>
											<span><?php echo $comment_count->approved; ?> Reviews</span>
										<?php endif;?>
									</p>
									
									<?php if($comment_count->approved == 0):?>
										<p>0 Reviews</p>
									<?php else: ?>
										<p><?php echo $comment_count->approved; ?> Reviews</p>
									<?php endif;?>
									<a href="<?php echo get_the_permalink($restaurant); ?>" class="news">Restaurant of the Month</a>
								</div>
							</div>
						<?php else:?>
							<?php break;?>
						<?php endif;?>
					<?php endforeach;?>
				
				<?php else:?>
					<a href="#" class="swiper-slide mv__item" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/mv_bg.png">
					</a>
					<a href="#" class="swiper-slide mv__item" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/mv_bg.png">
					</a>
					<a href="#" class="swiper-slide mv__item" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/mv_bg.png">
					</a>
				<?php endif;?>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
		</div>
	</section>
	<?php get_template_part('template/partial/menu-mid'); ?>
	<section class="section restaurent_list_section">
		<?php  get_template_part('template/partial/breadcrumb') ; ?>
		<div class="tag__fixed">
			<form class="tag_filter" data-url="<?php echo site_url() ?>/wp-admin/admin-ajax.php">				
				<input type="hidden" name="term_name" value="<?php echo $term->name; ?>" />
				<input type="hidden" name="taxonomy" value="<?php echo $category->taxonomy;?>" />
				<input type="hidden" name="term" value="<?php echo $category->slug; ?>" />
				<div class="tag__fixed__res">
					<div class="tag__fixed__res__click">
						<span class="text-centered">Tags</span>
					</div>
					<div id="tags_list">
						<div class="tags_top">
							<div class="icon_close_tag" block-sc-sp>
								<i class="fas fa-arrow-left"></i>
							</div>
							<h4>Tags</h4>
							<div class="icon_close_tag" block-sc-pc>
								<i class="fas fa-arrow-left"></i>
							</div>
						</div>
						<div class="tags_content">
							<div class="tags_title">
								<span>Cuisine</span>
							</div>
							<div class="list_tag">
								<?php 
									$cuisines =  get_terms( array(
				    					'taxonomy' => 'cuisine_option',
				    					'hide_empty' => false,
									) );
									if($cuisines) :
										foreach($cuisines as $cuisine):
								?>
									<button class="btn_tag" data-value="<?php echo $cuisine->slug;?>" type="button" >
										<span class="name_tag">
											<?php echo ucfirst($cuisine->name);?>
										</span>
										<input type="hidden" class="filter_input" name="cuisine[]"  />
									</button>
								<?php endforeach;?>
								<?php else :?>
									<p>Please contact admin to create Cuisine tag filter</p>
								<?php endif;?>
							</div>
							<div class="tags_title">
								<span>Rating</span>
							</div>
							<div class="list_tag">
								<div class="heartbar">
									<ul id="ratecv">
										<?php for ($i=1; $i < 6; $i++) : ?>
											<?php if ($i == 1 ):?>
												<li data-value="<?php echo $i;?>" class="rate-star hearted heart"></li>
											<?php else:?>
												<li data-value="<?php echo $i;?>" class="rate-star heart"></li>
											<?php endif;?>
				                   		 <?php endfor ?>
										<input type="hidden" class="voted_star" name="voted_star" value="0" />
									</ul>
								</div>
							</div>
							<div class="tags_title">
								<span>Ingredients</span>
							</div>
							<div class="list_tag">
								<?php 
								$ingredients =  get_terms( array(
									'taxonomy' => 'ingredient_option',
									'hide_empty' => false,
								) );
								
								if ( $ingredients) : 
									foreach($ingredients as $ingredient):
										
								?>
									<button class="btn_tag" data-value="<?php echo $ingredient->slug;?>" type="button" >
										<span class="name_tag">
											<?php echo ucfirst($ingredient->name);?>
										</span>
										<input type="hidden" class="filter_input" name="ingredient[]"  />
									</button>
								<?php endforeach;?>
								<?php else :?>
									<p>Please contact admin to create Ingredients tag filter</p>
								<?php endif;?>
							</div>
							<div class="tags_title">
								<span>Purpose</span>
							</div>
							<div class="list_tag">
								<?php 
								$purposes =  get_terms( array(
									'taxonomy' => 'purpose_option',
									'hide_empty' => false,
								) );
								if ( $purposes) : 
									
									foreach($purposes as $purpose):
								?>
									<button class="btn_tag" data-value="<?php echo $purpose->slug;?>" type="button" >
										<span class="name_tag">
											<?php echo ucfirst($purpose->name);?>
										</span>
										<input type="hidden" class="filter_input" name="purpose[]"  />
									</button>
									
								<?php endforeach;?>
								<?php else :?>
									<p>Please contact admin to create Ingredients tag filter</p>
								<?php endif;?>
								
							</div>
							<div class="list_tag">
								<button class="btn_submit" type="submit">Find</button>
							</div>
						</div>
					</div>
				</div>	
			</form>
		</div>		
		<div class="container">					
			<div class="inner">
				<div class="main">
					<div class="content">
						<div class="new_info">
							<?php if (wp_is_mobile() ) {
								get_template_part('template/partial/bannerA1') ;
								}
							?>
							<h2 class="title" block-sc-pc><?php echo $term->name;?></h2>
							<div class="restaurant-list">
								<?php if($post_query->have_posts()):?>
									<?php foreach($post_query->posts as $key =>$all_post): ?>
										<?php if($key < 12) :?>
											<div class="item-list-rest ">
										<?php else: ?>
											<div class="item-list-rest search-unactive">
										<?php endif;?>										
											<a href="<?php echo get_the_permalink($all_post->ID); ?>">
												<div class="image-list">
													
													<?php if ( has_post_thumbnail($all_post->ID) ): ?>
														<div class="img restaurant_img" data-background="<?php echo get_the_post_thumbnail_url($all_post->ID,'full');?>">
														</div>
													<?php else:?>
														<div class="img restaurant_img" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/Clip.png">
														</div>
													<?php endif;?>
													
													
													<div class="image-on-image">
														<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/heart_bg_white.png" alt="">
													</div>
												</div>
											</a>
											<div class="name-address">
												<a href="<?php echo get_the_permalink($all_post->ID); ?>" class="name-res">
													<?php echo $all_post->post_title; ?>
												</a>
												<span class="add-res">
													<?php 
														if ( !empty(get_field('address', $all_post->ID)) ) { 
															echo get_field('address', $all_post->ID);
														}
													?>
												</span>
												<br/>
												<div class="heartbar">
													<?php 
														$post_type = 'restaurants';
														$average_vote = get_average_vote($all_post->ID, $post_type);
													?>
													
													<?php for ($i=1; $i < 6; $i++) : ?>
                        								<?php if($i <= round($average_vote)):?>
                          									<span data-value="<?php echo $i;?>" class="hearted"></span>
								                        <?php else:?>
								                        	<span data-value="<?php echo $i;?>" class="heart"></span>
								                    	<?php endif;?>
													<?php endfor ?>
												</div>
												<span class="viewser"><?php echo getpostviews($all_post->ID); ?></span>
											</div>
										</div>
									<?php endforeach;?>
								<?php endif;wp_reset_query();?>
							</div>
							
							<?php if(count($post_query->posts) > 12):?>
								<div class="see_more" data-page-type="restaurants">
									<a >
										<i class="fas fa-angle-double-down"></i><span>See more</span>
									</a>
								</div>
							<?php endif;?>	
							<?php if (wp_is_mobile() ) {
								get_template_part('template/partial/bannerA2') ;
							}
							?>
							<?php if (wp_is_mobile() ) {
								get_template_part('template/partial/bannerB') ;
							}
							?>
						</div>
					</div>
					<div class="banner home_banner">
						<?php  get_template_part('template/partial/advertise_private') ; ?>
					</div>
				</div>
				
				
			</div>
		</div>	
			
	</section>
</div>
	
	<?php get_footer(); ?>