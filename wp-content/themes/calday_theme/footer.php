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
                  <li><a href="#">Prices</a></li>
                  <li><a href="#">Timetables</a></li>
                  <li>&nbsp;</li>
                  <li><a href="#">Privacy Policy</a></li>
                  <li><a href="#">Terms &amp; Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-3 pull-right">
            	<h2>Contact Info</h2>
                <p><?php echo $option['theme_options']['address']['street']; ?><br>
				   <?php echo $option['theme_options']['address']['address_2']; ?><br>
                   <?php echo $option['theme_options']['address']['town']; ?><br>
                   <?php echo $option['theme_options']['address']['postcode']; ?></p>
                <p><?php echo $option['theme_options']['address']['phone']; ?></p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
