<?php
/**
 * The template for displaying Spa List Page.
 * @package Miyatsu
 * Template Name: Spa List
**/
?>
<?php get_header(); ?>
<?php
	global $mvn_pagenavi, $mvn_blog, $wp_query;
 	$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
	$category = $wp_query->get_queried_object();
	$post_per_page = 12;
	$number_loadmore = 3;
	$args = array(
		'post_type'			=>'spas',
		'post_status'		=>'publish',
		'posts_per_page' 	=> $post_per_page,
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
		'paged' 			=> max( get_query_var( 'paged' ), get_query_var( 'page' )),
	);

	$post_query = new WP_Query($args);
	$wp_query = $post_query;

	// Ajax loadmore
	/* Post Ajax attr */
	$mvn_blog = array(
		'number_post'		=> intval(wp_count_posts()->publish),
		'started_posts'		=> $post_per_page,
		'post_per_page'		=> $post_per_page,
		'number_loadmore'	=> $number_loadmore,
	);

	if( ( $post_query->found_posts - $post_per_page ) < 0 ){
		$max_paged = 1;
	} else {
		$max_paged = ceil( ( $post_query->found_posts - $post_per_page ) / $number_loadmore ) + 1;
	}



	$ajax_key =  uniqid();
	$mvn_pagenavi = array( 'key' => 'mvn_'.$ajax_key, 'max-paged' => $max_paged );

	if ( function_exists('mvn_render_script_ajax_block')) {
		mvn_render_script_ajax_block($args, $mvn_blog, $ajax_key);
	}

	$delay = 0;
	$average_vote = 1;
	$restaurants = array();
	if( $post_query->have_posts() ) {
		foreach( $post_query->posts as $restaurant ) {
			$comment_args = array(
				'status' => 'approve',
				'type'  => 'comment',
				'post_type' => 'spas',
				'post_id' => $restaurant->ID,
				'date_query' => array(
					array(
						'year' => date( 'Y' ),
						'month' => date( 'm' ),
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
	if( $restaurants ) {
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
								<div class="content">
									<h2 class="tit"><?php echo get_the_title($restaurant);?></h2>
									<p class="address">
										<?php
											if ( !empty(get_field('address', $restaurant)) ) {
												echo get_field('address', $restaurant);
											}else{
												echo "18 Phan Boi Chau - Hoan Kiem - Hanoi";
											}
										?>
									</p>
									<?php 
										$comment_count = wp_count_comments($restaurant);
									?>
									<?php if($comment_count->approved == 0):?>
										<p>0 Reviews</p>
									<?php else: ?>
										<p><?php echo $comment_count->approved; ?> Reviews</p>
									<?php endif;?>
									<a href="<?php echo get_the_permalink($restaurant); ?>" class="news">Spa of the Month</a>
								</div>
							</div>
						<?php else:?>
							<?php break;?>
						<?php endif;?>
					<?php endforeach;?>

				<?php else:?>
					<div class="swiper-slide mv__item" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/mv_bg.png">
						<div class="content">
							<h2 class="tit">Chuoi Hem Quan</h2>
							<p class="address">18 Phan Boi Chau - Hoan Kiem - Hanoi<br>12345 reviews</p>
							<a href="javascript:void(0)" class="news">Spa of the Month</a>
						</div>
					</div>
					<div class="swiper-slide mv__item" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/mv_bg.png">
					</div>
					<div class="swiper-slide mv__item" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/mv_bg.png">
					</div>
				<?php endif;?>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
		</div>
	</section>
	<?php  get_template_part('template/partial/menu-mid') ; ?>
	<section class="section restaurent_list_section">
		<?php  get_template_part('template/partial/breadcrumb') ; ?>
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
									<?php foreach($post_query->posts as $post): ?>

										<div class="item-list-rest ">
											<a href="<?php echo get_the_permalink($post->ID); ?>">
												<div class="image-list">

													<?php if ( has_post_thumbnail($post->ID) ): ?>
														<div class="img restaurant_img" data-background="<?php echo get_the_post_thumbnail_url($post->ID,'full');?>">
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
												<a href="<?php echo get_the_permalink($post->ID); ?>" class="name-res">
													<?php echo $post->post_title; ?>
												</a>
												<span class="add-res">
													<?php
														if ( !empty(get_field('address', $post->ID)) ) {
															echo get_field('address', $post->ID);
														}
													?>
												</span>
												<br/>
												<div class="heartbar">
													<?php
														$post_type = 'spas';
														$average_vote = get_average_vote($post->ID, $post_type);
													?>
													<?php for ($i=1; $i < 6; $i++) : ?>
                        								<?php if($i <= round($average_vote)):?>
                          									<span data-value="<?php echo $i;?>" class="hearted"></span>
								                        <?php else:?>
								                        	<span data-value="<?php echo $i;?>" class="heart"></span>
								                    	<?php endif;?>
													<?php endfor ?>
												</div>
												<span class="viewser"><?php echo getpostviews($post->ID); ?></span>
											</div>
										</div>
									<?php endforeach;?>
								<?php endif;wp_reset_query();?>
							</div>
						</div>
					</div>
					<div class="banner home_banner">
						<?php  get_template_part('template/partial/advertise_private') ; ?>
					</div>
				</div>
				<?php if($mvn_pagenavi['max-paged'] > 1):?>
					<div class="see_more">
						<a href="javascript:;" data-page-type="taxonomy-location" data-key="<?php echo esc_attr($mvn_pagenavi['key']) ?>" data-disable="0" data-max-paged="<?php echo esc_attr($mvn_pagenavi['max-paged']) ?>" data-paged="2" class="btn btn__ajax--loadmore">
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

	</section>
</div>

	<?php get_footer(); ?>
