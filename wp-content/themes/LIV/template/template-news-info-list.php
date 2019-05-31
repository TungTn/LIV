<?php
/**
 * The template for displaying News Info List Page.
 * @package Miyatsu
 * Template Name: News Info List
**/
?>
<?php get_header(); ?>
<?php
global $mvn_pagenavi, $mvn_blog, $wp_query;
$category = $wp_query->get_queried_object();
$order = isset($_GET['sort']) ? $_GET['sort'] : 'DESC';
	// Wp_query get post
$post_per_page = 4;
$number_loadmore = 4;
$args = array(
	'post_type'			=>'news',
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

$delay = 0;wp_reset_query();
?>
<div class="newsInfoArea">
	<section class="mvArea">
		<?php 
			$slider_args = array(
				'post_type'			=>'news', 
				'post_status'		=>'publish',
				'posts_per_page' 	=> '3',
				'offset'           	=> 0,
				'meta_key'   		=> 'feature_post',
				'meta_value' 		=> true,
				'orderby'          	=> 'date title',
				'order'            	=> 'DESC',
			);
			$slider_query = new WP_Query($slider_args);


		?>
		<div class="swiper-container mv" id="mv">
			<div class="swiper-wrapper">
				<?php if($slider_query->have_posts()):?>
					<?php foreach($slider_query->posts as $slider):?>
						<?php if ( has_post_thumbnail($slider->ID) ): ?>
							<a href="<?php echo get_the_permalink($slider->ID); ?>" class="swiper-slide mv__item" data-background='<?php echo get_the_post_thumbnail_url($slider->ID,'full') ?>'>
						<?php else:?>
							<a href="<?php echo get_the_permalink($slider->ID); ?>" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/mv_bg.png'>
						<?php endif;?>
								<div class="content">
									<h2 class="tit"><?php echo $slider->post_title;?></h2>
									<p class="date"><?php echo get_the_date('d.m.Y',$slider->ID);?></p>
									<div class="news">Today News</div>
								</div>
							</a>
					<?php endforeach;?>
				<?php else:?>
				<a href="#" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/mv_bg.png'>
					<div class="content">
						<h2 class="tit">Vietnam Top 20</h2>
						<p class="date">28.11.2018</p>
						<p class="news">Today News</p>
					</div>

				</a>
				<a href="#" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/mv_bg.png'>
					<div class="content">
						<h2 class="tit">Vietnam Top 20</h2>
						<p class="date">28.11.2018</p>
					</div>
				</a>
				<a href="#" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/mv_bg.png'>
					<div class="content">
						<h2 class="tit">Vietnam Top 20</h2>
						<p class="date">28.11.2018</p>
					</div>
				</a>
				<?php endif;?>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
		</div>
	</section>
	<section class="section news_info_section">
		<?php get_template_part('template/partial/breadcrumb'); ?>
		<div class="container">
			<div class="inner">
				<div class="main">
					<?php get_template_part( 'template/partial/aside' ); ?>
					<?php
					$today = getdate();
					$today_post_args = array(
						'post_status' 		=> 'publish',
							'post_type' 		=> 'news', //CHANGE IT
							'posts_per_page' 	=> 3,
							'orderby' 			=> 'date',
							'order' 			=> 'DESC',
							'date_query' => array(
					            array(
					              'year'  => $today['year'],
					              'month' => $today['mon'],
					              'day'   => $today['mday'],
					            ),
          					),
						);
					$today_post_query = new WP_Query($today_post_args);
					?>					
					<div class="content">
						<?php if($today_post_query->have_posts()):?>
							<div class="today_news">
								<h2 class="title"><a href="#">Today News</a></h2>
								<ul class="list">
									<?php foreach($today_post_query->posts as $today_post): ?>
										<li class="item">
											<a href="<?php echo get_the_permalink($today_post->ID); ?>">
												<?php if ( has_post_thumbnail($today_post->ID) ): ?>
													<div class="img today_news_img" data-background='<?php echo get_the_post_thumbnail_url($today_post->ID,'full') ?>'></div>													
												<?php else:?>
													<div class="img today_news_img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_01.png'></div>													
												<?php endif;?>
											</a>
											<div class="in">
												<h3 class="tit">
													<a href="<?php echo get_the_permalink($today_post->ID); ?>">
														<?php echo $today_post->post_title; ?>
													</a>
												</h3>
												<p class="date"><?php echo get_the_date('d.m.Y',$today_post->ID);?> </p>
												<p class="txt" block-sc-pc>
													<?php
														if($today_post->post_content){
															$today_post_content = wp_strip_all_tags($today_post->post_content);
															$today_post_content = mb_substr($today_post_content, 0, 200);
															echo $today_post_content.'...';
														}
														
													?>
												</p>
												<p class="txt" block-sc-sp>
													<?php
														if($today_post->post_content){
															$today_post_content = wp_strip_all_tags($today_post->post_content);
															$today_post_content = mb_substr($today_post_content, 0, 200);
															echo $today_post_content.'...';
														}
														
													?>
												</p>
												<div class="chatting">
													<p class="view"><?php echo getpostviews($today_post->ID); ?> </p>
													<p class="like">
														<?php
														if (function_exists('wp_ulike_get_post_likes')):
															echo wp_ulike_get_post_likes($today_post->ID);
														else:
															echo " 0 like";
														endif;
														?>
													</p>
												</div>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif;wp_reset_query(); ?>												
						<div class="news">		
							<?php if (wp_is_mobile() ) {
								get_template_part('template/partial/bannerA1') ;
							}
							?>					
							<?php if($post_query->have_posts()):?>
								<div class="ttl">
									<h2 class="title"><a href="#">News</a></h2>
									<div class="dropdown">
										<form id="sort_select_form" data-post-type="news" data-post-per-page="4" method="post" data-page-type="news" data-url="<?php echo site_url() ?>/wp-admin/admin-ajax.php">
											<select class="sort_select icondown" name="sort">									
												<option value="DESC">Lastest</option>
												<option value="ASC">Oldest</option>
											</select>
											<i class="chevron-down"></i>
										</form>
									</div>
								</div>
								<ul class="list lastest-new">
									<?php foreach($post_query->posts as $post): ?>
										<li class="item">
											<a href="<?php echo get_the_permalink($post->ID); ?>">
												<?php if ( has_post_thumbnail($post->ID) ): ?>
													<div class="img today_news_img" data-background='<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>'></div>													
												<?php else:?>
													<div class="img today_news_img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_01.png'></div>													
												<?php endif;?>
											</a>
											<div class="in">
												<h3 class="tit">
													<a href="<?php echo get_the_permalink($post->ID); ?>">
														<?php echo $post->post_title; ?>
													</a>
												</h3>
												<p class="date"><?php echo get_the_date('d.m.Y',$post->ID);?></p>
												<p class="txt" block-sc-pc>
													<?php
														if($post->post_content){
															$content = wp_strip_all_tags($post->post_content);
															$content = mb_substr($content, 0, 200);
															echo $content.'...';
														}
													?>
												</p>
												<p class="txt" block-sc-sp>
													<?php
														if($post->post_content){
															$content = wp_strip_all_tags($post->post_content);
															$content = mb_substr($content, 0, 100);
															echo $content.'...';
														}
													?>
												</p>
												<div class="chatting">
													<p class="view"><?php echo getpostviews($post->ID); ?>  </p>
													<p class="like">
														<?php
														if (function_exists('wp_ulike_get_post_likes')):
															echo wp_ulike_get_post_likes($post->ID);
														else:
															echo " 0 like";
														endif;
														?>
													</p>
												</div>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif;wp_reset_query(); ?>

						</div>

						<?php if($mvn_pagenavi['max-paged'] > 1):?>
							<div class="see_more">
								<a  data-page-type="news-info" data-sort="DESC" data-key="<?php echo esc_attr($mvn_pagenavi['key']) ?>" data-disable="0" data-max-paged="<?php echo esc_attr($mvn_pagenavi['max-paged']) ?>" data-paged="2" class="btn btn__ajax--loadmore">
									<i class="fas fa-angle-double-down"></i><span>See more</span>
								</a>
							</div>
						<?php endif;?>		
						<?php if (wp_is_mobile() ) {
								get_template_part('template/partial/bannerA2') ;
							}
							?>									
						<?php if (wp_is_mobile() ) {
							get_template_part('template/partial/bannerB');
						}
						?> 
					</div>
					<div class="banner home_banner">
						<?php get_template_part( 'template/partial/rightside' ); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>

