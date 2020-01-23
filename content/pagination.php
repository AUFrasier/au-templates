<?php
/**
 * Template part for displaying a pagination
 *
 * @package qualityroof_theme
 */

namespace WP_Rig\WP_Rig;

the_posts_pagination(
	[
		'mid_size'           => 2,
		'prev_text'          => _x( 'Previous', 'previous set of search results', 'qualityroof-theme' ),
		'next_text'          => _x( 'Next', 'next set of search results', 'qualityroof-theme' ),
		'screen_reader_text' => __( 'Page navigation', 'qualityroof-theme' ),
	]
);
