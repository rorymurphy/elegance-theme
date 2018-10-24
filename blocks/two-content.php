<?php

elegance_get_block_header();
$content1 = get_sub_field('content1');
$content2 = get_sub_field('content2');

$layouts = array(
  intval(get_sub_field('content_layout_desktop')),
  get_sub_field('content_layout_tablet'),
  get_sub_field('content_layout_mobile'),
);

$layouts[0] = array_map(function($x){return intval($x);}, explode('_', $layouts[0]));

for($i = 1; $i < sizeof($layouts); $i++){
  if( 'inherit' === $layouts[$i] ){
    $layouts[$i] = $layouts[ $i - 1 ];
  }else{
    $layouts[$i] = array_map(function($x){return intval($x);}, explode('_', $layouts[$i]));
  }
}

$classes_left = array();
$classes_left[] = 'col-md-' . $layouts[0][0];
$classes_left[] = 'col-sm-' . $layouts[1][0];
$classes_left[] = 'col-xs-' . $layouts[2][0];

$classes_right = array();
$classes_right[] = 'col-md-' . $layouts[0][1];
$classes_right[] = 'col-sm-' . $layouts[1][1];
$classes_right[] = 'col-xs-' . $layouts[2][1];

printf('<div class="row"><div class="%1$s">%2$s</div><div class="%3$s">%4$s</div></div>', implode(' ', $classes_left), $content1, implode(' ', $classes_right), $content2);

elegance_get_block_footer();
