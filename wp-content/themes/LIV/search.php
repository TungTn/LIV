<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Miyatsu
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="mvn_wrap">

	<header class="page-header">
		<?php if ( have_posts() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'mvn' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			<?php else : ?>
				<h1 class="page-title"><?php _e( 'Nothing Found', 'mvn' ); ?></h1>
			<?php endif; ?>
		</header><!-- /.page-header -->

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();

							/**
							 * content page
							 */

						endwhile; // End of the loop.

						else : ?>

							<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mvn' ); ?></p>
							<?php
							get_search_form();

						endif;
						?>

					</main><!-- #main -->
				</div><!-- #primary -->
				
			</div><!-- /.mvn_wrap -->

			<?php get_footer();
