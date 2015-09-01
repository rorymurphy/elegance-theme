<?php
require_once 'plugins/plugin-loader.php';
load_plugin('builder-framework');
load_plugin('navbar-walker');

add_action('wp_enqueue_scripts', function(){
  wp_register_style('theme', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));

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
