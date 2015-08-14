<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title(''); ?></title>
<?php wp_head(); ?>
<link rel="stylesheet" href="/css/style.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body <?php body_class(); ?>>
<header id="header" class="container">
	<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/logo.png" width="144" height="144" alt=""/>
</header>
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
            <h1><span>About your pool</span></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
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
<footer id="footer" class="container-fluid">
	<div id="footer-inner" class="container">
    	<div class="row">
        	<div class="col-md-2">
            	<img src="img/logo.png" width="144" height="144" alt=""/>
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
                <p>Some Street<br>
				   Some Village<br>
                   Wirral<br>
                   CH12 3AB</p>
                <p>0151 525 1000</p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
