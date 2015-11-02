/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function

var app = {
  side_menu : {
    menu : null,
    init : function() {

      // creat a Snap menu
      this.menu = new Snap({
          element: document.getElementById('container'),
          disable: 'left',
      });

      this.menu.on('animated', function(){

        console.log('menu animated');
        var snapper_state = app.side_menu.menu.state();

        if( snapper_state.state === 'closed' ){
          // remove freezer
          jQuery('#container').removeClass('freezed');
        } else {
          // freeze up content area
          jQuery('#container').addClass('freezed');
        }
      });

      // disable it by default
      this.menu.disable();

      // Get view port
      viewport = updateViewportDimensions();
      // if we're above or equal to 768 fire this off
      if( viewport.width >= 768 ) {
        console.log('desktop');
        // disable sidebar menu
        this.menu.disable();
        // move navigation to header
        this.move_to_header();
      } else {
        console.log('mobile');
        // move navigation to side-menu
        this.move_to_side();
        // enable snap menu
        this.menu.enable();
      }
    },

    move_to_side: function(){
      if( !jQuery('body').hasClass('snap-js') ){
        // add class to body
        jQuery('body').addClass('snap-js');
        // add class to main container
        jQuery('#container').addClass('snap-content');

        jQuery('.top-nav').prependTo('body').wrap('<div class="snap-drawers"><div class="snap-drawer snap-drawer-right"></div></div>');

        // add logo
        jQuery('.snap-drawer-right').prepend('<img src="/wp-content/themes/gc/library/images/logo-giant-sydney.jpg" alt="Giant Sydney Logo">')
      }
    },
    move_to_header: function(){
      if( jQuery('body').hasClass('snap-js') ){
        // remove from body
        jQuery('body').removeClass('snap-js');
        // remove class fron main container
        jQuery('#container').removeClass('snap-content');
        // put back to the header
        jQuery('.top-nav').prependTo('.main-menu-wrap');
        // delete snap drawers
        jQuery('.snap-drawers').remove();
      }
    }
  },

  enable_smoothscroll : function(){
    /*Smooth scroll*/
    jQuery('a[href*=#]:not([href=#]):not([href*=#vc_images])').on('click', function() {

      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = jQuery(this.hash);
        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
        if (target.length) {

          jQuery('a[href*=#]:not([href=#]):not([href*=#vc_images])').removeClass('active');
          jQuery(this).addClass('active');

          jQuery('html, body').animate({
            scrollTop: target.offset().top
          }, 1000 );
          return false;
        }
      }
    });
  }
}

/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();

  /* Initialize Sidebar menu */
  app.side_menu.init();

  /* Hanle Mobile Menu Toggle */
  $('#toggle-menu').on('click', function(){
    if( app.side_menu.menu.state().state=="right" ){
      app.side_menu.menu.close();
    } else {
      app.side_menu.menu.open('right');
    }
  });

  viewport = updateViewportDimensions();
  // if we're above or equal to 768 fire this off
  if( viewport.width >= 768 ) {

    app.enable_smoothscroll();
  }

  // Handle differences on window resize
  $(window).resize(function () {

    // if we're on the home page, we wait the set amount (in function above) then fire the function
    waitForFinalEvent( function() {
        // update the viewport, in case the window size has changed
        viewport = updateViewportDimensions();

        // if we're above or equal to 768 fire this off
        if( viewport.width >= 768 ) {

          // disable sidebar menu
          app.side_menu.menu.disable();

          // move navigation to header
          app.side_menu.move_to_header();

        } else {
          
          // enable sidebar menu
          app.side_menu.menu.enable();

          // move navigation to header
          app.side_menu.move_to_side();

        }
      }
      , timeToWaitForLast
      , "function-identifier-string");

  }); 

}); /* end of as page load scripts */
