<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Miyatsu
 */

if ( ! function_exists( 'mvn_the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function mvn_the_posts_navigation() {
	the_posts_pagination( array(
		'mid_size'				=> 2,
		'prev_text'          	=> __( '<i class="fa fa-angle-double-left"></i>', 'mvn' ),
		'next_text'          	=> __( '<i class="fa fa-angle-double-right"></i>', 'mvn' ),
		'before_page_number' 	=> '<span class="meta-nav screen-reader-text">' . __( 'Page', 'mvn' ) . ' </span>',
	) );
}
endif;

if ( ! function_exists( 'mvn_the_posts_navigation_ajax' ) ) :

	function mvn_the_posts_navigation_ajax($page) {
			
		global $wp_query, $mvn_pagenavi;
		if( $mvn_pagenavi['max-paged'] > 1 ) {
			
			if ( $page == 'single' ) {
				?>
					<div class="mvn-load-more">
						<a href="javascript:;" data-key="<?php echo esc_attr($mvn_pagenavi['key']) ?>" data-disable="0" data-max-paged="<?php echo esc_attr($mvn_pagenavi['max-paged']) ?>" data-paged="2" class="btn btn__ajax--loadmore btn__ajax__single--loadmore">
							<span>VIEW MORE</span>
							<i class="fa fa-spin fa fa-refresh"></i>
						</a>
					</div>
				<?php
			} else {
				?>
					<div class="mvn-load-more">
						<a href="javascript:;" data-key="<?php echo esc_attr($mvn_pagenavi['key']) ?>" data-disable="0" data-max-paged="<?php echo esc_attr($mvn_pagenavi['max-paged']) ?>" data-paged="2" class="btn btn__ajax--loadmore">
							<span>READ MORE</span>
							<i class="fa fa-spin fa fa-refresh"></i>
						</a>
					</div>
				<?php
			}
		}
	}
	
endif;


if ( ! function_exists( 'mvn_navigation_prev_next' ) ) :

	function mvn_navigation_prev_next() {
		global $wp_query, $paged;
		$paged = max( get_query_var( 'paged' ), get_query_var( 'page' ));
		
		if ( $wp_query->max_num_pages > 1 ) :  ?>
		<div class="mvn-layout"  id="tf-pagination">
			<nav class="row navigation" role="navigation">
				<div class="col-sm-6 nav-previous text-left"><?php previous_posts_link( '<i class="fa fa-angle-double-left"></i> Newer Posts' ); ?></div>
				<div class="col-sm-6 nav-next text-right"><?php next_posts_link( 'Older Posts <i class="fa fa-angle-double-right"></i>', $wp_query ->max_num_pages ); ?></div>
			</nav>
		</div>
	<?php 
		endif;
	}
	
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- /.nav-links -->
	</nav><!-- /.navigation -->
	<?php
}
endif;
add_action('wp_ajax_mvn_sort_post', 'mvn_sort_post');
add_action('wp_ajax_nopriv_mvn_sort_post', 'mvn_sort_post');
function mvn_sort_post() {
	parse_str($_POST['form'],$post);

	$order = $post['sort'];
	$page_type = $_POST['page_type'];
	
	if($_POST['post_type']  == 'tag'){
		$post_type = array('tours','lifes','issues','news');
	}else{
		$post_type = $_POST['post_type'];
	}

	// Wp_query get post
	$post_per_page = $_POST['post_per_page'];
	$number_loadmore = 2;
	$args = array(
		'post_type'			=> $post_type, 
		'post_status'		=>'publish',
		'posts_per_page' 	=> $post_per_page,
		'offset'           	=> 0,
		'orderby'          	=> 'date title',
		'order'            	=> $order,
		'paged' 			=> max( get_query_var( 'paged' ), get_query_var( 'page' )),
	);
	if($_POST['tag']){
		$args['tag'] = $_POST['tag'];
	}
	if($_POST['post_taxonomy'] ) {
		$args['tax_query'] = array(
			array(
				'taxonomy'     => $_POST['post_taxonomy'],
				'field'        => 'slug',
				'terms'        => $_POST['taxonomy_term']
			)
		);
	}
	$post_query = new WP_Query($args);

	if ( $post_query->have_posts() ) :
		foreach($post_query->posts as $key => $post):
?>
		<?php if ( $page_type == 'news' ) :?>
			<li class="item">
				<a href="<?php echo get_the_permalink($post->ID); ?>">
					<?php if ( has_post_thumbnail($post->ID) ): ?>
						<div class="img" data-background='<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>'></div>													
					<?php else:?>
						<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png'></div>													
					<?php endif;?>
				</a>
				<div class="in">
					<h3 class="tit">
						<a href="<?php echo get_the_permalink($post->ID); ?>">
							<?php echo $post->post_title; ?>
							
						</a>
					</h3>
					<p class="date"><?php echo get_the_date('d.m.Y',$post->ID);?></p>
					<p class="txt">
						<?php
							if($post->post_content){
								$content = wp_strip_all_tags($post->post_content);
								$content = mb_substr($content, 0, 200);
								echo $content.'...';
							}
							
						?>
					</p>
					<div class="chatting">
						<p class="view"><?php echo getpostviews($post->ID); ?>  </p>
						<p class="like">
							<?php 
                                if (function_exists('wp_ulike_get_post_likes')):
                                  echo wp_ulike_get_post_likes($post->ID);
                                else:
                                  echo " 0 like";
                                endif;
								?>
						</p>
					</div>
				</div>
			</li>	
		<?php elseif ( $page_type =='lifes' ): ?>
			<?php if($key == 0):?>
				<li class="item item__first">
					<a href="<?php echo get_the_permalink($post->ID); ?>">
						<div class="image-list">
							<div class="image-badge">
								<?php 
									switch ($post->post_type) {
										case 'news':
											echo 'News';
											break;
										case 'tours':
											echo 'Tour';
											break;
										case 'lifes':
											echo 'Blog Post';
											break;
										case 'issues':
											echo 'Issue';
											break;
										default :
											echo "Post";
									}
								?>
							</div>
							<?php if ( has_post_thumbnail($post->ID) ): ?>
								<div class="img" data-background='<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>'></div>													
							<?php else:?>
								<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png'></div>													
							<?php endif;?>
						</div>
					</a>
					<div class="content">
						<a href="<?php echo get_the_permalink($post->ID); ?>">
							<span class="name"><?php echo $post->post_title; ?></span>
						</a>
						<div class="cmt">
							<span class="viewser"><?php echo getpostviews($post->ID); ?></span>
							<span class="likes">
								<?php
								if (function_exists('wp_ulike_get_post_likes')):
									echo wp_ulike_get_post_likes($post->ID);
								else:
									echo " 0 like";
								endif;
								?>
							</span>
						</div>
					</div>
				</li>
			<?php else: ?>
				<li class="item">
					<a href="<?php echo get_the_permalink($post->ID); ?>">
						<div class="image-list">
							<div class="image-badge">
								<?php 
									switch ($post->post_type) {
										case 'news':
											echo 'News';
											break;
										case 'tours':
											echo 'Tourism';
											break;
										case 'lifes':
											echo 'Blog Post';
											break;
										case 'issues':
											echo 'Issues';
											break;
										default :
											echo "Post";
									}
								?>
							</div>
							<?php if ( has_post_thumbnail($post->ID) ): ?>
								<div class="img" data-background='<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>'>
									
								</div>													
							<?php else:?>
								<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png'></div>										
							<?php endif;?>
						</div>
					</a>
					<div class="content">
						<a href="<?php echo get_the_permalink($post->ID); ?>">
							<span class="name"><?php echo $post->post_title; ?></span>
						</a>
						<div class="cmt">
							<span class="viewser"><?php echo getpostviews($post->ID); ?></span>
							<span class="likes">
								<?php
								if (function_exists('wp_ulike_get_post_likes')):
									echo wp_ulike_get_post_likes($post->ID);
								else:
									echo " 0 like";
								endif;
								?>
							</span>
						</div>
					</div>
				</li>
			<?php endif;?>
		<?php elseif ( $page_type =='issue' ):?>
			<li class="item">
                <div class="in">
                    <div class="top">
                        <h3 class="tit"><a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                      	<div class="chatting" block-sc-pc>
                            <p class="view"><?php echo getpostviews($post->ID); ?></p>
                            <p class="like">
                              <?php 
                                if (function_exists('wp_ulike_get_post_likes')):
                                  echo wp_ulike_get_post_likes($post->ID);
                                else:
                                  echo " 0 like";
                                endif;
                              ?>
                            </p>
                          </div>
                        </div>
                        <div class="author">
                          <p class="name">
                            <?php 
                              if ( !empty(get_field('real_author', $post->ID)) ) {
                                echo '<span>'.get_field('real_author', $post->ID).'</span>'; 
                              }else{
                                echo '<span>Admin</span>';
                              }
                            ?> 
                          </p>
                          <p class="country">
                           <?php 
                              if ( !empty(get_field('author_nationality', $post->ID)) ) {
                                echo '<span>'.get_field('author_nationality', $post->ID).'</span>'; 
                              }else{
                                echo '<span>Korean</span>';
                              }
                            ?> 
                          </p>
                        </div>
                        <p class="txt">
                          <?php 
                            if($post->post_content){
                              $content = wp_strip_all_tags($post->post_content);
                              $content = mb_substr($content, 0, 300);
                              echo $content.'...';
                            }
                            
                          ?>
                        </p>
                      </div>                      
                      <div class="imgArea" block-sc-pc>
                        <?php if ( !empty(get_field('gallery_image', $post->ID)) ): ?>
                          <?php $count = 0;?>
                          <?php foreach(get_field('gallery_image', $post->ID) as $image):?>
                            <img class="padding-left-10" src="<?php echo mvn_get_attachment_image_src($image['ID'],'mvn_200x200'); ?>" alt="">
                            <?php 
                              $count++;
                              if($count == 4 ){
                                break;
                              }
                             ?>
                          <?php endforeach;?>
                        <?php else:?>
                          <div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
                          </div>
                          <div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
                          </div>
                          <div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
                          </div>
                          <div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
                          </div>
                        <?php endif;?>
                      </div>
                      
					<div class="imgArea imgAreasp swiper-container" block-sc-sp>
						<?php if ( !empty(get_field('gallery_image', $post->ID)) ): ?>
						    <div class="swiper-wrapper">
						    
						      	<?php $count = 0;?>
						      	<?php foreach(get_field('gallery_image', $post->ID) as $image):?>
						        	<div class="swiper-slide">
						          		<div class="padding-left-10" data-background='<?php echo mvn_get_attachment_image_src($image['ID'],'full'); ?>'>
						      			</div>
						       	 	</div>                            
							        <?php 
							          	$count++;
						          		if($count == 4 ){
							            	break;
							          	}
							        ?>
							      	<?php endforeach;?>
						    </div>                          
						<?php endif;?>    
					<!-- Add Pagination -->
					<div class="swiper-pagination "></div>                    
					</div>
	            <p class="like_view_sp" block-sc-sp>
	                <span class="view"><?php echo getpostviews($post->ID); ?></span>
	                <span class="like">
	                  <?php 
	                    if (function_exists('wp_ulike_get_post_likes')):
	                      echo wp_ulike_get_post_likes($post->ID);
	                    else:
	                      echo " 0 like";
	                    endif;
	                  ?>
	                </span>
	  			</p>
        	</li>
		<?php else:?>
			<li class="item">
              	<div class="in">
                    <div class="top">
                      	<h3 class="tit"><a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                      	<div class="chatting">
                            <p class="view"><?php echo getpostviews($post->ID); ?></p>
                            <p class="like">
                              	<?php 
                                	if (function_exists('wp_ulike_get_post_likes')):
                                  		echo wp_ulike_get_post_likes($post->ID);
	                                else:
	                                  	echo " 0 like";
	                                endif;
                              	?>
                            </p>
                      	</div>
                    </div>
					<div class="author">
					  	<p class="name">
						    <?php 
						      	if ( !empty(get_field('real_author', $post->ID)) ) {
						        	echo '<span>'.get_field('real_author', $post->ID).'</span>'; 
						      	}else{
					       	 		echo '<span>Admin</span>';
						      	}
						    ?> 
					  	</p>
						<p class="country">
							<?php 
							  	if ( !empty(get_field('author_nationality', $post->ID)) ) {
							    	echo '<span>'.get_field('author_nationality', $post->ID).'</span>'; 
							  	}else{
							    	echo '<span>Korean</span>';
							  	}
							?> 
						</p>
					</div>
                    <p class="txt">
                      	<?php 
                        	if($post->post_content){
                          		$content = wp_strip_all_tags($post->post_content);
                          		$content = mb_substr($content, 0, 300);
                          		echo $content.'...';
                        	}
                        
                      	?>
                    </p>
                </div>
              	<div class="imgArea">
                	<?php if ( !empty(get_field('gallery_image', $post->ID)) ): ?>
                  		<?php $count = 0;?>
                  		<?php foreach(get_field('gallery_image', $post->ID) as $image):?>
		                    <p class="img">
		                      	<img src="<?php echo $image['url'];?>">
		                    </p>
		                    <?php 
		                      	$count++;
		                      	if($count == 4 ){
		                        	break;
		                      	}
		                    ?>
                  		<?php endforeach;?>
                	<?php endif;?>
              	</div>
            </li>
		<?php endif;?>
<?php 
		endforeach;
	endif;
	exit;	

}

