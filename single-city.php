<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<?php
			// Do the left sidebar check and open div#primary.
			get_template_part( 'global-templates/left-sidebar-check' );
			?>

			<main class="site-main" id="main">

				<?php
				while ( have_posts() ) {
					the_post();

					?>
					<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
						<header class="entry-header header-single__city ">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

						</header><!-- .entry-header -->

						<!-- get_template_part( 'loop-templates/content', 'single' ); -->

						<?php
					// understrap_post_nav();


					}

					$nedvijimosts = get_posts(array( 'post_type'=>'nedvijimost', 'post_parent'=>$post->ID, 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));
					
					if( $nedvijimosts ){
						global $post;
						?>

						
						<div class="row">
							<?php
							foreach( $nedvijimosts as $post ){
								setup_postdata($post);

								get_template_part( 'include/nedvij' );
							}
							?>

							
						</div>
						<?php
	// вернем $post Обратно
						wp_reset_postdata();
					}
					?>
					<div class="entry-content">

						<?php
						the_content();

						?>

					</div><!-- .entry-content -->

					<footer class="entry-footer">

						<?php understrap_entry_footer(); ?>

					</footer><!-- .entry-footer -->

				</article><!-- #post-<?php the_ID(); ?> -->
			</main>

			<?php
			// Do the right sidebar check and close div#primary.
			// get_template_part( 'global-templates/right-sidebar-check' );
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
