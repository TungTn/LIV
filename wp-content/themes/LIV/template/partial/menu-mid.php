<?php 
	if(is_page('ha-noi') ) {
		$current_location = 'ha-noi';
		$current_taxonomy = '0';
	}elseif(is_page('ho-chi-minh') ) {
		$current_location = 'ho-chi-minh';
		$current_taxonomy = '0';
	}elseif(is_page('da-nang') ) {
		$current_location = 'da-nang';
		$current_taxonomy = '0';
	}else {
		$current_location = get_queried_object()->slug;
		$current_taxonomy = get_queried_object()->taxonomy;
	}
	



?>
<div class="slidebox" block-sc-sp>

	<div <?php if($current_taxonomy == 'restaurant'):?> class="slidebox__block active" <?php else:?> class="slidebox__block" <?php endif;?> >
		<a href="<?php echo get_site_url();?>/restaurant/<?php echo $current_location;?>" class="block_link">
			<div class="slide__block__img">
				<?php if($current_taxonomy == 'restaurant') : ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_01_active.png">
				<?php else: ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_01.png">
				<?php endif;?>
			</div>
			<div class="slide_block_txt">
				Restaurant
			</div>									
		</a>
	</div>
	<div <?php if($current_taxonomy == 'spa'):?> class="slidebox__block active" <?php else:?> class="slidebox__block" <?php endif;?>>
		<a href="<?php echo get_site_url();?>/spa/<?php echo $current_location;?>" class="block_link">
			<div class="slide__block__img">
				<?php if($current_taxonomy == 'spa') : ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_02_active.png">
				<?php else: ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_02.png">
				<?php endif;?>
			</div>
			<div class="slide_block_txt">
				Spa/<br>Hair Salon
			</div>	
		</a>
	</div>
	<div <?php if($current_taxonomy == 'cafe'):?> class="slidebox__block active" <?php else:?> class="slidebox__block" <?php endif;?>>
		<a href="<?php echo get_site_url();?>/cafe/<?php echo $current_location;?>" class="block_link">
			<div class="slide__block__img">
				<?php if($current_taxonomy == 'cafe') : ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_03_active.png">
				<?php else: ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_03.png">
				<?php endif;?>
			</div>
			<div class="slide_block_txt">
				Cafe
			</div>
		</a>
	</div>
	<div <?php if($current_taxonomy == 'golf'):?> class="slidebox__block active" <?php else:?> class="slidebox__block" <?php endif;?> >
		<a href="<?php echo get_site_url();?>/golf/<?php echo $current_location;?>" class="block_link">
			<div class="slide__block__img">
				<?php if($current_taxonomy == 'golf') : ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_04_active.png">
				<?php else: ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_04.png">
				<?php endif;?>
			</div>
			<div class="slide_block_txt">
				Golf
			</div>
		</a>
	</div>
	<div <?php if($current_taxonomy == 'tour'):?> class="slidebox__block active" <?php else:?> class="slidebox__block" <?php endif;?> >
		<a href="<?php echo get_site_url();?>/tour/<?php echo $current_location;?>" class="block_link">
			<div class="slide__block__img">
				<?php if($current_taxonomy == 'tour') : ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_05_active.png">
				<?php else: ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_05.png">
				<?php endif;?>
			</div>
			<div class="slide_block_txt">
				Tourism
			</div>									
		</a>
	</div>
	<div class="slidebox__block">
		<a href="<?php echo get_site_url();?>/about-vietnam" class="block_link">
			<div class="slide__block__img">
				<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_06.png">
			</div>
			<div class="slide_block_txt">
				About Vietnam
			</div>	
		</a>
	</div>
	<div <?php if($current_taxonomy == 'nightlife'):?> class="slidebox__block active" <?php else:?> class="slidebox__block" <?php endif;?> >
		<a href="<?php echo get_site_url();?>/nightlife/<?php echo $current_location;?>" class="block_link">
			<div class="slide__block__img">
				<?php if($current_taxonomy == 'nightlife') : ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_07_active.png">
				<?php else: ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_07.png">
				<?php endif;?>
			</div>
			<div class="slide_block_txt">
				Nightlife
			</div>
		</a>
	</div>
	<div <?php if($current_taxonomy == 'casino'):?> class="slidebox__block active" <?php else:?> class="slidebox__block" <?php endif;?> >
		<a href="<?php echo get_site_url();?>/casino/<?php echo $current_location;?>" class="block_link">
			<div class="slide__block__img">
				<?php if($current_taxonomy == 'casino') : ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_08_active.png">
				<?php else: ?>
					<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/listpage/ic_08.png">
				<?php endif;?>
			</div>
			<div class="slide_block_txt">
				Casino
			</div>
		</a>
	</div>
</div>