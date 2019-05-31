<div class="banner-aside" block-sc-pc>
	<?php 
		if ( !empty(get_field('image_top', 'option')) ) : 
			$banner_top =  get_field('image_top', 'option');
			$banner_link = get_field('link_top','option');
	?>
	 <a href="<?php if($banner_link): echo $banner_link; else: echo'#'; endif;?>" class="link">
	 	<div class="img banner-aside-img" data-background="<?php echo $banner_top;?>">
	 		
	 	</div>
        
    </a>
	<?php endif;?>
   
</div>
