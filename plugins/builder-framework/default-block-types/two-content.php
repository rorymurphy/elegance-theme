<?php

class Two_Content_Block {
  const BLOCK_TYPE = 'two-content';

  function __construct(){
    add_filter('elegance_block_types', array($this, 'register_block_type'));
    add_action('elegance_block_render_' . self::BLOCK_TYPE, array($this, 'render_block'));
  }

  function register_block_type($block_types){
    $block_types[self::BLOCK_TYPE] = array(
      'label' => 'Two Content',
      'fields' => array(
        'Content' => array (
          array (
      			'key' => 'field_55d7cffd3c19b',
      			'label' => 'Desktop Layout',
      			'name' => 'content_layout_desktop',
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
      				'2_10' => '1/6 - 5/6',
      				'3_9' => '1/4 - 3/4',
      				'4_8' => '1/3 - 2/3',
      				'5_7' => '5/12 - 7/12',
      				'6_6' => '1/2 - 1/2',
      				'7_5' => '7/12 - 5/12',
      				'8_4' => '2/3 - 1/3',
      				'9_3' => '3/4 - 1/4',
      				'10_2' => '5/6 - 1/6',
      				'12_12' => 'Stacked Vertically',
      			),
      			'default_value' => array (
      				'6_6' => '6_6',
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
      			'key' => 'field_55d7d1fc2a0d5',
      			'label' => 'Tablet Layout',
      			'name' => 'content_layout_tablet',
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
      				'2_10' => '1/6 - 5/6',
      				'3_9' => '1/4 - 3/4',
      				'4_8' => '1/3 - 2/3',
      				'5_7' => '5/12 - 7/12',
      				'6_6' => '1/2 - 1/2',
      				'7_5' => '7/12 - 5/12',
      				'8_4' => '2/3 - 1/3',
      				'9_3' => '3/4 - 1/4',
      				'10_2' => '5/6 - 1/6',
      				'12_12' => 'Stacked Vertically',
      				'inherit' => 'Same as desktop',
      			),
      			'default_value' => array (
      				'inherit' => 'inherit',
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
      			'key' => 'field_55d7d3505ce1b',
      			'label' => 'Mobile Layout',
      			'name' => 'content_layout_mobile',
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
      				'2_10' => '1/6 - 5/6',
      				'3_9' => '1/4 - 3/4',
      				'4_8' => '1/3 - 2/3',
      				'5_7' => '5/12 - 7/12',
      				'6_6' => '1/2 - 1/2',
      				'7_5' => '7/12 - 5/12',
      				'8_4' => '2/3 - 1/3',
      				'9_3' => '3/4 - 1/4',
      				'10_2' => '5/6 - 1/6',
      				'12_12' => 'Stacked Vertically',
      				'inherit' => 'Same as tablet',
      			),
      			'default_value' => array (
      				'12_12' => '12_12',
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
      			'key' => 'field_55d7cfe83c19a',
      			'label' => 'Left Content',
      			'name' => 'content1',
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
      		array (
				'key' => 'field_55d7cfe83c19b',
				'label' => 'Right Content',
				'name' => 'content2',
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

$one_content = new Two_Content_Block();
