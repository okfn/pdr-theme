<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
	<input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field " placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>">
	<label class="hide"><?php _e('Search for:', 'roots'); ?></label>
	<button type="submit" class="search-submit"><?php _e('Search', 'roots'); ?></button>
</form>
<p><a href="<?php echo apply_filters('browse_by_tag_link', $link); ?>"><?php _e('..or BROWSE BY TAG') ?></p></a>