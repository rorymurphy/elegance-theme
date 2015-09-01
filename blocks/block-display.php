<div class="row">
<?php
  global $__elegance_builder_framework;
  // check if the flexible content field has rows of data
  if( have_rows('block_wrapper') ):
      $__elegance_builder_framework->block_iter = 0;
       // loop through the rows of data
      while ( have_rows('block_wrapper') ) : the_row();
          $layout = get_row_layout();
          do_action('elegance_block_render_' . $layout);
          $__elegance_builder_framework->block_iter++;
      endwhile;
  endif;
?>
</div>
