<?php
	global $tailored_theme;
	$option = $tailored_theme->get_option();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title(''); ?></title>
<?php wp_head(); ?>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php
	echo ( isset( $option['theme_options']['advanced']['head'] ) && $option['theme_options']['advanced']['head'] != '' ? stripslashes( $option['theme_options']['advanced']['head'] ) : '' );
?>

<style>
	<?php
		echo ( isset( $option['theme_options']['advanced']['css'] ) && $option['theme_options']['advanced']['css'] != '' ? stripslashes( $option['theme_options']['advanced']['css'] ) : '' );
	?>

</style>
<script>
	<?php
		echo ( isset( $option['theme_options']['advanced']['js'] ) && $option['theme_options']['advanced']['js'] != '' ? stripslashes( $option['theme_options']['advanced']['js'] ) : '' );
	?>

</script>
</head>
<body <?php body_class(); ?>>
<?php
	echo ( isset( $option['theme_options']['analytics']['code'] ) && $option['theme_options']['analytics']['code'] != '' ? stripslashes( $option['theme_options']['analytics']['code'] ) : '' );
?>

<header id="header" class="container">
	<div class="row">
    	<div class="col-md-2">
    		<a href="/"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/logo.png" width="144" height="144" alt=""/></a>
        </div>
        <div class="col-md-10 headerright">
            <nav id="nav" class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <?php if ( function_exists('wp_nav_menu') ) { wp_nav_menu( array(
                            'menu'              => 'primary',
                            'theme_location'    => 'primary',
                            'container'         => 'div',
                            'container_class'   => 'collapse navbar-collapse main-nav',
                            'container_id'      => 'main-nav',
                            'menu_class'        => 'nav navbar-nav pull-right',
                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                            'walker'            => new wp_bootstrap_navwalker()
                            )
                        ); } ?>
            </nav>
        </div>
</header>