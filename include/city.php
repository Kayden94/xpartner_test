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
	<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>" <?php post_class('city-i'); ?>>
		<div class="city-i__l">
			<?php the_post_thumbnail( 'medium', '' ); ?>
		</div>
		<div class="city-i__r">
			<div class="city-i-title"><?php the_title(); ?></div>
			 
			<div class="city-i__a btn">Перейти</div>
		</div>
	</a>
</div>
