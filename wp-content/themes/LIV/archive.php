<?php
/**
 * The template for displaying archive pages
 * @package Miyatsu
 * @version 1.0
 */

get_header(); ?>

	<div class="mvn_wrap">
	
		<div class="container">
		
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<?php
						/*
						 * Archives Page Titles
						 */
					?>
				</header>
				<!-- /.page-header -->
			<?php endif; ?>

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php
						if ( have_posts() ) : 
						
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
								 * Content Page Here
								 */
								 
							endwhile;

						else :

							/*
							 * Content Page None
							 */

						endif; 
					?>

				</main>
				<!-- #main -->
			</div>
			<!-- #primary -->
			
		</div>
		
	</div>
	<!-- /.mvn_wrap -->

<?php get_footer();
