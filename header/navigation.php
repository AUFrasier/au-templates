<?php
/**
 * Template part for displaying the header navigation menu layout
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( ! wp_rig()->is_primary_nav_menu_active() ) {
	return;
}

?>

<nav class="site-navigation">
   <?php 
      get_template_part( 'header/mobile-navigation');
      get_template_part( 'header/main-navigation');
   ?>
  
</nav><!-- .site-navigation -->