add_action('wp_ajax_loadmore_posts_action', 'mvn_loadmore_posts_action');
add_action('wp_ajax_nopriv_loadmore_posts_action', 'mvn_loadmore_posts_action');

function mvn_loadmore_posts_action() {
	
	global $post, $wp_query, $count, $mvn_blog;
	
	$query = $_POST['query'];
	$atts = $_POST['atts'];
	$paged = $_POST['paged'];
	$page_type = $_POST['page_type'];
	$order = $_POST['sort'];

	$atts = str_replace('\"', '"', $atts);
	$atts = str_replace('\\\'', '\'', $atts);
	$mvn_agrs = json_decode($atts,true);
	$mvn_blog = $mvn_agrs;
	$query = str_replace('\"', '"', $query);
	$query = str_replace('\\\'', '\'', $query);
	$mvn_query = json_decode($query,true);
	
	$started_posts 		= $mvn_blog['started_posts'];
	$number_loadmore 	= $mvn_blog['number_loadmore'];
	$args = array(
		'posts_per_page' 	=> $number_loadmore,
		'offset'			=> $started_posts + $number_loadmore*($paged-2),
		'orderby'          	=> 'date title',
		'order'            	=> $order,
	);
	if($_POST['post_taxonomy'] ) {
		$args['tax_query'] = array(
			array(
				'taxonomy'     => $_POST['post_taxonomy'],
				'field'        => 'slug',
				'terms'        => $_POST['taxonomy_term']
			)
		);
	}
	$new_args = array_merge( $mvn_query, $args );
	$the_query = new WP_Query( $new_args );
	$post_type = $mvn_query['post_type'];
	$count = $started_posts + $number_loadmore*($paged-2);
	$delay = 0;
	
	if ( $the_query->have_posts() ) :
		while ($the_query->have_posts() ) : $the_query->the_post();
			if ( $page_type == 'single' ) :
				$delay++;	
				?>
				<article class="news__layout__item grid__row__col" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>00"> 
					<div class="news__thumb">
						<?php 
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'mvn_600x295' );
						?>
						<a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
					</div>
					<div class="news__meta">
						<span><?php echo get_the_date('Y.m.d',$post->ID); ?></span>
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					</div>
				</article>
			<?php elseif($page_type == 'taxonomy-location'):?>
				<div class="item-list-rest ">
					<a href="<?php echo get_the_permalink($post->ID); ?>">
						<div class="image-list">
							
							<?php if ( has_post_thumbnail($post->ID) ): ?>
								<div class="img restaurant_img" data-background="<?php echo get_the_post_thumbnail_url($post->ID,'full');?>">
								</div>
							<?php else:?>
								<div class="img restaurant_img" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/Clip.png">
								</div>
							<?php endif;?>
							
							
							<div class="image-on-image">
								<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/heart_bg_white.png" alt="">
							</div>
						</div>
					</a>
					<div class="name-address">
						<a href="<?php echo get_the_permalink($post->ID); ?>" class="name-res">
							<?php echo $post->post_title; ?>
						</a>
						<span class="add-res">
							<?php 
								if ( !empty(get_field('address', $post->ID)) ) { 
									echo get_field('address', $post->ID);
								}
							?>
						</span>
						<br/>
						<div class="heartbar">
							<?php 
								$comment_args = array(
									'status' => 'approve',
									'type'  => 'comment',
									'post_type' => $post_type,
									'post_id' => $post->ID,
								);
								$comments = get_comments($comment_args);
								if($comments){
									$comment_point = array();
									foreach($comments as $comment) {
										$rating = get_comment_meta( $comment->comment_ID, 'restaurant_rating', true );
										if($rating != ''){
											$comment_point[] = $rating;
										}		
									}
									if($comment_point != null){
										$average_vote = array_sum($comment_point)/count($comment_point);
									}	
								}else{
									$average_vote = 1;
								}
								
							?>
							<?php for ($i=1; $i < 6; $i++) : ?>
								<?php if($i <= round($average_vote)):?>
  									<span data-value="<?php echo $i;?>" class="hearted"></span>
		                        <?php else:?>
		                        	<span data-value="<?php echo $i;?>" class="heart"></span>
		                    	<?php endif;?>
							<?php endfor ?>
						</div>
						<span class="viewser"><?php echo getpostviews($post->ID); ?></span>
					</div>
				</div>
			<?php elseif($page_type == 'life-info' ):?>
				<li class="item">
					<a href="<?php echo get_the_permalink($post->ID); ?>">
						<div class="image-list">
							<div class="image-badge">
								Blog Post
							</div>
							<?php if ( has_post_thumbnail($post->ID) ): ?>
								<div class="img" data-background='<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>'>
									
								</div>													
							<?php else:?>
								<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png'></div>										
							<?php endif;?>
						</div>
					</a>
					<div class="content">
						<a href="<?php echo get_the_permalink($post->ID); ?>">
							<span class="name"><?php echo $post->post_title; ?></span>
						</a>
						<div class="cmt">
							<span class="viewser"><?php echo getpostviews($post->ID); ?></span>
							<span class="likes">
								<?php 
	                                if (function_exists('wp_ulike_get_post_likes')):
	                                  echo wp_ulike_get_post_likes($post->ID);
	                                else:
	                                  echo " 0 like";
	                                endif;
  								?>
							</span>
						</div>
					</div>
				</li>
			<?php elseif($page_type == 'news-info'):?>
				<li class="item">
					<a href="<?php echo get_the_permalink($post->ID); ?>">
						<?php if ( has_post_thumbnail($post->ID) ): ?>
							<div class="img" data-background='<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>'></div>													
						<?php else:?>
							<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png'></div>													
						<?php endif;?>
					</a>
					
					<div class="in">
						<h3 class="tit">
							<a href="<?php echo get_the_permalink($post->ID); ?>">
								<?php echo $post->post_title; ?>
								
							</a>
						</h3>
						<p class="date"><?php echo get_the_date('d.m.Y',$post->ID);?></p>
						<p class="txt">
							<?php
								$content = wp_strip_all_tags($post->post_content);
								$content = mb_substr($content, 0, 200);
								echo $content.'...';
							?>
						</p>
						<div class="chatting">
							<p class="view"><?php echo getpostviews($post->ID); ?>  </p>
							<p class="like">
								<?php 
	                                if (function_exists('wp_ulike_get_post_likes')):
	                                  echo wp_ulike_get_post_likes($post->ID);
	                                else:
	                                  echo " 0 like";
	                                endif;
  								?>
							</p>
						</div>
					</div>
				</li>	
			<?php elseif( $page_type == 'tour-info'): ?>
				<article class="article">
					<div class="img">
						<a href="<?php echo get_the_permalink($post->ID); ?>">
							<?php if ( has_post_thumbnail($post->ID) ): ?>
								<div class="img img_tour" data-background='<?php echo get_the_post_thumbnail_url($post->ID); ?>'></div>
							<?php else: ?>
								<div class="img img_tour" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png'></div>
							<?php endif;?>
						</a>
					</div>
					<div class="box">
						<h3 class="ttl">
							<a href="<?php echo get_the_permalink($post->ID); ?>">
								<?php echo $post->post_title; ?>													
							</a>
						</h3>
						<div class="rate">
							<span class="view"><?php echo getpostviews($post->ID); ?></span>  
							<span class="like">
								<?php 
	                                if (function_exists('wp_ulike_get_post_likes')):
	                                  echo wp_ulike_get_post_likes($post->ID);
	                                else:
	                                  echo " 0 like";
	                                endif;
  								?>
							</span>
						</div>
					</div>
				</article>	
			<?php elseif( $page_type == 'issue' ) :?>	
				<li class="item">
              		<div class="in">
                        <div class="top">
                          	<h3 class="tit"><a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                          	<div class="chatting" block-sc-pc>
                            	<p class="view" ><?php echo getpostviews($post->ID); ?></p>
	                            <p class="like">
	                              <?php 
	                                if (function_exists('wp_ulike_get_post_likes')):
	                                  echo wp_ulike_get_post_likes($post->ID);
	                                else:
	                                  echo " 0 like";
	                                endif;
	                              ?>
	                            </p>
                          	</div>
                        </div>
                        <div class="author">
                          	<p class="name">
	                            <?php 
	                              if ( !empty(get_field('real_author', $post->ID)) ) {
	                                echo '<span>'.get_field('real_author', $post->ID).'</span>'; 
	                              }else{
	                                echo '<span>Admin</span>';
	                              }
	                            ?> 
                          	</p>
                        	<p class="country">
                           		<?php 
									if ( !empty(get_field('author_nationality', $post->ID)) ) {
									echo '<span>'.get_field('author_nationality', $post->ID).'</span>'; 
									}else{
									echo '<span>Korean</span>';
									}
                            	?> 
                          	</p>
                        </div>
                        <p class="txt">
                          <?php 
                            if($post->post_content){
                              $content = wp_strip_all_tags($post->post_content);
                              $content = mb_substr($content, 0, 300);
                              echo $content.'...';
                            }
                            
                          ?>
                        </p>
                    </div>
					<div class="imgArea" block-sc-pc>
						<?php if ( !empty(get_field('gallery_image', $post->ID)) ): ?>
						  	<?php $count = 0;?>
					  		<?php foreach(get_field('gallery_image', $post->ID) as $image):?>
                            	<div class="img" data-background='<?php echo $image['url'] ?>'>
                            	</div>
							    <?php 
							      $count++;
							      if($count == 4 ){
							        break;
							      }
							    ?>
					  		<?php endforeach;?>
						<?php else:?>
							<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
                        	</div>
                        	<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
                        	</div>
                        	<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
                        	</div>
                        	<div class="img" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/life_info/item1.jpg'>
                        	</div>
						<?php endif;?>
					</div>
					<div class="imgArea imgAreasp imgAreasp__loadmore swiper-container" block-sc-sp>
                      	<?php if ( !empty(get_field('gallery_image', $post->ID)) ): ?>
	                        <div class="swiper-wrapper">
	                          	<?php $count = 0;?>
	                          	<?php foreach(get_field('gallery_image', $post->ID) as $image):?>
		                            <div class="swiper-slide">
		                              	<div class="padding-left-10" data-background='<?php echo mvn_get_attachment_image_src($image['ID'],'full'); ?>'>
		                          		</div>
		                            </div>                            
		                            <?php 
		                              	$count++;
		                              	if($count == 4 ){
		                                	break;
		                              	}
		                            ?>
	                          <?php endforeach;?>
	                        </div> 
                        <?php endif;?>
                          <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>                        
                    </div>
                    <p class="like_view_sp" block-sc-sp>
                        <span class="view"><?php echo getpostviews($post->ID); ?></span>
                        <span class="like">
                          <?php 
                            if (function_exists('wp_ulike_get_post_likes')):
                              echo wp_ulike_get_post_likes($post->ID);
                            else:
                              echo " 0 like";
                            endif;
                          ?>
                        </span>
                    </p>
                </li>
			<?php else : ?>
				<div class="item-list-rest ">
					<a href="<?php echo get_the_permalink($post->ID); ?>">
						<div class="image-list">
							<?php if ( has_post_thumbnail($post->ID) ): ?>
								<img src="<?php echo mvn_get_attachment_image_src(get_post_thumbnail_id($post->ID),'mvn_362x315'); ?>" alt="">
							<?php endif?>
						</div>
					</a>
					<div class="name-address">
						<a href="<?php echo get_the_permalink($post->ID); ?>">
							<span class="name-res"><?php echo $post->post_title; ?></span>
						</a>
						<br/>
						<span class="add-res">
							<?php 
								if ( !empty(get_field('address', $post->ID)) ) { 
									echo get_field('address', $post->ID);
								}
							?>
						</span>
						<br/>
						<div class="heartbar">
							<?php 
								if ( !empty(get_field('vote', $post->ID)) ) { 
									$vote = get_field('vote', $post->ID);
								}
							?>
							<?php for ($i=1; $i < 6; $i++) : ?>
								<?php if($i <= round($vote)):?>
  									<span data-value="<?php echo $i;?>" class="hearted"></span>
		                        <?php else:?>
		                        	<span data-value="<?php echo $i;?>" class="heart"></span>
		                    	<?php endif;?>
							<?php endfor ?>
						</div>
						<span class="viewser"><?php echo getpostviews($post->ID); ?></span>
					</div>
				</div>
			<?php
			endif;
		endwhile;
	endif;
	
	exit;
}
add_action('wp_ajax_mvn_filter_tag', 'mvn_filter_tag');
add_action('wp_ajax_nopriv_mvn_filter_tag', 'mvn_filter_tag');
function mvn_filter_tag(){
	if(defined('DOING_AJAX') && DOING_AJAX) {
		parse_str($_POST['form'],$input_post);

		$filter = array();
		$cuisine_value = array();
		$ingredient_value = array();
		$purpose_value = array();
		if( $input_post['ingredient'] != null ) {
			foreach($input_post['ingredient'] as $ingredient_input){
				if($ingredient_input != null){
					$ingredient_value[] = $ingredient_input;
				}
			}
			$filter['ingredient_option'] = $ingredient_value;
		}
		

		if( $input_post['purpose'] != null ) {
			foreach($input_post['purpose'] as $purpose_input){
				if($purpose_input != null){
					$purpose_value[] = $purpose_input;
				}
			}
			$filter['purpose_option'] = $purpose_value; 
		}
		

		if( $input_post['cuisine'] != null ) {
			foreach($input_post['cuisine'] as $cuisine_input){
				if($cuisine_input != null){
					$cuisine_value[] = $cuisine_input;
				}
			}
			$filter['cuisine_option'] = $cuisine_value;
		}

		
		$filter_option_args = array(
			'relation' => 'OR',
		);
		foreach( $filter as $meta_key => $meta_value ) {
			foreach($meta_value as $value){
				$filter_query = array(
					'taxonomy' => $meta_key,
					'field' => 'slug',
					'terms' => $value,
				);
				array_push( $filter_option_args, $filter_query );
			}

		}
		$filter_location_args = array(
			'relation' => 'AND',
			array(
					'taxonomy'     => $input_post['taxonomy'],
					'field'        => 'slug',
					'terms'        => $input_post['term']
			),
			$filter_option_args
		);
		
		$filter_args = array(
			'tax_query' => $filter_location_args,

		);
		
		$basic_args = array(
			'post_type' => 'restaurants',
			'post_status' 		=> 'publish',
			'orderby'          => 'date title',
			'order'            => 'DESC',
			'posts_per_page'	=> -1,
			'paged' 			=> max( get_query_var( 'paged' ), get_query_var( 'page' )),
			
		);

		$post_args = array_merge($basic_args,$filter_args);
		$post_query = new WP_Query($post_args);
		
		
		$voted_star = (empty($input_post['voted_star'])) ? 0 : $input_post['voted_star'];
		
		$post_with_vote = array();
		if( $post_query->have_posts() ) {
			foreach( $post_query->posts as $post ) {
				$comment_args = array(
					'status' => 'approve',
					'type'  => 'comment',
					'post_type' => 'restaurants',
					'post_id' => $post->ID,
				);
				$comments = get_comments( $comment_args );
				$average_vote = 1;
				if( $comments ) {
					$comment_point = array();
					foreach( $comments as $comment ) {
						$rating = get_comment_meta( $comment->comment_ID, 'restaurant_rating', true );
						if($rating != ''){
							$comment_point[] = $rating;
						}
					}
					if($comment_point != null){
						$average_vote = array_sum($comment_point)/count($comment_point);
					}
					if(round($average_vote) >= $voted_star){
						$post_with_vote[$post->ID] = $average_vote;
					}
					
				}else{
					if($voted_star <= 1) {
						$post_with_vote[$post->ID] = $average_vote;
					}
					
				}
			}
		}
		
		if($post_with_vote != null ){
			if( $voted_star < 5 ) {
				asort($post_with_vote);
			}else{
				arsort($post_with_vote);
			}
		}
				
?>
	
	<h2 class="title"><?php echo $input_post['term_name'];?></h2>
		<div class="restaurant-list">
		<?php 
			if($post_with_vote):
			$count = 0;
			foreach($post_with_vote as $key => $post): 
				$count++;
		?>	
		<?php if($count <= 12) :?>
			<div class="item-list-rest ">
		<?php else: ?>
			<div class="item-list-rest search-unactive">
		<?php endif;?>
			
				<a href="<?php echo get_the_permalink($key); ?>">
					<div class="image-list">
						
						<?php if ( has_post_thumbnail($key) ): ?>
							<div class="img restaurant_img" data-background="<?php echo get_the_post_thumbnail_url($key,'full');?>">
							</div>
						<?php else:?>
							<div class="img restaurant_img" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/Clip.png">
							</div>
						<?php endif;?>
						<div class="image-on-image">
							<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/restaurant_list/heart_bg_white.png" alt="">
						</div>
					</div>
				</a>
				<div class="name-address">
					<a href="<?php echo get_the_permalink($key); ?>" class="name-res">
						<?php echo get_the_title($key) ; ?>
					</a>
					<span class="add-res">
						<?php 
							if ( !empty(get_field('address', $key)) ) { 
								echo get_field('address', $key);
							}
						?>
					</span>
					<br/>
					<div class="heartbar">
						<?php 
							$comment_args = array(
								'status' => 'approve',
								'type'  => 'comment',
								'post_type' => 'restaurants',
								'post_id' => $key,
							);
							$comments = get_comments($comment_args);
							if($comments){
								$comment_point = array();
								foreach($comments as $comment) {
									$rating = get_comment_meta( $comment->comment_ID, 'restaurant_rating', true );
									if($rating != ''){
										$comment_point[] = $rating;
									}
									
								}
								if($comment_point != null){
									$average_vote = array_sum($comment_point)/count($comment_point);
								}
							}else{
								$average_vote = 1;
							}
						?>
						<?php for ($i=1; $i < 6; $i++) : ?>
							<?php if($i <= round($average_vote)):?>
									<span data-value="<?php echo $i;?>" class="hearted"></span>
	                        <?php else:?>
	                        	<span data-value="<?php echo $i;?>" class="heart"></span>
	                    	<?php endif;?>
						<?php endfor ?>
					</div>
					<span class="viewser"><?php echo getpostviews($key); ?></span>
				</div>
			</div>
			
		
	<?php endforeach; ?>
	</div>
<?php if(count($post_with_vote) > 12 ):?>
	 <div class="see_more" data-page-type="restaurants">
        <a >
            <i class="fas fa-angle-double-down"></i><span>See more</span>
        </a>
    </div>  
<?php endif;?>
<?php		
	else :
		echo "<h2>Sorry , Nothing has found... Please try again , Thank you</h2>";
	endif;
	exit;
	}
	
}

