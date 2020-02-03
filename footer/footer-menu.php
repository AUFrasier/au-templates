<?php
/**
 * Template part for displaying the footer menu
 *
 *  @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<div class="footer-menu-wrapper">
    <menu class="footer-menu">
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
</div><!-- .footer-menu-wrapper -->
