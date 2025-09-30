<?php
$theme = wp_get_theme( 'priotech' );
$priotech_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}
require get_theme_file_path( 'inc/class-tgm-plugin-activation.php' );
$priotech = (object) array(
	'version' => $priotech_version,
	/**
	 * Initialize all the things.
	 */
	'main' => require 'inc/class-main.php',
);

require get_theme_file_path( 'inc/functions.php' );
require get_theme_file_path( 'inc/template-hooks.php' );
require get_theme_file_path( 'inc/template-functions.php' );

require_once get_theme_file_path( 'inc/merlin/vendor/autoload.php' );
require_once get_theme_file_path( 'inc/merlin/class-merlin.php' );
require_once get_theme_file_path( 'inc/merlin-config.php' );
require_once get_theme_file_path( 'inc/class-customize.php' );

if ( priotech_is_woocommerce_activated() ) {
	$priotech->woocommerce = require get_theme_file_path( 'inc/woocommerce/class-woocommerce.php' );

	require get_theme_file_path( 'inc/woocommerce/class-woocommerce-adjacent-products.php' );
	require get_theme_file_path( 'inc/woocommerce/woocommerce-functions.php' );
	require get_theme_file_path( 'inc/woocommerce/woocommerce-template-functions.php' );
	require get_theme_file_path( 'inc/woocommerce/woocommerce-template-hooks.php' );
	require get_theme_file_path( 'inc/woocommerce/template-hooks.php' );
	require get_theme_file_path( 'inc/woocommerce/class-woocommerce-settings.php' );
	require get_theme_file_path( 'inc/woocommerce/class-woocommerce-brand.php' );
	require get_theme_file_path( 'inc/woocommerce/class-woocommerce-extra.php' );
	require get_theme_file_path( 'inc/woocommerce/class-woocommerce-quantity-field-shop-page.php' );

	require get_theme_file_path( 'inc/merlin/includes/class-wc-widget-product-brands.php' );
	require get_theme_file_path( 'inc/merlin/includes/product-360-view.php' );
}

if ( priotech_is_contactform_activated() ) {
	require get_theme_file_path( 'inc/cf7/class-cf7.php' );
}

if ( priotech_is_wishlist_activated() ) {
	require get_theme_file_path( 'inc/wishlist/class-wishlist.php' );
}


if ( priotech_is_elementor_activated() ) {
	require get_theme_file_path( 'inc/elementor/functions-elementor.php' );

	if ( ! defined( 'ELEMENTOR_PRO_VERSION' ) && version_compare( ELEMENTOR_VERSION, '3.18.0', '>=' ) ) {
		require get_theme_file_path( 'inc/elementor/class-fix-elementor.php' );
	}

	$priotech->elementor = require get_theme_file_path( 'inc/elementor/class-elementor.php' );
	//====start_premium
	$priotech->megamenu = require get_theme_file_path( 'inc/megamenu/megamenu.php' );
	//====end_premium
	$priotech->parallax = require get_theme_file_path( 'inc/elementor/class-section-parallax.php' );


	if ( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
		require get_theme_file_path( 'inc/elementor/functions-elementor-pro.php' );
	}

	if ( function_exists( 'hfe_init' ) ) {
		require get_theme_file_path( 'inc/header-footer-elementor/class-hfe.php' );
		require get_theme_file_path( 'inc/merlin/includes/breadcrumb.php' );
		require get_theme_file_path( 'inc/merlin/includes/class-custom-shapes.php' );
	}

	if ( priotech_is_woocommerce_activated() ) {
		require_once get_theme_file_path( 'inc/elementor/elementor-control/class-elementor-control.php' );
	}
}

if ( ! is_user_logged_in() ) {
	require get_theme_file_path( 'inc/modules/class-login.php' );
}

