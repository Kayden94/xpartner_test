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
						<header class="entry-header header-single__nedvij ">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

						</header><!-- .entry-header -->


						<?php
						if (get_field('stoimost')): 
							$price_nedvij = get_field('stoimost');
							$price_nedvij_f = number_format($price_nedvij, 2, '.', ' ');
							?>
							<div class="single-jil__price-wr">
								<span class="single-jil__price-test">Стоимость:</span>

								<span class="single-jil__price"><?php echo $price_nedvij_f; ?>&nbsp;₽</span>
							</div>
						<?php endif; ?>

						<div class="single-jil__info">
							<?php  
							if (get_field('ploshhad')): ?>
								<div class="single-jil__info-i">
									<div class="single-jil__info-i-l">Площадь:   </div>
									<div class="single-jil__info-i-l"><?php the_field('ploshhad'); ?>&nbsp;кв. м.</div>
								</div>
							<?php endif;

							if (get_field('zhilaya_ploshhad')): ?>
								<div class="single-jil__info-i">
									<div class="single-jil__info-i-l">Жилая площадь:   </div>
									<div class="single-jil__info-i-l"><?php the_field('zhilaya_ploshhad'); ?>&nbsp;кв. м.</div>
								</div>
							<?php endif;

							if (get_field('adres')): ?>
								<div class="single-jil__info-i">
									<div class="single-jil__info-i-l">Адрес:   </div>
									<div class="single-jil__info-i-l"><?php the_field('adres'); ?></div>
								</div>
							<?php endif;

							if (get_field('etazh')): ?>

								<div class="single-jil__info-i">
									<div class="single-jil__info-i-l">Этаж:   </div>
									<div class="single-jil__info-i-l"><?php the_field('etazh'); ?></div>
								</div>
							<?php endif; ?>
						</div>


						<div class="entry-content">

							<?php
							the_content();

							?>

						</div><!-- .entry-content -->

						<footer class="entry-footer">

							<?php understrap_entry_footer(); ?>

						</footer><!-- .entry-footer -->

					</article><!-- #post-<?php the_ID(); ?> -->


				<?php } ?>



			</main>

			<?php
			// Do the right sidebar check and close div#primary.
			get_template_part( 'global-templates/right-sidebar-check' );
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
