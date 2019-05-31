<?php 
	if( is_tax() ){
		
		$post_type = get_queried_object()->taxonomy;
		if( !empty( get_field($post_type.'_block_b','option' ) ) ) {
			$adboxs_B = get_field($post_type.'_block_b','option' );
		}
		if( !empty( get_field($post_type.'_block_c','option' ) ) ) {
			$adboxs_C = get_field($post_type.'_block_c','option' );
		}
		if( !empty( get_field($post_type.'_block_d','option' ) ) ) {
			$adboxs_D = get_field($post_type.'_block_d','option' );
		}
		if( !empty( get_field($post_type.'_block_e','option' ) ) ) {
			$adboxs_E = get_field($post_type.'_block_e','option' );
		}
	}else{
		if ( !empty(get_field('ad_box_b', 'option')) ) {
			$adboxs_B =  get_field('ad_box_b', 'option');
		}
		if ( !empty(get_field('ad_box_c', 'option')) ) {
			$adboxs_C =  get_field('ad_box_c', 'option');
		}
		if ( !empty(get_field('ad_box_d', 'option')) ) {
			$adboxs_D =  get_field('ad_box_d', 'option');
		}
		if ( !empty(get_field('ad_box_e', 'option')) ) {
			$adboxs_E =  get_field('ad_box_e', 'option');
		}
	}
	
	


?>
<div class="banner_group">
	<div class="group_B">
		<?php 
			if($adboxs_B):
				foreach($adboxs_B as $ad_box_B):
					?>	
					<div class="banner_b">
						<?php echo adrotate_ad($ad_box_B['advertise_id']); ?>
					</div>
					
					<?php
				endforeach; 
			endif;
		?> 
	</div>
	<div class="group_C">
		<?php 
			if($adboxs_C):
				foreach($adboxs_C as $ad_box_C):
					?>	
					<div class="banner_c">
						<?php echo adrotate_ad($ad_box_C['advertise_id']); ?>
					</div>
					
					<?php
				endforeach; 
			endif;
		?> 
	</div>
	<div class="group_B">
		<?php 
			if($adboxs_D):
				foreach($adboxs_D as $ad_box_D):
					?>	
					<div class="banner_b">
						<?php echo adrotate_ad($ad_box_D['advertise_id']); ?>
					</div>
					
					<?php
				endforeach; 
			endif;
		?> 
	</div>
	<div class="group_C">
		<?php 
			if($adboxs_E):
				foreach($adboxs_E as $ad_box_E):
					?>	
					<div class="banner_c">
						<?php echo adrotate_ad($ad_box_E['advertise_id']); ?>
					</div>
					
					<?php
				endforeach; 
			endif;
		?> 
	</div>
</div>