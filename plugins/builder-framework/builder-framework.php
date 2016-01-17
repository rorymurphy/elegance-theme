<?php

require_once 'template-page.php';
require_once 'default-block-types/one-content.php';
require_once 'default-block-types/two-content.php';
require_once 'default-block-types/recent-posts.php';
require_once 'default-block-types/carousel.php';

class Builder_Framework{
  const BLOCK_TYPES_FILTER = 'elegance_block_types';
  const BLOCK_CLASSES_FILTER = 'elegance_block_classes';
  const BLOCK_VERTICAL_SIZES = 'elegance_block_vertical_sizes';
  const THEME_TYPE_FILTER = 'elegance_block_themes';
  const BUILDER_POST_TYPES_FILTER = 'elegance_builder_post_types';
  const TEMPLATE_PAGE_POST_TYPE = 'template_page';
  const BUILDER_BLOCK_RENDER_ACTION = 'elegance_block_render_%1$s';

  var $block_types;
  var $post_types;
  var $block_iter;
  var $builder_obj;
  var $themes;
  var $vertical_sizes;

  function __construct(){
    $this->register_actions_filters();
  }

  function register_actions_filters(){
    add_action('init', array($this, 'register_elements'));

    add_action('wp_head', array($this, 'create_embedded_stylesheet'));

    add_filter(self::BLOCK_CLASSES_FILTER, array($this, 'block_classes'));
  }

  function register_elements(){
    //Add default builders
    $this->block_types = array();
    $this->block_types = apply_filters(self::BLOCK_TYPES_FILTER, $this->block_types);

    $this->post_types = array(
      self::TEMPLATE_PAGE_POST_TYPE
    );
    $this->post_types = apply_filters(self::BUILDER_POST_TYPES_FILTER, $this->post_types);
    $this->themes = array(
      'default' => 'Default'
    );
    $this->themes = apply_filters(self::THEME_TYPE_FILTER, $this->themes);

    $this->vertical_sizes = array (
      'tight' => 'Tight',
      'short' => 'Short',
      'med' => 'Medium',
      'tall' => 'Tall',
    );
    $this->vertical_sizes = apply_filters(self::BLOCK_VERTICAL_SIZES, $this->vertical_sizes);

    $this->register_fields();
  }

  function block_classes($classes){
    $css_class = get_sub_field('css_class');
    $theme = get_sub_field('theme');

    $css_class = ($css_class !== '') ? explode(' ', $css_class) : array();

    $layout = get_row_layout();
    $css_class[] = 'eblock-type-' . $layout;
    $css_class[] = 'eblock-idx-' . $this->block_iter;
    if(null !== $theme && '' !== $theme){
      $css_class[] = 'eblock-theme-' . $theme;
    }

    $widths = array(
      intval(get_sub_field('width_desktop')),
      get_sub_field('width_tablet'),
      get_sub_field('width_mobile'),
    );
    if( -1 === $widths[0] ){
      $widths[0] = 12;
    }

    for($i = 1; $i < sizeof($widths); $i++){
      //If the width specified is 'inherit' (-2)
      if( -2 === $widths[$i] ){
        $widths[$i] = $widths[ $i - 1 ];
      }else{
        $widths[$i] = intval( $widths[$i] );
      }
    }

    if($widths[0] === 0){
      $css_class[] = 'hidden-md';
    }else{
      $css_class[] = 'col-md-' . $widths[0];
    }

    if($widths[1] === 0){
      $css_class[] = 'hidden-sm';
    }else{
      $css_class[] = 'col-sm-' . $widths[1];
    }

    if($widths[2] === 0){
      $css_class[] = 'hidden-xs';
    }else{
      $css_class[] = 'col-xs-' . $widths[2];
    }

    $size_mode = get_sub_field('size_mode_vertical');
    $size = get_sub_field('size_vertical');

    $css_class[] = sprintf('size-vert-%1$s-%2$s', $size_mode, $size);

    $classes = array_merge($classes, $css_class);
    return $classes;
  }

