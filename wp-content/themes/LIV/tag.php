
<?php get_header(); ?>
<div class="lifeInforArea">
	<!-- <section class="mvArea">
		<div class="swiper-container mv" id="mv">
			<div class="swiper-wrapper">
				<div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/mv_bg.png'>
					<div class="content">
						<h2 class="tit">Season of white lotus</h2>
						<p class="date">12345 views  |  326 likes</p>
					</div>
				</div>
				<div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/mv_bg.png'>
					<div class="content">
						<h2 class="tit">Season of white lotus</h2>
						<p class="date">12345 views  |  326 likes</p>
					</div>
				</div>
				<div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/mv_bg.png'>
					<div class="content">
						<h2 class="tit">Season of white lotus</h2>
						<p class="date">12345 views  |  326 likes</p>
					</div>
				</div>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</section> -->
	<section class="section life_section">
		<?php  get_template_part('template/partial/breadcrumb') ; ?>
		<div class="container">
			<div class="inner">
				<div class="main">
					<?php  get_template_part('template/partial/aside') ; ?>
					<div class="content">
						<div class="info">

							<div class="dropdown">
								<?php 
									$tag = $wp_query->get_queried_object();
								?>
								<form id="sort_select_form" data-tag="<?php echo $tag->slug; ?>" data-post-type="tag" data-post-per-page="14" method="post" data-page-type="lifes" data-url="<?php echo site_url() ?>/wp-admin/admin-ajax.php">
									<select class="sort_select icondown" name="sort">									
										<option value="DESC">Lastest</option>
										<option value="ASC">Oldest</option>
									</select>
									<i class="chevron-down"></i>
								</form>
							</div>
							<h3 class="searched_tag" block-sc-sp>Tagged with : "<?php echo $tag->name;?>"</h3>
							<ul class="list life-list">
								<?php
								global $mvn_pagenavi, $mvn_blog, $wp_query;
									// Wp_query get post
								$order = isset($_GET['sort']) ? $_GET['sort'] : 'DESC';
								$post_per_page = 14;
								$number_loadmore = 2;
								$args = array(
									'tag'				=> $tag->slug,
									'post_type'			=> array('news','lifes','issues','tours'),
									'post_status'		=>'publish',
									'posts_per_page' 	=> $post_per_page,
									'offset'           	=> 0,
									'orderby'          	=> 'date title',
									'order'            	=> $order,
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
								?>
								<?php if($post_query->have_posts()):?>
									<?php foreach($post_query->posts as $key => $post): ?>
										
										<?php if($key == 0):?>
											<li class="item item__first">
												<a href="<?php echo get_the_permalink($post->ID); ?>">
													<div class="image-list">
														<div class="mnv__post__category">
															<?php 
																switch ($post->post_type) {
																	case 'news':
																		echo 'News';
																		break;
																	case 'tours':
																		echo 'Tourism';
																		break;
																	case 'lifes':
																		echo 'Blog Post';
																		break;
																	case 'issues':
																		echo 'Issues';
																		break;
																	default :
																		echo "Post";
																}
															?>
														</div>

														<?php if ( has_post_thumbnail($post->ID) ): ?>
															<div class="img" data-background="<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>">
																
															</div>
														<?php else:?>
															<div class="img" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png">
																
															</div>
														<?php endif;?>
														
														

													</div>
												</a>
												<div class="content">
													<a href="<?php echo get_the_permalink($post->ID); ?>">
														<span class="name"><?php echo $post->post_title; ?></span>
													</a>
													<div class="cmt">
														<span class="viewser"><?php echo getpostviews($post->ID); ?></span>
														<span class="likes">
															<?php
																if (function_exists('wp_ulike_get_post_likes')):
																	echo wp_ulike_get_post_likes($post->ID);
																else:
																	echo " 0 like";
																endif;
															?>
														</span>
													</div>
												</div>
											</li>
										<?php else:?>
											<li class="item">
												<a href="<?php echo get_the_permalink($post->ID); ?>">
													<div class="image-list">
														<div class="mnv__post__category">
															<?php 
																switch ($post->post_type) {
																	case 'news':
																		echo 'News';
																		break;
																	case 'tours':
																		echo 'Tourism';
																		break;
																	case 'lifes':
																		echo 'Blog Post';
																		break;
																	case 'issues':
																		echo 'Issues';
																		break;
																	default :
																		echo "Post";
																}
															?>
														</div>
														<?php if ( has_post_thumbnail($post->ID) ): ?>
															<div class="img" data-background="<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>">
																
															</div>
														<?php else:?>
															<div class="img" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png">
																
															</div>
														<?php endif;?>
													</div>
												</a>
												<div class="content">
													<a href="<?php echo get_the_permalink($post->ID); ?>">
														<p class="name"><?php echo $post->post_title; ?></p>
														
													</a>
													<div class="cmt">
														<span class="viewser"><?php echo getpostviews($post->ID); ?></span>
														<span class="likes">
															<?php
															if (function_exists('wp_ulike_get_post_likes')):
																echo wp_ulike_get_post_likes($post->ID);
															else:
																echo " 0 like";
															endif;
															?>
														</span>
													</div>
												</div>
											</li>								
										<?php endif;?>
										
									<?php endforeach; ?>
								<?php endif;wp_reset_query(); ?>

							</ul>
						</div>
						<?php if($mvn_pagenavi['max-paged'] > 1):?>
							<div class="see_more">
								<a  data-page-type="life-info"  data-sort="DESC" data-key="<?php echo esc_attr($mvn_pagenavi['key']) ?>" data-disable="0" data-max-paged="<?php echo esc_attr($mvn_pagenavi['max-paged']) ?>" data-paged="2" class="btn btn__ajax--loadmore">
									<i class="fas fa-angle-double-down"></i><span>See more</span>
								</a>
							</div>
						<?php endif;?>
					</div>
					<div class="banner home_banner"><?php get_template_part( 'template/partial/rightside' ); ?></div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>
