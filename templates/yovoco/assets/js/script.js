jQuery('document').ready(function(){
    /*============================================
     Scrolling Animations
     ==============================================*/
    jQuery('.scrollimation').waypoint(function(){
        jQuery(this).addClass('in');
    },{offset:'80%'});
});
jQuery(window).load(function(){
    jQuery('body').stickfooter();
});

jQuery(window).scroll(function() {
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 94) {
        jQuery("#main-nav").addClass("scrollnav");
    } else {
        jQuery("#main-nav").removeClass("scrollnav");
    }
});

jQuery(window).load(function() {

    var theWindow        = jQuery(window),
        $bg              = jQuery(".background img"),
        aspectRatio      = $bg.width() / $bg.height();

    function resizeBg() {

        if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
            $bg
                .removeClass()
                .addClass('bgheight');
        } else {
            $bg
                .removeClass()
                .addClass('bgwidth');
        }

    }

    theWindow.resize(resizeBg).trigger("resize");

});
/*
function cycleImages(){
      event.preventDefault();

		// Get the div containing the clicked link...
		var currentslide = jQuery('.background .slider').parents('img:first');

		// ... and get the index of that div
		var currentposition = jQuery('.background .slider img').index(currentslide);

		// Use that index to get the slide we'll be fading to
		var nextposition = (jQuery('.background .slider').attr('class')=='next') ? currentposition+1 : currentposition-1;

		// Fade the current slide out...
		jQuery('.slideshow div:eq('+currentposition+')').animate({opacity: 0}, 250, function() {

			// ... and hide it.
			$('.slideshow div:eq('+currentposition+')').css('display','none');

			// Show the next slide...
			$('.slideshow div:eq('+nextposition+')').css('display','block');

			// ... and fade it in.
			$('.slideshow div:eq('+nextposition+')').animate({opacity: 100}, 1500);
		  }
		);
    }

jQuery(document).ready(function(){
// run every 7s
setInterval('cycleImages()', 7000);
})
*/


$.fn.stickfooter = function() {

    var el = $(this);
    var wrap = el.outerHeight();

    $(window).bind('resize.stickfooter', function() {
        check(wrap);
    });
    function check() {
        var footerouter = jQuery('footer').outerHeight() + 20;
        var contentheight = footerouter;
        jQuery('body').css('margin-bottom',(contentheight)+'px');
    }



    check(wrap);
};

$.fn.autoheight = function(options) {

    var el = $(this);
    var opt = $.extend({
        element: ".headertop",
        check: ".headertext"
    }, options );

    $(window).bind('resize.autoheight', function() {
        setheight()
    });

    function setheight() {
        var theheight = el.outerHeight();
        var elementheight = jQuery(opt.element).outerHeight();
        var checkheight = jQuery(opt.check).outerHeight();

        if(theheight > checkheight){
            jQuery(opt.element).css('height',(theheight)+'px');
        }
        else {
            jQuery(opt.element).css('height',(checkheight)+'px');
        }
    }


    setheight();
};


function iFrameHeight()
{
    var h = 0;
    if (!document.all)
    {
        h = document.getElementById('blockrandom').contentDocument.height;
        document.getElementById('blockrandom').style.height = h + 60 + 'px';
    } else if (document.all)
    {
        h = document.frames('blockrandom').document.body.scrollHeight;
        document.all.blockrandom.style.height = h + 20 + 'px';
    }
}