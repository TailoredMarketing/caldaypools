<aside id="sidebar" class="col-md-4">
	<?php if ( is_active_sidebar( 'main_sidebar' ) ) : ?>
        <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
            <?php dynamic_sidebar( 'main_sidebar' ); ?>
        </div><!-- #primary-sidebar -->
	<?php endif; ?>
</aside>