<?php
/**
 * Render your site front page, whether the front page displays the blog posts index or a static page.
 *
 */

get_header();
?>
	<main id="primary" class="site-main">
		<?php
		get_template_part( 'template-parts/sections/wrap', '1' );
		get_template_part( 'template-parts/sections/wrap', '2' );
		get_template_part( 'template-parts/sections/wrap', '3' );
		get_template_part( 'template-parts/sections/wrap', '4' );
		get_template_part( 'template-parts/sections/wrap', '5' );
		?>
	</main><!-- #primary -->
<?php
get_footer();
