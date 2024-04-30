<?php
/**
 * The single post loop Default template
 **/
// if( is_user_logged_in() && ( '30225' == get_current_user_id() ) ) {
//     return;
// }

$sidebar = true;
// if( is_user_logged_in() && ( '30225' == get_current_user_id() ) ) {
// if( is_singular( 'post' ) && get_the_category() ) {
//     $catIDs = [];
//     foreach( get_the_category() as $term ) {
//         if( cat_is_ancestor_of( '137574', $term->cat_ID ) || cat_is_ancestor_of( '150870', $term->cat_ID ) ) {
//             array_push( $catIDs, $term->cat_ID );
//         }
//     }

//     if( empty( $catIDs ) ) {
//         $sidebar = false;
//     }

//     var_dump($catIDs, $sidebar);

// }
// }

if (have_posts()) {
    the_post();

                        
    $td_mod_single = new td_module_single($post);
    
    ?>
    <style>.tdi_40{margin-top:10px!important;margin-bottom:30px!important}@media (max-width:767px){.tdi_40{margin-top:10px!important;margin-bottom:30px!important}}</style>
    <style>.tdb-breadcrumbs{margin-bottom:11px;font-family:'Open Sans','Open Sans Regular',sans-serif;font-size:12px;color:#747474;line-height:18px}.tdb-breadcrumbs a{color:#747474}.tdb-breadcrumbs a:hover{color:#000}.tdb-breadcrumbs .tdb-bread-sep{line-height:1;vertical-align:middle}.tdb-breadcrumbs .tdb-bread-sep-svg svg{height:auto}.tdb-breadcrumbs .tdb-bread-sep-svg svg,.tdb-breadcrumbs .tdb-bread-sep-svg svg *{fill:#c3c3c3}.single-tdb_templates.author-template .tdb_breadcrumbs{margin-bottom:2px}.tdb_category_breadcrumbs{margin:21px 0 9px}.search-results .tdb_breadcrumbs{margin-bottom:2px}.tdi_40 .tdb-bread-sep{font-size:10px;margin:0 12px;color:#1e99d5}.tdi_40,.tdi_40 a{color:#000000}.tdi_40 .tdb-bread-sep-svg svg,.tdi_40 .tdb-bread-sep-svg svg *{fill:#000000;fill:#1e99d5}.tdi_40 a:hover{color:#1e99d5}.td-theme-wrap .tdi_40{text-align:left}.tdi_40{font-size:10px!important;line-height:1.5!important;font-weight:700!important;text-transform:uppercase!important}h1,h2,h3,h4{font-family:Kanit!important;}@media (max-width:767px){.tdi_40 .tdb-bread-sep{font-size:10px}.tdi_40 .tdb-bread-sep{margin:0 7px}.tdi_40{font-weight:600!important}}</style>
    <article id="post-<?php echo esc_attr( $td_mod_single->post->ID ) ?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $td_mod_single->get_item_scope();?>>
        <!-- 	data before content	start	 -->
				<!-- 	codes cuted from here		 -->
		<!-- 	data before content	end	 -->

        <?php echo $td_mod_single->get_social_sharing_top(); ?>

        <div class="td-post-content <?php echo ! empty( $sidebar ) ? esc_attr( 'td-pb-span8' ) : ''; ?> tagdiv-type">
		<?php do_shortcode('[bbp_show_popular_tags]'); ?>
    <!-- 	data before content -	start	 -->
			<div class="td-post-header">

            <?php 
                // $td_mod_single->show_category();
                global $wp;
                $breadcrumbs_array;
                $url = $wp->request;
                if(!empty($url )){
                    $urlArray = explode('/',$url);
                    if(!empty($urlArray)){
                        $bindURL = get_site_url().'/';
                        $tempArray = array();
                        $count = 1;
                        foreach($urlArray as $url_){
                            if(count($urlArray) == $count){
                                continue;
                            }
                            if(!empty($url_)){
                                $bindURL .= $url_.'/';
                                $tempArray[] = array(
                                    'title_attribute' => ucwords($url_),
                                    'url' => esc_url($bindURL),
                                    'display_name' => ucwords(str_replace('-',' ',$url_))
                                );
                                $count++;
                            }
                        }
                        $breadcrumbs_array = $tempArray;

                    }
                }
                if(!empty($breadcrumbs_array)){

                    $buffy = '';

                    $buffy .= '<div class="td_block_wrap tdb_breadcrumbs tdi_40 td-pb-border-top td_block_template_1 tdb-breadcrumbs"  data-td-block-uid="tdi_40">';

                        $buffy .= '<div class="tdb-block-inner td-fix-index">';

                            foreach ( $breadcrumbs_array as $key => $breadcrumb ) {

                                if ( empty( $breadcrumb['url'] ) ) {
                                    
                                    //no link - breadcrumb
                                    $buffy .=  '<span class="tdb-bred-no-url-last">' . esc_html( str_replace('Tags','Near Me',$breadcrumb['display_name'])) . '</span>';

                                } else {
                                    if ($key != 0) { //add separator only after first
                                        
                                        $buffy .= '<i class="tdb-bread-sep td-icon-right-arrow"></i>';
                                    }

                                    //normal links
                                    $buffy .= '<span><a title="' . esc_attr( $breadcrumb['title_attribute'] ) . '" class="tdb-entry-crumb" href="' . esc_url( $breadcrumb['url'] ) . '">' . esc_html( $breadcrumb['display_name'] ) . '</a></span>';
                                }
                            }

                        $buffy .= '</div>';

                    $buffy .= '</div>';
                    echo $buffy;
                }
            ?>
            <header class="td-post-title bppm-desktop-view-content">
                <?php 
    //                 if( geodir_is_gd_post_type(get_post_type( get_the_ID() )) ) {
    //                     global $gd_post;
    //                     preg_match_all('/\b[A-Z]{2}\b/', $gd_post->street2, $matches);
    //                     $state_code = !empty($matches[0]) ? implode(', ', $matches[0]) : ''; 
    //                     echo "<h1 style='font-size: 30px !important; font-family: Kanit; font-weight: 600; line-height: 1.2;'>" . $gd_post->name . ' in ' . $gd_post->city . ', ' . $state_code . "</h1>";
    //                 }else{
    //                     $td_mod_single->show_title();
    //                 }
                ?>

                <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
                    <p class="td-post-sub-title"><?php printf( '%1$s', $td_mod_single->td_post_theme_settings['td_subtitle'] ) ?></p>
                <?php } ?>


                <div class="td-module-meta-info">
                    <?php $td_mod_single->show_author() ?>
                    <?php $td_mod_single->show_date(false, false) ?>
                    <?php $td_mod_single->show_comments() ?>
                    <?php $td_mod_single->show_views() ?>
                </div>

            </header>

        </div>
    <!-- 	data before content - end		 -->
            <?php
            // override the default featured image by the templates (single.php and home.php/index.php - blog loop)
            if (!empty(td_global::$load_featured_img_from_template)) {
                $td_mod_single->show_image(td_global::$load_featured_img_from_template);
            } else {
                $td_mod_single->show_image('td_696x0');
            }
            ?>

            <?php $td_mod_single->show_content() ?>
        </div>

        <?php 
        if( ! empty ( $sidebar ) ){
        ?>

        <div class="td-pb-span4 td-main-sidebar" role="complementary">
            <div class="td-ss-main-sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>

        <?php } ?>

        <footer class="<?php echo ! empty( $sidebar ) ? esc_attr( 'td-pb-span8' ) : ''; ?> single-padded-element">
            <?php $td_mod_single->show_post_pagination() ?>
            <?php $td_mod_single->show_review() ?>

            <div class="td-post-source-tags">
                <?php $td_mod_single->show_source_and_via() ?>
                <?php $td_mod_single->show_the_tags() ?>
            </div>

            <?php echo $td_mod_single->get_social_sharing_bottom(); ?>
            <?php $td_mod_single->show_next_prev_posts() ?>
            <?php $td_mod_single->show_author_box() ?>
            <?php $td_mod_single->show_item_scope_meta() ?>
        </footer>

    </article> <!-- /.post -->

    <style>
        /* custom css - generated by TagDiv Composer */
        /* compiled from reviews.less - from standard pack */
		.td-post-content {
				margin-top: 10px !important;
			}
        .td-review {
            width: 100%;
            margin-bottom: 34px;
            font-size: 13px;
        }
        .td-review td {
            padding: 7px 14px;
        }
        .td-review .td-review-summary {
            padding: 21px 14px;
        }
        @media (max-width: 767px) {
            .td-review .td-review-summary {
                padding: 0;
            }
			.td-post-content {
				margin-top: 5px !important;
			}
        }
        .td-review i {
            margin-top: 5px;
        }
        .td-review .td-review-row-stars:hover {
            background-color: #fcfcfc;
        }
        .td-review .td-review-percent-sign {
            font-size: 15px;
            line-height: 1;
        }
        .td-review-header .block-title {
            background-color: #222;
            color: #fff;
            display: inline-block;
            line-height: 16px;
            padding: 8px 12px 6px;
            margin-bottom: 0;
            border-bottom: 0;
        }
        .td-review-header td {
            padding: 26px 0 26px 0;
            border: 0;
        }
        @-moz-document url-prefix() {
            .td-review-header .block-title {
                padding: 7px 12px;
            }
        }
        .td-icon-star,
        .td-icon-star-empty,
        .td-icon-star-half {
            font-size: 15px;
            width: 20px;
        }
        .td-review-stars {
            text-align: center;
        }
        @media (max-width: 767px) {
            .td-review-stars {
                width: 134px;
            }
        }
        .td-review-final-score {
            line-height: 80px;
            font-size: 48px;
            margin-bottom: 5px;
        }
        .td-rating-bar-wrap {
            margin: 0 0 7px 0;
            background-color: #f5f5f5;
        }
        .td-rating-bar-wrap div {
            height: 20px;
            background-color: var(--td_theme_color, #4db2ec);
            max-width: 100%;
        }
        .td-review-row-bars .td-review-desc {
            display: inline-block;
            padding-bottom: 2px;
        }
        .td-review-percent {
            float: right;
            padding-bottom: 2px;
        }
        @media (max-width: 767px) {
            .td-review-footer {
                border-left: 1px solid #ededed;
                position: relative;
                display: block;
            }
            .td-review-footer:after {
                content: '';
                width: 1px;
                background-color: #ededed;
                position: absolute;
                right: -1px;
                top: 0;
                height: 100%;
            }
        }
        .td-review-summary {
            padding: 21px 0 0 0;
            vertical-align: top;
        }
        @media (max-width: 767px) {
            .td-review-summary {
                display: block;
                width: 100%;
                clear: both;
                border: 0;
            }
        }
        .td-review-summary .block-title {
            background-color: #222;
            color: #fff;
            display: inline-block;
            line-height: 16px;
            padding: 8px 12px 6px;
            margin-bottom: 13px;
            position: relative;
            border-bottom: 0;
        }
        @media (max-width: 767px) {
            .td-review-summary .block-title {
                margin: 14px 0 0 14px;
            }
        }
        @-moz-document url-prefix() {
            .td-review-summary .block-title {
                padding: 7px 12px;
            }
        }
        .td-review-summary-content {
            font-size: 12px;
            margin-right: 21px;
        }
        @media (max-width: 767px) {
            .td-review-summary-content {
                margin: 14px;
            }
        }
        .td-review-score {
            font-family: 'Open Sans', 'Open Sans Regular', sans-serif;
            font-weight: bold;
            text-align: center;
            padding: 0;
            vertical-align: bottom;
            width: 150px;
        }
        @media (max-width: 767px) {
            .td-review-score {
                display: block;
                width: 100%;
                padding: 0;
                border-left: 0;
                border-right: 0;
            }
        }
        .td-review-overall {
            padding: 0 0 28px 0;
            line-height: 14px;
        }
        .td-review-overall span {
            font-size: 11px;
        }
        .td-review-final-star {
            margin-bottom: 5px;
        }
        @media (max-width: 767px) {
            .td-review-row-stars {
                display: block;
                width: 100%;
                clear: both;
                float: left;
                border: 1px solid #ededed;
                border-bottom: 0;
                border-right: 0;
            }
            .td-review-row-stars td {
                float: left;
                border: 0;
            }
            .td-review-row-stars .td-review-desc {
                width: 70%;
                padding: 9px 14px;
            }
            .td-review-row-stars .td-review-stars {
                width: 30%;
                text-align: right;
            }
            .td-review-row-stars:nth-last-of-type(2) {
                border-bottom: 1px solid #ededed;
            }
        }
        @media (max-width: 500px) {
            .td-review-row-stars .td-review-desc {
                width: 55%;
            }
            .td-review-row-stars .td-review-stars {
                width: 45%;
            }
        }
    </style>

    <?php
} else {
    //no posts
    echo td_page_generator::no_posts();
}
