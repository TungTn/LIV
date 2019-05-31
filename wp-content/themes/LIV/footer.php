<?php
/**
 * The template for displaying the footer
 *
 * @package Miyatsu
 * @since 1.0
 * @version 1.0
 */

?>
<p class="backTop">
	<a href="#top__page"><span block-sc-pc>Back to top</span></a>
</p>
<footer>
	<div class="footer container">
		<a href="/" class="footer__logo" block-sc-sp><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/logo.png"></a>
		<div class="footer__attack">
			<h2 class="footer__ttl">Attack</h2>
			<ul class="footer__list">
				<li class="footer__item"><a href="<?php echo get_site_url();?>/careers">Careers</a></li>
				<li class="footer__item footer__item__policy"><a href="<?php echo get_site_url();?>/privacy-policy/">Privacy Policy</a></li>
			</ul>
		</div>

		<div class="footer__business">
			<h2 class="footer__ttl">Do Business with us</h2>
			<ul class="footer__list">
				<li class="footer__item"><a href="<?php echo get_site_url();?>/advertise-with-us">Advertise with Us</a></li>
			</ul>
		</div>

		<div class="footer__contact">
			<h2 class="footer__ttl">Contact</h2>
			<ul class="footer__list">
				<li class="footer__item"><a href="mailto:nguyen.thi.thu@miyatsu.vn">Get email</a></li>
			</ul>
		</div>

		<div class="footer__follow">
			<h2 class="footer__ttl">Follow Us</h2>
			<ul class="footer__sns">
				<li class="footer__sns__icon"><a href="#"></a></li>
				<li class="footer__sns__icon"><a href="#"></a></li>
			</ul>
		</div>

		<div class="footer__copyright">
			<a href="/" class="footer__logo" block-sc-pc><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/logo.png"></a>
			<p class="footer__copyright__txt">© 2018 Attack All rights reserved.</p>
		</div>
	</div>
</footer>
<!-- /.site -->

<?php wp_footer(); ?>

</body>
</html>
