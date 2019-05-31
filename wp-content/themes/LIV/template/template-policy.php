<?php
/**
* The template for displaying Policy Page.
* @package Miyatsu
* Template Name: Policy
**/


?>
<?php get_header(); ?>

<div class="policyArea">
	<section class="mvArea">
		<div class="swiper-container mv" id="">
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
					<div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/policy/mv_bg.png'>
						<div class="content">
							<h2 class="tit">Privacy policy</h2>
						</div>
					</div>
				<?php endif;?>	
				

			</div>
			<!-- Add Pagination -->
			<!-- <div class="swiper-pagination"></div> -->
		</div>
	</section>
	<section class="section">
		<?php  get_template_part('template/partial/breadcrumb') ; ?>
		<div class="container">
			<div class="inner">
				<div class="main">

					<?php  get_template_part('template/partial/aside') ; ?>
					<div class="content">
						<div class="policy_info">
							<?php echo apply_filters('the_content', get_post_field('post_content',  $post->ID )); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>

