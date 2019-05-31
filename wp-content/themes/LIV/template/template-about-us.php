<?php
/**
* The template for displaying About Us Page.
* @package Miyatsu
* Template Name: About Us
**/


?>
<?php get_header(); ?>

<div class="AboutArea">
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
					<div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/about_us/mv_bg.png'>
						<div class="content">
							<h2 class="tit">About Us</h2>
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
						<div class="about_info">
                            <h4 class="ttl">About ATTACK</h4>
                            <ul class="list list_info">
								<li class="item">
									<div class="item__details" style="display:none;">
										<div class="item__details__box">
											<h4>702M</h4>
											<span>reviews and opinions</span>
										</div>
										<div class="item__details__box">
											<h4>490M</h4>
											<span>monthly average unique visitors</span> 
										</div>
										<div class="item__details__box">
											<h4>8M</h4>
											<span>accommodations, airlines, experiences, and restaurants</span> 
										</div>
									</div>
									<div class="box">
										<div class="desc">
											<?php echo apply_filters('the_content', get_post_field('post_content',  $post->ID )); ?> 
										</div>
									</div>
								</li>
							</ul>
							<h4 class="mini_ttl">Our team</h4>
							<ul class="list">
								<?php if ( !empty(get_field('team_member')) ) : ?>
									<?php $members =  get_field('team_member'); ?>
									<?php foreach($members as $member): ?>
										<li class="item">
											<div class="img">
												<a href="#"><img src="<?php echo $member['member_avatar']?>" alt=""></a>
											</div>
											<div class="box">
												<h3 class="ttl">
		                                            <a href="#"><?php echo $member['member_name']?></a>                                            
		                                        </h3>
		                                        <div class="position">
		                                            <?php echo $member['member_title'];?>
		                                        </div> 
												<div class="desc">
		                                           <?php echo $member['member_content']; ?> 
												</div>
											</div>
										</li>
										<?php endforeach;?>
									<?php else :?>
										<li class="item">
											<div class="img">
												<a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_us/our_01.png" alt=""></a>
											</div>
											<div class="box box_info">
												<h3 class="ttl">
		                                            <a href="#">Stephen Kaufer</a>                                            
		                                        </h3>
		                                        <p class="position">
		                                            President & CEO
		                                        </p> 
												<p class="desc">
		                                            Steve co-founded in 2000 with the mission to help travelers around the world
		                                            plan and book the perfect trip. Under his leadership, has grown into the largest
		                                            travel site in the world. Prior to co-founding, Steve was president of CDS, an
		                                            independent software vendor, and prior to that, was co-founder and vice president
		                                            of engineering of CenterLine Software. Steve holds several software patents.
												</p>
											</div>
										</li>
										<li class="item">
											<div class="img">
												<a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_us/our_02.png" alt=""></a>
											</div>
											<div class="box box_info">
												<h3 class="ttl">
		                                            <a href="#">Stephen Kaufer</a>                                            
		                                        </h3>
		                                        <p class="position">
		                                            President & CEO
		                                        </p>
												<p class="desc">
		                                            Steve co-founded in 2000 with the mission to help travelers around the world
		                                            plan and book the perfect trip. Under his leadership, has grown into the largest
		                                            travel site in the world. Prior to co-founding, Steve was president of CDS, an
		                                            independent software vendor, and prior to that, was co-founder and vice president
		                                            of engineering of CenterLine Software. Steve holds several software patents.
												</p>
											</div>
		                                </li>
		                                <li class="item">
											<div class="img">
												<a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_us/our_03.png" alt=""></a>
											</div>
											<div class="box box_info">
												<h3 class="ttl">
		                                            <a href="#">Stephen Kaufer</a>                                            
		                                        </h3>
		                                        <p class="position">
		                                            President & CEO
		                                        </p> 
												<p class="desc">
		                                            Steve co-founded in 2000 with the mission to help travelers around the world
		                                            plan and book the perfect trip. Under his leadership, has grown into the largest
		                                            travel site in the world. Prior to co-founding, Steve was president of CDS, an
		                                            independent software vendor, and prior to that, was co-founder and vice president
		                                            of engineering of CenterLine Software. Steve holds several software patents.
												</p>
											</div>
		                                </li>
		                                <li class="item">
											<div class="img">
												<a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_us/our_01.png" alt=""></a>
											</div>
											<div class="box box_info">
												<h3 class="ttl">
		                                            <a href="#">Stephen Kaufer</a>                                            
		                                        </h3>
		                                        <p class="position">
		                                            President & CEO
		                                        </p>
												<p class="desc">
		                                            Steve co-founded in 2000 with the mission to help travelers around the world
		                                            plan and book the perfect trip. Under his leadership, has grown into the largest
		                                            travel site in the world. Prior to co-founding, Steve was president of CDS, an
		                                            independent software vendor, and prior to that, was co-founder and vice president
		                                            of engineering of CenterLine Software. Steve holds several software patents.
												</p>
											</div>
		                                </li>
		                                <li class="item">
											<div class="img">
												<a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_us/our_02.png" alt=""></a>
											</div>
											<div class="box box_info">
												<h3 class="ttl">
		                                            <a href="#">Stephen Kaufer</a>                                            
		                                        </h3>
		                                        <p class="position">
		                                            President & CEO
		                                        </p>
												<p class="desc">
		                                            Steve co-founded in 2000 with the mission to help travelers around the world
		                                            plan and book the perfect trip. Under his leadership, has grown into the largest
		                                            travel site in the world. Prior to co-founding, Steve was president of CDS, an
		                                            independent software vendor, and prior to that, was co-founder and vice president
		                                            of engineering of CenterLine Software. Steve holds several software patents.
												</p>
											</div>
		                                </li>
		                                <li class="item">
											<div class="img">
												<a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_us/our_03.png" alt=""></a>
											</div>
											<div class="box box_info">
												<h3 class="ttl">
		                                            <a href="#">Stephen Kaufer</a>                                            
		                                        </h3>
		                                        <p class="position">
		                                            President & CEO
		                                        </p> 
												<p class="desc">
		                                            Steve co-founded in 2000 with the mission to help travelers around the world
		                                            plan and book the perfect trip. Under his leadership, has grown into the largest
		                                            travel site in the world. Prior to co-founding, Steve was president of CDS, an
		                                            independent software vendor, and prior to that, was co-founder and vice president
		                                            of engineering of CenterLine Software. Steve holds several software patents.
												</p>
											</div>
										</li>
									<?php endif;?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>

