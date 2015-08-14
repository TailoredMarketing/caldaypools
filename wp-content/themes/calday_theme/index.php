<?php get_header(); ?>
<section id="masthead" class="container-fluid">
	<div id="masthead-inner" class="container">
    	<div id="masthead-text" class="col-md-6 col-md-offset-2">
        	<h1><strong>Calday Community Swimming Pool</strong></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <p><a href="#" class="btn btn-default">Contact Us</a></p>
        </div>
    </div>
</section>
<section id="homeboxes" class="container">
	<div class="row">
    	<div class="homebox col-md-4">
        	<div>
       	    	<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/box-1.png" width="358" height="240" alt=""/>
            </div>
            <div class="homebox-inner pink">
            	<h2>Book your swimming lessons today!</h2>
                <p>Are you interested in booking swimming lessons for any age group?</p>
                <p><a href="#" class="btn btn-default">Read More</a></p>
            </div>
        </div>
        <div class="homebox col-md-4">
        	<div>
            	<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/box-2.png" width="358" height="240" alt=""/>
            </div>
            <div class="homebox-inner orange">
            	<h2>Book your swimming lessons today!</h2>
                <p>Are you interested in booking swimming lessons for any age group?</p>
                <p><a href="#" class="btn btn-default">Read More</a></p>
            </div>
        </div>
        <div class="homebox col-md-4">
        	<div>
            	<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/box-3.png" width="358" height="240" alt=""/>
            </div>
            <div class="homebox-inner green">
            	<h2>Book your swimming lessons today!</h2>
                <p>Are you interested in booking swimming lessons for any age group?</p>
                <p><a href="#" class="btn btn-default">Read More</a></p>
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
        <aside id="sidebar" class="col-md-4">
        	<div class="sidebox">
            	<h2>Our Facilities</h2>
                <div>
                	<ul class="fa-ul facilities-list">
                      <li><i class="fa-li fa fa-check-square"></i>Disabled Access</li>
                      <li><i class="fa-li fa fa-check-square"></i>Family Friendly</li>
                      <li><i class="fa-li fa fa-check-square"></i>Spectator Area</li>
                      <li><i class="fa-li fa fa-check-square"></i>Fully Qualified Instructors</li>
                    </ul>
                </div>
            </div>
        </aside>
    </div>  
</section>
<?php get_footer(); ?>