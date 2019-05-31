<?php
/**
 * The header for our theme
 *
 * @package Miyatsu
 * @since 1.0
 * @version 1.0
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<title>ATTACK</title>
	<meta charset="UTF-8">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="keywords" content="attack">

	<meta property="og:title" content="attack">
	<meta property="og:description" content="attack">
	<meta property="og:image" content="http://liv.miyatsu.vn/homepage.png" />
	<meta property="og:url" content="http://liv.miyatsu.vn/">
	<meta property="og:site_name" content="ATTACK" />
	<meta property="og:type" content="website" />


	<?php if (is_search()) { ?>
		<meta name="robots" content="noindex, nofollow" />
	<?php } ?>

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/assets/images/fav.png">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="site" id="site" data-ajax-url="<?php echo esc_html(admin_url( "admin-ajax.php" )); ?>">

		<header class="header" id="header">
			<!-- <div class="container"> -->
				<div class="header__info container">
					<a href="#" class="header__hamburger" id="header__hamburger" block-sc-sp><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/mobile_menu.png"></a>
					<a href="/" class="header__logo"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/logo.png"></a>

					<a href="#" class="header__search__mobile" block-sc-sp><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/icon_search_sp.png"></a>
					<div class="header__search" block-sc-pc>
						<form class="header__search__form" action="<?php echo get_site_url();?>/search">
							<label class="header__search__label">
								<input type="search" name="search">
							</label>
							<button type="submit" class="header__search__submit"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/icon_search.png"></button>
						</form>
					</div>
					<a href="<?php echo get_site_url()?>/contact-us" class="header__contact" block-sc-pc>Contact us</a>

				</div>
				<div class="header__navArea">
					<nav class="header__menubar" block-sc-pc>
						<div class="header__menubar__menu">
							<?php
							wp_nav_menu(
								array(
									'menu' => 'Header menu',
									'menu_class' => 'header__menubar__list',
									'menu_id' => 'header__nav__list',
									'container' => false,
									'depth' => 4,
								)
							);
							?>
						</div>
					</nav>
					<nav class="header__menubar" id="header--mobile" block-sc-sp>
						<div class="header__menubar__menu">
							<?php
							wp_nav_menu(
								array(
									'menu' => 'Mobile menu',
									'menu_class' => 'header__menubar__list',
									'menu_id' => 'header__nav__list',
									'container' => false,
									'depth' => 4,
								)
							);
							?>
						</div>
					</nav>
					<a href="#" block-sc-sp class="header__navArea__close"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/icon_close.png"></a>
				</div>
				<div class="header__search--sp" block-sc-sp>
					<p class="header__search__cancel"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/icon_cancel.png"></p>
					<form class="" action="<?php echo get_site_url();?>/search">
						<label class="">
							<input type="search" name="search">
						</label>
						<button type="submit" class=""><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/icon_search_orange.png"></button>
					</form>
				</div>

				<!-- </div> -->
			</header>
			<!-- /.header -->



