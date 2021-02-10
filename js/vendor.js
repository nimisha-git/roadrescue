/*==== Main menu Section ====*/
var forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(var c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(var e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};
var hamburgers = document.querySelectorAll(".hamburger");
if (hamburgers.length > 0) {
  forEach(hamburgers, function(hamburger) {
    hamburger.addEventListener("click", function() {
      this.classList.toggle("is-active");
    }, false);
  });
}

//Auto height set sticky
// var videoheight  = jQuery('#chassis').height();
// jQuery(window).scroll(function() {
//     if (jQuery(window).scrollTop() >=videoheight) {
//         jQuery('#mission-ready-sec .fusion-builder-row-inner').addClass('fixed');
//     } else {
//         jQuery('#mission-ready-sec  .fusion-builder-row-inner').removeClass('fixed');
//     }
// });

 $(window).scroll(function(){
    if ($(window).scrollTop() >= 1630) {
      $('#mission-ready-sec .fusion-builder-row-inner').addClass('fixed');
     }
     else {
      $('#mission-ready-sec .fusion-builder-row-inner').removeClass('fixed');
     }
  });

jQuery(document).on("click",".hamburger",function(){
	if (jQuery('.sitemenu').hasClass("is-down") ) 
	{
		jQuery(".sitemenu").removeClass("is-down");
		jQuery(".sitemenu").addClass("is-hidden");
		jQuery('html').removeClass('is-nav-open');
	}
	else if ( jQuery('.sitemenu').hasClass( "is-hidden" ) ) 
	{
		jQuery(".sitemenu").removeClass("is-hidden");
		jQuery('html').addClass('is-nav-open');
	}else
	{
		jQuery(".sitemenu").addClass("is-down"); 
		jQuery('.sitemenu').delay(1000).queue(function(){
			jQuery(this).removeClass('is-down').addClass('is-hidden').clearQueue()
		});
		jQuery('html').removeClass('is-nav-open');
	}
});


jQuery(document).on("click",".close-menu",function(){
	if (jQuery('.sitemenu').hasClass("is-down") ) 
	{
		jQuery(".sitemenu").removeClass("is-down");
		jQuery(".sitemenu").addClass("is-hidden");
		jQuery('html').removeClass('is-nav-open');
	}
	else if ( jQuery('.sitemenu').hasClass( "is-hidden" ) ) 
	{
		jQuery(".sitemenu").removeClass("is-hidden");
		jQuery('html').addClass('is-nav-open');
	}else
	{
		jQuery(".sitemenu").addClass("is-down"); 
		jQuery('.sitemenu').delay(1000).queue(function(){
			jQuery(this).removeClass('is-down').addClass('is-hidden').clearQueue()
		});
		jQuery('html').removeClass('is-nav-open');
	}
});
jQuery(".close-menu").click(function() {
    jQuery(".hamburger--spin").removeClass("is-active");
});

/*=== Tabbing Section ===*/
jQuery(document).ready(function(){	
	jQuery('.nav-tabs ul li').click(function(){
		var tab_id = jQuery(this).attr('data-tab');
		jQuery('.nav-tabs ul li').removeClass('selected');
		jQuery('.tab-pane').removeClass('active');
		jQuery(this).addClass('selected');
		jQuery("#"+tab_id).addClass('active');
	})
})


jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 350){  
      jQuery('header').addClass("sticky");
    }
    else{
      jQuery('header').removeClass("sticky");
    }
  });

jQuery('.chessis-sldider').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  infinite: true,
   dots: false,
    responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
