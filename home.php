<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UnderstrapChild
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
	}
	?> 
	<?php
	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
			?>
		<!-- <header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header> -->

		<header class="page-header">
			<h1 class="page-title">Блог</h1>		
		</header>
		<?php
	endif;
	?>

	<div class="news-terms">

		<a href="/blog/" class="news-term-a news-term-i ">Все статьи</a>
		<?php 

		$terms = get_terms('category');

		foreach ($terms as $term) {
			echo '<a href="' . get_term_link($term) . '" class="news-term-i">' . $term->name . '</a>';
		}

		?>
	</div> 

	<div class="mnews-in grid-container col-3">
		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/news', get_post_type() );

				// get_template_part( 'include/otzyvitem', get_post_type() );


		endwhile;
		?>
	</div>
	<?php
	the_posts_pagination( array(
		'mid_size' => 2,
	) ); 

else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>

</main><!-- #main -->
<script>
	// jQuery(function () {
	// 	jQuery('.news-terms   a').each(function () {
	// 		var location = window.location.href;
	// 		var link = this.href;                
	// 		if(location == link) {
	// 			// this.previousElementSibling.classList.add("active");
	// 			jQuery(this).addClass('current');
	// 			// jQuery(this).parent().addClass('active');
	// 		}
	// 	});
 
	// });
	document.querySelectorAll('.news-terms a').forEach(function (e) {
			var location = window.location.href;
			var link = e.href;                
			if(location == link) {
				e.classList.add('current');
			}
			console.log(location );
			console.log( link);
		});
</script>

<?php

get_footer();
