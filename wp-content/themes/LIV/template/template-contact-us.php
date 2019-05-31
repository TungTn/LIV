<?php
/**
* The template for displaying Contact Us Page.
* @package Miyatsu
* Template Name: Contact Us
**/


?>
<?php get_header(); ?>

<div class="ContactsArea">
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
						<div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/contact_us/mv_bg.png'>
							<div class="content">
								<h2 class="tit">Contact Us</h2>
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
							<div class="contact_info">
								<h4>Contact form</h4>
								<p class="subttl">Please use the form below to get in touch:</p>
								<?php $contact_shortcode = '[contact-form-7 id="406" title="Contact form"]'; ?>
								<?php echo do_shortcode($contact_shortcode); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php get_footer(); ?>