add_action('wp_ajax_add_review', 'add_review');
add_action('wp_ajax_nopriv_add_review', 'add_review');

function add_review() {
	if(defined('DOING_AJAX') && DOING_AJAX) {
		parse_str($_POST['form'],$post);
		if($post['g-recaptcha-response'] == null ){

			$errors['captcha'] = '*You need to verify the captcha';
		}
		if($post['restaurant_rating']){
			$rating_array = ['5','4','3','2','1'];
			if(in_array($post['restaurant_rating'],$rating_array) === false) {
				$errors['validate'] = 'Your input is not correct with our form';
			}
		}
		if($post['input_name'] == null ){

			$errors['name'] = '*Your name cannot be empty, please try again.';
		}
		if($post['input_email'] == null ){
			$errors['email'] = '*Your email cannot be empty, please try again.';
		}
		if($post['comment'] == null){
			$errors['comment'] = "*Your comment cannot be empty, please try again.";
		}
		if($_FILES) {
			$allowed_file_types = array( "image/jpeg", "image/jpg", "image/png" );
			$allowed_file_size = 10000000;
			if( !in_array($_FILES['file']['type'], $allowed_file_types)){
				$errors['file'] = "*Your file type is invalid";
			}
			if( $_FILES['file']['size'] > $allowed_file_size){
				$errors['file'] = "*Your file size is too big";
			}
		}

		if($errors == null){
			$time = current_time('mysql');
			$data = array(
				'comment_post_ID' => $_POST['post_id'],
				'comment_author' => sanitize_text_field($post['input_name']),
				'comment_author_email' => sanitize_email($post['input_email']),
				'comment_content' => sanitize_textarea_field($post['comment']),
				'comment_type' => '',
				'comment_parent' => 0,
				'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
				'comment_agent' => $_SERVER['HTTP_USER_AGENT'],
				'comment_date' => $time,
				'comment_approved' => 0,
				'user_id' => get_current_user_id(),
			);
			$comment_id = wp_insert_comment($data);
			if($comment_id != false ){
				if($_FILES){
					$avatar = wp_upload_bits($_FILES['file']['name'], null, file_get_contents($_FILES['file']['tmp_name']));
					add_comment_meta($comment_id,'avatar_url',$avatar['url']);
				}
				if($_POST['comment_type'] == 'review'){
					add_comment_meta($comment_id,'restaurant_rating',sanitize_text_field($post['restaurant_rating']));
          			add_comment_meta($comment_id,'travel_type',sanitize_text_field($post['travel_type']));
	          		
				}
				
          		
				$result = array(
					'status' => 'success',
					'message' => 'thank you for submit',
				);
			}
			echo json_encode($result);
			exit;

		}else{
			$result = array(
				'status' => 'error',
				'message' => $errors,
			);
			echo json_encode($result);
			exit;
		}
	}
}

