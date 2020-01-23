<?php
/**
 * Template part for displaying a testimonial slider
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<div class="testimonial-container">
	<div class="testimonial-wrapper">
		<div class="testimonial-slider">
		<?php 
			// args
			$args = array(
				'numberposts'	=> -1,
				'post_type'		=> 'testimonial'
			);
			// query
			$the_query = new \WP_Query( $args );
			?>
			<?php if( $the_query->have_posts() ): ?>
			   
				<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="testimonial-card"> 
					<div class="testimonial-info">
						<span class="testimonial-author"><?php the_field('name'); ?></span>
						<p class="testimonial-content"><?php the_field('review'); ?></p>
					</div>
				</div>   
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
		</div>
	</div>
</div><!-- .testimonial-container -->
