<?php
/**
* The template for displaying About Vietnam Page.
* @package Miyatsu
* Template Name: About Vietnam
**/


?>
<?php get_header(); ?>

<div class="About_vnArea">
	<section class="mvArea">
		<div class="swiper-container mv" id="">
			<div class="swiper-wrapper">
				<?php
                    if ( !empty(get_field('slider_mv')) ) :
                        $sliders =  get_field('slider_mv');
                        foreach($sliders as $slider):
                ?>
                    <div class="swiper-slide mv__item" data-background='<?php echo $slider['slider_image'];?>'>
                        <div class="content">
                            <h2 class="tit">
                                <?php echo $slider['slider_text'];?>
                            </h2>
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php else: ?>
                    <div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/mv_bg.png'>
                        <div class="content">
                            <h2 class="tit">About Vietnam</h2>
                        </div>
                    </div>
                    <div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/mv_bg.png'>
                    </div>
                    <div class="swiper-slide mv__item" data-background='<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/mv_bg.png'>
                    </div>
                <?php endif;?>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
		</div>
	</section>
	<section class="section">
		<?php  get_template_part('template/partial/breadcrumb') ; ?>
        <?php  get_template_part('template/partial/menu-mid') ; ?>
		<div class="container">
			<div class="inner">
				<div class="main">
					<?php  get_template_part('template/partial/aside') ; ?>
					<div class="content">
						<div class="about_vn_info">
                            <h4 class="flag">Socialist Republic of Vietnam</h4>
                            <section class="about_vn_info__section about_vn_info__section--01">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_01.png" alt="">
                                                    <h5>LANGUAGE</h5>
                                                </div>
                                                <span>Vietnamese (official language)<br>Chinese - Khmer - English - French etc.</span>
                                            </div>
                                        </div>
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_02.png" alt="">
                                                    <h5>MAJOR <br> CITIES</h5>
                                                </div>
                                                <span><strong>Capital</strong>: Hanoi (Ha Noi) <br> <strong>City of central government</strong>: Hanoi - Hai Phong - Da Nang - Ho Chi Minh - Can Tho</span>
                                            </div>
                                        </div>
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_03.png" alt="">
                                                    <h5>MAIN <br>CHARACTER</h5>
                                                </div>
                                                <span>
                                                    <strong>Communist party secretary</strong>: Nguyen Phu Trong <br>
                                                    <strong>President of the state</strong>: Nguyen Phu Trong <br>
                                                    <strong>Prime minister</strong>: Nguyen Xuan Phuc
                                                </span>
                                            </div>
                                        </div>
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_04.png" alt="">
                                                    <h5>POLITICS</h5>
                                                </div>
                                                <span>
                                                    <strong>Diet</strong>: Unicameral <br>
                                                    <strong>Number of seats</strong>: 500 seats <br>
                                                    <strong>National assembly speaker</strong>: Nguyen Thi Kim Ngan <br>
                                                    <strong>Party</strong>: Communist party <br>
                                                    <strong>Women's diet member ratio</strong>: 26.8% (14th term
                                                    <2016 ~ 2021 term> Diet)
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_05.png" alt="">
                                                    <h5>COUNTRY AND <br>POPULATION RELATED</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        <strong>Area (2015)</strong>: 330,967 km2 <br>
                                                        <strong>Population density (2015)</strong>: 277 people/km2 <br>
                                                        <strong>Population (2015)</strong>: 91,173,300 people <br>
                                                        <strong>Population growth rate (2015)</strong>: 0.94% <br>
                                                        <strong>Birthrate (2015)</strong>: 1.62% <br>
                                                        <strong>Mortality rate (2015)</strong>: 0.68% <br>
                                                        <strong>Gender ratio (2015):</strong> <br>
                                                    </p>
                                                    <div class="item__details__box--content--percent">
                                                        <div class="percent">
                                                            <div class="percent--ttl">
                                                                At birth
                                                            </div>
                                                            <div class="percent--box">
                                                                <div class="percent--box-show w53"><span>53%</span></div>
                                                                <div class="percent--box-hide w47"><span>47%</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="percent">
                                                            <div class="percent--ttl">
                                                                Average
                                                            </div>
                                                            <div class="percent--box">
                                                                <div class="percent--box-show w49"><span>49.32%</span></div>
                                                                <div class="percent--box-hide w51"><span>50.68%</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        <strong>Less than 1-year-old milk infant mortality (2015)</strong> : Male: 1.67% - Female: 1.27% - Average: 1.47%<br>
                                                        <strong>Life expectancy</strong>: Male: 70.6 (2014) - Female: 76.0 (2014) - Average: 73.3 (2015)<br>
                                                        <strong>15 years of age or older person literacy rate of opening (2015)</strong>: Male: 96.6% - Female: 93.3% - Average: 94.9%<br>
                                                        <strong>Ethnic composition</strong>: 85.73% of the Kir (Bet) tribe - 1.89% of the Tai family - 1.81% of the Thai group - 1.48% of the
                                                        Muong group - 1.47% of the Khmer tribe - 0.96% of the Hua group etc.<br>
                                                        <strong>Religious composition (2009)</strong>: Buddhism: 7.92% - Catholic: 6.61% - Hoa Hao: 1.67% - Cao Dai: 0.94% - Protestar:
                                                        0.86% - Muslim: 0.09% - Hinduism: 0.07% - Others: 0.08% - No religion: 81.77% <br>
                                                        <strong>Number of people living with HIV/AIDS survivors (2015)</strong>: 313,348 people, 0.34% of the nation's population<br>
                                                        <strong>Number of AIDS fatalities (2015)</strong>: 2130 people<br>
                                                        <strong>Number of beds per 10,000 people (2015)</strong>: 27.1 floor
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_06.png" alt="">
                                                    <h5>LABOR</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        <strong>Working population (2015)</strong>: 53,982,400 people
                                                    </p>
                                                    <div class="item__details__box--content--details">
                                                        <div class="item__details__box--content--details__items3">
                                                            <div class="item__details__box--content--details__items3-01">
                                                                <p>
                                                                    15 - 24 years old
                                                                </p>
                                                                <h6>
                                                                    8,012,400 <br block-sc-pc> people
                                                                </h6>
                                                            </div>
                                                            <div class="item__details__box--content--details__items3-02">
                                                                <p>
                                                                    25 - 49 years old
                                                                </p>
                                                                <h6>
                                                                    31,973,000 <br block-sc-pc> people
                                                                </h6>
                                                            </div>
                                                            <div class="item__details__box--content--details__items3-03">
                                                                <p>
                                                                    > 49 years old
                                                                </p>
                                                                <h6>
                                                                    14,001,500 <br block-sc-pc> people
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        <strong>Unemployment rate (2015)</strong>: 3.4%
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--01">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_07.png" alt="">
                                                    <h5>CURRENCY</h5>
                                                </div>
                                                <span>Vietnamese Dong (VND)</span>
                                            </div>
                                        </div>
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_08.png" alt="">
                                                    <h5>OFFICIAL <br> RATE</h5>
                                                </div>
                                                <span>1 USD = 22,161 VND (January 16, 2017)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_09.png" alt="">
                                                    <h5>INFLATION <br> RATE</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <div class="item__details__box--content--percent">
                                                        <div class="percent">
                                                            <div class="percent--ttl">
                                                                2013
                                                            </div>
                                                            <div class="percent--box">
                                                                <div class="percent--box-default w100 y2013 "><span>6.6%</span></div>                                                                
                                                            </div>
                                                        </div>
                                                        <div class="percent">
                                                            <div class="percent--ttl">
                                                                2014
                                                            </div>
                                                            <div class="percent--box">
                                                                <div class="percent--box-default w67 y2014"><span>4.09%</span></div>                                                                
                                                            </div>
                                                        </div>
                                                        <div class="percent">
                                                            <div class="percent--ttl">
                                                                2015
                                                            </div>
                                                            <div class="percent--box">
                                                                <div class="percent--box-default w10 y2015"><span>0.63%</span></div>                                                                
                                                            </div>
                                                        </div>
                                                        <div class="percent">
                                                            <div class="percent--ttl">
                                                                2016
                                                            </div>
                                                            <div class="percent--box">
                                                                <div class="percent--box-default w36 y2016"><span>2.66%</span></div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_10.png" alt="">
                                                    <h5>GROSS DOMESTIC <br> PRODUCT (GDP)</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <div class="item__details__box--content--percent">
                                                        <p>
                                                            <strong>Nominal GDP (2016)</strong>: 4,502,733,000,000 VND (about 20 billion USD) <br>
                                                            <strong>Real GDP growth rate: </strong>
                                                        </p>
                                                        <div class="percent">
                                                            <div class="percent--ttl">
                                                                2013
                                                            </div>
                                                            <div class="percent--box">
                                                                <div class="percent--box-default w78 y2013 "><span>5.42%</span></div>                                                                
                                                            </div>
                                                        </div>
                                                        <div class="percent">
                                                            <div class="percent--ttl">
                                                                2014
                                                            </div>
                                                            <div class="percent--box">
                                                                <div class="percent--box-default w85 y2014"><span>5.98%</span></div>                                                                
                                                            </div>
                                                        </div>
                                                        <div class="percent">
                                                            <div class="percent--ttl">
                                                                2015
                                                            </div>
                                                            <div class="percent--box">
                                                                <div class="percent--box-default w100 y2015"><span>6.68%</span></div>                                                                
                                                            </div>
                                                        </div>
                                                        <div class="percent">
                                                            <div class="percent--ttl">
                                                                2016
                                                            </div>
                                                            <div class="percent--box">
                                                                <div class="percent--box-default w94 y2016"><span>6.21%</span></div>                                                                
                                                            </div>
                                                        </div>
                                                        <p>
                                                            <strong>GDP per citizen (purchasing power parity) (2015)</strong>: 6035 USD<br>
                                                            <strong>Component composition by GDP industry (2016):</strong>
                                                        </p>
                                                        <div class="item__details__box--content--details">
                                                            <div class="item__details__box--content--details__items4">
                                                                <div class="item__details__box--content--details__items4-01">
                                                                    <p>
                                                                        Agriculture, forestry
                                                                    </p>
                                                                    <h6>
                                                                        16.3%
                                                                    </h6>
                                                                </div>
                                                                <div class="item__details__box--content--details__items4-02">
                                                                    <p>
                                                                        Industrial/Construction industry
                                                                    </p>
                                                                    <h6>
                                                                        32.7%
                                                                    </h6>
                                                                </div>
                                                                <div class="item__details__box--content--details__items4-03">
                                                                    <p>
                                                                        Service industry
                                                                    </p>
                                                                    <h6>
                                                                        40.9%
                                                                    </h6>
                                                                </div>
                                                                <div class="item__details__box--content--details__items4-04">
                                                                    <p>
                                                                        Other
                                                                    </p>
                                                                    <h6>
                                                                        10.0%
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_11.png" alt="">
                                                    <h5>NATIONAL <br> BUDGET</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        <strong>Revenue (from January 1 to December 15 2016)</strong>: 943,300,000,000 VND<br>
                                                        <strong>Expenditure (from January 1 to December 15 2016)</strong>: 1,135,500,000,000 VND<br>
                                                        <strong>Fiscal balance (2016)</strong>: ^ 192,200,000,000 VND - ^ 4.3% of GDP
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_12.png" alt="">
                                                    <h5>OVERALL <br> BALANCE</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        ^ 6,032,000 USD (2015) - 6,442,000 USD (2016 first half year)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_13.png" alt="">
                                                    <h5>TRADE</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        <strong>Export value (2016)</strong>: 176,631,000 USD <br>
                                                        <strong>Import amount (2016)</strong>: 171,100,000 USD <br>
                                                        <strong>Trade balance (2016)</strong>: 2,521,000 USD (+ 1,4% of export value) <br>
                                                        <strong>Major export items (2016)</strong>: Mobile phones/parts - Clothing/textiles - Computer/electronic product/part -
                                                        Footwear - Machinery/equipment/part - Fishery products - Wood and woodworking products - Vehicles/parts
                                                        etc. <br>
                                                        <strong>Major import items (2016)</strong>: Machinery/equipment/part - Computers/electronic products/parts - Mobile phones/
                                                        parts - Various fabrics - Steel - Raw materials - Sewing items/raw materials for leather goods/secondary
                                                        materials etc. <br>
                                                        <strong>Major export destinations (composition ratio) (2016)</strong>: US (21.8%) - China (12.4%) - Japan (8.3%) - Korea (6.5%) -
                                                        Hong Kong (3.4%) - Holland (3.4%) - Germany (3.4%) - United Arab Emirates (2.8%) - UK (2.8%) - Thailand (2.1%) <br>
                                                        <strong>Main importer (composition ratio) (2016)</strong>: China (28.7%) - Korea (18.4%) - Japan (8.6%) - Taiwan (6.4%) -
                                                        Thailand (5.1%) - US (5.0%) - Malaysia (2.9%) - Singapore (2.7%) - Indonesia (1.7%) - Germany (1.6%)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_14.png" alt="">
                                                    <h5>FOREIGN DIRECT <br> INVESTMENT (FDI)</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        <strong>Authorization amount (2016)</strong>: 24,373,000 USD <br>
                                                        <strong>Execution amount (2016)</strong>: 15,800,000,000 USD
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_15.png" alt="">
                                                    <h5>OFFICIAL DEVELOPMENT ASSISTANCE (ODA) <br> AMOUNT EXECUTED</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        4,650,000,000 USD (2015)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_16.png" alt="">
                                                    <h5>TRANSFER AMOUNT BY OVERSEAS <br> (OVERSEAS VIETNAMESE)</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        9,000,000,000 USD (estimated in 2016)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_17.png" alt="">
                                                    <h5>EXTERNAL <br> DEBT</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        77,800,000,000 USD (2015)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_18.png" alt="">
                                                    <h5>GOVERMENT EXTERNAL DEBT - <br> GOVERMENT GUARANTEED EXTERNAL DEBT</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        46,300,000,000 USD (2015)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_19.png" alt="">
                                                    <h5>FOREIGN EXCHANGE <br> RESERVES</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        40,000,000,000 USD (October 2016)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_20.png" alt="">
                                                    <h5>COMMUNICATION</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        <strong>Number of fixed phone contracts (2015)</strong>: 5,900,000 cases <br>
                                                        <strong>Mobile phone contract number (2015)</strong>: 122,100,000 cases <br>
                                                        <strong>Number of Internet contracts (2016)</strong>: 9,026,000 cases
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_21.png" alt="">
                                                    <h5>TRAFFIC</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        <strong>Total railway extension (2014)</strong>: 2600 km <br>
                                                        <strong>Total road extension (2014)</strong>: 258,200 km (including national roads and highways: 10,844 km) <br>
                                                        <strong>Total waterway extension (2011)</strong>: 47,130 km
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_22.png" alt="">
                                                    <h5>ELECTRIC POWER - <br> OIL - GAS</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <p>
                                                        <strong>Generated electric energy (2014)</strong>: 135,000,000,000 kWh <br>
                                                        <strong>Power consumption (2014)</strong>: 125,000,000,000 kWh <br>
                                                        <strong>Crude oil output (Nissan) (2015)</strong>: 333,400 barrels <br>
                                                        <strong>Production volume of petroleum related products (Nissan) (2013)</strong>: 140,000 barrels <br>
                                                        <strong>Petroleum related product consumption (per day) (2014)</strong>: 390,000 barrels <br>
                                                        <strong>Crude oil proved reserved</strong>: 4,400,000,000 barrels <br>
                                                        <strong>Natural gas output (2014)</strong>: 8,900,000 m3 <br>
                                                        <strong>Natural gas consumption (2014)</strong>: 8,900,000 m3 <br>
                                                        <strong>Natural gas proved reserves (as of January 1, 2016)</strong>: 69,990,000,000 m3
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="about_vn_info__section about_vn_info__section--02">
                                <div class="list">
                                    <div class="item">
                                        <div class="item__details">
                                            <div class="item__details__box">
                                                <div class="item__details__box--image">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/about_vietnam/icon_23.png" alt="">
                                                    <h5>MILITARY <br> AFFAIRS</h5>
                                                </div>
                                                <div class="item__details__box--content">
                                                    <div class="item__details__box--content--percent">
                                                            <p>
                                                                <strong>Organization (2016)</strong>: People's army: army, navy, air force, border guard, maritime police <br>
                                                                <strong>Military budget (proportion of GDP): </strong>
                                                            </p>
                                                            <div class="percent">
                                                                <div class="percent--ttl">
                                                                    2009
                                                                </div>
                                                                <div class="percent--box">
                                                                    <div class="percent--box-default w74 y2013 "><span>1.83%</span></div>                                                                
                                                                </div>
                                                            </div>
                                                            <div class="percent">
                                                                <div class="percent--ttl">
                                                                    2010
                                                                </div>
                                                                <div class="percent--box">
                                                                    <div class="percent--box-default w100 y2014"><span>2.37%</span></div>                                                                
                                                                </div>
                                                            </div>
                                                            <div class="percent">
                                                                <div class="percent--ttl">
                                                                    2011
                                                                </div>
                                                                <div class="percent--box">
                                                                    <div class="percent--box-default w87 y2015"><span>2.17%</span></div>                                                                
                                                                </div>
                                                            </div>
                                                            <div class="percent">
                                                                <div class="percent--ttl">
                                                                    2012
                                                                </div>
                                                                <div class="percent--box">
                                                                    <div class="percent--box-default w100 y2016"><span>2.37%</span></div>                                                                
                                                                </div>
                                                            </div>
                                                            <p>
                                                                <strong>Number of vocational troops (estimate for 2009)</strong>: 450,000 people<br>
                                                                <strong>Reserve party (estimate for 2009)</strong>: 5,000,000 <br>
                                                                <strong>Draft recruitment age (16-49 years old) (2010):</strong>
                                                            </p>
                                                            <div class="item__details__box--content--details">
                                                                <div class="item__details__box--content--details__items4" block-sc-pc>
                                                                    <div class="item__details__box--content--details__items4-01">
                                                                        <p>
                                                                            Agriculture, forestry
                                                                        </p>
                                                                        <h6>
                                                                            16.3%
                                                                        </h6>
                                                                    </div>
                                                                    <div class="item__details__box--content--details__items4-02">
                                                                        <p>
                                                                            Industrial/Construction industry
                                                                        </p>
                                                                        <h6>
                                                                            32.7%
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p>
                                                                <strong>Military service subject (2016)</strong>: Men aged 18-25 <br>
                                                                <strong>Military service period (2016)</strong>: 2 years
                                                            </p>
                                                        </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
						</div>						
					</div>
					<div class="banner home_banner"><?php get_template_part( 'template/partial/rightside' ); ?></div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>

