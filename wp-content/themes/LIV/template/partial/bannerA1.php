<div class="group_A">
<?php 
		if( is_tax() ){
			$post_type = get_queried_object()->taxonomy;
			if( !empty( get_field($post_type.'_block_a','option' ) ) ) {
				$adboxs_A = get_field($post_type.'_block_a','option' );
			}
		}else{
			if( !empty( get_field('ad_box','option' ) ) ) {
				$adboxs_A = get_field('ad_box','option' );
			}
		}
		
		if($adboxs_A)
		{
			foreach($adboxs_A as $key => $ad_box_A):
				
				if($key == 0 ):
	?>	
			<div class="banner_a">
				<?php echo adrotate_ad($ad_box_A['advertise_id']); ?>
			</div>
				
	<?php
			endif;
			endforeach; 
		}
			
	?> 
</div>
	