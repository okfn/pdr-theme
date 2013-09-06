<?php do_action('before_post'); ?>
<article <?php post_class(); ?>>
	<div class="article-inner">
		<div class="media-object">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $size = is_feature_item() ? 'pdr_large' : 'thumbnail' ); ?>
			</a>
		</div>
		<div class="media-body">
			<header>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</article>
<?php do_action('after_post'); ?>