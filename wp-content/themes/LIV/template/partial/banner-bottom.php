<div class="banner-bottom" block-sc-pc>
	<?php 
		if ( !empty(get_field('image_bottom', 'option')) ) : 
			$banner_bottom =  get_field('image_bottom', 'option');
			$banner_link = get_field('link_bottom','option');
	?>
	 <a href="<?php if($banner_link): echo $banner_link; endif;?>" class="link">
	 	<div class="img banner-bottom-img" data-background="<?php echo $banner_bottom;?>">
	 		
	 	</div>

    </a>
	<?php endif;?>
   
</div>