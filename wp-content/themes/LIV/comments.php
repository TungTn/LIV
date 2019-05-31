<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package Miyatsu
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
	
	
		<div class="testimonial">
			
		<?php if ( have_comments() ) : ?>
			<?php
				if(is_singular('restaurants')){
					$comments = get_comments(
						array(
							'post_type' => 'restaurants',
							'post_id'	=> get_the_ID(),
							'status'	=> 'approve',
							'orderby' 	=> 'date',
							'order' 	=> 'DESC' 	
						)
					);
				}else{
					$comments = get_comments(
						array(
							'post_id'	=> get_the_ID(),
							'status'	=> 'approve',
							'orderby' 	=> 'date',
							'order' 	=> 'DESC' 	
						)
					);
				}


			?>
			<?php  if( !empty($comments)) :?>
				<h3 class="title">
					Comment
				</h3>
			<?php endif;?>
			<ul class="comment__list">
				<?php foreach($comments as $key =>  $comment):?>
					<?php if($key < 3 ) : ?>
						<li class="comment "  id="li-comment-<?php comment_ID() ?>">

					<?php else: ?>
						<li  class="comment search-unactive"  id="li-comment-<?php comment_ID() ?>">

					<?php endif; ?>
					    <div class="comments" id="comment-<?php comment_ID(); ?>" >
					        <div class="comments__avatar ">
					            <?php
					              $avatar = get_comment_meta($comment->comment_ID,'avatar_url',true);
					              if($avatar):
					               
					            ?>
					                <img style="" src="<?php echo $avatar;?>" />
					            <?php else: ?>
					                <img style="" src="<?php echo get_avatar_url($comment->user_id);?>" />
					            <?php endif; ?>
					        </div>
					        <div class="comments__content" style="">
					            <div class="comments__content__author">
					                <p><?php echo get_comment_author();?></p>
					      		  </div>
					            <div class="comments__content__time ">
					  				      <p>
					                    <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
									        </p>
					            </div>
					            <div class="comment__content__txt">
					                <?php echo wp_trim_words(get_comment_text(),
					                    '20',
					                    '<p data-content-short="'.mb_substr(get_comment_text(), 0, 145).'" data-content="'.get_comment_text().'"  class="comment_read_more" ><i>Read more...</i></p>');?>
					            </div>
					      	</div>
					    </div>
					</li>
				<?php endforeach;?>
			</ul>
		<?php endif; ?>
			
		</div><!-- #comments -->
		<?php  if( count($comments) > 3 ) :?>
			
			<button class="comments__btn--loadmore see_more " data-page-type="comment"  >
					Loadmore
			</button>
		<?php endif;?>
		<?php
			if(!is_singular('restaurants') && !is_singular('spas') && !is_singular('golfs') && !is_singular('casinos') && !is_singular('cafes') && !is_singular('nightlifes') ):
				
		?>
			<div class="comments__box">
				<h3 class="title">
					Leave a comment
				</h3>
				<div class="form-reviews-comment">
					<form enctype="multipart/form-data" data-type="comment" id="submit_comment" method="post" class="customForm form-comment" data-post-id="<?php echo $post->ID?>" data-user-id="<?php echo get_current_user_id();?>" data-url="<?php echo site_url() ?>/wp-admin/admin-ajax.php">
						<textarea id="comment" name="comment" placeholder="Leave a Comment" rows="5"></textarea>
						<p id="comment_error" class="log_error"></p>
						<input type="text" id="name" name="input_name" placeholder="Name*">
						<p id="name_error" class="log_error"></p>
						<input type="email" id="email" name="input_email" placeholder="Email*">
						<p id="email_error" class="log_error"></p>
						<input type="file" name="user_avatar" id="user_avatar" />
						<p>Upload your avatar ( support JPG,JPEG,PNG file ,max size 10mb</p>
						<p id="file_error" class="log_error"></p>
						<div class="g-recaptcha" data-sitekey="6LeMwJYUAAAAAJ3cUISBORqTfMdl5fF4WIw_hYyH"></div><br>
						<p id="captcha_error" class="log_error"></p>
						<button type="submit" class="submit-button">Submit</button>
					</form>
				</div>
			</div>
		<?php endif;?>
		
		