function mvn_breadcrumb() { 
	
    //Variable (symbol >> encoded) and can be styled sepmvntely.
    //Use >> for different level categories (parent >> child >> grandchild)
    $delimiter = '<span class="delimiter"> &raquo; </span>';
    //Use bullets for same level categories ( parent . parent )
    $delimiter1 = '<span class="delimiter1"> &bull; </span>';
     
    //text link for the 'Home' page
            $main = esc_html__('Home','mvn'); 
    //Display only the first 30 chmvncters of the post title.
            $maxLength= 30; 
     
    //variable for archived year
    $arc_year = get_the_time('Y');
    //variable for archived month
    $arc_month = get_the_time('F');
    //variables for archived day number + full
    $arc_day = get_the_time('d');
    $arc_day_full = get_the_time('l'); 
     
    //variable for the URL for the Year
    $url_year = get_year_link($arc_year);
    //variable for the URL for the Month   
    $url_month = get_month_link($arc_year,$arc_month);
 
    /*is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
    when the main blog page is being displayed and the 'Settings > Reading ->Front page displays'
    is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
    "A static page" and the "Front Page" value is the current Page being displayed. In this case
    no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */
     
    //Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
    if (!is_front_page()) {        
        //If Breadcrump exists, wrap it up in a div container for styling.
        //You need to define the breadcrumb class in CSS file.
         echo "<ul class='breadcrumb'>";
         
        //global WordPress variable $post. Needed to display multi-page navigations.
        global $post, $cat;        
        //A safe way of getting values for a named option from the options database table.
        $homeLink = home_url('/'); //same as: $homeLink = get_bloginfo('url');
        //If you don't like "You are here:", just remove it.
        // echo '<li><a href="' . esc_url($homeLink) . '">' . $main . '</a></li>';   
        echo '<li><a href="' . esc_url($homeLink) . '">'.$main.'</a></li>';   
         
        //Display breadcrumb for single post
        if (is_single()) { //check if any single post is being displayed.          
            //Returns an array of objects, one object for each category assigned to the post.
            //This code does not work well (wrong delimiters) if a single post is listed
            //at the same time in a top category AND in a sub-category. But this is highly unlikely.
           
            $post_type = get_post_type(get_the_ID());

            $post_type_object = get_post_type_object($post_type);

           	$get_post_taxonomies = get_post_taxonomies(get_the_ID());
           	$tax = $get_post_taxonomies[1];
            $term = get_the_terms(get_the_ID(),$tax);
          	
           	switch ($post_type_object->name){
           		case 'news':
        		$single_link = 'news-info';
        		break;
        		case 'lifes':
        		$single_link = 'lifes-info';
        		break;
        		case 'issues':
        		$single_link = 'issue';
        		break;
        		case 'restaurants':
        		$single_link = 'restaurant';
        		$type = 'Restaurant';
        		break;
        		case 'tours':
        		$single_link = 'tour';
        		break;
        		case 'casinos':
        		$single_link = 'casino';
        		$type = 'Casino';
        		break;
        		case 'spas':
        		$single_link = 'spa';
        		$type = 'Spa/Hair Salon';
        		break;
        		case 'cafes':
        		$single_link = 'cafe';
        		$type = 'Cafe';
        		break;
        		case 'golfs':
        		$single_link = 'golf';
        		$type = 'Golf';
        		break;
        		case 'nightlifes':
        		$single_link = 'nightlife';
        		$type = 'Night Life';
        		break;
           	}
            echo '<li><a href="'.get_site_url().'/'.$single_link.'"><span>' . $post_type_object->label .'</span></a></li>'; 
            if(is_singular('restaurants') || is_singular('spas') || is_singular('golfs') || is_singular('casinos') || is_singular('cafes') || is_singular('nightlifes') ) {
            	echo '<li><a href="'.get_site_url().'/'.$single_link.'/'.$term[0]->slug.'"><span>'.$type.' in '.$term[0]->name.'</span></a></li>';
            }
           
            echo '<li><span>' . get_the_title() .'</span></li>';
            
			
        }
        //Display breadcrumb for category and sub-category archive
        elseif (is_category()) { //Check if Category archive page is being displayed.
            //returns the category title for the current page.
            //If it is a subcategory, it will display the full path to the subcategory.
            //Returns the parent categories of the current category with links sepmvnted by '»'
            echo '<li><span>'. substr(get_category_parents($cat, true,' | '),0 ,strlen(get_category_parents($cat, true,' | '))-2) . '</span></li>' ;
        }      
        //Display breadcrumb for tag archive       
        elseif ( is_tag() ) { //Check if a Tag archive page is being displayed.
            //returns the current tag title for the current page.
            echo '<li><span>'. esc_html__('Tagged with','mvn') .': "' . single_tag_title("", false) . '"'. '</span></li>';
        }
        elseif ( is_tax() ) {
        	$tax = get_post_taxonomies(get_the_ID());
           	switch (get_query_var('taxonomy')){
           		case 'news':
        		$single_link = 'news-info';
        		$taxonomy_label = 'News Info';
        		break;
        		case 'lifes':
        		$single_link = 'lifes-info';
        		$taxonomy_label = 'Life Info';
        		break;
        		case 'issues':
        		$single_link = 'issues';
        		$taxonomy_label = 'Issues';
        		break;
        		case 'restaurant':
        		$single_link = 'restaurant';
        		$taxonomy_label = 'Restaurant';
        		break;
        		case 'tour':
        		$single_link = 'tour';
        		$taxonomy_label = 'Tour';
        		break;
        		case 'casino':
        		$single_link = 'casino';
        		$taxonomy_label = 'Casino';
        		break;
        		case 'spa':
        		$single_link = 'spa';
        		$taxonomy_label = 'Spa/Hair Salon';
        		break;
        		case 'golf':
        		$single_link = 'golf';
        		$taxonomy_label = 'Golf';
        		break;
        		case 'nightlife':
        		$single_link = 'nightlife';
        		$taxonomy_label = 'Night Life';
        		break;
        		case 'cafe':
        		$single_link = 'cafe';
        		$taxonomy_label = 'Cafe';
        		break;
           	}
            //then the post is listed in more than 1 category. 
         
            echo '<li><a href="'.get_site_url($single_link).'/'.$single_link.'"><span>'. $taxonomy_label .'</span></a></li>';   
        	echo '<li><span>'.$taxonomy_label.' in ' . single_term_title("",false) .'</span></li>';
        }       
        //Display breadcrumb for calendar (day, month, year) archive
        elseif ( is_day()) { //Check if the page is a date (day) based archive page.
            echo '<li><a href="' . esc_url($url_year) . '">' . $arc_year . '</a></li>';
            echo '<li><a href="' . esc_url($url_month) . '">' . $arc_month . '</a> ' . $arc_day . ' (' . $arc_day_full . ')</li>';
        }
        elseif ( is_month() ) {  //Check if the page is a date (month) based archive page.
            echo '<li><span><a href="' . esc_url($url_year) . '">' . $arc_year . '</a> ' . $arc_month . '</span></li>';
        }
        elseif ( is_year() ) {  //Check if the page is a date (year) based archive page.
            echo '<li><span>'. $arc_year .'</span></li>';
        }      
        //Display breadcrumb for search result page
        elseif ( is_search() ) {  //Check if search result page archive is being displayed.
            echo '<li><span>'. esc_html__('Search results for','mvn') .' "'. get_search_query() .'"</span></li>';
        }      
        //Display breadcrumb for top-level pages (top-level menu)
        elseif ( is_page() && !$post->post_parent ) { //Check if this is a top Level page being displayed.
            echo '<li><span>'. get_the_title() .'</span></li>';
        }          
        //Display breadcrumb trail for multi-level subpages (multi-level submenus)
        elseif ( is_page() && $post->post_parent ) {  //Check if this is a subpage (submenu) being displayed.
            //get the ancestor of the current page/post_id, with the numeric ID
            //of the current post as the argument.
            //get_post_ancestors() returns an indexed array containing the list of all the parent categories.               
            $post_array = get_post_ancestors($post);
             
            //Sorts in descending order by key, since the array is from top category to bottom.
            krsort($post_array);
             
            //Loop through every post id which we pass as an argument to the get_post() function.
            //$post_ids contains a lot of info about the post, but we only need the title.
            foreach($post_array as $key=>$postid){
                //returns the object $post_ids
                $post_ids = get_post($postid);
                //returns the name of the currently created objects
                $title = $post_ids->post_title;
                //Create the permalink of $post_ids
                echo '<li><a href="' . get_permalink($post_ids) . '">' . $title . '</a> </li>';
            }
			echo '<li><span>';
            the_title(); //returns the title of the current page.           
			echo '</span></li>';
        }          
        //Display breadcrumb for author archive  
        elseif ( is_author() ) {//Check if an Author archive page is being displayed.
            global $author;
            //returns the user's data, where it can be retrieved using member variables.
            $user_info = get_userdata($author);
            echo  '<li><span>'. esc_html__('Posts by','mvn') .': ' . $user_info->display_name .'</span></li>';
        }      
        //Display breadcrumb for 404 Error
        elseif ( is_404() ) {//checks if 404 error is being displayed
            echo  '<li class="active">'. esc_html__('Error 404 - Not Found.','mvn') .'</li>';
        }
		elseif( is_archive() ) {
			echo  '<li><span>'. mvn_get_the_archive_title() .'</span></li>';
		}
        else {
            //All other cases that I missed. No Breadcrumb trail.
        }
        echo '</ul>';
    }  
}