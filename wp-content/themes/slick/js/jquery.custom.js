
/*

Custom Javascript

------------------------------------------------------------------------------- */


jQuery.noConflict();

jQuery(document).ready(function($) {




/*	SUPERFISH - MENU - http://users.tpg.com.au/j_birch/plugins/superfish/#options
------------------------------------------------------------------------------- */

jQuery('#navi ul').superfish({
	delay: 200,									// one second delay on mouseout
	animation: {opacity:'show', height:'show'},	// an object equivalent to first parameter of jQuery’s .animate() method
	speed: 'normal',							// faster animation speed
	dropShadows: false,							// completely disable drop shadows by setting this to false
	autoArrows: true							// if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance
});




/*	CONTACT FORM VALIDATION
------------------------------------------------------------------------------- */

jQuery("#contactForm").validate();




/*	PRETTYPHOTO - http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
------------------------------------------------------------------------------- */

function prettyphoto_function() {

// $(document).ready(function(){
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		theme: 'pp_default',
		opacity: 0.90, /* Value between 0 and 1 */
		show_title: false, /* true/false */
		social_tools: false, /* html or false to disable */
		default_width: 700,
		default_height: 400
	});
// });
}

prettyphoto_function();




/*	`PORTFOLIO - ISOTOPE - http://isotope.metafizzy.co/
------------------------------------------------------------------------------- */

$(window).load(function(){

	// cache container
	var $container = $('#container');

	// initialize isotope
	$container.isotope({
		itemSelector : '.element',
		layoutMode : 'fitRows',
		resizable: false, // disable normal resizing
		animationEngine : 'best-available',
  		// set columnWidth to a percentage of container width
  		masonry: {
  			columnWidth: $container.width() / 5
  		}
	});

	// update columnWidth on window resize
	$(window).smartresize(function(){
		$container.isotope({
			// update columnWidth to a percentage of container width
			masonry: { columnWidth: $container.width() / 5 }
		});
	});

	// filter items when filter link is clicked
	$('#filters a').click(function(){
		var selector = $(this).attr('data-filter');
		$container.isotope({ filter: selector });
		return false;
	});

	// set selected menu items
	var $optionSets = $('.option-set'),
		$optionLinks = $optionSets.find('a');

		$optionLinks.click(function() {
			var $this = $(this);
			// don't proceed if already selected
			if ( $this.hasClass('selected') ) {
				return false;
			}

			var $optionSet = $this.parents('.option-set');
			$optionSet.find('.selected').removeClass('selected');
			$this.addClass('selected'); 
		});

});




/*	`PORTFOLIO - SLIDER
------------------------------------------------------------------------------- */

// Show the paging and activate its first link
jQuery(".paging").show();
jQuery(".paging a:first").addClass("active");

// Get size of the image, how many images there are, then determin the size of the image reel.
var imageWidth = jQuery(".window").width();
var imageSum = jQuery(".image_reel img").size();
var imageReelWidth = imageWidth * imageSum;

// Adjust the image reel to its new size
jQuery(".image_reel").css({'width' : imageReelWidth});

// Paging  and Slider Function
rotate = function(){
	var triggerID = $active.attr("rel") - 1; //Get number of times to slide
	var image_reelPosition = triggerID * imageWidth; //Determines the distance the image reel needs to slide

	jQuery(".paging a").removeClass('active'); //Remove all active class
	$active.addClass('active'); //Add active class (the $active is declared in the rotateSwitch function)

	// Slider Animation
	jQuery(".image_reel").animate({
    	left: -image_reelPosition
	}, 500 );

};

// Rotation  and Timing Event
rotateSwitch = function(){
	play = setInterval(function(){ //Set timer - this will repeat itself every 7 seconds
    	$active = jQuery('.paging a.active').next(); //Move to the next paging
    	if ( $active.length === 0) { //If paging reaches the end...
        	$active = jQuery('.paging a:first'); //go back to first
    	}
    	rotate(); //Trigger the paging and slider function
	}, 5000); //Timer speed in milliseconds (7 seconds)
};

