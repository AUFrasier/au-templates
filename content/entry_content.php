<?php
/**
 * Template part for displaying a post's content
 *
 * @package qualityroof_theme
 */

namespace WP_Rig\WP_Rig;

?>

<div class="entry-content">
	<?php
	the_content(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'qualityroof-theme' ),
				[
					'span' => [
						'class' => [],
					],
				]
			),
			get_the_title()
		)
	);

	wp_link_pages(
		[
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'qualityroof-theme' ),
			'after'  => '</div>',
		]
	);
	?>
</div><!-- .entry-content -->