<?php
/**
* The template for displaying Careers Page.
* @package Miyatsu
* Template Name: Careers
**/


?>
<?php get_header(); ?>

<div class="careersArea">
	<section class="mvArea">
		<div class="swiper-container mv" id="">
			<div class="swiper-wrapper">
        <?php 
          
          if ( !empty(get_field('slider_mv')) ) :
            $sliders =  get_field('slider_mv');
            foreach($sliders as $slider):
        ?>
          <a href="<?php echo $slider['slider_link'];?>" class="swiper-slide mv__item" data-background='<?php echo $slider['slider_image'];?>'>
            <div class="content">
              <h2 class="tit">
                <?php echo $slider['slider_text'];?>
                  
                </h2>
            </div>
          </a>
          <?php endforeach;?>
        <?php else: ?>
          <div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/careers/mv_bg.png'>
            <div class="content">
              <h2 class="tit">Careers</h2>
            </div>
          </div>
        <?php endif;?>  
        
			</div>
			<!-- Add Pagination -->
			<!-- <div class="swiper-pagination"></div> -->
		</div>
	</section>
	<section class="section">
    <?php  get_template_part('template/partial/breadcrumb') ; ?>
    <div class="container">
      <div class="inner">
        <div class="main">
          <?php  get_template_part('template/partial/aside') ; ?>
          <div class="content">
            <div class="careers_info">
              <h4>Recruitment occupation</h4>
              <p>
                ATTACK which celebrated its third year in the first year is a free paper for Japanese living in Vietnam, including
                Hanoi, Ho Chi Minh, Da Nang. Our strength is to be able to deliver "optimally useful information rooted in the
                locality". For beginners in Vietnam it is "easy to understand and useful" and even if veteran living here who lives
                here for more than a few years reads it "there was a new discovery" as well. To disseminate such valuable
                information at various angles. It is the spirit that rib cherishes at any time.<br><br>

                We are looking for members to work together.  Clearly, all the jobs you leave are those with heavy effort and
                responsibility. There is nothing that can be done with a half-hearted feeling. That is why it is a matter of waiting
                for "individual growth" and "exciting experience" that others can not experience.<br><br>

                If such feelings are growing inside you, it may be a sign to take a new start. People smoldering are welcome.
                Why do not you face ahead once again who have settled down?<br><br>

                With motivation and enthusiasm, the ribs have places where you can shine. We all are waiting for your
                application! Please see the details below.<br><br>
              </p>
              <h4>Details</h4> 
              <ul class="list">
                <?php 
                  $args = array(
                    'post_type'     =>'career',
                    'post_status'   =>'publish',
                    'posts_per_page'  => '3',
                    'offset'            => 0,
                    'orderby'           => 'date title',
                    );
                 
                  $careers = new WP_Query($args);
                ?>
                <?php if($careers->have_posts()): ?>
                    <?php foreach($careers->posts as $career):?>
                      <li class="item">
                        <div class="img">
                          <?php if ( has_post_thumbnail($career->ID) ): ?>
                            <a href="<?php echo get_the_permalink($career->ID); ?>">
                              <img src="<?php echo get_the_post_thumbnail_url($career->ID,'thumbnail');?>" alt="">
                            </a>
                          <?php endif;?>
                         
                        </div>
                        <div class="box">
                          <h3 class="ttl">
                            <a href="<?php echo get_the_permalink($career->ID); ?>">
                              <?php echo $career->post_title; ?>
                            </a>
                          </h3>
                          <p class="desc">
                            <?php 
                              if($career->post_content){
                                $content = wp_strip_all_tags($career->post_content);
                                $content = mb_substr($content, 0, 200);
                                echo $content.'...';
                              }

                            ?>
                          </p>
                        </div>
                      </li>
                    <?php endforeach;?>
                <?php else: ?>
                  <li class="item">
                    <div class="img">
                      <a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/careers/img_01.png" alt=""></a>
                    </div>
                    <div class="box">
                      <h3 class="ttl">
                        <a href="#">Sales recruitment</a>
                      </h3>
                      <p class="desc">
                        Employment type: regular employee/contract employee <br>
                        Eligibility: Over 2 years experience in social workers, sales experience
                        unquestioned, people with everyday English conversation skills welcome <br>
                        Business description: development of new and existing customers, customer
                        follow-up, hearing of advertisement content, consulting, customer related
                        interview correspondence, etc. <br>
                        Location: Hanoi, Ho Chi Minh <br>
                        Holiday: Saturdays, Sundays and Vietnamese holidays <br>
                        Salary/treatment: Consideration based on their own experience and ability.<br>
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="img">
                      <a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/careers/img_02.png" alt=""></a>
                    </div>
                    <div class="box">
                      <h3 class="ttl"><a href="#">Designer recruitment</a></h3>
                      <p class="desc">
                        Employment form: regular employee/contract worker/part work permitted <br>
                        Eligibility: vocational school/college graduate or above, those who can use tools
                        such as illstulater, Photoshop, Indesign, etc. Preferable work experience of one
                        year or more of designer <br>
                        Work content: creation of advertisement design, Trafficking work, printing<br>
                        instructions, etc. <br>
                        Location: Hanoi, Ho Chi Minh, Japan <br>
                        Salary/treatment: Consideration based on their experience and ability.<br>
                        Holidays: Saturdays, Sundays, Vietnamese Holidays<br>
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="img">
                      <a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/careers/img_03.png" alt=""></a>
                    </div>
                    <div class="box">
                      <h3 class="ttl"><a href="#">Writer recruitment</a></h3>
                      <p class="desc">
                        Employment form: External staff * Part time work accepted <br>
                        Eligibility: Over 3 years experience in social work , Writer experience unwilling<br>
                        (Welcome worker with more than 1 year of work experience), Who can use tools
                        such as word, Excel <br>
                        Work content: Coverage of various articles Interview, photo shooting may be
                        included), writing, proofreading, etc. <br>
                        Location: Not a problem * Preferred resident in Vietnam <br>
                        Payment/treatment: Consideration based on the person's experience and ability<br>
                        Holidays: Working hours required consultation<br>
                      </p>
                    </div>
                  </li>
                <?php endif;?>
                
              </ul>
              <h4>Application method</h4>
              <p>
                Please send your resume/job history to the following e-mail address. After screening documents, we will
                contact you from the person in charge. <br>
                Please note that applications will not be returned. <br>
                (Note) ※ In addition to the above, the designer must send the portfolio mandatory. ※ In addition to the above,
                please send any writer if there is anything that understands the results of the past writing. <br>
                Destination e-mail address: <a href="mailto:info@sourcesvn.com">info@sourcesvn.com</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>

