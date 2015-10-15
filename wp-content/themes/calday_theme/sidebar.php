<aside id="sidebar" class="col-md-4">
	<?php
		$queried_post_type = get_query_var('post_type');
		if ( is_single() && ( 'clubs' ==  $queried_post_type || 'lessons' ==  $queried_post_type ) ) :
	?>
		<?php if ( is_active_sidebar( 'clubs_sidebar' ) ) : ?>
            <div id="clubs-sidebar" class="clubs-sidebar widget-area" role="complementary">
                <?php dynamic_sidebar( 'clubs_sidebar' ); ?>
            </div><!-- #primary-sidebar -->
        <?php endif; ?>
    <?php endif; ?>
	<?php if ( is_active_sidebar( 'main_sidebar' ) ) : ?>
        <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
            <?php dynamic_sidebar( 'main_sidebar' ); ?>
        </div><!-- #primary-sidebar -->
	<?php endif; ?>
</aside>