  function render_blocks(){
    global $post;
    $old_post = $post;
    $post = $this->get_builder_object();

    setup_postdata( $post );
    if(locate_template('blocks/block-display.php')){
      get_template_part('blocks/block-display');
    }else{
      print '<div class="row">';
      // check if the flexible content field has rows of data
      if( have_rows('block_wrapper') ):
          $this->block_iter = 0;
           // loop through the rows of data
          while ( have_rows('block_wrapper') ) : the_row();
              $layout = get_row_layout();
              do_action( sprintf(self::BUILDER_BLOCK_RENDER_ACTION, $layout) );
              $this->block_iter++;
          endwhile;
      endif;
      print '</div>';

      $post = $old_post;
    }

    wp_reset_postdata();
  }
  function create_embedded_stylesheet(){
    global $post;
    $old_post = $post;
    $post = $this->get_builder_object();
    setup_postdata( $post );

    if( have_rows('block_wrapper') ):
        print '<style type="text/css">';
        $this->block_iter = 0;
         // loop through the rows of data
        while ( have_rows('block_wrapper') ) : the_row();
            printf('.eblock.eblock-idx-%1$s{', $this->block_iter);

            $text_color = get_sub_field('text_color');
            if('' !== $text_color){
              printf('color: %1$s;', $text_color);
            }

            $background_image = get_sub_field('background_image');
            if(null !== $background_image && $background_image > 0){
              $background_image = wp_get_attachment_image_src($background_image, 'full');
              $background_image = $background_image[0];
              // var_dump($background_image);
              printf('background-image: url(%1$s);', $background_image);
            }



            $background_color = get_sub_field('background_color');
            if('' !== $background_color){
              printf('background-color: %1$s;', $background_color);
            }
            $background_image = get_sub_field('background_image');

            $background_position = get_sub_field('background_position');
            if('' !== $background_position){
              printf('background-position: %1$s;', $background_position);
            }

            $background_attachment = get_sub_field('background_attachment');
            if('' !== $background_attachment){
              printf('background-attachment: %1$s;', $background_attachment);
            }

            $background_size = get_sub_field('background_size');
            if('' !== $background_size){
              printf('background-size: %1$s;', $background_size);
            }

            $background_repeat = get_sub_field('background_repeat');
            if('' !== $background_repeat){
              printf('background-repeat: %1$s;', $background_repeat);
            }
            print '}';
            $this->block_iter++;
        endwhile;
        print '</style>';
    endif;

    wp_reset_postdata();
    $post = $old_post;
  }

  function register_fields(){
    if( function_exists('acf_add_local_field_group') ):
      $locations = array (
        array (
          array (
            'param' => 'page_template',
            'operator' => '==',
            'value' => 'builder-page.php',
          ),
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'page',
          ),
        ),
      );

