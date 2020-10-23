<?php
/**
 * Template part for displaying a testimonial slider
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */


?>

<div class="swiper-container">
	<div class="swiper-wrapper">
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
				<div class="swiper-slide"> 
					<div class="testimonial-info">
						<span class="testimonial-author"><?php echo get_post_meta(get_the_ID(), 'author_meta_box_nonce', true); ?></span>
						<p class="testimonial-content"><?php echo get_post_meta(get_the_ID(), 'content_meta_box_nonce', true); ?></p>
					</div>
				</div>   
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>

			<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	</div>
	<div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div><!-- .swiper-container -->
