
<div class="all_info" block-sc-pc>
	<h2 class="title">
		<a href="#">All info</a>	
	</h2>
	<?php 
		if ( !empty(get_field('menu_box', 'option')) ) : 
			$left_side_bars =  get_field('menu_box', 'option');
		
	?>
		<ul class="list">
			<?php foreach($left_side_bars as $side_bar ):?>
				<?php 
					switch ($side_bar['title']) {
						case 'Restaurant':
						$page = 'restaurant';
						break;
						case 'Spa/Hair Salon':
						$page = 'spa';
						break;
						case 'Cafe':
						$page = 'cafe';
						break;
						case 'Golf':
						$page = 'golf';
						break;
						case 'Tourism':
						$page = 'tour';
						break;
						case 'About Vietnam':
						$page = 'about-vietnam';
						break;
						case 'Night Life':
						$page = 'nightlife';
						break;
						case 'Casino':
						$page = 'casino';
						break;
					}
				?>
				<?php if (is_page($page)) :?>
					<li class="item active">
				<?php else:?>
					<li class="item">
				<?php endif;?>
					<a href="<?php echo $side_bar['link'];?>" data-background="<?php echo mvn_get_attachment_image_src($side_bar['image'],'mvn_200x200'); ?>">
						<div class="box">
							<img src="<?php echo mvn_get_attachment_image_src($side_bar['icon'],'mvn_114x138'); ?>">
							<h3 class="ttl"><?php echo $side_bar['title'];?></h3>
						</div>
					</a>
				</li>
			<?php endforeach;?>
		</ul>
	<?php endif; ?>
	
</div>