      foreach ($this->post_types as $ptype) {
        $locations[] = array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => $ptype,
          ),
        );
      }


      $layouts = array();
      foreach($this->block_types as $block_type => $block_attrs){
        $block_fields = $block_attrs['fields'];

        $layout = array (
          'key' => 'block_' . $block_type . '_55c976d2bd9a7',
          'name' => $block_type,
          'label' => $block_attrs['label'],
          'display' => 'block',
          'sub_fields' => array(),
          'min' => '',
          'max' => '',
        );
        $common_fields = $this->get_common_fields($block_type);
        $combo_fields = array_merge_recursive($common_fields, $block_fields);
        foreach($combo_fields as $tab => $tab_fields){
          $tab_key = preg_replace('/[^\w]+/', '_', $tab);
          $layout['sub_fields'][] = array (
            'key' => 'block_' . $block_type . '_tab_' . $tab_key,
            'label' => $tab,
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'placement' => 'top',
            'endpoint' => 0,
          );

          foreach($tab_fields as $f){
            $layout['sub_fields'][] = $f;
          }
        }
        $layouts[] = $layout;
      }

      acf_add_local_field_group(array (
      	'key' => 'group_55c976af5fe8a',
      	'title' => 'Elegance Builder',
      	'fields' => array (
      		array (
      			'key' => 'field_55c976bd5ed65',
      			'label' => 'Block Wrapper',
      			'name' => 'block_wrapper',
      			'type' => 'flexible_content',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'button_label' => 'Add Block',
      			'min' => '',
      			'max' => '',
      			'layouts' => $layouts,
      		),
      	),
      	'location' => $locations,
      	'menu_order' => 0,
      	'position' => 'normal',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      ));

    endif;
  }

  static function is_builder_editor(){
    return self::is_edit_page();
  }

  static function is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()){ return false; }


    if($new_edit == "edit"){
        return in_array( $pagenow, array( 'post.php',  ) );
    } elseif($new_edit == "new") { //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    } else {//check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
    }
  }

  function set_builder_object($value){
    $this->builder_obj = $value;
  }

  function get_builder_object(){
    return ( null !== $this->builder_obj ) ? $this->builder_obj : get_queried_object();
  }

  static function get_block_type_key($block_type, $key){
    return preg_replace('/^field_/', 'field_' . $block_type, $key);
  }

  function get_common_fields($block_type){
    $theme_keys = array_keys($this->themes);

    $fields = array(
      'Content' => array(

      ),
      'Appearance' => array(
        array (
          'key' => 'field_55cacbaf0577d',
          'label' => 'Theme',
          'name' => 'theme',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 50,
            'class' => '',
            'id' => '',
          ),
          'choices' => $this->themes,
          'default_value' => $theme_keys[0],
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'placeholder' => '',
          'disabled' => 0,
          'readonly' => 0,
        ),
        array (
          'key' => 'field_55cacb880577c',
          'label' => 'CSS Class',
          'name' => 'css_class',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 50,
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
          'readonly' => 0,
          'disabled' => 0,
        ),
        array (
          'key' => 'field_55e3db6053b60',
          'label' => 'Text Color',
          'name' => 'text_color',
          'type' => 'color_picker',
          'instructions' => 'Generally either a theme or background/text color are used',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
        ),
        array (
          'key' => 'field_55c97743637de',
          'label' => 'Background Color',
          'name' => 'background_color',
          'type' => 'color_picker',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
        ),
        array (
          'key' => 'field_55c9777c637df',
          'label' => 'Background Image',
          'name' => 'background_image',
          'type' => 'image',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'return_format' => 'id',
          'preview_size' => 'thumbnail',
          'library' => 'all',
          'min_width' => '',
          'min_height' => '',
          'min_size' => '',
          'max_width' => '',
          'max_height' => '',
          'max_size' => '',
          'mime_types' => '',
        ),
        array (
          'key' => 'field_55c977af637e0',
          'label' => 'Background Position',
          'name' => 'background_position',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            'left top' => 'left top',
            'left center' => 'left center',
            'left bottom' => 'left bottom',
            'right top' => 'right top',
            'right center' => 'right center',
            'right bottom' => 'right bottom',
            'center top' => 'center top',
            'center center' => 'center center',
            'center bottom' => 'center bottom',
          ),
          'default_value' => array (
            'center top' => 'center top',
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'placeholder' => '',
          'disabled' => 0,
          'readonly' => 0,
        ),
        array (
          'key' => 'field_55c977d6637e1',
          'label' => 'Background Attachment',
          'name' => 'background_attachment',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            'scroll' => 'scroll',
            'fixed' => 'fixed',
            'local' => 'local',
            'initial' => 'initial',
            'inherit' => 'inherit',
          ),
          'default_value' => array (
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'placeholder' => '',
          'disabled' => 0,
          'readonly' => 0,
        ),
        array (
          'key' => 'field_55c977e9637e2',
          'label' => 'Background Size',
          'name' => 'background_size',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            'auto' => 'auto',
            'cover' => 'cover',
            'contain' => 'contain',
            'initial' => 'initial',
            'inherit' => 'inherit',
          ),
          'default_value' => array (
          ),
          'multiple' => 0,
          'allow_null' => 0,
          'ui' => 0,
          'ajax' => 0,
          'placeholder' => '',
          'disabled' => 0,
          'readonly' => 0,
        ),
        array (
          'key' => 'field_55cac43d1df98',
          'label' => 'Background Repeat',
          'name' => 'background_repeat',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            'repeat' => 'Repeat both directions',
            'repeat-x' => 'Repeat horizontally',
            'repeat-y' => 'Repeat vertically',
            'no-repeat' => 'No repeat',
            'inherit' => 'Inherit value'
          ),
          'default_value' => 'no-repeat',
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'placeholder' => '',
          'disabled' => 0,
          'readonly' => 0,
        ),
      ),
      'Responsiveness & Sizing' => array(
        array (
          'key' => 'field_55e3aff57009e',
          'label' => 'Desktop Block Width',
          'name' => 'width_desktop',
          'type' => 'select',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            1 => '1/12 width',
            2 => '1/6 width',
            3 => '1/4 width',
            4 => '1/3 width',
            5 => '5/12 width',
            6 => '1/2 width',
            7 => '7/12 width',
            8 => '2/3 width',
            9 => '3/4 width',
            10 => '5/6 width',
            11 => '11/12 width',
            12 => 'Full Container Width',
            -1 => 'Full Screen Width',
            0 => 'Hidden',
          ),
          'default_value' => 12,
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'placeholder' => '',
          'disabled' => 0,
          'readonly' => 0,
        ),
        array (
          'key' => 'field_55e3be447009f',
          'label' => 'Tablet Block Width',
          'name' => 'width_tablet',
          'type' => 'select',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            -2 => 'Same as Desktop',
            0 => 'Hidden',
            1 => '1/12 width',
            2 => '1/6 width',
            3 => '1/4 width',
            4 => '1/3 width',
            5 => '5/12 width',
            6 => '1/2 width',
            7 => '7/12 width',
            8 => '2/3 width',
            9 => '3/4 width',
            10 => '5/6 width',
            11 => '11/12 width',
            12 => 'Full Width',
          ),
          'default_value' => -2,
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'placeholder' => '',
          'disabled' => 0,
          'readonly' => 0,
        ),
        array (
          'key' => 'field_55e3ca5a700a0',
          'label' => 'Mobile Block Width',
          'name' => 'width_mobile',
          'type' => 'select',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            -2 => 'Same as Tablet',
            1 => '1/12 width',
            2 => '1/6 width',
            3 => '1/4 width',
            4 => '1/3 width',
            5 => '5/12 width',
            6 => '1/2 width',
            7 => '7/12 width',
            8 => '2/3 width',
            9 => '3/4 width',
            10 => '5/6 width',
            11 => '11/12 width',
            12 => 'Full Width',
            0 => 'Hidden',
          ),
          'default_value' => -2,
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'placeholder' => '',
          'disabled' => 0,
          'readonly' => 0,
        ),
        array (
          'key' => 'field_55fcc6b226255',
          'label' => 'Vertical Sizing Mode',
          'name' => 'size_mode_vertical',
          'type' => 'select',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            'auto' => 'Auto',
            'fixed' => 'Fixed',
          ),
          'default_value' => array (
            'auto' => 'auto',
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'placeholder' => '',
          'disabled' => 0,
          'readonly' => 0,
        ),
        array (
          'key' => 'field_55f4d1614cf47',
          'label' => 'Vertical Size',
          'name' => 'size_vertical',
          'type' => 'select',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => 25,
            'class' => '',
            'id' => '',
          ),
          'choices' => $this->vertical_sizes,
          'default_value' => array (
            'med' => 'med',
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'placeholder' => '',
          'disabled' => 0,
          'readonly' => 0,
        ),
      )
    );

    foreach($fields as $group => $blocks){
      $new_blocks = array();
      foreach($blocks as $b){
        $b['key'] = preg_replace('/^field_/', 'field_' . $block_type, $b['key']);
        $new_blocks[] = $b;
      }
      $fields[$group] = $new_blocks;
    }
    return $fields;
  }
}

global $__elegance_builder_framework;
$__elegance_builder_framework = new Builder_Framework();

function elegance_get_block_header(){
  $template_name = apply_filters('elegance_block_header_template', 'block-header');
  get_template_part('blocks/' . $template_name);
}

function elegance_get_block_footer(){
  $template_name = apply_filters('elegance_block_footer_template', 'block-footer');
  get_template_part('blocks/' . $template_name);
}
