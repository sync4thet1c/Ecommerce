<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ecommerce
 */
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel = "stylesheet" href ="/css/main.css?v=<?php echo time(); ?>">
	<link rel = "stylesheet" href ="style.css?v=<?php echo time(); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ecommerce' ); ?></a>

	

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row align-items-center p-0">
				<div class="col site-header_logo">
					<?php the_custom_logo(); ?>
				</div>

				<div class="col-md-5 search"><?php aws_get_search_form( true ); ?></div>
				<div class="col cart d-flex justify-content-end align-items-center">
					<a href="<?php echo wc_get_cart_url(); ?>"><i class = "bi bi-bag-dash p-2"></i></a>
					<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> – <?php echo WC()->cart->get_cart_total(); ?></a>
					<ul class="nav navbar-nav navbar-right">
      					<li><a href="signup.php"><i class="bi bi-person-circle p-2"></i>Sign Up</a></li>
    				</ul>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
