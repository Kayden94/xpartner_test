<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );
// -------------------------

add_action( 'template_redirect', 'author_archive_redirect' );
add_filter( 'author_link', 'remove_author_pages_link' );

// редиректим на главную со страниц авторов
function author_archive_redirect() {
	if( is_author() ) {
		wp_redirect( home_url(), 301 );
		exit;
	}
}

// удаляем ссылку
function remove_author_pages_link( $content ) {
	return home_url();
}

// модернизация отрывка
add_filter( 'excerpt_length', function(){
	return 30;
} );
add_filter('excerpt_more', function($more) {
	return '...';
});
// 
## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter( 'get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});
// ==========================
/**
 * Enqueue scripts and styles.
 */
function understrap_child_scripts() {
	wp_enqueue_style( 'understrap_child-style', get_stylesheet_uri(), array()  );
 
}
add_action( 'wp_enqueue_scripts', 'understrap_child_scripts' );

// =====================
add_action('add_meta_boxes', function () {
	add_meta_box( 'rielt_box', 'Город', 'nedvijimost_city_metabox', 'nedvijimost', 'side', 'low'  );
}, 1);

 
function nedvijimost_city_metabox( $post ){
	$citys = get_posts(array( 'post_type'=>'city', 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));

	if( $citys ){
		// чтобы портянка пряталась под скролл...
		echo '
		<div style="max-height:200px; overflow-y:auto;">
			<ul>
		';

		foreach( $citys as $city ){
			echo '
			<li><label>
				<input type="radio" name="post_parent" value="'. $city->ID .'" '. checked($city->ID, $post->post_parent, 0) .'> '. esc_html($city->post_title) .'
			</label></li>
			';
		}

		echo '
			</ul>
		</div>';
	}
	else
		echo 'Городов нет...';
}

// проверка  
add_action('add_meta_boxes', function(){
	add_meta_box( 'nedvijimosts', 'Объекты', 'city_nedvijimosts_metabox', 'city', 'side', 'low'  );
}, 1);

function city_nedvijimosts_metabox( $post ){
	$nedvijimosts = get_posts(array( 'post_type'=>'nedvijimost', 'post_parent'=>$post->ID, 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));

	if( $nedvijimosts ){
		foreach( $nedvijimosts as $nedvijimost ){
			echo $nedvijimost->post_title .'<br>';
		}
	}
	else
		echo 'Объектов нет...';
}