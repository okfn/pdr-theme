(function($) {

	function fix_heights() {

		if( Modernizr.mq('screen and (min-width:768px)') ) {
			if ( $('.home-collection .row').length ) {
				$('.home-collection .row').each(function(){
					$(this).find('.regular-list-item .article-inner').equalHeights();
				});
			}

			if ( $('.grid .main .regular-list-item, .related-content article').length ) {
				$('.grid .main .regular-list-item, .related-content article').equalHeights();
			}

			if ( $('.home-collection .row').length ) {
				$('.home-collection').each(function(){
					$(this).find('.main, .sidebar, .sidebar .widget-inner').equalHeights();
				});
			}


			if( Modernizr.mq('screen and (max-width:767px)') ) {
				if ( $('.home-collection').length ) {
					$('.home-collection').each(function(){
						$(this).find('.sidebar, .sidebar .widget-inner').equalHeights();
					});
				}
			}
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
        id = setTimeout(fix_heights, 0);
    });

    $(window).load(function() {
		fix_heights();
    });

    fix_heights();
	
})(jQuery);


