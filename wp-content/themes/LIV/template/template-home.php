<?php
/**
 * The template for displaying Home Page.
 * @package Miyatsu
 * Template Name: Home
**/


?>

<?php get_header(); ?>

<div class="homeArea">
	<section class="mvArea">
		<div class="slick_mv" id="home_mv">
			<?php
				if ( !empty(get_field('slider_advertise')) ) :
					$sliders =  get_field('slider_advertise');
					foreach($sliders as $slider):
			?>

					<?php echo adrotate_ad($slider['advertise_id']); ?>
					
					<?php endforeach;?>
			<?php endif;?>
		</div>
		
		
	</section>
	<section class="section">
		<div class="container">
			<div class="inner">
				<div class="advertising">
					<div class="img weather">
						<?php $weather_widget = weather_widget();?>
						<?php if($weather_widget != false):?>
							<?php foreach($weather_widget->list as $weather):?>
								<div class="weather__block">
									<h2><?php echo round($weather->main->temp);?>°C</h1>
									<?php if($weather->name == 'Turan') :?>
										<p><?= 'Da Nang';?></p>
									<?php elseif($weather->name == 'Thanh pho Ho Chi Minh'):?>
										<p><?= 'Tp HCM';?></p>
									<?php else:?>
										<p><?= 'Hanoi';?></p>
									<?php endif;?>
								</div>
							<?php endforeach;?>
						<?php endif;?>
					</div>

					<?php $currency_widget = currency_widget();?>
					<?php if($currency_widget != false):?>
						<div class="img currency">
							<div class="currency__block">
								<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/vietnam_flag.jpg" />
								<p><?php echo number_format(round($currency_widget->quotes->USDVND));?><br>VND</p>
							</div>
							<div class="currency__block">
								<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/korean_flag.jpg" />
								<p><?php echo number_format(round($currency_widget->quotes->USDKRW));?><br>KRW</p>
							</div>
							<div class="currency__block">
								<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/usa_flag.jpg" />
								<p>1 <br> USD</p>
							</div>

						</div>
					<?php endif;?>
				</div>
				<div class="main">
					<?php  get_template_part('template/partial/aside') ; ?>
					<div class="content">
						<div class="slidebox" block-sc-sp>
							<div class="slidebox__block"><a href="<?php echo get_site_url();?>/ha-noi" class="block_link">Hanoi</a></div>
							<div class="slidebox__block"><a href="<?php echo get_site_url();?>/ho-chi-minh" class="block_link">Ho Chi Minh <br>City</a></div>
							<div class="slidebox__block"><a href="<?php echo get_site_url();?>/da-nang" class="block_link">Da Nang</a></div>
						</div>
						<div class="new_info">
							<?php
								global $post, $wp_query;

								$new_args = array(
									'post_status' 		=> 'publish',
									'post_type' 		=> 'news', //CHANGE IT
									'posts_per_page' 	=> 3,
									'orderby' 			=> 'date',
									'order' 			=> 'DESC',
								);
									$news_query = new WP_Query($new_args);
							?>
									<div class="title">
										<a href="<?php echo get_site_url();?>/news-info" block-sc-pc>News info</a>
										<p class="link-default" block-sc-sp>News info</p>
										<a href="<?php echo get_site_url();?>/news-info" class="see-all" block-sc-sp><span class="txt">See all</span></a>
									</div>
									<ul class="list">
										<?php if( $news_query->have_posts() ) : ?>
											<?php foreach($news_query->posts as $new):?>
												<li class="item">
													<a href="<?php echo get_the_permalink($new->ID); ?>">
														<?php if ( has_post_thumbnail($new->ID) ): ?>
															<div class="img" data-background='<?php echo get_the_post_thumbnail_url($new->ID,'full') ?>'>
															</div>
														<?php else:?>
															<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
															</div>
														<?php endif;?>
													</a>
													<div class="box">
														<h3 class="ttl">
															<a href="<?php echo get_the_permalink($new->ID); ?>">
																<?php echo get_the_title($new->ID); ?>
															</a>
														</h3>
														<p class="date"><?php echo get_the_date('d.m.Y',$new->ID) ?></p>
														<p class="desc">
															<?php echo wp_trim_words(apply_filters('the_content', get_post_field('post_content',  $new->ID )),'30'); ?>
														</p>
														<p class="view"><?php echo getpostviews($new->ID); ?></p>
													</div>
												</li>
											<?php endforeach;?>
										<?php endif;wp_reset_query();?>
									</ul>
									<?php if (wp_is_mobile() ) {
										get_template_part('template/partial/bannerA1') ;
									}
									?>
								</div>
								
								<div class="issue">
									<div class="title">
										<a href="<?php echo get_site_url();?>/issue" block-sc-pc>Issues</a>
										<p class="link-default" block-sc-sp>Issues</p>
										<a href="<?php echo get_site_url();?>/issue" class="see-all" block-sc-sp><span class="txt">See all</span></a>
									</div>
									<?php
										global $post, $wp_query;

										$issues_args = array(
											'post_status' 		=> 'publish',
											'post_type' 		=> 'issues', //CHANGE IT
											'posts_per_page' 	=> 5,
											'orderby' 			=> 'date',
											'order' 			=> 'DESC',
										);
										$issues_query = new WP_Query($issues_args);
									?>
									<?php if( $issues_query->have_posts() ) : ?>
										<?php foreach($issues_query->posts as $issue):?>
											<article class="article">
												<div class="box-l">
													<h3 class="ttl">
														<a href="<?php echo get_the_permalink($issue->ID); ?>"><?php echo get_the_title($issue->ID); ?></a>
													</h3>
													<h4 class="subttl">
														<?php
															if ( !empty(get_field('real_author', $issue->ID)) ) {
																echo '<span>'.get_field('real_author', $issue->ID).'</span>';
															}else{
																echo '<span>Admin</span>';
															}
														?>
														|
														<?php
															if ( !empty(get_field('author_nationality', $issue->ID)) ) {
																echo '<span>'.get_field('author_nationality', $issue->ID).'</span>';
															}else{
																echo '<span>Korean</span>';
															}
														?>

													</h4>
												</div>
												<div class="box-r">
													<button class="like">
														Thanks to
														<?php
															if ( !empty(get_field('real_author', $issue->ID)) ) {
																echo '<span>'.get_field('real_author', $issue->ID).'</span>';
															}else{
																echo '<span>Admin</span>';
															}
														?>
													</button>
													<p class="view"><?php echo getpostviews($issue->ID); ?></p>
												</div>
											</article>
										<?php endforeach;?>
									<?php endif;wp_reset_query();?>									
								</div>
								<div class="life_info">
									<?php if (wp_is_mobile() ) {
										get_template_part('template/partial/bannerA2') ;
									}
									?>
									<div class="title">
										<a href="<?php echo get_site_url();?>/lifes-info" block-sc-pc>Life info</a>
										<p class="link-default" block-sc-sp>Life info</p>
										<a href="<?php echo get_site_url();?>/lifes-info" class="see-all" block-sc-sp><span class="txt">See all</span></a>
									</div>	

									<?php
										global $post, $wp_query;

										$life_args = array(
											'post_status' 		=> 'publish',
											'post_type' 		=> 'lifes', //CHANGE IT
											'posts_per_page' 	=> 6,
											'orderby' 			=> 'date',
											'order' 			=> 'DESC',
										);
										$lifes_query = new WP_Query($life_args);
									?>
									<div class="articleArea" block-sc-pc>
										<?php if( $lifes_query->have_posts() ) : ?>
											<?php foreach($lifes_query->posts as $life):?>
												<article class="article swiper-slide">
													<a href="<?php echo get_the_permalink($life->ID); ?>">
														<?php if ( has_post_thumbnail($life->ID) ): ?>
															<div class="img" data-background='<?php echo get_the_post_thumbnail_url($life->ID,'full') ?>'>
															</div>
														<?php else:?>
															<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
															</div>
														<?php endif;?>
													</a>

													<div class="box">
														<h3 class="ttl">
															<a href="<?php echo get_the_permalink($life->ID); ?>">
																<?php echo get_the_title($life->ID); ?>
															</a>
														</h3>
														<div class="rate">
															<p class="view"><?php echo getpostviews($life->ID); ?></p>
															<p class="likes">
																<?php
																	if (function_exists('wp_ulike_get_post_likes')):
																		echo wp_ulike_get_post_likes($life->ID);
																	else:
																		echo " 0 like";
																	endif;
																?>
															</p>
														</div>
													</div>
											</article>
											<?php endforeach;?>
										<?php endif;wp_reset_query();?>
									</div>
									<div class="articleArea articleAreasp swiper-container" block-sc-sp>
										<div class="swiper-wrapper">
											<?php if( $lifes_query->have_posts() ) : ?>
												<?php foreach($lifes_query->posts as $life):?>
													<article class="article swiper-slide">
														<a href="<?php echo get_the_permalink($life->ID); ?>">
															<?php if ( has_post_thumbnail($life->ID) ): ?>
															<div class="img" data-background='<?php echo get_the_post_thumbnail_url($life->ID,'full') ?>'>
															</div>
															<?php else:?>
																<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
																</div>
															<?php endif;?>
														</a>
														<div class="box">
															<h3 class="ttl">
																<a href="<?php echo get_the_permalink($life->ID); ?>">
																	<?php echo get_the_title($life->ID); ?>
																</a>
															</h3>
															<div class="rate">
																<p class="view"><?php echo getpostviews($life->ID); ?></p>
																<p class="likes">
																	<?php
																	if (function_exists('wp_ulike_get_post_likes')):
																		echo wp_ulike_get_post_likes($life->ID);
																	else:
																		echo " 0 like";
																	endif;
																	?>
																</p>
															</div>
														</div>
													</article>
												<?php endforeach;?>
											<?php endif;wp_reset_query();?>
										</div>
										<div class="swiper-pagination"></div>
									</div>
									<?php if (wp_is_mobile() ) {
										get_template_part('template/partial/bannerB');
									}
									?> 
								</div>
							</div>
					</div>
				</div>
				<div class="banner home_banner">
					<?php get_template_part( 'template/partial/rightside' ); ?>
				</div>
		</section>
	</div>
<?php get_footer(); ?>