function priotech_custom_css() {
	$temp_dir_uri = get_template_directory_uri();
	$str = '<style>
  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-weight: 900;
  	font-display: swap;
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb_Black.eot);
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb_Black.eot?#iefix) format("embedded-opentype"), url(%THEME_DIR_URI%/font/woff2/IRANSansWeb_Black.woff2) format("woff2"), url(%THEME_DIR_URI%/font/woff/IRANSansWeb_Black.woff) format("woff"), url(%THEME_DIR_URI%/font/ttf/IRANSansWeb_Black.ttf) format("truetype")
  }

  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-weight: 700;
  	font-display: swap;
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb_Bold.eot);
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb_Bold.eot?#iefix) format("embedded-opentype"), url(%THEME_DIR_URI%/font/woff2/IRANSansWeb_Bold.woff2) format("woff2"), url(%THEME_DIR_URI%/font/woff/IRANSansWeb_Bold.woff) format("woff"), url(%THEME_DIR_URI%/font/ttf/IRANSansWeb_Bold.ttf) format("truetype")
  }

  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-display: swap;
  	font-weight: 500;
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb_Medium.eot);
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb_Medium.eot?#iefix) format("embedded-opentype"), url(%THEME_DIR_URI%/font/woff2/IRANSansWeb_Medium.woff2) format("woff2"), url(%THEME_DIR_URI%/font/woff/IRANSansWeb_Medium.woff) format("woff"), url(%THEME_DIR_URI%/font/ttf/IRANSansWeb_Medium.ttf) format("truetype")
  }

  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-display: swap;
  	font-weight: 300;
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb_Light.eot);
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb_Light.eot?#iefix) format("embedded-opentype"), url(%THEME_DIR_URI%/font/woff2/IRANSansWeb_Light.woff2) format("woff2"), url(%THEME_DIR_URI%/font/woff/IRANSansWeb_Light.woff) format("woff"), url(%THEME_DIR_URI%/font/ttf/IRANSansWeb_Light.ttf) format("truetype")
  }

  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-weight: 200;
  	font-display: swap;
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb_UltraLight.eot);
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb_UltraLight.eot?#iefix) format("embedded-opentype"), url(%THEME_DIR_URI%/font/woff2/IRANSansWeb_UltraLight.woff2) format("woff2"), url(%THEME_DIR_URI%/font/woff/IRANSansWeb_UltraLight.woff) format("woff"), url(%THEME_DIR_URI%/font/ttf/IRANSansWeb_UltraLight.ttf) format("truetype")
  }

  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-weight: 400;
  	font-display: swap;
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb.eot);
  	src: url(%THEME_DIR_URI%/font/eot/IRANSansWeb.eot?#iefix) format("embedded-opentype"), url(%THEME_DIR_URI%/font/woff2/IRANSansWeb.woff2) format("woff2"), url(%THEME_DIR_URI%/font/woff/IRANSansWeb.woff) format("woff"), url(%THEME_DIR_URI%/font/ttf/IRANSansWeb.ttf) format("truetype")
  }
  body,a,h1,h2,h3,h5,h6,h4,span,td,tr,input,p,textarea,.rtl h1, .rtl h2, .rtl h3, .rtl h4, .rtl h5, .rtl h6,.editor-post-title__block .editor-post-title__input{
    font-family: IRANSans, sans-serif;
  }

  </style>';
	if ( is_rtl() ) {
		echo str_replace( '%THEME_DIR_URI%', $temp_dir_uri, $str );
	}
}

add_action( 'admin_head', 'priotech_custom_css' );

// Load translation files
function priotech_load_textdomain() {
	load_theme_textdomain( 'priotech', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'priotech_load_textdomain' );

// Move translation files to WordPress standard directory
function priotech_move_translation_files() {
	$languages_dir = WP_LANG_DIR . '/themes/';
	$theme_languages_dir = get_template_directory() . '/languages/';

	if ( ! file_exists( $languages_dir ) ) {
		mkdir( $languages_dir, 0755, true );
	}

	$files = glob( $theme_languages_dir . '*.mo' );
	foreach ( $files as $file ) {
		$filename = basename( $file );
		copy( $file, $languages_dir . $filename );
	}
}
add_action( 'after_switch_theme', 'priotech_move_translation_files' );