rotateSwitch(); //Run function on launch

// On Hover
jQuery(".image_reel a").hover(function() {
	clearInterval(play); //Stop the rotation
}, function() {
	rotateSwitch(); //Resume rotation timer
});

// On Click
jQuery(".paging a").click(function() {
	$active = jQuery(this); //Activate the clicked paging
	// Reset Timer
	clearInterval(play); //Stop the rotation
	rotate(); //Trigger rotation immediately
	rotateSwitch(); // Resume rotation timer
	return false; //Prevent browser jump to link anchor
});




/*	W3C 'rel' attribute
------------------------------------------------------------------------------- */

jQuery('a[data-rel]').each(function() {
	jQuery(this).attr('rel', jQuery(this).data('rel'));
});




/*	SHORTCODES - TABS
------------------------------------------------------------------------------- */

$(".tab_content").hide();
$("ul.tabs li:first").addClass("active").show();
$(".tab_content:first").show();

$("ul.tabs li").click(function() {

	$("ul.tabs li").removeClass("active");
	$(".tab_content").hide();
	$(this).addClass("active");
	var tabNum = ($(this).find("a").attr("href")).replace('#tab', '');
	$(this).parent().next().find("div:nth-child(" + tabNum + ")").fadeIn();

	return false;
});




/*	SHORTCODES - TOGGLE
------------------------------------------------------------------------------- */

$("h3.toggle").click(function() {
	$(this).toggleClass("active").next(".toggle_container").slideToggle("fast");
});




/*	CSS Equal Height Columns
------------------------------------------------------------------------------- */

/*
function equalheight_function() {
	jQuery(document).ready(function(){
		var H = 0;
		jQuery("ul.related-list li").each(function(i) {
	    	var h = jQuery("ul.related-list li").eq(i).height();
	    	if(h > H) H = h;
	   	});
	    	
		jQuery("ul.related-list li").height(H);

	});
}

equalheight_function();	
*/




/*	jQuery topLink Plugin - http://davidwalsh.name/jquery-top-link
------------------------------------------------------------------------------- */

jQuery.fn.topLink = function(settings) {
	settings = jQuery.extend({
		min: 1,
		fadeSpeed: 200
	},
	settings );
	return this.each(function() {

	// listen for scroll
	var el = $(this);
	el.hide(); // in case the user forgot
	jQuery(window).scroll(function() {
		if($(window).scrollTop() >= settings.min) {
			el.fadeIn(settings.fadeSpeed);
		} else {
			el.fadeOut(settings.fadeSpeed);
			}
		});
	});
};

// usage w/ smoothscroll
jQuery(document).ready(function() {
	
// set the link
jQuery('#top-link').topLink({
	min: 400,
	fadeSpeed: 500
});

// smoothscroll
jQuery('#top-link').click(function(e) {
	e.preventDefault();
	jQuery.scrollTo(0,300);
	});

});




/*	Fix YouTube iframe overlay and z-index issues
http://maxmorgandesign.com/fix_youtube_iframe_overlay_and_z_index_issues/
------------------------------------------------------------------------------- */

jQuery("iframe").each(function(){
    var ifr_source = jQuery(this).attr('src');
    var wmode = "wmode=transparent";
    if(ifr_source.indexOf('?') != -1) {
        var getQString = ifr_source.split('?');
        var oldString = getQString[1];
        var newString = getQString[0];
        jQuery(this).attr('src',newString+'?'+wmode+'&amp;'+oldString);
    }
    else jQuery(this).attr('src',ifr_source+'?'+wmode);
});




/*	jQuery show/hide - TOP NOTICE
------------------------------------------------------------------------------- */

/*
jQuery(document).ready(function() {

	jQuery('.show_hide').click(function() {
		jQuery(".slidingDiv").slideToggle();
		jQuery(this).toggleClass('open');
	});
	
});
*/



/*	Custom JS ENDS
------------------------------------------------------------------------------- */

});

