(function($) {

	function homepage_box_heights() {
		if( Modernizr.mq('screen and (min-width:768px)') ) {
			$('.home-collection .row').each(function(){
				$(this).find('.regular-list-item .article-inner').equalHeights();
			});
		}
	}

	function collections_box_heights() {
		if( Modernizr.mq('screen and (min-width:768px)') ) {
			$('.grid .main .regular-list-item, .related-content article').equalHeights();
		}
	}

	function collections_sidebar_heights_desktop() {
		if( Modernizr.mq('screen and (min-width:768px)') ) {
			$('.home-collection').each(function(){
				$(this).find('.main, .sidebar, .sidebar .widget-inner').equalHeights();
			});
		}
	}

	function collections_sidebar_heights_mobile() {
		if( Modernizr.mq('screen and (max-width:767px)') ) {
			$('.home-collection').each(function(){
				$(this).find('.sidebar, .sidebar .widget-inner').equalHeights();
			});
		}
	}

	if ( $('.taxonomy-nav').length ) {
		$('.taxonomy-nav .dropdown-menu').each(function() {
			if ( !$(this).children().length ) {
				$(this).closest('.dropdown').remove();
			}
		});
	}

	var id;
    $(window).resize(function() {
        clearTimeout(id);
        id = setTimeout(homepage_box_heights, 0);
        id = setTimeout(collections_box_heights, 0);
        id = setTimeout(collections_sidebar_heights_desktop, 0);
        id = setTimeout(collections_sidebar_heights_mobile, 0);
        
    });

    homepage_box_heights();
    collections_box_heights();
    collections_sidebar_heights_desktop();
    collections_sidebar_heights_mobile();
	
})(jQuery);


