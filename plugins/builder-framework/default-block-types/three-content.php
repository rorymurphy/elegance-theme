<?php

class Three_Content_Block {
  const BLOCK_TYPE = 'three-content';

  function __construct(){
    add_filter('elegance_block_types', array($this, 'register_block_type'));
    add_action('elegance_block_render_' . self::BLOCK_TYPE, array($this, 'render_block'));
  }

  function register_block_type($block_types){
    $block_types[self::BLOCK_TYPE] = array(
        'label' => 'Three Content',
        'fields' => array(
        'Content' => array (
            array (
                'key' => 'field_5bcd263613e1a',
                'label' => 'Desktop Layout',
                'name' => 'content_layout_desktop',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 33,
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    '4_4_4' => '1/3 - 1/3 - 1/3',
                    '6_3_3' => '1/2 - 1/4 - 1/4',
                    '3_3_6' => '1/4 - 1/4 - 1/2',
                    '12_12_12' => 'Stacked vertically',
                ),
                'default_value' => array (
                    '4_4_4' => '4_4_4',
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
                'key' => 'field_5bcdd1ff13e1b',
                'label' => 'Tablet Layout',
                'name' => 'content_layout_tablet',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 34,
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    '4_4_4' => '1/3 - 1/3 - 1/3',
                    '6_3_3' => '1/2 - 1/4 - 1/4',
                    '3_3_6' => '1/4 - 1/4 - 1/2',
                    '12_12_12' => 'Stacked vertically',
                ),
                'default_value' => array (
                    '4_4_4' => '4_4_4',
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
                'key' => 'field_5bcdd25a13e1c',
                'label' => 'Mobile Layout',
                'name' => 'content_layout_mobile',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 33,
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    '4_4_4' => '1/3 - 1/3 - 1/3',
                    '6_3_3' => '1/2 - 1/4 - 1/4',
                    '3_3_6' => '1/4 - 1/4 - 1/2',
                    '12_12_12' => 'Stacked vertically',
                ),
                'default_value' => array (
                    '12_12_12' => '12_12_12',
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
                'key' => 'field_5bcd257413e16',
                'label' => 'Left Content',
                'name' => 'content_1',
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
                'key' => 'field_5bcd25d313e18',
                'label' => 'Center Content',
                'name' => 'content_2',
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
                'key' => 'field_5bcd25f013e19',
                'label' => 'Right Content',
                'name' => 'content_3',
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
        )),
    );

    return $block_types;
  }

  function render_block(){
    get_template_part('blocks/' . self::BLOCK_TYPE);
  }
}

$three_content = new Three_Content_Block();
