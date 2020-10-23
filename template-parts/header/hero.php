<?php
/**
 * Template part for displaying the hero - header
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */

?>

<div class="hero-container">
    <div class="hero-content">
        <?php get_template_part( 'template-parts/header/hero', 'text' ); ?>
        <?php get_template_part( 'template-parts/header/hero', 'action' ); ?>
        <?php get_template_part( 'template-parts/header/hero', 'tag' ); ?>
    </div><!-- .hero-content -->
</div><!-- .hero-container -->
