<?php get_header(); ?>
<section id="main" class="container">
	<div class="row">
        <section id="content" class="col-md-8">
            <h1><span><?php the_title(); ?></span></h1>
            <?php the_content(); ?>
        </section>
        <?php get_sidebar(); ?>
    </div>  
</section>
<?php get_footer(); ?>