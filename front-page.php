<?php
/**
 * Template Name: Главная
 *
 * @package UnderstrapChild
 */

get_header();
?>

<main id="primary" class="site-main">

	<section class="mone  ">
		<div class="container relpos">
			<div class="mone-in ">
				<div class="mone-l0">Выгодно</div>
				<div class="mone-l1">Купить недвижимости в России</div>
			</div>
		</div>
	</section>


	<section  class="mtwo  sect">
		<div class="container">
			<div class="title__v1">Города <a href="/city/" class="title__a">Смотреть все</a></div>
			<?php 

			$city = new WP_Query(array('post_type' => 'city', 
				'orderby' => 'date', 
				'order' => 'DESC',
				// 'post__in' => [387, 382, 375, 372, 368, 359],
						// 'order' => 'asc',
				'posts_per_page' => 6)); 

				?>	
				<div class="row">
					<?php
					if ( $city->have_posts() ) : while ($city->have_posts() ) : $city->the_post();  

						get_template_part('include/city');

					endwhile; 

					wp_reset_postdata();
				endif; 
				?>
			</div>
		</div>
	</section>

	<section  class="mthree  sect">
		<div class="container">
			<div class="title__v1">Недвижимость <a href="/nedvijimost/" class="title__a">Смотреть все</a></div>
			<?php 

			$city = new WP_Query(array('post_type' => 'nedvijimost', 
				'orderby' => 'date', 
				'order' => 'DESC',
				// 'post__in' => [387, 382, 375, 372, 368, 359],
						// 'order' => 'asc',
				'posts_per_page' => 12)); 

				?>	
				<div class="row">
					<?php
					if ( $city->have_posts() ) : while ($city->have_posts() ) : $city->the_post();  

						get_template_part('include/nedvij');

					endwhile; 

					wp_reset_postdata();
				endif; 
				?>
			</div>
		</div>
	</section>

	<section  class="mfour  sect">
		<div class="container">
			<div class="title__v1">Добавь свою Недвижимость</div>
			<div class="row">
				<?php 
				echo do_shortcode('[forminator_form id="67"]');
				?>
			</div>
		</div>
	</div>
</section>

<?php 
	// get_template_part( 'include/worksbk' );
?>


</main><!-- #main -->

<?php

get_footer();
