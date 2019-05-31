<?php
/**
 * The template for displaying Search Page.
 * @package Miyatsu
 * Template Name: Search
**/ 
   
    
?> 
<?php get_header(); ?>
<?php 
    $post_type_args = array(
        'public'   => true,
        '_builtin' => false
    );
    $post_types = get_post_types($post_type_args,'names');

    $results = array();
    $search_result = array();
    foreach($post_types as $key => $post_type){

        $args = array(
            'post_type'         => $post_type,
            'post_status'       =>'publish',
            'posts_per_page'    => -1,
            'offset'            => 0,
            'orderby'           => 'date title',
            'order'             => 'DESC',
            'paged'             => max( get_query_var( 'paged' ), get_query_var( 'page' )),
        );
        $keyword = isset($_GET['search']) ? $_GET['search'] : '';
        if($keyword){
            $args['s'] = $keyword;
        }
        $post_query = new WP_Query($args);
        if($post_query->have_posts() ) 
        {
            foreach($post_query->posts as $post){
                $search_result[] = $post;
            }
        }
        
        switch ($post_type) {
            case 'news':
            $post_type = 'News Info';
            $results[0] = array(
                'post_type' => 'News Info',
                'link' => 'news-info',
                'image' => 'newspaper',
                'post' => $post_query->posts
            );
            break;
            case 'lifes':
             $results[1] = array(
                'post_type' => 'Life Info',
                'link' => 'lifes-info',
                'image' => 'bike',
                'post' => $post_query->posts
            );
            break;
            case 'restaurants':
             $results[2] = array(
                'post_type' => 'Restaurant',
                'link' => 'restaurant',
                'image' => 'restaurant',
                'post' => $post_query->posts
            );
            break;
            case 'tours':
             $results[7] = array(
                'post_type' => 'Tourism',
                'link' => 'tour',
                'image' => 'tourism',
                'post' => $post_query->posts
            );
            break;
            case 'issues':
             $results[4] = array(
                'post_type' => 'Issues',
                'link' => 'issue',
                'image' => 'discussion',
                'post' => $post_query->posts
            );
            break;
            case 'career':
             $results[10] = array(
                'post_type' => 'Career',
                'link' => 'careers',
                'image' => '',
                'post' => $post_query->posts
            );
            break;
            case 'casinos':
             $results[9] = array(
                'post_type' => 'Casino',
                'link' => 'casino',
                'image' => 'casino',
                'post' => $post_query->posts
            );
            break;
            case 'spas':
             $results[3] = array(
                'post_type' => 'Spa/Hair Salon',
                'link' => 'spa',
                'image' => 'flower',
                'post' => $post_query->posts
            );
            break;
            case 'golfs':
             $results[6] = array(
                'post_type' => 'Golf',
                'link' => 'golf',
                'image' => 'golf',
                'post' => $post_query->posts,
            );
            break;
            case 'cafes':
             $results[5] = array(
                'post_type' => 'Cafe',
                'link' => 'cafe',
                'image' => 'cafe',
                'post' => $post_query->posts
            );
            break;
            case 'nightlifes':
             $results[8] = array(
                'post_type' => 'Night Life',
                'link' => 'night-life',
                'image' => 'beer',
                'post' => $post_query->posts
            );
            break;
           
        }
    }
    ksort($results);
    $total_result = count($search_result);
    wp_reset_query();
