<?php

class Template_Page_Post_Type{
  const TYPE_NAME = 'template_page';
  const TEMPLATE_META_KEY = '_elegance_page_template';
  const BUILDER_TEMPLATE_PAGE = 'builder-page.php';

  function __construct(){
    add_action('init', array($this, 'register_post_type'));
    add_filter('template_include', array($this, 'template_page_filter'));
  }

  function register_post_type(){
    $labels = array(
      'name'               => _x( 'Template Pages', 'post type general name', 'elegance_theme' ),
      'singular_name'      => _x( 'Template Page', 'post type singular name', 'elegance_theme' ),
      'menu_name'          => _x( 'Template Pages', 'admin menu', 'elegance_theme' ),
      'name_admin_bar'     => _x( 'Template Page', 'add new on admin bar', 'elegance_theme' ),
      'add_new'            => _x( 'Add New', 'book', 'elegance_theme' ),
      'add_new_item'       => __( 'Add New Template Page', 'elegance_theme' ),
      'new_item'           => __( 'New Template Page', 'elegance_theme' ),
      'edit_item'          => __( 'Edit Template Page', 'elegance_theme' ),
      'view_item'          => __( 'View Template Page', 'elegance_theme' ),
      'all_items'          => __( 'All Template Page', 'elegance_theme' ),
      'search_items'       => __( 'Search Template Pages', 'elegance_theme' ),
      'parent_item_colon'  => __( 'Parent Template Pages:', 'elegance_theme' ),
      'not_found'          => __( 'No template pages found.', 'elegance_theme' ),
      'not_found_in_trash' => __( 'No template pages found in Trash.', 'elegance_theme' )
    );

    $args = array(
      'labels'             => $labels,
      'description'        => __( 'Description.', 'elegance_theme' ),
      'public'             => false,
      'publicly_queryable' => false,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      // 'rewrite'            => array( 'slug' => 'template-page' ),
      'capability_type'    => 'post',
      'has_archive'        => false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array( 'title', 'author' )
    );

    register_post_type( self::TYPE_NAME, $args );
  }

  function set_meta_template( $post_id, $post, $update ){
    if(self::TYPE_NAME === $post->post_type){
      //Set the meta field to the same as the slug, as it is necessary only
      //to facilitate more efficient lookups (using the template cascading naming)
      update_post_meta($post_id, self::TEMPLATE_META_KEY, $post->post_name);
    }
  }

  static function template_page_filter( $page_template ){
    $obj = get_queried_object();

    $templates = array();

    if(is_single()){
      //The object should be a post of some sort, look for the template for
      //that post_type first, then the generic single
      $templates[] = 'single-' . $obj->post_type;
      $templates[] = 'single';
    }elseif(is_category()){
      //The object should be a category page
      $templates[] = 'category-' . $obj->slug;
      $templates[] = 'category';
      $templates[] = 'archive';
    }elseif(is_archive()){
      //Must be a post type archive
      $templates[] = 'archive-' . $obj->name;
      $templates[] = 'archive';
    }elseif(is_404()){
      $templates[] = '404';
    }

    $meta_query = array();
    $meta_query[] = 'OR';
    foreach($templates as $t){
      $meta_query[] = array(
        'key' => self::TEMPLATE_META_KEY,
        'value' => $t,
        'compare' => '=',
      );
    }

    $posts = get_posts(array(
      'post_type' => self::TYPE_NAME,
      'meta_query' => $meta_query
    ));

    if(0 === sizeof($posts)){
      return $page_template;
    }

    usort($posts, function($a, $b) use($templates){
      return array_search($b->post_name, $templates) - array_search($a->post_name, $templates);
    });

    $template = $posts[0];

    global $__elegance_builder_framework;
    $__elegance_builder_framework->set_builder_object($posts[0]);

    return locate_template(self::BUILDER_TEMPLATE_PAGE);
  }
}

$template_page_post_type = new Template_Page_Post_Type();
