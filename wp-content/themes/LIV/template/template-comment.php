
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
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
                <?php echo wp_trim_words($comment->comment_content,
                    '20',
                    '<p data-content-short="'.mb_substr($comment->comment_content, 0, 145).'" data-content="'.$comment->comment_content.'"  class="comment_read_more" ><i>Read more...</i></p>');?>
            </div>
      	</div>
    </div>
</li>
      	
    