<?php
/**
 * The template for displaying Touris Detail Page.
 * @package Miyatsu
 * Template Name: Touris Details
**/ 
?> 
<?php get_header(); ?>
<?php
setpostview(get_the_ID()); 
?>
<div class="tourisArea">
	<section class="section touris_details_section">
		<?php  get_template_part('template/partial/breadcrumb') ; ?>
		<div class="container">
			<div class="touris-top-page">
				<h2 class="title"><?php echo $post->post_title; ?></h2>
				<div class="touris-details-add">
					<div class="address-details">
						<ul block-sc-pc>
							<li class="user-post">
								<span>By <span class="author"><?php echo the_author_meta('display_name',$post->post_author) ; ?></span> - <?php echo get_the_date('d.m.Y',$post->ID);?></span>
							</li>
							<li class="view-count">
								<span><?php echo getpostviews($post->ID); ?></span>
							</li>
							<li class="like-count">
								<span class="total_like">
									<?php 
		                                if (function_exists('wp_ulike_get_post_likes')):
		                                  echo wp_ulike_get_post_likes($post->ID);
		                                else:
		                                  echo " 0 like";
		                                endif;
      								?>
								</span>
							</li>
						</ul>
						<ul block-sc-sp>
							<li class="user-post">
								<span>By <span class="author"><?php echo the_author_meta('display_name',$post->post_author) ; ?></span> - <?php echo get_the_date('d.m.Y',$post->ID);?></span>
							</li>
							<li class="view-count">
								<span class="view"><?php echo getpostviews($post->ID); ?></span>
								<span class="total_like">
									<?php 
		                                if (function_exists('wp_ulike_get_post_likes')):
		                                  echo wp_ulike_get_post_likes($post->ID);
		                                else:
		                                  echo " 0 like";
		                                endif;
      								?>
								</span>
							</li>
						</ul>
					</div>
					<div class="address-details">
						<ul>
							<li class="position">
								<img class="icon-add" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/position.png" alt="">
								<?php if ( !empty(get_field('destination')) ) : ?>
									<span class="position__txt"><?php echo get_field('destination');?></span>
								<?php else:?>
									<span class="position__txt">Hanoi - Halong</span>
								<?php endif;?>
								
							</li>
							<li class="money">
								<img class="icon-add" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/touris_details/money.png" alt="">
								<?php if ( !empty(get_field('price')) ) : ?>
									<span class="money__txt"><?php echo get_field('price');?></span>
									
								<?php else:?>
									<span class="money__txt">$500 - $700</span>
								<?php endif;?>
								
							</li>
							<li class="calender">
								<img class="icon-add" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/touris_details/calendar.png" alt="">
								<?php if ( !empty(get_field('length')) ) : ?>
									<span class="calender__txt"><?php echo get_field('length');?> days</span>
									
								<?php else:?>
									<span class="calender__txt">7 days</span>
								<?php endif;?>								
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container">			
			<div class="inner">
				<div class="main">
					<div class="content">
						<div class="touris-details">							
							<div class="touris-details-content">
								<?php if ( has_post_thumbnail($post->ID) ): ?>
									<div class="img tourism_details_img" data-background='<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>'></div>	
									<span class="title-img"><?php get_post_meta(get_post_thumbnail_id($post->ID),'_wp_attachment_image_alt','true'); ?></span>
								<?php endif;?>
								
								<div class="text-content">
									<?php echo apply_filters('the_content', get_post_field('post_content',  $post->ID )); ?>
								</div>

								<div class="touris-gallery">
									<div class="swiper-container gallery-top">
										<div class="swiper-wrapper">
											<?php if ( !empty(get_field('gallery', $post->ID)) ): ?>
												<?php foreach(get_field('gallery', $post->ID) as $image):?>
													<div class="swiper-slide gallery__item">
														<img src="<?php echo mvn_get_attachment_image_src($image['ID'],'mvn_1150x500');?>" block-sc-pc/>
														<div class="img tourism_details_img" data-background='<?php echo mvn_get_attachment_image_src($image['ID'],'full');?>' block-sc-sp></div>
													</div>
												<?php endforeach;?>
											<?php endif;?>
										</div>
										<div class="swiper-pagination"></div>
										<!-- Add Arrows -->
									</div>
									<div class="swiper-container gallery-thumbs" block-sc-pc>
										<div class="swiper-wrapper">
											<?php if ( !empty(get_field('gallery', $post->ID)) ): ?>
												<?php foreach(get_field('gallery', $post->ID) as $image):?>
													<div class="swiper-slide gallery__item">
														<img src="<?php echo mvn_get_attachment_image_src($image['ID'],'mvn_272x200');?>" />
													</div>
												<?php endforeach;?>
											<?php endif;?>
										</div>
									</div>
								</div>
								<div class="tag-post">									
									<?php $tags = wp_get_post_tags($post->ID); ?>
									<?php if($tags): ?>
										<a class="tags_name">TAGS</a>
										<?php foreach($tags as $tag): ?>
											<a href="<?php echo get_term_link($tag->term_id);?>" class="tags"><?php echo $tag->name; ?></a>
										<?php endforeach;?>
									<?php endif;?>
								</div>
								<div class="social">
									<div class="social__item social__item__like" >
										<?php
											if(function_exists('wp_ulike')){
												echo do_shortcode('[wp_ulike]');
											}
										?>
									</div>
									<div class="social__item social__item__share">
										<?php
											if(function_exists('mashshare')){
												echo do_shortcode('[mashshare]');
											}
										?>
										
									</div>
									<div class="social__item social__item__comment">
										<span>Comment</span>
									</div>
								</div>
							</div>
							<div class="tourism-details-comment">
								<div class="page-section hero">
									<?php comments_template( '/comments.php' ); ?> 
								</div>
							</div>
							<h2 class="title">Related Tours</h2>
							<div class="related-tours">
								<?php global $wp_query, $post;
									$post_id = $post->ID;
									$post_args = array(
										'post_status' => 'publish',
										'post_type' => 'tours', //CHANGE IT
										'posts_per_page' => 2,
										'orderby' => 'date',
										'order' => 'DESC',
										'post__not_in' => array( $post_id ),
									);
									$related_posts = new WP_Query($post_args);
								?>
								<?php if($related_posts->have_posts()): ?>
									<?php foreach($related_posts->posts as $r_post):?>
										<article class="article">
											<a href="<?php echo get_the_permalink($r_post->ID); ?>">
												<?php if ( has_post_thumbnail($r_post->ID) ): ?>
													<div class="img img_tour" data-background='<?php echo get_the_post_thumbnail_url($r_post->ID,'full') ?>'>
													</div>
												<?php else:?>
													<div class="img img_tour" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
													</div>
												<?php endif;?>
											</a>
											<div class="box">
												<h3 class="ttl">
													<a href="<?php echo get_the_permalink($r_post->ID); ?>">
														<?php echo $r_post->post_title; ?>													
													</a>
												</h3>
												<div class="rate">
													<span class="view"><?php echo getpostviews($r_post->ID); ?></span>
													<span class="like">
														<?php 
							                                if (function_exists('wp_ulike_get_post_likes')):
							                                  echo wp_ulike_get_post_likes($r_post->ID);
							                                else:
							                                  echo " 0 like";
							                                endif;
                          								?>
													</span>
												</div>
											</div>
										</article>
									<?php endforeach;?>
								<?php endif;wp_reset_query();?>
								
							</div>
							
						</div>						
					</div>
				</div>
			</div>
			<div class="banner home_banner">
				<?php  get_template_part('template/partial/rightside') ; ?>	
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>