<?php
//Method 1;
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
    // echo '<meta name="twitter:site" content="@banyerhan" />';    echo '<meta name="twitter:banyerhan" content="@banyerhan" />';

  }
}

//Method 2;
function add_opengraph_doctype( $output ) {
        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    }
add_filter('language_attributes', 'add_opengraph_doctype');
 
//Lets add Open Graph Meta Info
 
function insert_fb_og_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
        echo '<meta property="fb:app_id" content="your-fb-page-id" />';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="Myanmar Right News (People Trusted Page)"/>';
    if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        $default_image="../wp-content/uploads/fb-cover.jpg"; //replace this with a default image on your server or an image in your media library
        echo '<meta property="og:image" content="' . $default_image . '"/>';
    }
    else{
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    }
    echo "
";
}
add_action( 'wp_head', 'insert_fb_og_head', 5 );


?>
