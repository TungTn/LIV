<?php
/**
 * The template for displaying Issue List Page.
 * @package Miyatsu
 * Template Name: Issue List
**/

?>
<?php get_header(); ?>

<div class="issueListArea" block-sc-sp>
	<section class="section issueList_section">
		<div class="container">
			<div class="inner">
				<div class="main">
					<div class="content">
						<div class="new_info">
							<h2 class="title">Issues</h2>
							<p class="txt">Pick a region you would like to discover.</p>
							<ul class="list">
								<?php
									$terms = get_terms( array(
									    'taxonomy' => 'issue',
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
													<!-- <span class="title-center" block-sc-pc>
														<?php echo $term->description; ?>
													</span>
													<a href="<?php echo get_term_link($term->term_id); ?>" class="seemore" block-sc-pc><span>See More</span></a> -->
												</span>
											</div>
										</li>
									<?php endforeach;?>

								<?php endif; ?>
							</ul>

							<?php  get_template_part('template/partial/banner-bottom') ; ?>

						</div>
					</div>
					<div class="banner home_banner"><?php get_template_part( 'template/partial/rightside' ); ?></div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>
