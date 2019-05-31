<?php
/**
* The template for displaying Advertis Page.
* @package Miyatsu
* Template Name: Advertis
**/


?>
<?php get_header(); ?>

<div class="AdvertisArea">
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
            <div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/advertis/mv_bg.png'>
              <div class="content">
                <h2 class="tit">The only place to reach 375 million loyal,<br block-sc-pc>
                engaged and connected travellers a month!</h2>
              </div>
            </div>
          <?php endif;?>

        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
      </div>
    </section>
    <section class="section">
      <?php  get_template_part('template/partial/breadcrumb') ; ?>
      <div class="container">
        <div class="inner">
          <div class="main">

            <?php  get_template_part('template/partial/aside') ; ?>
            <div class="content">
              <h2 class="tit" block-sc-sp>Advertis With Us</h2>
              <div class="advertis_info">
                <div class="box-collapse">
                  <div class="collapsible">
                    <div class="container-img">
                      <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/advertis/img_01.png" alt="">
                    </div>
                    <div class="container-txt hasCollapse">
                      <h2 class="tit">WHY ATTACK</h2>
                    </div>
                  </div>
                  <div class="content-collapse hasCollapse">
                    <p>
                      ATTACK is the world's largest travel site, enabling travellers to know better, book better and go better to get the most out of their travel experience. ATTACK offers advice from millions of travelers around the world, a wealth of relevant travel content from our community and seasoned travel experts and the largest selection of places to stay at the best prices as well as unforgettable things to do and places to eat to make your trip the very best it can be. ATTACK branded sites make up the largest travel community in the world, reaching 340 million unique monthly visitors, and more than 350 million reviews and opinions covering more than 6.5 million accommodations, restaurants and attractions. The sites operate in 48 countries worldwide. <br> <br>

                      ATTACK draws a diverse international audience with a common passion for travel. Whether adventurous explorers, business travelers or couples looking for a romantic honeymoon spot, our audience returns to ATTACK time and time again to research and share their experiences with reviews, photos, opinions, and more. With 230+ new contributions every minute and over 350 million reviews and opinions, ATTACK is the world's most trusted place for travel advice.
                    </p>
                  </div>
                </div>
                <div class="box-collapse" style="display:none;">
                  <div class="collapsible">
                    <div class="container-img" block-sc-pc>
                      <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/advertis/img_02.png" alt="">                      
                    </div>
                    <div class="container-img" block-sc-sp>
                      <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/advertis/item_sp.png" alt="">
                    </div>                    
                    <div class="container-txt container-txt-specs">
                      <h2 class="tit">Advertising specs</h2>
                      <div class="box_collapse_mini">
                        <a class="box__collapse box__collapse_1" data-id="1">
                          <div class="txt">Advertising policies</div>
                          <div class="icon"><span></span></div>
                        </a>
                        <a class="box__collapse box__collapse_2" data-id="2">
                          <div class="txt">Standard display guidelines</div>
                          <div class="icon"><span></span></div>
                        </a>
                        <a class="box__collapse box__collapse_3" data-id="3">
                          <div class="txt">Rich media guidelines</div>
                          <div class="icon"><span></span></div>
                        </a>
                        <a class="box__collapse box__collapse_4" data-id="4">
                          <div class="txt">Mobile guidelines</div>
                          <div class="icon"><span></span></div>
                        </a>
                        <a class="box__collapse box__collapse_5" data-id="5">
                          <div class="txt">Video specs</div>
                          <div class="icon"><span></span></div>
                        </a>
                        <a class="box__collapse box__collapse_6" data-id="6">
                          <div class="txt">ATTACK everywhere guidelines</div>
                          <div class="icon"><span></span></div>
                        </a>
                      </div>
                    </div>

                  </div>
                  <div class="box__collapse__open box__collapse__open_1 hasCollapse" data-id="1">
                    <p>aaaaaaaaaaaaaaaaaa</p>
                  </div>
                  <div class="box__collapse__open box__collapse__open_2 hasCollapse" data-id="2">
                    <p>bbbbbbbbbbbbbbbbb</p>
                  </div>
                  <div class="box__collapse__open box__collapse__open_3 hasCollapse" data-id="3">
                    <p>bbbbbbbbbbbbbbbbb</p>
                  </div>
                  <div class="box__collapse__open box__collapse__open_4 hasCollapse" data-id="4">
                    <p>bbbbbbbbbbbbbbbbb</p>
                  </div>
                  <div class="box__collapse__open box__collapse__open_5 hasCollapse" data-id="5">
                    <p>bbbbbbbbbbbbbbbbb</p>
                  </div>
                  <div class="box__collapse__open box__collapse__open_6 hasCollapse" data-id="6">
                    <p>
                      ATTACK Everywhere is an end to end solution that meets marketer goals by leveraging high value, proprietary, fresh data from the world’s most visited travel site to create unique, relevant audiences, extending campaign reach into premium ad positions on sites across the web.<br><br>

                      Provide as many ad sizes as possible:<br>
                      * 160x600 <br>
                      * 300x250<br>
                      * 300x600<br>
                      * 320x50<br>
                      * 468x60<br>
                      * 728x90<br>
                      * Native Ad assets (Native Ads for TripAdvisor Everywhere Guidelines)<br><br>

                      DCM tracking:<br>
                      * No InReds possible<br><br>

                      Video:<br>
                      * No 1x1 tracking URLs for raw video assets<br>
                      * VAST tag required – no VPAID tags<br>
                      * No added pixels for VAST tags - any additional pixels must be built in on the back end<br>
                      * 3rd party tags must be skippable<br><br>

                      Backup images are mandatory for site served HTML5 creative. Any creative related to tobacco, religion, politics, guns or sexually explicit themes is not allowed. Any creative related to gambling, alcohol, and pharmaceuticals will need to be submitted for approval.
                    </p>
                  </div>
                </div>
                <div class="box-collapse" style="display:none;">
                  <div class="collapsible">
                    <div class="container-img">
                      <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/advertis/img_03.png" alt="">
                    </div>
                    <div class="container-txt hasCollapse">
                      <h2 class="tit">Custom media solutions</h2>
                    </div>
                  </div>
                  <div class="content-collapse hasCollapse">
                    <p>
                      <strong>Custom Content Pages</strong> <br>
                      Promote your brand and increase engagement in a highly impactful and relevant context customized to fit your budget, objectives, content and target audience. Integrate ATTACK content to create a more organic experience and drive deeper brand alignment. ATTACK partners with third party technologies including Doubleclick to deliver efficient media buying. <br><br>

                      <strong>Premium Destination Partnership</strong> <br>
                      Exclusive opportunity for Destination Marketing Organizations to create and distribute custom targeted content throughout destination specific pages on TripAdvisor thereby increasing your reach and relevancy to a qualified audience.
                      <br><br>
                      <strong>Custom Interactive or Dynamic Banners</strong><br>
                      Turn your creative into a unique content experience that leverages the trust of ATTACK’s reviews and ratings and drives deeper engagement! Overlay dynamic targeting capabilities to contextualize your creative further by pulling in content directly from the page the user is currently viewing.
                      <br><br>
                      <strong>Mobile</strong><br>
                      ATTACK offers a variety of targeted native mobile solutions to ensure your message is reaching the right users at the right time whether they are planning their next trip, looking for a new local hotspot or actively exploring a new destination.
                      <br><br>
                      <strong>Travelers' Choice Sponsorship</strong><br>
                      Align your brand with the prestige of TripAdvisor’s coveted awards with a 360-degree multi-platform solution.
                      <br><br>
                      <strong>Video</strong><br>
                      Bring your creative to life, drive deeper engagement and increase consideration for your brand with our integrated video solutions. Integrate ATTACK branding into your video assets to drive further alignment and contextual relevance.
                    </p>
                  </div>
                </div>
                <div class="box-collapse">
                  <div class="collapsible">
                    <a href="<?php echo get_site_url();?>/about-us">
                      <div class="container-img">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/advertis/img_04.png" alt="">
                      </div>
                      <div class="container-txt">
                        <h2 class="tit">Meet the team</h2>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="box-collapse">
                  <div class="collapsible">
                    <a href="<?php echo get_site_url();?>/contact-us">
                      <div class="container-img">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/advertis/img_05.png" alt="">
                      </div>
                      <div class="container-txt">
                        <h2 class="tit">Contact Us</h2>
                      </div>
                    </a>
                  </div>
                </div>
              </div>              
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php get_footer(); ?>