?>
<div class="searchArea">
    <section class="section search_section">
        <?php  get_template_part('template/partial/breadcrumb') ; ?>
        <?php if( $keyword == '' || $total_result == 0 ): ?>
            <div class="container">
                <div class="search-top-page nothing-found">
                    <h2 class="title">Search: <?php echo $keyword; ?> </h2>
                    <div class="result">
                        0 result
                    </div>
                    <div class="alert">
                        <h2 class="title">Oops, we couldn't find anything!</h2>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="container">            
                <div class="search-top-page">
                    <h2 class="title">Search: <?php echo $keyword;?></h2>
                    <div class="result">
                        <?php echo $total_result;?> result
                    </div>
                    <p class="ttl" block-sc-sp>Jump to</p>
                    <div class="menu-search" block-sc-pc>                        
                        <div class="menu-search-in">
                            <p class="ttl" block-sc-pc>Jump to</p>
                            <?php if($results):?>
                                <?php foreach($results as $key => $result):?>
                                   
                                    <?php if( $key <10 ):?>
                                    <div class="search-box-result">
                                        <a href="<?php echo get_site_url();?>/<?php echo $result['link'];?>" <?php if(!empty($result['post'])):?> class="active" <?php else:?> class="unactive" <?php endif; ?> >
                                            <?php echo $result['post_type'];?>
                                        </a>
                                    </div>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="menu-search" block-sc-sp>                    
                        <div class="slidebox">
                            <?php if( wp_is_mobile() ) :?>
                                <?php if( $results ) : ?>
                                    <?php foreach( $results as $key => $result ) : ?>
                                        <?php if ( $key < 10 ):?>
                                            <div <?php if(!empty($result['post'])):?> class="slidebox__block active" <?php else:?> class="slidebox__block" <?php endif; ?> class="slidebox__block">
                                                <a href="<?php echo get_site_url();?>/<?php echo $result['link'];?>" class="block_link">
                                                    <div class="slide__block__img">
                                                        <?php if(!empty($result['post'])):?>
                                                            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/search/<?php echo
                                                            $result['image']?>_active.png">
                                                         <?php else:?>
                                                            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/search/<?php echo
                                                            $result['image']?>.png">
                                                         <?php endif;?>
                                                    </div>
                                                    <div class="slide_block_txt">
                                                        <?php echo $result['post_type'];?>
                                                    </div>                                  
                                                </a>
                                             </div>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                <?php endif;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>                       
            </div>        
            <div class="container">         
                <div class="inner">
                    <div class="main">
                        <div class="content">
                            <div class="search">
                                <?php if($results): ?>
                                    <?php foreach($results as $position => $result):?>
                                        <?php if($position < 10) :?>
                                            <?php if(!empty($result['post'])):?>
                                            <div class="search-details" id="<?php echo $result['post_type'];?>">
                                                
                                                <h2 class="title">
                                                    <a href="<?php get_site_url()?>/<?php echo $result['link'];?>"><?php echo ucfirst($result['post_type']);?></a>
                                                </h2>
                                                <div class="search-box">
                                                    <ul class="list">
                                                        <?php foreach($result['post'] as $key => $post):?>
                                                            <?php if( $key < 3 ) :?>
                                                                <li class="item">
                                                                    <div class="img">
                                                                        <a href="<?php echo get_the_permalink($post->ID); ?>">
                                                                            <?php if ( has_post_thumbnail($post->ID) ): ?>
                                                                                <div class="img img-search" data-background="<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>">
                                                                                </div>
                                                                            <?php else:?>
                                                                                <div class="img img-search" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png">
                                                                                </div>
                                                                            <?php endif;?>
                                                                        </a>
                                                                    </div>
                                                                    <div class="in">
                                                                        <h3 class="tit">
                                                                            <a href="<?php echo get_the_permalink($post->ID); ?>">
                                                                                <?php echo $post->post_title;?>
                                                                            </a>
                                                                        </h3>
                                                                        <p class="date">
                                                                            <?php echo get_the_date('d.m.Y',$post->ID);?>
                                                                        </p>
                                                                        <p class="txt">
                                                                            <?php 
                                                                                if($post->post_content){
                                                                                    $post_content = wp_strip_all_tags($post->post_content);
                                                                                    $post_content = mb_substr($post_content, 0, 200);
                                                                                    echo $post_content.'...';
                                                                                }
                                                                            ?>
                                                                        </p>
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
                                                                </li>
                                                            <?php else: ?>
                                                                <li class="item search-unactive" >
                                                                    <div class="img">
                                                                        <a href="<?php echo get_the_permalink($post->ID); ?>">
                                                                            <?php if ( has_post_thumbnail($post->ID) ): ?>
                                                                                <div class="img img-search" data-background="<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>">
                                                                                </div>
                                                                            <?php else:?>
                                                                                <div class="img img-search" data-background="<?php echo get_stylesheet_directory_uri();?>/assets/images/news_info/news_04.png">
                                                                                </div>
                                                                            <?php endif;?>
                                                                        </a>
                                                                    </div>
                                                                    <div class="in">
                                                                        <h3 class="tit">
                                                                            <a href="<?php echo get_the_permalink($post->ID); ?>">
                                                                                <?php echo $post->post_title;?>
                                                                            </a>
                                                                        </h3>
                                                                        <p class="date">
                                                                            <?php echo get_the_date('d.m.Y',$post->ID);?>
                                                                        </p>
                                                                        <p class="txt">
                                                                            <?php 
                                                                                if($post->post_content){
                                                                                    $post_content = wp_strip_all_tags($post->post_content);
                                                                                    $post_content = mb_substr($post_content, 0, 200);
                                                                                    echo $post_content.'...';
                                                                                }
                                                                            ?>
                                                                        </p>
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
                                                                </li>
                                                            <?php endif;?>
                                                            
                                                        <?php endforeach;?>
                                                    </ul>   
                                                    <?php if(count($result['post']) > 3) :?>
                                                        <div class="see_more" data-page-type="search">
                                                            <a >
                                                                <i class="fas fa-angle-double-down"></i><span>See more</span>
                                                            </a>
                                                        </div>  
                                                    <?php endif;?>
                                                </div>                                
                                            </div>  
                                            <?php endif;?>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </div>                      
                        </div>
                    </div>
                </div>
                <?php get_template_part('lefeside'); ?> 
            </div>
        <?php endif;?>    
    </section>
</div>

<?php get_footer(); ?>