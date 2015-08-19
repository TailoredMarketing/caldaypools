<?php
	global $tailored_theme;
	$option = $tailored_theme->get_option();
?>
<footer id="footer" class="container-fluid">
	<div id="footer-inner" class="container">
    	<div class="row">
        	<div class="col-md-2">
            	<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/logo.png" width="144" height="144" alt=""/>
            </div>
            <div class="col-md-6">
            	<ul class="list-unstyled">
                  <?php if ( function_exists('wp_nav_menu') ) { wp_nav_menu( array(
                            'menu'              => 'footer',
                            'theme_location'    => 'footer',
                            'container'         => 'div',
                            'container_id'      => 'footer-nav',
                            )
                        ); } ?>
                </ul>
            </div>
            <div class="col-md-3 pull-right">
            	<h2>Contact Info</h2>
                <div itemscope itemtype="http://schema.org/LocalBusiness">
                    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                        <span itemprop="streetAddress">
							<?php echo $option['theme_options']['address']['street']; ?>,<br>
                            <?php echo $option['theme_options']['address']['address_2']; ?>
                        </span><br>
                        <span itemprop="addressLocality"><?php echo $option['theme_options']['address']['town']; ?></span><br>
                        <span itemprop="addressRegion"><?php echo $option['theme_options']['address']['county']; ?></span><br>
                        <span itemprop="postalCode"><?php echo $option['theme_options']['address']['postcode']; ?></span>
                    </div>
                    <div itemprop="address" itemscope itemtype="http://schema.org/ContactPoint">
                        <span itemprop="telephone"><?php echo $option['theme_options']['address']['phone']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
