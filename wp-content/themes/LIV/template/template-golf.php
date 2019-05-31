<?php
/**
 * The template for displaying Golf Page.
 * @package Miyatsu
 * Template Name: Golf
**/

?>
<?php get_header(); ?>

<div class="restaurantArea">
	<section class="mvArea">
		<div class="swiper-container mv" id="mv">
			<div class="swiper-wrapper">
				<?php
					if ( !empty(get_field('slider_mv')) ) :
						$sliders =  get_field('slider_mv');
						foreach($sliders as $slider):
				?>
					<a href="<?php echo $slider['slider_link'];?>" class="swiper-slide mv__item" data-background='<?php echo $slider['slider_image'];?>'>
						<div class="content">
							<h2 class="tit">
								<?php echo $slider['slider_text'];?>
							</h2>
						</div>
					</a>
					<?php endforeach;?>
				<?php else: ?>
					<a href="#" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/golf/mv_bg.png'>
						<div class="content">
							<h2 class="tit">Golf in Vietnam</h2>
						</div>
					</a>
					<a href="#" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/golf/mv_bg_01.png'>
					</a>
					<a href="#" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/golf/mv_bg.png'>
					</a>
				<?php endif;?>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
		</div>
	</section>
	<section class="section restaurent_section">
		<?php  get_template_part('template/partial/breadcrumb') ; ?>
		<div class="container">
			<div class="inner">
				<div class="main">
					<?php  get_template_part('template/partial/aside') ; ?>
					<div class="content">
						<div class="new_info">
							<h2 class="title" block-sc-pc>&nbsp;</h2>
							<ul class="list">
								<?php
									$terms = get_terms( array(
									    'taxonomy' => 'golf',
									    'hide_empty' => false,
									    'orderby' => 'term_id',
									    'order' => 'ASC',
									) );
								?>
								<?php
									if(is_wp_error($terms)){
										echo '<p>Vui lòng khởi tạo dữ liệu hoặc liên hệ quản trị viên. </p>';
									}
								?>
								<?php if( !empty( $terms ) ) :?>
									<?php foreach($terms as $term) :?>
										<?php
											if ( !empty(get_field('image', $term->taxonomy.'_'.$term->term_id)) ) {
												$feature_img = get_field('image',$term->taxonomy.'_'.$term->term_id);
											}
										?>
										<li class="item">
											<div class="img">
												<a href="<?php echo get_term_link($term->term_id); ?>">
													<?php if($feature_img): ?>
														<img src="<?php echo $feature_img;?>">
													<?php else: ?>
														<img alt="" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png" />
													<?php endif;?>
												</a>
												<span class="text-centered">
													<h2><a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a></h2>
													<span class="title-center" block-sc-pc>
														<?php echo $term->description; ?>
													</span>
													<a href="<?php echo get_term_link($term->term_id); ?>" class="seemore" block-sc-pc><span>See More</span></a>
												</span>
											</div>
										</li>
									<?php endforeach;?>

								<?php endif; ?>
							</ul>
							
						</div>
					</div>
					<div class="banner home_banner"><?php get_template_part( 'template/partial/advertise_private' ); ?></div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>
