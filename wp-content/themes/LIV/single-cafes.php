<?php
/**
 * The template for displaying Cafe Detail Page.
 * @package Miyatsu
 * Template Name: Cafe Details
**/ 
?> 
<?php 
	get_header();
	global $wp_query, $post;
	$terms = get_the_terms( $post->ID, 'cafe' );
	$args = array(
		'post_type'			=> 'cafes', 
		'post_status'		=> 'publish',
		'posts_per_page' 	=> -1,
		'orderby' 		=> 'date title',
		'order' 			=> 'DESC', 
		'nopaging' => true,
	);
	if( $terms ) {
		$primary_term = $terms[0];
		$args['tax_query'] = array(
			array(
				'taxonomy'     => $primary_term->taxonomy,
				'field'        => 'slug',
				'terms'        => $primary_term->slug
			)
		
		);
	}
	$post_query = new WP_Query($args);
	wp_reset_query();
	foreach( $post_query->posts as $all_post ) {
		$all_comment_args = array(
			'status' => 'approve',
			'type'  => 'comment',
			'post_type' => 'cafes',
			'post_id' => $all_post->ID,
		);
		$all_comments = get_comments( $all_comment_args );
		$avg_vote = 1;
		if( $all_comments ){
			$comment_point = array();
			foreach( $all_comments as $all_comment ) {
				$rating = get_comment_meta( $all_comment->comment_ID, 'restaurant_rating', true );
				if($rating != ''){
					$comment_point[] = $rating;
				}
			}
			if($comment_point != null){
				if( $post->ID == $all_post->ID ) {
					$current_post_vote = array_sum( $comment_point ) / count( $comment_point );
					$current_comment_point = $comment_point;
				}
				$avg_vote = array_sum( $comment_point ) / count( $comment_point );
			}
			$total_post[$all_post->ID] = $avg_vote;
		}else{
			$total_post[$all_post->ID] = $avg_vote;
		}
	}
	$ranking_array = arsort($total_post);
	$rank = 0;
	foreach( $total_post as $post_id => $vote ) {
		if( $post_id == $post->ID ){
			break;
		}
		$rank++;
	}

	$total_comments = wp_count_comments( $post->ID );
	wp_reset_query();
	setpostview( $post->ID ); 
?>

		



