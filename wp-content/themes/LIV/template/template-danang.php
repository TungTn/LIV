<?php
/**
* The template for displaying Da Nang Page.
* @package Miyatsu
* Template Name: Da Nang
**/


?>

<?php get_header(); ?>

<div class="listpageArea" block-sc-sp>
	<section class="mvArea">
		<div class="mv">				
			<div class="mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/danang.png'>
				<div class="content">
					<h2 class="tit">Da Nang</h2>
				</div>
			</div>
		</div>
	</section>
	<section class="section">
		<div class="container">
			<div class="inner">
				<div class="main">
					<div class="content">
						<?php  get_template_part('template/partial/menu-mid') ; ?>
						<div class="issue">
							<?php
								global $post, $wp_query;
								$issues_args = array(
									'post_status' 		=> 'publish',
									'post_type' 		=> 'issues', //CHANGE IT
									'posts_per_page' 	=> 4,
									'orderby' 			=> 'date',
									'order' 			=> 'DESC',
									'tax_query'        => array(
										array(
											'taxonomy'     => 'issue',
											'field'        => 'slug',
											'terms'        => 'da-nang'
										)
									),
								);
								$issues_query = new WP_Query($issues_args);
							?>
							<div class="title">
								<a href="javascript:avoid(0)" class="link-default">Issue in Da Nang</a>
								<?php if($issues_query->max_num_pages > 0 ) :?>
									<a href="<?php echo get_site_url();?>/issue/da-nang" class="see-all"><span class="txt">See all</span></a>
								<?php endif;?>
							</div>
							
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
									} else {
										echo '<span>Admin</span>';
									}
									?>
									|
									<?php
									if ( !empty(get_field('author_nationality', $issue->ID)) ) {
									echo '<span>'.get_field('author_nationality', $issue->ID).'</span>';
									} else {
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
							<?php
								global $post, $wp_query;

								$life_args = array(
									'post_status' 		=> 'publish',
									'post_type' 		=> 'lifes', //CHANGE IT
									'posts_per_page' 	=> 6,
									'orderby' 			=> 'date',
									'order' 			=> 'DESC',
									'tax_query'        => array(
										array(
											'taxonomy'     => 'life',
											'field'        => 'slug',
											'terms'        => 'da-nang'
										)
									),
								);
								$lifes_query = new WP_Query($life_args);
							?>
							<div class="title">
								<a href="javascript:avoid(0)" class="link-default">Life info of Da Nang</a>
								<?php if($lifes_query->max_num_pages > 0 ) :?>
									<a href="<?php echo get_site_url();?>/life/da-nang" class="see-all"><span class="txt">See all</span></a>
								<?php endif;?>
							</div>									
							
							<div class="articleArea articleAreasp swiper-container">
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
						</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>

