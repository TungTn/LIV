//
// This is The Scripts used for Theme
//
function main() {

	(function ($) {
		'use strict';
	//Custom Script
	//-----------------------------------
	function set_background() {

		if ( $('*[data-background]').length != 0 ) {
			$('*[data-background]').each(function(){
				$(this).css({
					'background-image':'url('+$(this).attr('data-background')+')',
					'background-repeat': 'no-repeat',
					'background-size':'cover',
					'background-position':'center center',
				});
			});
		}
	}
	function open_collapse(){
		var coll = $(".collapsible");
		var i;

		for (i = 0; i < coll.length; i++) {
			$(".collapsible").click(function(){
				var content = this.nextElementSibling;
				if (content.style.maxHeight){
					content.style.maxHeight = null;
				} else {
					content.style.maxHeight = content.scrollHeight + "px";
				}
			});
		}
	}
	function close_collapse(){
		var col = $(".content-collapse");
		var i;

		for (i = 0; i < col.length; i++) {
			$(".content-collapse").click(function(){
				$(this).css("max-height", "0");
			});
		}
	}
	jQuery(document).ready(function(){

		var height_P = $(this).find(".item__details__box--content--details__items4-01 p").outerHeight();
		$(".item__details__box--content--details__items4").each(function(){
			$(this).find("p").css("height", height_P);
		});
		    	// Get the modal
		    	var modal = $("#popup");

		// When the user clicks on <span> (x), close the modal
		$(".close").click(function(){
			$("#popup").css("display", "none");
		})

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target !== modal) {
				$("#popup").css("display", "none");
			}
		}
		$(".header__menubar__menu li").each(function(){
			$(this).click(function(){
				$(this).addClass("current");
			});
		});
		$("#header__hamburger").on('click',function(e){
			e.preventDefault();
			$('.header__navArea').addClass('active');
			$('body').addClass('noScroll');
		});
		jQuery('.header__navArea__close').on('click', function(e){
			e.preventDefault();
			jQuery('.header__navArea').removeClass('active');
			jQuery('body').removeClass('noScroll');
		});
		$(document).on('click',function(e){
			if( !$(e.target).is('.header__navArea') && !$(e.target).is('.header__navArea *') && !$(e.target).is('#header__hamburger') && !$(e.target).is('#header__hamburger *') ){
				$('.header__navArea').removeClass('active');
				$('body').removeClass('noScroll');

			}
		});
		$(".header__search__mobile").on('click',function(e){
			e.preventDefault();
			$('.header__search--sp').addClass('active');
		});
		$(".header__search__cancel").on('click',function(e){
			e.preventDefault();
			$('.header__search--sp').removeClass('active');
		});

		$(".dropdown a:after").on('click',function(e){
			e.preventDefault();
			$(".sub-menu").slideToggle();
		});
		$(".box_collapse_mini a").each(function(){
			$(this).on("click", function(){
				$(".box_collapse_mini a").removeClass("active");
				$(this).addClass("active");
			});
		});
		$(".box__collapse__open").hide();
		$(".box__collapse").on('click',function(){
			let id = $(this).attr('data-id');
			let expand_area = $('.box__collapse__open_'+id);
			if(expand_area.is(":hidden")) {
				$('.box__collapse__open').hide();
				expand_area.fadeIn(500);
			}else{
				$(".box_collapse_mini a").removeClass("active");
				expand_area.fadeOut(500);
			}
			$(".box__collapse__open p").after().click(function(){
				expand_area.fadeOut(500);
				$(".box_collapse_mini a").removeClass("active");
			});
		});

		open_collapse();
		close_collapse();
		$('.showmore').on("click",function(event) {

			event.preventDefault();
			$('.more-text').slideToggle();
			if ($('.showmore').text() == "+ More") {
				$(this).text("- Less")
			} else {
				$(this).text("+ More")
			}
		});
		$(".tag__fixed__res__click").on("click", function(){
			event.preventDefault;
			var duration = 500;
			$('#tags_list').toggle(duration);
		});
		$('.btn_tag').on('click',function(){
			var value = $(this).attr('data-value');
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$(this).find('.filter_input').val('');
			}else{
				$(this).addClass('active');
				$(this).find('.filter_input').val(value);
			}

		});

		if (navigator.userAgent.match(/Android/)) {
			$(".slide_block_txt").css("font-size", "13px");
		}
		
		$(".icon_close_tag").on("click", function(){
			$("#tags_list").toggle( 500);
		});
		$('.navigation__link').bind('click', function(e) {
			e.preventDefault(); // prevent hard jump, the default behavior

			var target = $(this).attr("href"); // Set the target as variable

			// perform animated scrolling by getting top-position of target-element and set it as scroll target
			$('html, body').stop().animate({
				scrollTop: $(target).offset().top
			}, 600, function() {
				location.hash = target; //attach the hash (#jumptarget) to the pageurl
			});
			return false;
		});
		$(".button-write-review").on("click", function(e){
			e.preventDefault();
			$(this).hide();
			$(".tab-review-point").hide();
			$(".testimonial").hide();
			$('.see_more').hide();
			var duration = 500;
			$(".form-reviews-comment").removeClass("hide", duration).addClass("show", duration);
		});
		$('.cancel_button').on('click',function(){
			var duration = 500;
			$(".form-reviews-comment").removeClass("show", duration).addClass("hide", duration);
			$(".tab-review-point").show();
			$(".testimonial").show();
			$(".button-write-review").show();
			$('.mvn_load_more_comment').show();
			$('input:checkbox').removeAttr('checked');
			$('.log_error').hide();
			$('.customForm').trigger("reset");
			$('.see_more').show();
			grecaptcha.reset();
		})

		$('#header--mobile a').on('click',function(e){
			if (e.offsetX > (this.offsetWidth - 32)) {
				if ( $(this).next().length != 0 ) {
					$(this).next().stop(true,false).slideToggle("slow");
					$(this).toggleClass('open');
					e.preventDefault();
				}
			}
		});
		/*Dropdown Menu*/
		$(".dropdown").click(function(){
			$(this).find(".dropdown-menu").slideToggle("slow");
		});
		$('.dropdown .dropdown-menu li').click(function () {
			$(this).parents('.dropdown').find('span').text($(this).text());
			$(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
		});
		/*End Dropdown Menu*/
		$("input:checkbox").on('click', function() {
		  // in the handler, 'this' refers to the box clicked on
		  var $box = $(this);
		  if ($box.is(":checked")) {
		    // the name of the box is retrieved using the .attr() method
		    // as it is assumed and expected to be immutable
		    var group = "input:checkbox[name='" + $box.attr("name") + "']";
		    // the checked state of the group/box on the other hand will change
		    // and the current value is retrieved using .prop() method
		    $(group).prop("checked", false);
		    $box.prop("checked", true);
		} else {
			$box.prop("checked", false);
		}
	});

		$("input[name='rating']").on('change',function(){
			var rate = $(this).val();
			$("input[name='restaurant_rating']").val(rate);
		});

		$("input[name='type']").on('change',function(){
			var type = $(this).val();
			$("input[name='travel_type']").val(type);
		});
		$('.restaurant_review').on('submit',function(e){
			e.preventDefault();
			var type = $(this).data('type');
			var url = $(this).data('url');
			var post_id = $(this).data('post-id');
			var form = $(this).serialize();
			var fd = new FormData();
			var file = jQuery(document).find('input[id="user_avatar"]');
			var individual_file = file[0].files[0];
			fd.append("file", individual_file);
			fd.append('post_id', post_id);
			fd.append('form', form);
			fd.append('comment_type',type);
			fd.append('action', 'add_review');
			$.ajax({
				url: url,
				type:"POST",
				processData:false,
				contentType: false,
				data: fd,
				success:function(response){
					var data = jQuery.parseJSON(response);
					if(data.status == 'success'){
						$('input:checkbox').removeAttr('checked');
						$('.log_error').hide();
						$('.customForm').trigger("reset");
						grecaptcha.reset();
						$("#popup").css("display", "block");
					}else{
						for ( var key in data.message){
							var value = data.message[key];
							$('#'+key+'_error').html(value);
						}
					}
				}
			});
		})
		$('#submit_comment').on('submit',function(e){
			e.preventDefault();
			var type = $(this).data('type');
			var url = $(this).data('url');
			var post_id = $(this).data('post-id');
			var form = $(this).serialize();
			var fd = new FormData();
			var file = jQuery(document).find('input[id="user_avatar"]');
			var individual_file = file[0].files[0];
			fd.append("file", individual_file);
			fd.append('post_id', post_id);
			fd.append('form', form);
			fd.append('comment_type',type);
			fd.append('action', 'add_review');
			$.ajax({
				url: url,
				type:"POST",
				processData:false,
				contentType: false,
				data: fd,
				success:function(response){
					console.log()
					var data = jQuery.parseJSON(response);
					if(data.status == 'success'){
						$('.customForm').trigger("reset");
						$('.log_error').hide();
						grecaptcha.reset();
						$("#popup").css("display", "block");
					}else{
						for ( var key in data.message){
							var value = data.message[key];
							$('#'+key+'_error').html(value);
						}
					}
				}
			});
		});

		$('#sort_select_form').on('submit',function(e){
			e.preventDefault();
			var url = $(this).data('url');
			var form = $(this).serialize();
			var page_type = $(this).data('page-type');
			var post_type = $(this).data('post-type');
			var post_per_page = $(this).data('post-per-page');
			var post_taxonomy = $(this).data('post-taxonomy');
			var taxonomy_term = $(this).data('taxonomy-term');
			var data_tag = $(this).data('tag');
			$.ajax({
				url:url,
				method:"POST",
				data:{
					form : form,
					page_type : page_type,
					post_type : post_type,
					post_per_page : post_per_page,
					post_taxonomy : post_taxonomy,
					taxonomy_term : taxonomy_term,
					tag : data_tag,
					action:'mvn_sort_post'
				},
				success:function(response){
					console.log(response);
					switch (page_type ) {
						case 'lifes' :
						$('.life-list').html(response);
						break;
						case 'news' :
						$('.lastest-new').html(response);
						break;
						case 'issue' :
						$('.issue-list').html(response);
						break;

					}
					var imgSwiper =  new Swiper('.imgAreasp', {
						loop: true,
						slidesPerView: 1,
						autoplay: false,
						pagination: {
							el: '.swiper-pagination',
							clickable: true,
						},
					});
					set_background();

				}
			});
		});
		$('.sort_select').on('change',function(){

			$('#sort_select_form').submit();
			$('.btn__ajax--loadmore').attr('data-sort',$(this).val());
		});
		$('.site').on('click','.see_more',function(e){
			var page_type = $(this).data('page-type');
			e.preventDefault();
			if ( page_type == 'restaurants'){
				$('.restaurant-list').find('.search-unactive').slice(0,3).removeClass('search-unactive');
				if($('.restaurant-list').find('.item-list-rest').hasClass('search-unactive') === false){
					$(this).remove();
				}
			}if ( page_type == 'search'){
				var result_box = $(this).parents('.search-details').children('.search-box');
				var item_list = result_box.children('.list');
				$(item_list).find('li.search-unactive').slice(0,3).removeClass("search-unactive");
				if($(item_list).find('li').hasClass('search-unactive') === false){
					$(this).remove();
				}
			}if ( page_type == 'comment' ) {
				$('.comment__list').find('.search-unactive').slice(0,3).removeClass('search-unactive');
				if($('.comment__list').find('.comment').hasClass('search-unactive') === false){
					$(this).remove();
				}
			} 
			

		});
		$('.rate-star').on('click',function(){
			var onStar = parseInt($(this).data('value'), 10); // The star currently selected
			var stars = $(this).parent().children('li.heart');

			for (var i = 0; i < stars.length; i++) {
				$(stars[i]).removeClass('hearted');
			}
			for (var i = 0; i < onStar; i++) {
				$(stars[i]).addClass('hearted');
			}
			var input = $(this).parent().children('.voted_star');
			input.val($(this).data('value'));

		});
		$('.tag_filter').on('submit',function(e){
			e.preventDefault(e);
			var url = $(this).attr('data-url');
			var form = $(this).serialize();
			$.ajax({
				url:url,
				method:"POST",
				data:{
					form : form,
					action:'mvn_filter_tag'
				},
				success:function(response){	
					console.log(response);
					$("#tags_list").hide(500);
					$('.new_info').html("");
					$('.new_info').html(response);
					set_background()

				}
			});
		});
		$('.comment__content__txt').on('click','.comment_read_more',function(e){
			e.preventDefault();
			var data = $(this).attr('data-content');
			var content_short = $(this).attr('data-content-short');
			$(this).parent().html("<p>"+data+"</p><p data-content='"+data+"' data-content-short='"+content_short+"' class='comment_show_less'><i>Show less...</i></p>");
		});
		$('.comment__content__txt').on('click','.comment_show_less',function(){
			var data = $(this).attr('data-content');
			var content_short = $(this).attr('data-content-short');
			$(this).parent().html("<p>"+content_short+"</p><p data-content='"+data+"' data-content-short='"+content_short+"' class='comment_read_more'><i>Read more...</i></p>");
		});
		$('.box__total__info').on('click','.comment_read_more',function(e){
			e.preventDefault();
			var data = $(this).attr('data-content');
			var content_short = $(this).attr('data-content-short');
			$(this).parent().html("<p>"+data+"</p><p data-content='"+data+"' data-content-short='"+content_short+"' class='comment_show_less'><i>Show less...</i></p>");
		});
		$('.box__total__info').on('click','.comment_show_less',function(){
			var data = $(this).attr('data-content');
			var content_short = $(this).attr('data-content-short');
			$(this).parent().html("<p>"+content_short+"</p><p data-content='"+data+"' data-content-short='"+content_short+"' class='comment_read_more'><i>Read more...</i></p>");
		});
	});


$(window).scroll(function() {
	let header_height = $("#header").outerHeight();
	let slide_height = $(".mvArea").outerHeight();
	let top_height =  slide_height + header_height;
	let scrollTop = $(window).scrollTop();
	let h = window.innerHeight;
	let header = $('.header__menubar');
	if ( scrollTop > top_height) {
		$(".tag__fixed").addClass("fixed");
		$(".backTop").addClass("fixed");
		
	} else {
		$(".tag__fixed").removeClass("fixed");
		$(".backTop").removeClass("fixed");
		
	}
	if ( scrollTop > header_height) { 
		header.addClass('header__fix');
	} else {
		header.removeClass('header__fix');
	}
	let headerInfo_height = h - 819;
	
	if( $(window).width() > 720) {
		if(scrollTop < headerInfo_height) {
			
		} else {
			
		}
	}

	var scrollDistance = $(window).scrollTop();

		// Assign active class to nav links while scolling
		$('.page-section').each(function(i) {
			if ($(this).position().top <= scrollDistance) {
				$('.navigation a.active').removeClass('active');
				$('.navigation a').eq(i).addClass('active');
			}
		});
	}).scroll();


jQuery(window).load( function() {

	
	// Load more button click
	$('.btn__ajax--loadmore').on('click', function(e){

		e.preventDefault();
		var load_more = $(this);

		if( load_more.attr('data-disable') == undefined ) load_more.attr('data-disable',0);
		load_more.attr('data-disable',parseFloat(load_more.attr('data-disable')+1));
		load_more.find('.fa').show();

		var mvn_key_eval = eval(load_more.attr('data-key')),
		paged = parseFloat(load_more.attr('data-paged')),
		max_paged = parseFloat(load_more.attr('data-max-paged')),
		page_type = load_more.attr('data-page-type'),
		sort = load_more.attr('data-sort');
		var post_taxonomy = $(this).data('post-taxonomy');
		var taxonomy_term = $(this).data('taxonomy-term');

		if( parseFloat(load_more.attr('data-disable')) == 1 ) {

			$.ajax({
				type: "POST",
				url: mvn_key_eval.url,
				data: {
					'action' 		: 'loadmore_posts_action',
					'atts' 			: mvn_key_eval.atts,
					'query' 		: mvn_key_eval.query,
					'paged'			: paged,
					'page_type'		: page_type,
					'sort'			: sort,
					post_taxonomy 	: post_taxonomy,
					taxonomy_term 	: taxonomy_term,

				}
			}).done(function(data){
				
				load_more.attr('data-disable', 0 );
				load_more.find('.fa').hide();

				var items = $(data);
				switch (page_type ) {
					case 'taxonomy-location':
					$('.restaurant-list').append(items);
					break;
					case 'life-info' :
					$('.life-list').append(items);
					break;
					case 'news-info' :
					$('.lastest-new').append(items);
					break;
					case 'tour-info' :
					$('.articleArea').append(items);
					break;
					case 'issue' :
					$('.issue-list').append(items);
					break;
				}
				set_background();
				var imgSwiper =  new Swiper('.imgAreasp__loadmore', {
					loop: true,
					slidesPerView: 1,
					autoplay: false,
					pagination: {
						el: '.swiper-pagination',
						clickable: true,
					},
				});
				if( paged < max_paged ) {
					load_more.attr('data-paged',parseFloat(paged)+1);
				}
				else {
					load_more.remove();
				}

			});
		}

	});
	AOS.init();
	$("a[href^='#']:not([href$='#'])").on('click', function(e) {
		e.preventDefault();
		var target = $(this).attr('href');
		var pos = 0;
		var headerHeight = Math.ceil($(".header").height());
		if (target != '#top__page') {
			pos = $(target).offset().top - headerHeight;
		}
		$('html,body').stop().animate({
			'scrollTop': pos
		}, {
			'duration': 1500,
			'easing': 'swing'
		});
		return false;
	});

	var galleryThumbs = new Swiper('.gallery-thumbs', {
		spaceBetween: 20,
		slidesPerView: 4,
		draggable: true,
		watchSlidesVisibility: true,
		watchSlidesProgress: true,
	});
	var galleryTop = new Swiper('.gallery-top', {
		spaceBetween: 10,
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: "true",
		},
		thumbs: {
			swiper: galleryThumbs
		}
	});
	var swiper = new Swiper('.articleAreasp', {
		loop: true,
		autoplay: {
			delay: 2500,
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
	});	
	var swiper = new Swiper('.imgDetails', {
		loop: true,
		autoplay: {
			delay: 2500,
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
	});	
	var issue_item = new Swiper('.imgAreasp', {
		loop: true,
		slidesPerView: 1,
		autoplay: false,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
	});
	

	if( $('#mv').length != 0 ) {
		var swiper = new Swiper('#mv', {
			loop: true,
			autoplay: {
				delay: 2500,
			},
			autoplayDisableOnInteraction:false,
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
		});
	}	
	$('#home_mv').slick({
		infinite: true,
		dots: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 3000,
	});
	set_background();
});

jQuery(window).scroll(function(){
	var headerHeight = $(".header").outerHeight();
	
	if ( $("body").hasClass("logged-in")){ 
		if ($(window).scrollTop() > headerHeight) {
			$(".header").addClass("sticky");
		} else {
			$(".header").removeClass("sticky");
		}
	} else {
		if ($(window).scrollTop() > headerHeight) {
			$(".header").addClass("fixed");
		} else {
			$(".header").removeClass("fixed");
		}
	}
});

jQuery(window).resize(function(){

});
jQuery(document).on("click", function(event){
	var $trigger = $(".dropdown");
	if($trigger !== event.target && !$trigger.has(event.target).length){
		$(".dropdown-menu").slideUp("slow");
	}
});


}(jQuery));

}
main();
