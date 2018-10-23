<?php
require_once 'plugins/plugin-loader.php';
load_plugin('builder-framework');
load_plugin('navbar-walker');
load_plugin('bootstrap-search-widget');

add_theme_support('post-thumbnails');
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('menus');

register_nav_menus(array(
    'header-menu' => 'Header Menu',
    'footer-menu' => 'Footer Menu'
));

add_action( 'widgets_init', function(){
    register_sidebar(array(
        'name'          => "Blog Page Right",
        'id'            => 'blog-rail',
        'description'   => '',
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>'
    ));
    
    register_sidebar(array(
        'name'          => "Footer",
        'id'            => 'footer',
        'description'   => '',
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>'
    ));
} );


acf_form_head();
add_action('wp_enqueue_scripts', function(){

  wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), sha1(filemtime(get_template_directory() . '/js/bootstrap.min.js')) );
  if(file_exists(get_stylesheet_directory() . '/css/theme.css')){
    wp_register_style( 'theme', get_stylesheet_directory_uri() . '/css/theme.css', array(), sha1(filemtime(get_stylesheet_directory() . '/css/theme.css')) );
  }
  wp_enqueue_style('theme');
});





function get_background_image_size($size){
    global $wpdb;
    $bkgd = get_background_image();
    $upload_base = wp_upload_dir();
    $upload_base = trailingslashit( $upload_base['baseurl'] );
    $bkgd = str_replace($upload_base, '', $bkgd);
    $id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $bkgd));
    if($id >= 0){
        $bkgd = wp_get_attachment_image_src($id, $size);
        $bkgd = $bkgd[0];
    }
    return $bkgd;
}

function get_favicon_url(){
    if(file_exists(get_stylesheet_directory() . '/favicon.ico')){
        return get_stylesheet_directory_uri() . '/favicon.ico';
    }elseif (file_exists(get_template_directory() . '/favicon.ico')) {
        return get_template_directory_uri() . '/favicon.ico';
    }else{
        return '/favicon.ico';
    }
}
