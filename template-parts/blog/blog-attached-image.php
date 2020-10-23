<?php
// Default arguments
$args = array(
	'posts_per_page' => -1, // How many items to display
	'p'   => get_the_ID(), // Exclude current post
	'no_found_rows'  => true, // We don't ned pagination so this speeds up the query
);

$related_query = new wp_query( $args );

if ($related_query->have_posts()):?>

<div class="blog-image">
    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
        <?php
            $img = '';
            if ( has_post_thumbnail() ) {
                $img = get_the_post_thumbnail( $post->ID, 'related-thumbnail', array( 'title' => $title, 'alt' => $title ) );
            }
            else {
                $attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image',  'numberposts' => 1 ) );

                if ( count( $attachments ) > 0 ) {
                    $img = array_shift( $attachments );
                    $img = wp_get_attachment_image( $img->ID, 'related-thumbnail', true );
                }
            }
        ?>
        <a href="<?php the_permalink() ?>" rel="bookmark">
            <?php echo $img; ?>
        </a>
    <?php endwhile; ?>
</div>

<?php endif; ?>