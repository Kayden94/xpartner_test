<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 *
 * @package UnderstrapChild
 */

?>
<div class="col-12 col-sm-6  col-md-4 col-xl-3">
	<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>" <?php post_class('nedvij-i'); ?>>
		<div class="nedvij-i__l">
			<?php the_post_thumbnail( 'medium', '' ); ?>
		</div>
		<div class="nedvij-i__r">
			<div class="nedvij-i-title"><?php the_title(); ?></div>
			<?php
			if (get_field('stoimost')): 
				$price_nedvij = get_field('stoimost');
				$price_nedvij_f = number_format($price_nedvij, 2, '.', ' ');
				?>
				<div class="nedvij-i__price-wr">
					<span class="nedvij-i__price-test">Цена:</span>

					<span class="nedvij-i__price"><?php echo $price_nedvij_f; ?>&nbsp;₽</span>
				</div>
			<?php endif; ?>
			<div class="nedvij-i__info">
				<?php  
				if (get_field('ploshhad')): ?>
					<div class="nedvij-i__info-i">
						<div class="nedvij-i__info-i-l">Площадь:   </div>
						<div class="nedvij-i__info-i-l"><?php the_field('ploshhad'); ?>&nbsp;кв. м.</div>
					</div>
				<?php endif;

				if (get_field('zhilaya_ploshhad')): ?>
					<div class="nedvij-i__info-i">
						<div class="nedvij-i__info-i-l">Жилая площадь:   </div>
						<div class="nedvij-i__info-i-l"><?php the_field('zhilaya_ploshhad'); ?>&nbsp;кв. м.</div>
					</div>
				<?php endif;

				if (get_field('adres')): ?>
					<div class="nedvij-i__info-i">
						<div class="nedvij-i__info-i-l">Адрес:   </div>
						<div class="nedvij-i__info-i-l"><?php the_field('adres'); ?></div>
					</div>
				<?php endif;

				if (get_field('etazh')): ?>

					<div class="nedvij-i__info-i">
						<div class="nedvij-i__info-i-l">Этаж:   </div>
						<div class="nedvij-i__info-i-l"><?php the_field('etazh'); ?></div>
					</div>
				<?php endif; ?>
			</div>
			<!-- <div class="nedvij-i-text"><?php the_excerpt(); ?></div> -->

			<div class="nedvij-i__a btn">Узнать подробнее</div>
		</div>


	</a>
</div>
