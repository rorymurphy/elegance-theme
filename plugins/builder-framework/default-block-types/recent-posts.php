<?php

class Recent_Posts_Block {
  const BLOCK_TYPE = 'recent-posts';

  function __construct(){
    add_filter('elegance_block_types', array($this, 'register_block_type'));
    add_action('elegance_block_render_' . self::BLOCK_TYPE, array($this, 'render_block'));
  }

  function register_block_type($block_types){
    $block_types[self::BLOCK_TYPE] = array(
      'label' => 'Recent Posts',
      'fields' => array(
        'Content' => array (
          array (
      			'key' => 'field_55f8c89dcad8d',
      			'label' => 'Number of Posts',
      			'name' => 'post_count',
      			'type' => 'number',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'default_value' => 10,
      			'placeholder' => '',
      			'prepend' => '',
      			'append' => '',
      			'min' => 1,
      			'max' => 100,
      			'step' => 1,
      			'readonly' => 0,
      			'disabled' => 0,
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

$one_content = new Recent_Posts_Block();
