<?php

class Carousel_Block {
  const BLOCK_TYPE = 'carousel';
  const BLOCK_LABEL = 'Carousel';
  const CAROUSEL_ITEM_CLASSES = 'elegance_carousel_item_classes';

  private $carousel_item_common_fields;
  private $carousel_item_types;

  public $carousel_iter;
  public $carousel_item_iter;

  function __construct(){
    $this->carousel_iter = 0;
    add_filter('elegance_block_types', array($this, 'register_block_type'), 99);
    add_action('elegance_block_render_' . self::BLOCK_TYPE, array($this, 'render_block'));
    add_filter(self::CAROUSEL_ITEM_CLASSES, array($this, 'carousel_item_classes'));
    add_action('wp_head', array($this, 'create_embedded_stylesheet'));
  }

  function carousel_item_classes($classes){
    $css_class = get_sub_field('css_class');

    $css_class = ($css_class !== '') ? explode(' ', $css_class) : array();

    $layout = get_row_layout();
    $css_class[] = 'eblock-type-' . $layout;
    $css_class[] = 'carousel-item-idx-' . $this->block_iter;

    return $classes;
  }

  function create_embedded_stylesheet(){

    if( have_rows('block_wrapper') ):
        print '<style type="text/css">';
        $this->block_iter = 0;
         // loop through the rows of data
        while ( have_rows('block_wrapper') ) : the_row();
            printf('.carousel-item.carousel-item-idx-%1$s{', $this->block_iter);

            $text_color = get_sub_field('text_color');
            if('' !== $text_color){
              printf('color: %1$s;', $text_color);
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

  }

  function register_block_type($block_types){

    $item_types = $block_types;

    $layouts = array();
    foreach($item_types as $block_type => $block_attrs){
      $block_fields = $block_attrs['fields'];

      $layout = array (
        'key' => 'block_' . $block_type . '_a74c03e18c90a',
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
          'key' => 'carousel_item_' . $block_type . '_tab_' . $tab_key,
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
          $f['key'] = 'carousel_item_' . $f['key'];
          $layout['sub_fields'][] = $f;
        }
      }
      $layouts[] = $layout;
    }

    $block_types[self::BLOCK_TYPE] = array(
      'label' => self::BLOCK_LABEL,
      'fields' => array(
        'Content' => array (
        		array (
        			'key' => 'field_562da1ee9638f',
        			'label' => 'Show Arrows?',
        			'name' => 'show_arrows',
        			'type' => 'true_false',
        			'instructions' => '',
        			'required' => 0,
        			'conditional_logic' => 0,
        			'wrapper' => array (
        				'width' => 25,
        				'class' => '',
        				'id' => '',
        			),
        			'message' => '',
        			'default_value' => 1,
        		),
        		array (
        			'key' => 'field_562da20596390',
        			'label' => 'Show Dots?',
        			'name' => 'show_dots',
        			'type' => 'true_false',
        			'instructions' => '',
        			'required' => 0,
        			'conditional_logic' => 0,
        			'wrapper' => array (
        				'width' => 25,
        				'class' => '',
        				'id' => '',
        			),
        			'message' => '',
        			'default_value' => 1,
        		),
        		array (
        			'key' => 'field_562da21e96391',
        			'label' => 'Dot Position',
        			'name' => 'dot_position',
        			'type' => 'select',
        			'instructions' => '',
        			'required' => 0,
        			'conditional_logic' => array (
        				array (
        					array (
        						'field' => 'field_562da20596390',
        						'operator' => '==',
        						'value' => '1',
        					),
        				),
        			),
        			'wrapper' => array (
        				'width' => 25,
        				'class' => '',
        				'id' => '',
        			),
        			'choices' => array (
        				'top_left' => 'Top Left',
        				'top_center' => 'Top Center',
        				'top_right' => 'Top Right',
        				'bottom_left' => 'Bottom Left',
        				'bottom_center' => 'Bottom Center',
        				'bottom_right' => 'Bottom Right',
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
        			'key' => 'field_562da28a96392',
        			'label' => 'Dot Orientation',
        			'name' => 'dot_orientation',
        			'type' => 'select',
        			'instructions' => '',
        			'required' => 0,
        			'conditional_logic' => array (
        				array (
        					array (
        						'field' => 'field_562da20596390',
        						'operator' => '==',
        						'value' => '1',
        					),
        				),
        			),
        			'wrapper' => array (
        				'width' => 25,
        				'class' => '',
        				'id' => '',
        			),
        			'choices' => array (
        				'horizontal' => 'Horizontal',
        				'vertical' => 'Vertical',
        			),
        			'default_value' => array (
        				'horizontal' => 'horizontal',
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
        			'key' => 'field_5680bd0a754d0',
        			'label' => 'Interval Between Slides',
        			'name' => 'interval',
        			'type' => 'number',
        			'instructions' => 'Enter the interval (in milliseconds) between slides. A zero interval represents manual carousel operation.',
        			'required' => 0,
        			'conditional_logic' => 0,
        			'wrapper' => array (
        				'width' => 25,
        				'class' => '',
        				'id' => '',
        			),
        			'default_value' => 0,
        			'placeholder' => '',
        			'prepend' => '',
        			'append' => '',
        			'min' => 0,
        			'max' => 10000,
        			'step' => 100,
        			'readonly' => 0,
        			'disabled' => 0,
        		),
        		array (
        			'key' => 'field_562da2d893da0',
        			'label' => 'Carousel Items',
        			'name' => 'carousel_items',
        			'type' => 'flexible_content',
        			'instructions' => '',
        			'required' => 0,
        			'conditional_logic' => 0,
        			'wrapper' => array (
        				'width' => '',
        				'class' => '',
        				'id' => '',
        			),
        			'button_label' => 'Add Row',
        			'min' => '',
        			'max' => '',
        			'layouts' => $layouts,
        		),
      	),
      ),
    );

    return $block_types;
  }

  function get_common_fields($item_type){
    $fields = array(
      'Content' => array(

      ),
      'Appearance' => array(
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
    );

    $fields = apply_filters('elegance_carousel_item_common_fields', $fields);

    foreach($fields as $group => $blocks){
      $new_blocks = array();
      foreach($blocks as $b){
        $b['key'] = preg_replace('/^field_/', 'field_' . $item_type, $b['key']);
        $new_blocks[] = $b;
      }
      $fields[$group] = $new_blocks;
    }
    return $fields;
  }
  function render_block(){
    get_template_part('blocks/' . self::BLOCK_TYPE);
  }
}

global $elegance_carousel_block;
$elegance_carousel_block = new Carousel_Block();
