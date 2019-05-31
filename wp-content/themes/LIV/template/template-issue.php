<?php
/**
 * The template for displaying Issue Page.
 * @package Miyatsu
 * Template Name: Issue
**/
?>
<?php get_header(); ?>

<div class="IssueArea">
  <section class="mvArea">
    <?php 
      $slider_args = array(
        'post_type'     =>'issues', 
        'post_status'   =>'publish',
        'posts_per_page'  => '3',
        'offset'            => 0,
        'meta_key'      => 'feature_post',
        'meta_value'    => true,
        'orderby'           => 'date title',
        'order'             => 'DESC',
      );
      $slider_query = new WP_Query($slider_args);


    ?>
    <div class="swiper-container mv" id="mv">
      <div class="swiper-wrapper">
        <?php if($slider_query->have_posts()):?>
          <?php foreach($slider_query->posts as $slider):?>
            <?php if ( has_post_thumbnail($slider->ID) ): ?>
              <a href="<?php echo get_the_permalink($slider->ID); ?>" class="swiper-slide mv__item" data-background='<?php echo get_the_post_thumbnail_url($slider->ID,'full') ?>'>
            <?php else:?>
              <a href="<?php echo get_the_permalink($slider->ID); ?>" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/issue/mv_bg.png'>
            <?php endif;?>
                <div class="content">
                  <h2 class="tit"><?php echo $slider->post_title;?></h2>
                  <p class="date" block-sc-pc><?php echo get_the_date('d.m.Y',$slider->ID);?></p>
                  <p class="author">
                    <?php
                      if ( !empty(get_field('real_author', $slider->ID)) ) {
                        echo '<span>'.get_field('real_author', $slider->ID).'</span>';
                      }else{
                        echo '<span>Admin</span>';
                      }
                    ?>
                    |
                    <?php
                      if ( !empty(get_field('author_nationality', $slider->ID)) ) {
                        echo '<span>'.get_field('author_nationality', $slider->ID).'</span>';
                      }else{
                        echo '<span>Korean</span>';
                      }
                    ?>
                  </p>
                </div>
              </a>
          <?php endforeach;?>
        <?php else:?>
          <a href="#" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/issue/mv_bg.png'>
            <div class="content">
              <h2 class="tit">Season of white lotus</h2>
              <p class="date" block-sc-pc>12345 views  |  326 likes</p>
              <p class="author" block-sc-sp>Kang Jo Mun  |  Korea</p>
            </div>
          </a>
          <a href="#" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/issue/mv_bg.png'>
            <div class="content">
              <h2 class="tit">Season of white lotus</h2>
              <p class="date" block-sc-pc>12345 views  |  326 likes</p>
              <p class="author" block-sc-sp>Kang Jo Mun  |  Korea</p>
            </div>
          </a>
          <a href="#" class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/issue/mv_bg.png'>
            <div class="content">
              <h2 class="tit">Season of white lotus</h2>
              <p class="date" block-sc-pc>12345 views  |  326 likes</p>
              <p class="author" block-sc-sp>Kang Jo Mun  |  Korea</p>
            </div>
          </a>
        <?php endif;?>
      </div>
      <!-- Add Pagination -->
      <div class="swiper-pagination"></div>
    </div>
  </section>
  <section class="section issue_section">
    <?php  get_template_part('template/partial/breadcrumb') ; ?>
    <div class="container">
      <div class="inner">
        <div class="main">
          <?php  get_template_part('template/partial/aside') ; ?>
          <div class="content">
            <div class="today_news">
              <div class="today_news_block">
                <h2 block-sc-sp class="todays_news_ttl">Issues </h2>
                <div class="dropdown">
                  <form id="sort_select_form" method="post" data-post-per-page="5" data-post-type="issues" data-page-type="issue" data-url="<?php echo site_url() ?>/wp-admin/admin-ajax.php">
                    <select class="sort_select icondown" name="sort">
                      <option value="DESC">Lastest</option>
                      <option value="ASC">Oldest</option>
                    </select>
                    <i class="chevron-down"></i>
                  </form>
                </div>
              </div>
              <ul class="list issue-list">
                <?php
                  global $mvn_pagenavi, $mvn_blog, $wp_query;
                  $category = $wp_query->get_queried_object();
                    // Wp_query get post
                  $order = isset($_GET['sort']) ? $_GET['sort'] : 'DESC';
                  $post_per_page = 5;
                  $number_loadmore = 2;
                  $args = array(
                    'post_type'     =>'issues',
                    'post_status'   =>'publish',
                    'posts_per_page'  => $post_per_page,
                    'offset'            => 0,
                    'orderby'           => 'date title',
                    'order'             => $order,
                    'paged'       => max( get_query_var( 'paged' ), get_query_var( 'page' )),
                  );
                  $post_query = new WP_Query($args);
                  $wp_query = $post_query;

                    // Ajax loadmore
                  /* Post Ajax attr */
                  $mvn_blog = array(
                    'number_post'   => intval(wp_count_posts()->publish),
                    'started_posts'   => $post_per_page,
                    'post_per_page'   => $post_per_page,
                    'number_loadmore' => $number_loadmore,
                  );

                  if( ( $post_query->found_posts - $post_per_page ) < 0 ){
                    $max_paged = 1;
                  } else {
                    $max_paged = ceil( ( $post_query->found_posts - $post_per_page ) / $number_loadmore ) + 1;
                  }



                  $ajax_key =  uniqid();
                  $mvn_pagenavi = array( 'key' => 'mvn_'.$ajax_key, 'max-paged' => $max_paged );

                  if ( function_exists('mvn_render_script_ajax_block')) {
                    mvn_render_script_ajax_block($args, $mvn_blog, $ajax_key);
                  }

                  $delay = 0;
                ?>
                <?php if( $post_query->have_posts() ) :?>
                  <?php foreach($post_query->posts as $post):?>
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
                            <div class="padding-left-10" data-background="<?php echo mvn_get_attachment_image_src($image['ID'],'mvn_200x200'); ?>"></div>
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
                  <?php endforeach;?>
                <?php endif;wp_reset_query();?>  
              </ul>
            </div>
            <?php if($mvn_pagenavi['max-paged'] > 1):?>
              <div class="see_more">
                <a  data-page-type="issue" data-sort="DESC" data-key="<?php echo esc_attr($mvn_pagenavi['key']) ?>" data-disable="0" data-max-paged="<?php echo esc_attr($mvn_pagenavi['max-paged']) ?>" data-paged="2" class="btn btn__ajax--loadmore">
                  <i class="fas fa-angle-double-down"></i><span>See more</span>
                </a>
              </div>
            <?php endif;?>
          </div>
          <div class="banner home_banner"><?php get_template_part( 'template/partial/rightside' ); ?></div>
        </div>
      </div>
    </section>
  </div>

  <?php get_footer(); ?>