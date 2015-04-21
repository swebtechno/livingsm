jQuery(document).ready( function() {
	draw_subnav();
	
	jQuery('#menu-main-menu li').mouseenter(function(){
		jQuery(this).children('.sub:first').slideToggle('fast');
		jQuery(this).addClass('hover');
	});
	
	jQuery('#menu-main-menu li').mouseleave(function(){
		jQuery(this).children('.sub:first').slideToggle('fast');
		jQuery(this).removeClass('hover');
	});
	
	elms = jQuery('#mainmenu ul');
	for (i=0;i<elms.length;i++){
		jQuery(elms[i]).children('li:last').addClass('last');
	}
	
});

jQuery(window).load( function () {
	fit_height();
});

jQuery(window).resize( function () {
	fit_height();
});

function draw_subnav(){
	jQuery('ul.menu li ul').wrap('<div class="sub"></div>');
	jQuery('ul.menu li ul').before('<div class="sub_top"><span><b></b></span></div>');
	jQuery('ul.menu li ul').after('<div class="sub_bottom"><span><b></b></span></div>');
	jQuery('ul.menu li ul').wrap('<div class="sub_wrapper"></div>');
	jQuery('ul.menu li ul').wrap('<div class="sub_inner"></div>');
}

function fit_height(){
	h = jQuery(window).height()-350-286;
	jQuery('#main').css('min-height',h);
}