<div class="restaurantArea__details">
	<section class="section restaurent_details_section">
		<?php  get_template_part('template/partial/breadcrumb') ; ?>
		<div class="container">			
			<div class="inner">
				<div class="main">
					<div class="content">
						<div class="restaurant-details">
							<h2 class="title"><?php echo $post->post_title; ?></h2>
							<div class="restaurant-details-add">
								<div class="heartbar">

									<?php 
										if(!$current_post_vote){
											$current_post_vote = 1;
										}
									?>
									<ul id="ratecv">
										<?php for ($i=1; $i < 6; $i++) : ?>
            								<?php if($i <= round($current_post_vote)):?>
            									<li>
            										<span data-value="<?php echo $i;?>" class="hearted"></span>
            									</li>
              									
					                        <?php else:?>
					                        	<li>
					                        		<span data-value="<?php echo $i;?>" class="heart"></span>
					                        	</li>					                        	
					                    	<?php endif;?>
										<?php endfor ?>
										<li>
											<span class="count"><?= $total_comments->approved; ?>  Reviews</span> 
											<span block-sc-pc>
												<strong>
													#<?php echo $rank+1;?>
												</strong> 
												of <?php echo count($total_post);?> Cafe in <?php echo $primary_term->name; ?>
											</span>
										</li>
									</ul>
								</div>
								<div class="ranking" block-sc-sp>								
									<span>
										<strong>
											#<?php echo $rank+1;?>
										</strong> 
										of <?php echo count($total_post);?> Cafe in <?php echo $primary_term->name; ?>
									</span>
								</div>
								<div class="address-details">
									<ul>
										<li class="position">
											<img class="icon-add" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/position.png" alt="">
											<span>
												<a href="#nearby">
													<?php 
														if ( !empty(get_field('address', $post->ID)) ) { 
															echo get_field('address', $post->ID);
														}else{
															echo "Hanoi Vietnam";
														}
													?>
												</a>
											</span>
										</li>
										<li class="opening_hour">
											<img class="icon-add" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/time.png" alt="">
											<span>
											<?php 
												$open_hour = ( !empty( get_field('opening_hour',$post->ID) ) ) ? get_field('opening_hour',$post->ID) : '6h00 AM - 21h00 PM';
											?>
												<a href="#nearby">
													<?php echo $open_hour; ?>
												</a>
											</span>
										</li>
										<li class="phone">
											<img class="icon-add" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/phone.png" alt="">
											<span>
												<a href="tel:<?php echo get_field('hotline', $post->ID); ?>">
													<?php 
														if ( !empty(get_field('hotline', $post->ID)) ) { 
															echo get_field('hotline', $post->ID);
														}else{
															echo '0976056027';
														}
													?>
												</a>
											</span>
										</li>
										<li class="web">
											<img class="icon-add" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/web.png" alt="">
											<span>
												<a href="http://<?php echo get_field('website', $post->ID); ?>" target="_blank" rel="noopener noreferrer">
													<?php 
														if ( !empty(get_field('website', $post->ID)) ) { 
															echo get_field('website', $post->ID);
														}else{
															echo "www.liv.miyatsu.vn";
														}
													?>
												</a>
											</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="restaurant-details-image"  block-sc-pc>
								<div class="restaurant-details-image__list">
									<?php 
										$upper_galleries = get_field('upper_gallery',$post->ID,'option');
										if(!empty($upper_galleries)):
											foreach($upper_galleries as $upper_gallery):
												
									?>
										<div class="restaurant-details-image__list__item">
											<img src="<?php echo mvn_get_attachment_image_src($upper_gallery['ID'],'mvn_484x460');?>" />
										</div>
									<?php 	endforeach;?>
									<?php endif;?>
									
								</div>
								<div class="restaurant-details-image__list">
									<?php 
										$lower_galleries = get_field('lower_gallery',$post->ID,'option');
										if(!empty($lower_galleries)):
											foreach($lower_galleries as $lower_gallery):
												
									?>
									<div class="restaurant-details-image__list__item__big">
										<img src="<?php echo mvn_get_attachment_image_src($lower_gallery['ID'],'mvn_732x250');?>" />
									</div>
									<?php 	endforeach;?>
									<?php endif;?>
								</div>
							</div>
							<div class="restaurant-details-image imgDetails swiper-container"  block-sc-sp>
								<div class="restaurant-details-image__list swiper-wrapper">
									<?php 
										$upper_galleries = get_field('upper_gallery',$post->ID,'option');
										if(!empty($upper_galleries)):
											foreach($upper_galleries as $upper_gallery):
												
									?>
										<div class="restaurant-details-image__list__item swiper-slide">
											<img class="" src="<?php echo mvn_get_attachment_image_src($upper_gallery['ID'],'mvn_484x460');?>" />
										</div>
									<?php 	endforeach;?>
									<?php endif;?>
									
								</div>
								<div class="swiper-pagination"></div>
							</div>
							<div class="restaurant-details-menu">
								<div class="menu-qr-img" block-sc-pc>
									<div class="menu-qr-img__image">

										<?php if ( has_post_thumbnail($post->ID) ): ?>
											<img src="<?php echo mvn_get_attachment_image_src(get_post_thumbnail_id($post->ID),'mvn_200x200'); ?>" alt="">
										<?php else:?>
											<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/menu.png" alt="" />
										<?php endif;?>
										<div class="menu-qr-img__image__text">
											<a href="<?php echo get_field('menu_qr',$post->ID);?>">
												Service
											</a>
										</div>	
									</div>
									<div class="scan__code">
										<span class="text-translate">TRANSLATE YOUR MENU</span>
										<div class="qr__code__img" >
											<?php 
												if(!empty(get_field('menu_qr',$post->ID,'option'))):
													$menu_qr = get_field('menu_qr',$post->ID);
													echo do_shortcode('[vqr msg="'.$menu_qr.'" size="147" /]');
												
											?>
											<?php else :?>
												<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_details/qr-code.png" alt="qr code" class="qr-code">
											<?php endif;?>
											
										</div>
										
										<span>SCAN THE CODE WITH YOUR SMART PHONE
										AND GET MENU</span>
									</div>
								</div>
								<div class="menu-qr-img" block-sc-sp>
									<a href="<?php echo get_field('menu_qr',$post->ID);?>" class="menu-qr-img__link">
										<div class="menu-qr-img__link__image">
											<?php if ( has_post_thumbnail($post->ID) ): ?>
											<img src="<?php echo mvn_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full'); ?>" alt="">
											<?php else:?>
												<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/menu.png" alt="" />
											<?php endif;?>
											<div class="menu-qr-img__link__image__text">
												Menu
											</div>	
										</div>
									</a>
								</div>								
							</div>
							<div class="restaurant-details-content-tab">
								<nav class="navigation" id="restaurantNav" block-sc-pc>
									<a class="navigation__link" href="#details">OVERVIEW</a>
									<a class="navigation__link" href="#amenities">AMENITIES</a>
									<a class="navigation__link" href="#reviews">REVIEWS</a>									
									<a class="navigation__link" href="#nearby">NEARBY</a>
								</nav>
								
								<div class="page-section content" id="details" >
									<div class="tab-details-top">
										<h3>Overview</h3>										
									</div>
									<div class="tab-details-content">
										<?php echo apply_filters('the_content', get_post_field('post_content',  $post->ID )); ?>
									</div>
								</div>
								<div class="page-section content" id="amenities" >
									<div class="tab-details-top">
										<h3>Amenities</h3>										
									</div>
									<div class="tab-details-content">
										<p>
											<?php 
												if(!empty(get_field('amenities',$post->ID))){
													echo  get_field('amenities',$post->ID);
												}
											?>
										</p>
									</div>
								</div>
								<div class="page-section hero" id="reviews">
									<div class="tab-review-top">
										<h3>Review</h3>
										<a href="#" class="button-write-review" block-sc-pc>Write a review</a>
									</div>
									<div class="tab-review-point">										
										<div class="heartbar">											
											<ul>
												<?php if($current_post_vote): ?>
												<li>
													<h2>
														<?php echo round($current_post_vote);?>
													</h2>
												</li>
												<?php for ($i=1; $i < 6; $i++) : ?>
                    								<?php if($i <= round($current_post_vote ? $current_post_vote : '1')):?>
                    									<li>
                    										<span data-value="<?php echo $i;?>" class="hearted"></span>
                    									</li>
                      									
							                        <?php else:?>
							                        	<li>
							                        		<span data-value="<?php echo $i;?>" class="heart"></span>
							                        	</li>
							                    	<?php endif;?>
												<?php endfor ?>
												<?php endif;?>
												<li><span><?= $total_comments->approved; ?> Reviews</span></li>
											</ul>
											<?php 
												if($current_comment_point):
													$rating_count = array_count_values($current_comment_point);
													$total_rating = count($current_comment_point);
													$excellent = 0;
													$good = 0;
													$average = 0;
													$poor = 0;
													$terrible = 0;
													if( isset($rating_count['5']) ) {
														$excellent = $rating_count['5']/$total_rating*100;
													}
													if( isset($rating_count['4']) ){
														$good = $rating_count['4']/$total_rating*100;
													}
													if( isset($rating_count['3']) ){
														$average = $rating_count['3']/$total_rating*100;
													}
													if( isset($rating_count['2']) ){
														$poor = $rating_count['2']/$total_rating*100;
													}
													if( isset($rating_count['1']) ){
														$terrible = $rating_count['1']/$total_rating*100;
													}
													
											?>		
												<ul class="percent top">
													<li><p>Excellent</p></li>
													<li>
														<div class="box-total-percent">
															<div class="box-percentage w<?php echo round($excellent);?>"></div>
														</div>
													</li>
													<li><p class="number-percent"><?php echo round($excellent);?>%</p></li>
												</ul>
												<ul class="percent">
													<li><p>Very Good</p></li>
													<li>
														<div class="box-total-percent">
															<div class="box-percentage w<?php echo round($good);?>"></div>
														</div>
													</li>
													<li><span><?php echo round($good);?>%</span></li>
												</ul>
												<ul class="percent">
													<li><p>Average</p></li>
													<li>
														<div class="box-total-percent">
															<div class="box-percentage w<?php echo round($average);?>"></div>
														</div>
													</li>
													<li><span><?php echo round($average);?>%</span></li>
												</ul>
												<ul class="percent">
													<li><p>Poor</p></li>
													<li>
														<div class="box-total-percent">
															<div class="box-percentage w<?php echo round($poor);?>"></div>
														</div>
													</li>
													<li><span><?php echo round($poor);?>%</span></li>
												</ul>
												<ul class="percent">
													<li><p>Terrible</p></li>
													<li>
														<div class="box-total-percent">
															<div class="box-percentage w<?php echo round($terrible);?>"></div>
														</div>
													</li>
													<li><span><?php echo round($terrible);?>%</span></li>
												</ul>
											<?php else:?>
												<ul class="percent top">
													<li><p>Excellent</p></li>
													<li>
														<div class="box-total-percent">
															<div class="box-percentage w0"></div>
														</div>
													</li>
													<li><p class="number-percent">0%</p></li>
												</ul>
												<ul class="percent">
													<li><p>Very Good</p></li>
													<li>
														<div class="box-total-percent">
															<div class="box-percentage w0"></div>
														</div>
													</li>
													<li><span>0%</span></li>
												</ul>
												<ul class="percent">
													<li><p>Average</p></li>
													<li>
														<div class="box-total-percent">
															<div class="box-percentage w0"></div>
														</div>
													</li>
													<li><span>0%</span></li>
												</ul>
												<ul class="percent">
													<li><p>Poor</p></li>
													<li>
														<div class="box-total-percent">
															<div class="box-percentage w0"></div>
														</div>
													</li>
													<li><span>0%</span></li>
												</ul>
												<ul class="percent">
													<li><p>Terrible</p></li>
													<li>
														<div class="box-total-percent">
															<div class="box-percentage w0"></div>
														</div>
													</li>
													<li><span>0%</span></li>
												</ul>
											<?php endif;?>
										</div>
									</div>
									<?php comments_template( '/comments.php' ); ?> 
									<div class="btn-sp">
										<button type="submit" class="button-write-review " block-sc-sp>Write a review</button>
									</div>
									<div class="form-reviews-comment hide">
										<div class="form-reviews hide">
											<div class="travel-rating">
												<h3>Traveler Rating</h3>
												<div class="reviewform">
													<input type="checkbox" name="rating" value="5" id="excellent">			
													<label for="excellent">
													Excellent
													</label>
												</div>
												<div class="reviewform">
													<input type="checkbox" name="rating" value="4" id="verygood">			
													<label for="verygood">														
														Very good
													</label>
												</div>
												<div class="reviewform">
													<input type="checkbox" name="rating" value="3" id="average">	
													<label for="average">																
														Average
													</label>
												</div>
												<div class="reviewform">
													<input type="checkbox" name="rating" value="2" id="poor">
													<label for="poor">																	
														Poor
													</label>
												</div>
												<div class="reviewform">
													<input type="checkbox" name="rating" value="1" id="terrible">	
													<label for="terrible">																
														Terrible
													</label>
												</div>
											</div>
											<div class="travel-type">
												<h3>Traveler Type</h3>
												<div class="reviewform">
													<input type="checkbox" name="type" value="families" id="families">
													<label for="families">																
														Families
													</label>
												</div>
												<div class="reviewform">
													<input type="checkbox" name="type" value="couples" id="couples">
													<label for="couples">
														
														Couples
													</label>
												</div>
												<div class="reviewform">
													<input type="checkbox" name="type" value="solo" id="solo">		
													<label for="solo">
														
														Solo
													</label>
												</div>
												<div class="reviewform">
													<input type="checkbox" name="type" value="business" id="business">
													<label for="business">
														
														Business
													</label>
												</div>
												<div class="reviewform">
													<input type="checkbox" name="type" value="friends" id="friends">	
													<label for="friends">
														
														Friends
													</label>
												</div>
											</div>
										</div>
										<form enctype="multipart/form-data" method="post" data-type="review" id="restaurant_review" class="customForm restaurant_review" data-user-id="<?php echo get_current_user_id();?>" data-post-id="<?= $post->ID; ?>" data-url="<?php echo site_url() ?>/wp-admin/admin-ajax.php"">
											<textarea id="comment" name="comment" placeholder="Leave a Comment" rows="5"></textarea>
											<p id="comment_error" class="log_error"></p>
											<input type="text" id="name" name="input_name" placeholder="Name*" required>
											<p id="name_error" class="log_error"></p>
											<input type="hidden" id="restaurant_rating" name="restaurant_rating" value="" />
											<input type="hidden" id="travel_type" name="travel_type" value="" />
											<input type="email" id="email" name="input_email" placeholder="Email*" required>
											<p id="email_error" class="log_error"></p>
											<input type="file" name="user_avatar" id="user_avatar" />
											<p>Upload your avatar ( support JPG,JPEG,PNG file ,max size 10mb</p>
											<p id="file_error" class="log_error"></p>
											<div class="g-recaptcha" data-sitekey="6LeMwJYUAAAAAJ3cUISBORqTfMdl5fF4WIw_hYyH"></div><br>
											<p id="captcha_error" class="log_error"></p>
											<div class="button_form">
												<button class="submit-button" >Submit</button>
												<button class="cancel_button">Cancel</button>
											</div>
											
										</form>
										<?php  get_template_part('template/partial/thanks_page') ; ?>
									</div>
								</div>
								<div class="page-section" id="nearby">
									<?php 
										if(!empty(get_field('google_map',$post->ID,'option'))):
									?>
										<div class="tab-nearby-top">
											<h3>Nearby</h3>										
										</div>
										<div class="tab-nearby-map">
											<?php 
												echo get_field('google_map',$post->ID,'option');
											?>
										</div>
									<?php endif;?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>

