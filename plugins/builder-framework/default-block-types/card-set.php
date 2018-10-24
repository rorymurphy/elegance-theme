<?php

class Card_Set_Block {
  const BLOCK_TYPE = 'card-set';

  function __construct(){
    add_filter('elegance_block_types', array($this, 'register_block_type'));
    add_action('elegance_block_render_' . self::BLOCK_TYPE, array($this, 'render_block'));
  }

  function register_block_type($block_types){
    $block_types[self::BLOCK_TYPE] = array(
      'label' => 'Card Set',
      'fields' => array(
        'Content' => array (
            array (
                'key' => 'field_5bcfcf7a1ab8c',
                'label' => 'Width',
                'name' => 'card_width',
                'type' => 'number',
                'instructions' => 'Width in em',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 25,
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 20,
                'placeholder' => '',
                'prepend' => '',
                'append' => 'em',
                'min' => 0,
                'max' => 9999,
                'step' => 1,
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_5bcfcfb31ab8d',
                'label' => 'Justify',
                'name' => 'card_justify',
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
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right',
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
                'key' => 'field_5bcfd0051ab8e',
                'label' => 'Cards',
                'name' => 'cards',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => '',
                'max' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
                'sub_fields' => array (
                    array (
                        'key' => 'field_5bcfd05a1ab8f',
                        'label' => 'Card Image',
                        'name' => 'card_image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => 15,
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
                        'key' => 'field_5bcfd07c1ab90',
                        'label' => 'Card Icon',
                        'name' => 'card_icon',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => 15,
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            'check' => 'Check',
                        ),
                        'default_value' => array (
                            'check' => 'check',
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
                        'key' => 'field_5bcfd09e1ab91',
                        'label' => 'Card Body',
                        'name' => 'card_body',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => 100,
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
        ),
    ),);

    return $block_types;
  }

  function render_block(){
    get_template_part('blocks/' . self::BLOCK_TYPE);
  }
}

$card_set = new Card_Set_Block();
