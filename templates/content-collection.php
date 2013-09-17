<?php do_action('before_post'); ?>
<article <?php post_class(); ?>>
	<div class="article-inner">
		<div class="media-object">
			<a href="<?php the_permalink(); ?>">
				<?php if ( is_feature_item() ): ?>
					<?php the_post_thumbnail('pdr_collection_large'); ?>
					<header>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					</header>
				<?php else: ?>
					<?php the_post_thumbnail('thumbnail'); ?>
				<?php endif; ?>
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