<?php get_header(); ?>
<section id="main" class="container">
	<div class="row">
        <section id="content" class="col-md-8">
            <h1><span><?php the_title(); ?></span></h1>
            <?php the_content(); ?>
        </section>
        <aside id="sidebar" class="col-md-4">
        	<?php get_sidebar(); ?>
        </aside>
    </div>  
</section>
<?php get_footer(); ?>