<?php

add_shortcode('bbp_related_links', function(){
        return;

        global $post, $geodir_post_type;
        $gd_city = get_query_var( 'city' );
        $gd_region = get_query_var( 'region' );
        $gd_country = get_query_var( 'country' );

        if( ! empty( $gd_region ) ) {
            $clean_string = str_replace("-", " ", $gd_region);
            // Make the first letter uppercase
            $clean_string = ucfirst($clean_string);
            $region = $clean_string;
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
            // $ip_details = json_decode(bppm_get_link_contents("http://ipinfo.io/{$ip}/json"));
            $ip_details = json_decode(bppm_get_link_contents("https://freeipapi.com/api/json/{$ip}"));
    
            $city       = ! empty( $ip_details ) ? $ip_details->cityName : '';
            $region     = ! empty( $ip_details ) ? $ip_details->regionName : '';
        }

        $is_nearmepage = false;
        if ( ! empty( $_GET['type'] ) && ( 4493405 === get_queried_object_id() ) ) {
            $is_nearmepage = true;
        }

        $ttype = ! empty( $_GET['type'] ) ? $_GET['type'] : $geodir_post_type;
        $ttype = ! empty( $ttype ) ? $ttype : 'gd_restaurants';
        $type_link = get_post_type_archive_link( $ttype );
		$cities = geodir_location_get_locations_array([ 'what' => 'city', 'region_val' => $region, 'location_link_part' => false, 'no_of_records' => 20 ]);
        
        usort($cities, function($a, $b) {
            return strcmp($a->city, $b->city);
        });

        ob_start();
        ?>


        <div class="bm-directory-related-links">
            
            <!-- Nearby Cities -->
            <?php if(! empty( $cities ) ) : ?>
            <div class="bm-link-group">
                <h3 class="bm-link-group-title">Nearby Cities</h3>
                <div class="bm-group-links">
                    <?php
                    foreach( $cities as $city ) {
        
                        if( $gd_city ) {
                            $link = str_replace( $gd_city, $city->city_slug, $type_link );
                            $link = str_replace( $gd_region, str_replace( ' ', '-', strtolower( $region ) ), $link );
        
                        }elseif( $gd_region ){
                            $link = $type_link . $city->city_slug;
                        }elseif( $gd_country ){
                            $link = $type_link . str_replace( ' ', '-', strtolower( $region ) ) . '/' . $city->city_slug;
                        }else{
                            $link = $type_link . 'united-states/'. $city->region_slug . '/' . $city->city_slug;
                        }
        
                        ?>
                        <a class="link-item" href="<?php echo bippermedia_url_lookup( $link ); ?>"><?php echo esc_attr( $city->city );?></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php endif; ?>
        
            <!-- Peaople Also Search -->
            <?php if( $ttype ) : ?>
            <div class="bm-link-group">
                <h3 class="bm-link-group-title">People Also Search</h3>
                <div class="bm-group-links">
                    <?php
                    $tags = get_terms( array(
                        'taxonomy'   => $ttype . '_tags',
                        'hide_empty' => true,
                        'number' => $is_nearmepage ? 30 : 20,
                        'offset' => 1,
                        'orderby' => 'count',
                        'order'   => 'desc',
        
                    ));
                    usort($tags, function($a, $b) {
                        return strcmp($a->name, $b->name);
                    });
        
                    if( ! is_wp_error( $tags ) ) {
                        foreach( $tags as $tag ) {
        
                            // $link = site_url() . '/near-me/?tag=' . $tag->name . '&type=' . $ttype
                            $link = get_term_link( $tag );
        
                            ?>
                            <a class="link-item" href="<?php echo bippermedia_url_lookup( $link ); ?>"><?php echo esc_attr( $tag->name );?></a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php endif; ?>
        
            <!-- US Cities -->
            <div class="bm-link-group">
                <h3 class="bm-link-group-title">US Cities</h3>
                <div class="bm-group-links">
                    <?php
                    $popular_cities = bppm_popular_city_list();
        
                    foreach( $popular_cities as $p_city ) {
                        
                        if( $gd_city ) {
                            $link = str_replace( $gd_city, $p_city['slug'], $type_link );
                            $link = str_replace( $gd_region, $p_city['region_slug'], $link );
        
                        }elseif( $gd_region ){
                            $link = str_replace( $gd_region, $p_city['region_slug'], $type_link );
                            $link = $link . $p_city['slug'];
                        }elseif( $gd_country ){
                            $link = $type_link . $p_city['region_slug'] . '/' . $p_city['slug'];
                        }else{
                            $link = $type_link . 'united-states/'. $p_city['region_slug'] . '/' . $p_city['slug'];
                        }
        
                        if( $is_nearmepage ) {
        
                            $url_parts = [ 'type' => $ttype, 'city' => $p_city['slug'] ];
                            
                            if( !empty( $_GET['tag'] ) ) {
                                $url_parts['tag'] .= sanitize_text_field( $_GET['tag'] );
                            }
        
                            $link = add_query_arg( $url_parts, site_url() . '/near-me/');
                        }
        
                        ?>
                        <a class="link-item" href="<?php echo esc_attr( $link ); ?>"><?php echo esc_attr( $p_city['name'] );?></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        
            <!-- US States -->
            <div class="bm-link-group">
                <h3 class="bm-link-group-title">US States</h3>
                <div class="bm-group-links">
                    <?php
                    $popular_regions = bppm_popular_states();
        
        
                    foreach( $popular_regions as $region ) {
        
                        $has_post = GeoDir_Location_Region::count_location_posts_by_type( $region['name'], 'United States', $geodir_post_type ); 
                        if( ! $has_post ) {
                            continue;
                        }
        
                        $name = $region['name'];
                        $slug = $region['slug'];
        
                        if( $gd_city ) {
                            $link = str_replace( $gd_city, '', $type_link );
                            $link = str_replace( $gd_region, $slug, $link );
        
                        }elseif( $gd_region ){
                            $link = str_replace( $gd_region, $slug, $type_link );
                        }elseif( $gd_country ){
                            $link = $type_link . $slug;
                        }else{
                            $link = $type_link . 'united-states/' . $slug;
                        }
        
                        $link = preg_replace('#([^:])/+#', '$1/', $link);
        
                        ?>
                        <a class="link-item" href="<?php echo bippermedia_url_lookup( $link ); ?>"><?php echo esc_attr( $name);?></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        
        <!-- main wrapper -->
        </div>   
                
        <?php
        return ob_get_clean();

    });



// banner gallery
add_shortcode('bbp_banner_gallery', function(){

    global $gd_post;

    if( ! is_user_logged_in() ) {
        return '';
    }
    if( '30225' != get_current_user_id() ) {
        return '';
    }
     
    $google_images  = geodir_get_post_meta( get_the_ID(), 'google_images', true );
    // $yelp_images  = geodir_get_post_meta( get_the_ID(), 'yelp_images', true );

    $google_images  = json_decode( $google_images );
    // $yelp_images  	= json_decode( $yelp_images );
     
    // $total_images = ! empty( $yelp_images ) ? array_merge( $yelp_images, $google_images ) : $google_images;
    $total_images = $google_images;
     
    $main_image = geodir_get_post_meta( get_the_ID(), 'main_image', true );
    ob_start();

    if( empty( $total_images ) ) {
        ?>
        <div id="single-main-image-background" style="background-image: url('<?php echo esc_url( $main_image ); ?>');"></div>
        <a id="single-main-image" class="main-image rrr" href="<?php echo bippermedia_url_lookup( get_the_permalink() ); ?>" rel="noopener"><img style="width: 100% !important;" title="<?php echo esc_attr( get_the_title() ); ?>" src="<?php echo esc_url( $main_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></a>   
         <?php
         return ob_get_clean();
    }

    $image_urls = [];

    foreach ($total_images as $subArray) {
        foreach ($subArray as $object) {
            $image_urls[] = $object->url;
        }
    }

    if( ! empty( $main_image ) && fopen( $main_image, 'r' ) ) {
        $image_urls[] = $main_image;
    }else{
        geodir_save_post_meta( get_the_ID(), 'main_image', $image_urls[0] );
    }
     
    $image_urls = array_reverse( $image_urls );
    ?>
       
        

    <div class="bm-banner-gallery">
    <div class="bm-banner-gallery-inner">
        <button id="prev-slide" class="slide-button">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="slide-list">
            
            <?php 
            $counter = 0;
            foreach($image_urls as $image_url) { 
                $counter++;    
                $alt_tag = $gd_post->name . ' in ' . $gd_post->city . ' picture ' . $counter;
            ?>
            <div class="slide-item">
                <img class="image-item" src="<?php echo $image_url; ?>" alt="<?php echo $alt_tag; ?>" />
            </div>

            <?php } ?>
            
        </div>
        <!-- total count -->
        <span class="gallery-total-count"><i class="far fa-images"></i> <?php echo count($urls); ?></span>
        <!-- modal start -->
        <div class="modal-alt">
            <div class="madal-alt-overlay"></div>
            <span class="close">&times;</span>
            <img class="fullscreen-image" title="Double click to zoom the image">
            <button id="" class="bppm-modal-alt-prev-slide">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="" class="bppm-modal-alt-next-slide">
                <i class="fas fa-chevron-right"></i>
            </button>
            <span class="zoom-hint">Double touch to zoom the image</span>
        </div>
        <!-- modal end -->
        <button id="next-slide" class="slide-button">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div> <!-- inner wrapper -->

    <!-- scroll bar -->
    <div class="slider-scrollbar">
        <div class="scrollbar-track">
            <div class="scrollbar-thumb"></div>
        </div>
    </div>
    
    </div> <!-- main wrapper -->

    <?php
    return ob_get_clean();
});
// banner gallery



