<?php

class One_Content_Block {
  const BLOCK_TYPE = 'one-content';

  function __construct(){
    add_filter('elegance_block_types', array($this, 'register_block_type'));
    add_action('elegance_block_render_' . self::BLOCK_TYPE, array($this, 'render_block'));
  }

  function register_block_type($block_types){
    $block_types[self::BLOCK_TYPE] = array(
      'label' => 'One Content',
      'fields' => array(
        'Content' => array (
      		array (
      			'key' => 'field_55d517e0335de',
      			'label' => 'Desktop Width',
      			'name' => 'content_width_desktop',
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
      			'default_value' => 6,
      			'allow_null' => 0,
      			'multiple' => 0,
      			'ui' => 0,
      			'ajax' => 0,
      			'placeholder' => '',
      			'disabled' => 0,
      			'readonly' => 0,
      		),
      		array (
      			'key' => 'field_55d52ab4e7269',
      			'label' => 'Tablet Width',
      			'name' => 'content_width_tablet',
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
              'inherit' => 'Same as Desktop',
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
      			'default_value' => array (
      				0 => 8,
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
      			'key' => 'field_55d52ae2e726a',
      			'label' => 'Mobile Width',
      			'name' => 'content_width_mobile',
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
              'inherit' => 'Same as Desktop',
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
      			'default_value' => array (
      				0 => 12,
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
      			'key' => 'field_55d51ccd335df',
      			'label' => 'Position',
      			'name' => 'position',
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
      				'center' => 'center',
      				0 => 'left',
      				'right' => 'Right',
      				1 => '1/12 Offset',
      				2 => '1/6 Offset',
      				3 => '1/4 Offset',
      				4 => '1/3 Offset',
      				5 => '5/12 Offset',
      				6 => '1/2 Offset',
      				7 => '7/12 Offset',
      				8 => '2/3 Offset',
      				9 => '3/4 Offset',
      				10 => '5/6 Offset',
      				11 => '11/12 Offset',
      			),
      			'default_value' => array (
      				'center' => 'center',
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
      			'key' => 'field_55d50d70335dd',
      			'label' => 'Content',
      			'name' => 'content',
      			'type' => 'wysiwyg',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'default_value' => '',
      			'tabs' => 'all',
      			'toolbar' => 'full',
      			'media_upload' => 1,
      		),
      	),
      ),
    );

    return $block_types;
  }

  function render_block(){
    get_template_part('blocks/' . self::BLOCK_TYPE);
  }
}

$one_content = new One_Content_Block();
