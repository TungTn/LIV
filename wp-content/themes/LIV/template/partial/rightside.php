<div class="group_A">
	<?php 
		if ( !empty(get_field('ad_box', 'option')) ) : 
			$adboxs_A =  get_field('ad_box', 'option');
			foreach($adboxs_A as $ad_box_A):
				?>	
				<div class="banner_a">
					<?php echo adrotate_ad($ad_box_A); ?>
				</div>
				
				<?php
			endforeach; 
		endif;
	?> 
</div>
<div class="group_B">
	<?php 
		if ( !empty(get_field('ad_box_b', 'option')) ) : 
			$adboxs_B =  get_field('ad_box_b', 'option');
			foreach($adboxs_B as $ad_box_B):
				?>	
				<div class="banner_b">
					<?php echo adrotate_ad($ad_box_B); ?>
				</div>
				
				<?php
			endforeach; 
		endif;
	?> 
	
</div>
<div class="group_C">
	<?php 
		if ( !empty(get_field('ad_box_c', 'option')) ) : 
			$adboxs_C =  get_field('ad_box_c', 'option');
			foreach($adboxs_C as $ad_box_C):
				?>	
				<div class="banner_c">
					<?php echo adrotate_ad($ad_box_C); ?>
				</div>
				
				<?php
			endforeach; 
		endif;
	?> 
	
</div>
<div class="group_B">
	<?php 
		if ( !empty(get_field('ad_box_d', 'option')) ) : 
			$adboxs_D =  get_field('ad_box_d', 'option');
			foreach($adboxs_D as $ad_box_D):
				?>	
				<div class="banner_b">
					<?php echo adrotate_ad($ad_box_D); ?>
				</div>
				
				<?php
			endforeach; 
		endif;
	?> 
	
</div>
<div class="group_C">
	<?php 
		if ( !empty(get_field('ad_box_e', 'option')) ) : 
			$adboxs_E =  get_field('ad_box_e', 'option');
			foreach($adboxs_E as $ad_box_E):
				?>	
				<div class="banner_c">
					<?php echo adrotate_ad($ad_box_E); ?>
				</div>
				
				<?php
			endforeach; 
		endif;
	?> 
	
</div>
