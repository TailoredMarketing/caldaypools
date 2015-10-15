<?php 
	get_header(); 
	global $tailored_theme;
	$option = $tailored_theme->get_option();
?>
<section id="masthead" class="container-fluid">
	<div id="masthead-inner" class="container">
    	<div id="masthead-text" class="col-md-6 col-md-offset-2">
        	<?php echo wpautop( $option['theme_options']['homepage']['intro'] ); ?>
            <p><a href="#" class="btn btn-default">Contact Us <i class="fa fa-envelope"></i></a></p>
        </div>
    </div>
</section>
<section id="homeboxes" class="container">
	<div class="row">
    	<div class="homebox col-md-4">
        	<div>
       	    	<?php echo wp_get_attachment_image( $option['theme_options']['homepage']['boxes']['box1']['image'], 'full', array( 'class' => 'img-responsive' ) ); ?>
            </div>
            <div class="homebox-inner pink">
            	<h2><?php echo $option['theme_options']['homepage']['boxes']['box1']['header']; ?></h2>
                <p><?php echo $option['theme_options']['homepage']['boxes']['box1']['text']; ?></p>
                <p><a href="<?php echo $option['theme_options']['homepage']['boxes']['box1']['link']; ?>" class="btn btn-default">Read More <i class="fa fa-chevron-circle-right"></i></a></p>
            </div>
        </div>
        <div class="homebox col-md-4">
        	<div>
            	<?php echo wp_get_attachment_image( $option['theme_options']['homepage']['boxes']['box2']['image'], 'full', array( 'class' => 'img-responsive' ) ); ?>
            </div>
            <div class="homebox-inner orange">
            	<h2><?php echo $option['theme_options']['homepage']['boxes']['box2']['header']; ?></h2>
                <p><?php echo $option['theme_options']['homepage']['boxes']['box2']['text']; ?></p>
                <p><a href="<?php echo $option['theme_options']['homepage']['boxes']['box2']['link']; ?>" class="btn btn-default">Read More <i class="fa fa-chevron-circle-right"></i></a></p>
            </div>
        </div>
        <div class="homebox col-md-4">
        	<div>
            	<?php echo wp_get_attachment_image( $option['theme_options']['homepage']['boxes']['box3']['image'], 'full', array( 'class' => 'img-responsive' ) ); ?>
            </div>
            <div class="homebox-inner green">
            	<h2><?php echo $option['theme_options']['homepage']['boxes']['box3']['header']; ?></h2>
                <p><?php echo $option['theme_options']['homepage']['boxes']['box3']['text']; ?></p>
                <p><a href="<?php echo $option['theme_options']['homepage']['boxes']['box3']['link']; ?>" class="btn btn-default">Read More <i class="fa fa-chevron-circle-right"></i></a></p>
            </div>
        </div>
    </div>
</section>
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