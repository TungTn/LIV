<?php
/**
 * The template for displaying Issue Detail Page.
 * @package Miyatsu
 * Template Name: Issue Details
**/ 
?> 
<?php get_header(); ?>
<?php
setpostview(get_the_ID()); 
?>
<div class="issue_details_Area">
	<section class="section issue_details_section">
		<?php  get_template_part('template/partial/breadcrumb') ; ?>
		<div class="container">
			<div class="issue-top-page">
				<h2 class="title"><?php echo $post->post_title; ?></h2>
				<div class="issue-details-add">
					<div class="address-details">
						<ul block-sc-pc>
							<li class="user-post">
								<span>By <span class="author"><?php 
								if ( !empty(get_field('real_author', $post->ID)) ) {
									echo '<span>'.get_field('real_author', $post->ID).'</span>'; 
								}?>
								-
								<?php 
								if ( !empty(get_field('author_nationality', $post->ID)) ) {
									echo '<span>'.get_field('author_nationality', $post->ID).'</span>'; 
								}
								?> </span>
								- <?php echo get_the_date('d.m.Y',$post->ID);?></span>
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
								<span>By <span class="author"><?php 
								if ( !empty(get_field('real_author', $post->ID)) ) {
									echo '<span>'.get_field('real_author', $post->ID).'</span>'; 
								}?>
								-
								<?php 
								if ( !empty(get_field('author_nationality', $post->ID)) ) {
									echo '<span>'.get_field('author_nationality', $post->ID).'</span>'; 
								}
								?> </span>
								- <?php echo get_the_date('d.m.Y',$post->ID);?></span>
							</li>
							<li class="view-count">
								<p>
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
								</p>
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
						<div class="issue-details">							
							<div class="issue-details-content">
								<?php if ( has_post_thumbnail($post->ID) ): ?>
									<div class="img issue_details_img" data-background='<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>'></div>	
									<span class="title-img"><?php get_post_meta(get_post_thumbnail_id($post->ID),'_wp_attachment_image_alt','true'); ?></span>
								<?php endif;?>
								<div class="text-content">
									<?php echo apply_filters('the_content', get_post_field('post_content',  $post->ID )); ?> 
								</div>
								<div class="issue-gallery">
									<div class="swiper-container gallery-top">
										<div class="swiper-wrapper">
											<?php if ( !empty(get_field('gallery_image', $post->ID)) ): ?>
												<?php foreach(get_field('gallery_image', $post->ID) as $image):?>
													<div class="swiper-slide gallery__item">
														<img src="<?php echo mvn_get_attachment_image_src($image['ID'],'mvn_1150x500');?>" block-sc-pc/>
														<div class="img issue_details_img" data-background='<?php echo mvn_get_attachment_image_src($image['ID'],'full');?>' block-sc-sp></div>
													</div>
												<?php endforeach;?>
											<?php endif;?>
										</div>
										<div class="swiper-pagination"></div>
										<!-- Add Arrows -->
									</div>
									<div class="swiper-container gallery-thumbs" block-sc-pc>
										<div class="swiper-wrapper">
											<?php if ( !empty(get_field('gallery_image', $post->ID)) ): ?>
												<?php foreach(get_field('gallery_image', $post->ID) as $image):?>
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
							<div class="issue-details-comment">
								<div class="page-section hero">
									<?php comments_template( '/comments.php' ); ?> 
									
									<?php get_template_part('template/partial/thanks_page') ; ?>
								</div>
							</div>
							<h2 class="title">Related Issues</h2>
							<div class="related-issue">
								<ul class="list">
									<?php global $wp_query, $post;
									$post_id = $post->ID;
									$post_args = array(
										'post_status' => 'publish',
											'post_type' => 'issues', //CHANGE IT
											'posts_per_page' => 3,
											'orderby' => 'date',
											'order' => 'DESC',
											'post__not_in' => array( $post_id ),
										);
									$related_posts = new WP_Query($post_args);
									?>
									<?php if($related_posts->have_posts()): ?>
										<?php foreach($related_posts->posts as $r_post):?>
											<li class="item">
												<div class="in">
													<h3 class="tit">
														<a href="<?php echo get_the_permalink($r_post->ID); ?>">
															<?php echo $r_post->post_title; ?>
														</a>
													</h3>
													<p class="user-post">
														<span class="author">
															<?php 
																if ( !empty(get_field('real_author', $r_post->ID)) ) {
																	echo '<span>'.get_field('real_author', $r_post->ID).'</span>'; 
																}
															?>
																
														</span>  
														<?php 
														if ( !empty(get_field('author_nationality', $r_post->ID)) ) {
															echo '<span>'.get_field('author_nationality', $r_post->ID).'</span>'; 
														}
														?>
													</p>
													<p class="txt">
														<?php 
														if($r_post->post_content){
															$content = wp_strip_all_tags($r_post->post_content);
															$content = mb_substr($content, 0, 200);
															echo $content.'...';
														}
														
														?>
													</p>
												</div>
											</li>
										<?php endforeach;?>
									<?php endif;?>
								</ul>							
							</div>
							
						</div>						
					</div>
				</div>
			</div>
			<div class="banner home_banner"><?php get_template_part( 'template/partial/rightside' ); ?></div>	
		</div>
	</section>
</div>

<?php get_footer(); ?>