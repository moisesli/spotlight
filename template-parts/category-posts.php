<?php
/**
 * Template part for displaying category posts section.
 *
 * @package Spotlight
 */

do_action( 'csco_category_posts_before' );

$ids = csco_get_category_posts_ids();

if ( $ids ) {
	$args = array(
		'ignore_sticky_posts' => true,
		'post__in'            => $ids,
		'posts_per_page'      => count( $ids ),
		'orderby'             => 'post__in',
	);

	$the_query = new WP_Query( $args );
}

// Determines whether there are more posts available in the loop.
if ( $ids && $the_query->have_posts() ) {
	$type = get_theme_mod( 'category_featured_posts_type', 'type-2' );
?>
<section class="section-category-posts">

	<?php do_action( 'csco_category_posts_start' ); ?>

		<div class="cs-container">

			<div class="cs-category-posts cs-featured-posts cs-featured-<?php echo esc_attr( $type ); ?>">
				<?php
				set_query_var( 'csco_featured', 'category_featured_posts' );
				set_query_var( 'csco_featured_query', $the_query );
				set_query_var( 'csco_featured_thumb_attr', array(
					'class' => 'pk-lazyload-disabled',
				) );

				if ( 'type-1' === $type || 'type-2' === $type ) {
				?>
					<div class="cs-featured-column cs-featured-column-1">
						<?php
							csco_get_featured_posts( array(
								'featured-full',
								'featured-list',
							) );
						?>
					</div>

					<div class="cs-featured-column cs-featured-column-2">
						<?php
							csco_get_featured_posts( array(
								'featured-grid',
								'featured-grid-simple',
								'featured-grid-simple',
							) );
						?>
					</div>

					<div class="cs-featured-column cs-featured-column-3">
						<?php
							csco_get_featured_posts( array(
								'featured-grid',
								'featured-grid-simple',
								'featured-grid-simple',
							) );
						?>
					</div>
				<?php
				} elseif ( 'type-3' === $type ) {
					?>
					<div class="cs-featured-column cs-featured-column-1">
						<?php
							csco_get_featured_posts( array(
								'featured-full',
							) );
						?>
					</div>

					<div class="cs-featured-column cs-featured-column-2">
						<?php
							csco_get_featured_posts( array(
								'featured-list',
								'featured-list',
							) );
						?>
						<div class="cs-featured-grid">
						<?php
							csco_get_featured_posts( array(
								'featured-grid-simple',
								'featured-grid-simple',
							) );
						?>
						</div>
					</div>
				<?php
				} else {
					csco_get_featured_posts( array(
						'featured-grid',
						'featured-grid',
						'featured-grid',
						'featured-grid',
					) );
				}
				?>
			</div>

			<?php wp_reset_postdata(); ?>

		</div>

	<?php do_action( 'csco_category_posts_end' ); ?>

</section>

<?php
}

do_action( 'csco_category_posts_after' );
