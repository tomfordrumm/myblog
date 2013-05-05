jQuery(document).ready(function(){				
    var tagfix = jQuery('.tagcloud a').html();
    jQuery('.tagcloud a').each(function(){
        var tagfix = jQuery(this).html();
        jQuery(this).html('').append('<div class="tag-holder"><div class="tag-left"></div><div class="tag-center">'+tagfix+'</div><div class="tag-right"></div>');
    });






jQuery(function(){
    var opts = {
    lines: 9, // The number of lines to draw
    length: 6, // The length of each line
    width: 2, // The line thickness
    radius: 5, // The radius of the inner circle
    corners: 0.4, // Corner roundness (0..1)
    rotate: 0, // The rotation offset
    color: '#FFF', // #rgb or #rrggbb
    speed: 1, // Rounds per second
    trail: 60, // Afterglow percentage
    shadow: true, // Whether to render a shadow
    hwaccel: false, // Whether to use hardware acceleration
    className: 'spinner', // The CSS class to assign to the spinner
    zIndex: 2e9, // The z-index (defaults to 2000000000)
    top: 'auto', // Top position relative to parent in px
    left: 'auto' // Left position relative to parent in px
  };
  var target = document.getElementById('portfolio-loader');
  var spinner = new Spinner(opts).spin(target);
})


    var container = jQuery('#portfolio-holder');
    jQuery(container).imagesLoaded(function(){




      
        jQuery('#portfolio-loader').attr('style', 'display:none');
        jQuery(container).show().animate({opacity:1},1000);
        
        jQuery(container).isotope({
            itemSelector: '.portfolio_box',
            isAnimated: true,
            animationEngine : 'jquery',
            animationOptions: {
                duration: 1000,
                easing: 'easeInOutBack',
                queue: false
            }
        });
    });






    jQuery('.portfolio-img-loaded').imagesLoaded(function(){
        jQuery('.portfolio-loader2').attr('style', 'display:none');
        jQuery('.speaker-show').attr('style', 'display:block');
    });

    jQuery('#filters a').click(function(){
        var selector = jQuery(this).attr('data-filter');       
        jQuery(container).isotope({ filter: selector });
        return false;
    });

        jQuery('.cat_cell a').click(function() {
          jQuery('#filters li').removeClass('cat_cell_active');
          jQuery('#filters li a').removeClass('cat_cell_active');
          jQuery(this).addClass('cat_cell_active');
        });

    jQuery(".sf-menu .sub-menu li:first-child").before('<li class="sub-menu-top"></li>');
    jQuery(".sf-menu .sub-menu li:last-child").after('<li class="sub-menu-bottom"></li>');


    // PIRO BOX
    jQuery().piroBox({
        my_speed: 300, //animation speed
        bg_alpha: 0.5, //background opacity
        slideShow : 'true', // true == slideshow on, false == slideshow off
        slideSpeed : 3, //slideshow
        close_all : '.piro_close' // add class .piro_overlay(with comma)if you want overlay click close piroBox
    });

jQuery('.nivo-caption').attr('style', 'opacity:0;')
jQuery('#slider').mouseover(function(){
     jQuery('.nivo-caption').animate({
        opacity: 1
       
  }, 5000, function() {
    // Animation complete.
  });
});




    });

