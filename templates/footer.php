<footer class="content-info container" role="contentinfo">
	<div class="row">
		<?php if ( is_active_sidebar('sidebar-footer-top') ): ?>
		<div class="footer-top">
			<div class="inner">
				<?php dynamic_sidebar('sidebar-footer-top'); ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar('sidebar-footer-bottom') ): ?>
		<div class="footer-bottom">
			<div class="inner">
				<?php dynamic_sidebar('sidebar-footer-bottom'); ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</footer>

<?php wp_footer(); ?>