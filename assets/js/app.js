!function ($) {

  $(function(){
    
	var $window = $(window);
    var $body   = $(document.body);
    var navHeight = $('.navbar').outerHeight(true) + 10

    if ($.fn.scrollspy) $body.scrollspy({
      target: '#topnav',
      offset: navHeight
    })

    $window.on('load', function () {
      if ($.fn.scrollspy) $body.scrollspy('refresh')
    })
    
	if ($.fn.collapse) $('#accordion').collapse();
	
	if ($.fn.localScroll) $('#topnav').localScroll({offset: {top:0}});

	$(".browse.smo").click(function(){
		if ($.fn.scrollTo) $("html,body").scrollTo($("#categories"), 1000);
	});

	$(".newsearch").click(function(){
		if ($.fn.scrollTo) $("html,body").scrollTo($("#search"), 1000);
	});
	
	var indeed_logo = function(a){
		var logo = $('#indeed_logo');
		if (logo.length == 0){
			if (typeof a != 'undefined'){
				$('<div id="indeed_logo" class="text-center"><span id=indeed_at><a href="http://www.indeed.com/">jobs</a> by <a href="http://www.indeed.com/" title="Job Search"><img src="http://www.indeed.com/p/jobsearch.gif" style="border: 0; vertical-align: middle;" alt="Indeed job search"></a></span></div>').appendTo(a);
				return $('#indeed_logo');
			}
		}
		return logo;
	};
	$('#tabAll').click(function(e){
		e.preventDefault();
		$('#tabAll').parent().addClass('active').siblings().removeClass('active');
		$('.tab-pane .no-jobs').addClass('hide');
		$('.tab-pane').each(function(i,t){
	  		$(this).addClass('active');  
	  	});
	  	$('[data-toggle="tab"]').one('click', function(){
		  	$('.tab-pane .no-jobs').removeClass('hide');
		});
	  	indeed_logo().hide();
	});
	
	$('#myTabs>ul>li>a').on('click', function(e){
		var t = $(this).attr('title'), index = $(this).index();
		if (t.match(/Indeed/ig)){
			var tc = $( $(this).attr('href') );
			indeed_logo(tc).show();
		} else {
			indeed_logo().hide();
		}
	});
	
	$(document).on('click.feedres', '[data-toggle="jump2feed"]', function(e){
		if ( $.fn.scrollTo ) e.preventDefault();
		var title = $(this).attr('href');
		title = title.replace(/.*(?=#[^\s]+$)/, '');
		title = title.substring(1);
		var target = $('#myTabs a[title*="'+title+'"]');
		if ( target.length ){
			target.click();
			// go to
			if ($.fn.scrollTo) $("html,body").scrollTo($(".results"), 1000);
		}
	});
	
	$(document).on('click', '.footer-links a', function(e){
		if ( $.fn.scrollTo ) e.preventDefault();
		var target = $(this).attr('href');
		target = target.replace(/.*(?=#[^\s]+$)/, '');
		if ( $(target).length ){
			// go to
			if ( $.fn.scrollTo ) $("html,body").scrollTo($(target), 1000);
		}
	});
	
	$(document).on('click.type', '[data-active]', function(e){
		var $this = $(this), data = $this.data();
		var target = $('#accordion [data-type*="'+data.active+'"]');
		console.log(this, data, data.active, target);
		if (target.length && !target.hasClass('collapsed')){
			target.click();
		}
	});
	
	if ( $.fn.niceScroll ){
		$("html").niceScroll({cursorcolor:"#333"});
	}
	
	$(window).on('load', function(e){
		var current_hash = window.location.hash;
		if (current_hash && $(current_hash).length){
			if ($.fn.scrollTo) $("html,body").scrollTo($(current_hash), 1000);
		}
	});
	
	$(document).on('click.theme', '[data-toggle="theme"]', function(e){
		e.preventDefault();
		if ($(this).parent().hasClass('active')){
			return false;
		}
		var href = $(this).attr('href'), $switcher = $('#theme_switcher');
		href = href.replace(/.*(?=#[^\s]+$)/, '').substr(1);
		if ( $switcher.length ){
			var newurl = 'assets/themes/' + href + '/bootstrap.min.css';
			$switcher.attr('href', newurl);
			$('#current_theme').text(href);
		}
	});
	
  });

}(window.jQuery)