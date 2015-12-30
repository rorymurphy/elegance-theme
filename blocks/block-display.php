<?php
  global $__elegance_builder_framework;
  $isFullWidth = false;
  $wasFullWidth = false;

  $container_norm = '<div class="container"><div class="row">';
  $container_wide = '<div class="container-fluid"><div class="row">';
  $container_close = '</div></div>';
  // check if the flexible content field has rows of data
  if( have_rows('block_wrapper') ):
      $__elegance_builder_framework->block_iter = 0;
       // loop through the rows of data
      while ( have_rows('block_wrapper') ) : the_row();
          $layout = get_row_layout();
          $isFullWidth = intval(get_sub_field('width_desktop')) === -1;

          if(0 === $__elegance_builder_framework->block_iter && $isFullWidth){
            print $container_wide;
          }elseif (0 === $__elegance_builder_framework->block_iter) {
            print $container_norm;
          }elseif ($isFullWidth && !$wasFullWidth) {
            print $container_close . $container_wide;
          }elseif (!$isFullWidth && $wasFullWidth) {
            print $container_close . $container_norm;
          }
          $wasFullWidth = $isFullWidth;
          do_action('elegance_block_render_' . $layout);
          $__elegance_builder_framework->block_iter++;
      endwhile;
  endif;

  print $container_close;
?>
