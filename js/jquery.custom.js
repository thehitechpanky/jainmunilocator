jQuery(function ($) {
	
	//Drop Down Menu
	
	$(".main-nav .sub-menu").hide();
	
	$(".main-nav li").hover(
		function () {
		$(this).find('.sub-menu:first').stop(true, true).slideDown(300)
	},
		function () {
		$(this).find('.sub-menu:first').slideUp(200)
	});
	
	// Animated logo
	
	var logo = $('.page-template-template-homepage-php .logo'),
	menu = $('.page-template-template-homepage-php .main-nav ul').children('li');
	
	content = $('.content, .container'),
	imageTip = $('.blog-thumb a, .portfolio-thumb a, .gallery-thumb a'),
	logoHolder = $('.menu-wrapper');
	
	logo.css('left', '-600px');
	menu.css('left', '-1000px');
	content.css('left', '-860px');
	
	imageTip.hover(
		function () {
		$(this).find('.over-more').stop(true, true).animate({
			right : 0
		}, 200);
		$(this).find('.over-more-title').stop(true, true).animate({
			left : 0
		}, 150);
	},
		function () {
		$(this).find('.over-more').stop(true, true).animate({
			right : -100
		}, 200);
		$(this).find('.over-more-title').stop(true, true).animate({
			left : -300
		}, 150);
	});
	
	$(window).load(function () {
		logo.animate({
			left : 0
		}, 400);
		content.animate({
			left : 50
		}, 400);
		$('.slider-thumb-tray').animate({
			bottom : 42
		}, 500);
		menu.each(function (index) {
			$(this).delay(150 * index).animate({
				left : 0
			}, 400);
		});
	});
	
	// Animated Page Change
	
	$(document).delegate("a[href*=.html]", "click", function (event) {
		event.preventDefault();
		linkLocation = this.href;
		
		content.animate({
			//left: $(window).width()
			left : -850
		}, 400);
		$('.slider-thumb-tray').animate({
			//left: $(window).width()
			bottom : -100
		}, 400);
		logoHolder.animate({
			top : '3%'
		}, 300, redirect);
	});
	
	function redirect() {
		window.location = linkLocation;
	}
	
	// scroll and view
	
	$(window).scroll(function () {
		var h = $('.content').height();
		var y = $(window).scrollTop();
		
		if (y > (h * .1) && y < (h * .99)) {
			$('.post-navigation').animate({
				bottom : '69px'
			}, 150);
		} else {
			$('.post-navigation').animate({
				bottom : '-90px'
			}, 150);
		}
	});
	
	//Portfolio filtering
	
	if ($().isotope) {
		$(function () {
			var isotopeContainer = $('.portfolio-wrapper'),
			isotopeFilter = $('#filter'),
			isotopeLink = isotopeFilter.find('a');
			isotopeContainer.isotope({
				itemSelector : '.isotope-item',
				layoutMode : 'fitRows',
				filter : '.all'
			});
			
			isotopeLink.click(function () {
				var selector = $(this).attr('data-category');
				isotopeContainer.isotope({
					filter : '.' + selector,
					itemSelector : '.isotope-item',
					layoutMode : 'fitRows',
					animationEngine : 'best-available'
				});
				isotopeLink.removeClass('active');
				$(this).addClass('active');
				return false;
			});
			
		});
		
	}
	
	// PrettyPhoto
	
	if ($().prettyPhoto) {
		$("a[class^='prettyPhoto']").prettyPhoto({
			theme : 'dark_square'
		});
		
		if (($.browser.msie) && (parseInt($.browser.version) === 9))
			$("a[class^='prettyPhoto']").prettyPhoto({
				social_tools : false,
				theme : 'dark_square'
			});
		
		// Else run normally
		else
			$("a[class^='prettyPhoto']").prettyPhoto({
				theme : 'dark_square'
			});
	}
	
	// Tabs
	
	$('.tabs').tabs({
		fx : {
			opacity : 'show'
		}
	});
	
	// Images Preloader
	if ($().preloader) {
		$(document).ready(function () {
			$(".load-item").preloader();
		});
	}
	
	//Search
	
	$('#s').each(
		function () {
		if ($(this).val() === '' || $(this).val() === 'To search type and hit enter') {
			$(this).val('To search type and hit enter');
			$(this).blur(
				function () {
				if ($(this).val() === '') {
					$(this).val('To search type and hit enter');
				}
			});
			
			$(this).focus(
				function () {
				if ($(this).val() === '' || $(this).val() === 'To search type and hit enter') {
					$(this).val('');
				}
			});
		}
	});
	
	// Scroll To Top
	
	$('.totop').click(function () {
		$.scrollTo(0, 800, {
			queue : true
		});
	});
	
	// Tipsy
	
	$(".social a").tipsy({
		gravity : 'n',
		fade : false
	});

});
