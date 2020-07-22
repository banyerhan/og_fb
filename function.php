<?php
add_action('wp_head', 'fc_opengraph');
function fc_opengraph() {
  if( is_single() || is_page() ) {

    $post_id = get_queried_object_id();
    $url = get_permalink($post_id);    
    $title = get_the_title($post_id);    $site_name = get_bloginfo('name');
    $description = wp_trim_words( get_post_field('post_content', $post_id), 25 );
    $image = get_the_post_thumbnail_url($post_id);    if( !empty( get_post_meta($post_id, 'og_image', true) ) ) $image = get_post_meta($post_id, 'og_image', true);
    $locale = get_locale();
    echo '<meta property="og:locale" content="' . esc_attr($locale) . '" />';
    echo '<meta property="og:type" content="article" />';    
    echo '<meta property="og:title" content="' . esc_attr($title) . ' | ' . esc_attr($site_name) . '" />';    
    echo '<meta property="og:description" content="' . esc_attr($description) . '" />';    
    echo '<meta property="og:url" content="' . esc_url($url) . '" />';    
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '" />';
    if($image) echo '<meta property="og:image" content="' . esc_url($image) . '" />';

    // Twitter Card   
    // echo '<meta name="twitter:card" content="summary_large_image" />';    
    //echo '<meta name="twitter:site" content="@banyerhan" />';    echo '<meta name="twitter:banyerhan" content="@banyerhan" />';

	}
}

?>
