<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Miyatsu
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<?php setpostview(get_the_ID()); ?>
	<div class="single__post">
		
		<div class="container">
			<div class="single__post__meta">
				<span>2018.10.01</span>
				<h3><?php the_title(); ?></h3>
			</div>
			
			<div class="single__post__content">
				<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						the_content();

					endwhile; // End of the loop.
				?>
			</div>
			
		</div>
		
	</div>
	<!-- /.single__post -->
	
	<section class="latest__news">
		<div class="container">
			<h2 class="section__ttl">LATEST NEWS</h2>
			<div class="news__layout grid__row" id="news__layout__single">
				
				<?php 
					global $mvn_pagenavi, $mvn_blog, $wp_query;
					
					// Wp_query get post
					$post_per_page = $number_loadmore = 3;
					$args = array(
						'post_type'			=>'post', 
						'post_status'		=>'publish',
						'posts_per_page' 	=> $post_per_page,
						'paged' 			=> max( get_query_var( 'paged' ), get_query_var( 'page' )),
					);
					
					$the_query = new WP_Query($args);
					$wp_query = $the_query; 
					
					// Ajax loadmore
					/* Post Ajax attr */
					$mvn_blog = array(
						'number_post'		=> intval(wp_count_posts()->publish),
						'started_posts'		=> $post_per_page,
						'post_per_page'		=> $post_per_page,
						'number_loadmore'	=> $post_per_page,
					);
					
					if( ( $the_query->found_posts - $post_per_page ) < 0 ){
						$max_paged = 1;
					} else {
						$max_paged = ceil( ( $the_query->found_posts - $post_per_page ) / $number_loadmore ) + 1;
					}
					
					
					
					$ajax_key =  uniqid(); 
					$mvn_pagenavi = array( 'key' => 'mvn_'.$ajax_key, 'max-paged' => $max_paged );
					
					if ( function_exists('mvn_render_script_ajax_block')) {
						mvn_render_script_ajax_block($args, $mvn_blog, $ajax_key);
					}
					
					$delay = 0;
				?>
				
				<?php if ( $the_query->have_posts() ) : ?>
						
						<!-- the loop -->
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
							$delay++;	
						?>
							
							<article class="news__layout__item grid__row__col" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>00"> 
								<div class="news__thumb">
									<?php 
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'mvn_600x295' );
									?>
									<a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
								</div>
								<div class="news__meta">
									<span><?php echo get_the_date('Y.m.d',$post->ID); ?></span>
									<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								</div>
							</article>
							
						<?php endwhile; ?>
						<!-- end of the loop -->
						
			</div>
			<div class="news__viewmore">
			
					<?php mvn_the_posts_navigation_ajax('single'); ?>
							
					<?php wp_reset_query(); ?>
				
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- /.latest__news -->

<?php get_footer();
