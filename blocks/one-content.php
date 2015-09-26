<?php

elegance_get_block_header();
$content = get_sub_field('content');

$widths = array(
  intval(get_sub_field('content_width_desktop')),
  get_sub_field('content_width_tablet'),
  get_sub_field('content_width_mobile'),
);

for($i = 1; $i < sizeof($widths); $i++){
  if( 'inherit' === $widths[$i] ){
    $widths[$i] = $widths[ $i - 1 ];
  }else{
    $widths[$i] = intval( $widths[$i] );
  }
}

$pos = get_sub_field('content_position');
$positions = array(
  $pos,
  $pos,
  $pos,
);

foreach($positions as $idx => $pos){
  switch($pos){
    case 'center':
      $positions[$idx] = intval((12 - $widths[$idx]) / 2);
      break;
    case 'right':
      $positions[$idx] = intval(12 - $widths[$idx]);
      break;
    default:
      $positions[$idx] = intval( $positions[$idx] );
      break;
  }
}

$classes = array();
$classes[] = 'col-md-' . $widths[0];
$classes[] = 'col-sm-' . $widths[1];
$classes[] = 'col-xs-' . $widths[2];

if($positions[0] !== null && $positions[0] !== 0){
  $classes[] = ' col-md-offset-' . $positions[0];
}
if($positions[0] !== null && $positions[1] !== 0){
  $classes[] = ' col-sm-offset-' . $positions[1];
}
if($positions[0] !== null && $positions[2] !== 0){
  $classes[] = ' col-xs-offset-' . $positions[2];
}

printf('<div class="row"><div class="%1$s">%2$s</div></div>', implode(' ', $classes), $content);

elegance_get_block_footer();
