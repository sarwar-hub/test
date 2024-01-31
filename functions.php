<?php
add_shortcode('bbp_archive_item_listicle', function(){
    $args = array(
    'post_type' => 'gd_listicles'
	);

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();

	

    ob_start();
	?>

	 <!-- archive item for grid layout -->
        <div class="bppm-archive-item-grid">
            <div class="bppm-grid-item-thumb">
                <a href="#">
                    <?php the_post_thumbnail('thumbnail'); ?>
                </a>
                <span class="bppm-grid-item-category">
                    <i class="fas fa-folder-open"></i>
                    <a href="#"><?php the_category(); ?></a>
                </span>
            </div>
            <div class="bppm-grid-item-text">
                <h3 class="bppm-grid-item-title">
                    <a href="#"><?php the_title(); ?></a>
                </h3>
                <div class="bppm-grid-item-address">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?php echo get_post_meta(get_the_ID(), 'address', true); ?></span>
                </div>
            </div>
        </div>

	<?php 
    return ob_get_clean();
	}
}
    
});
