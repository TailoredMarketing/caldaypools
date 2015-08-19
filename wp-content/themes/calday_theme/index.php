<?php get_header(); ?>
<section id="main" class="container">
	<div class="row">
        <section id="content" class="col-md-8">
            <h1><span><?php if( is_home() && get_option( 'page_for_posts' ) ) echo get_the_title( get_option( 'page_for_posts' ) ); ?></span></h1>
            <?php while( have_posts() ) :
					the_post();
			?>
            	<article>
                	<h2><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; ?>
					
        </section>
        <?php get_sidebar(); ?>
    </div>  
</section>
<?php get_footer(); ?>