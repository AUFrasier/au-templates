<?php
/**
 * Template part for displaying the header navigation menu
 *
 * @package qualityroof_theme
 */

namespace WP_Rig\WP_Rig;

if ( ! qualityroof_theme()->is_primary_nav_menu_active() ) {
	return;
}

?>

<nav class="site-navigation">
  
  <input id="nav" type="checkbox" />
  
  <label id="nav-bars" for="nav">
    <b><i></i><i></i><i></i></b>
  </label>
  
  <menu class="site-menu">
   <?php 
      // Check if menu exists
      if ( $menu_items = wp_get_nav_menu_items( 'Menu 1' ) ) {
         
         // Loop over menu items
         foreach ( $menu_items as $menu_item ) {

            // Compare menu object with current page menu object
            $current = ( $menu_item->object_id == get_queried_object_id() ) ? 'current' : '';
            
            // Print menu item
            echo '<li class="' . $current . '"><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
         }
      } 
   ?>
  </menu>
  
</nav>
