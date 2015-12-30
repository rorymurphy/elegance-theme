<?php
  elegance_get_block_header();

  global $elegance_carousel_block;
  $show_arrows = get_sub_field('show_arrows');
  $show_dots = get_sub_field('show_dots');
  $dot_position = get_sub_field('dot_position');
  $dot_orientation = get_sub_field('dot_orientation');
  $interval = get_sub_field('interval');
  $carousel_items = get_sub_field('carousel_items');

  $carousel_index = $elegance_carousel_block->carousel_iter++;
  $carousel_id = 'elegance-carousel-' . $carousel_index;
  if($show_dots){
    $indicator_class = array('carousel-indicators');
    $pos = explode('_', $dot_position);
    foreach($pos as $val){
      $indicator_class[] = 'carousel-indicator-' . $pos;
    }
    $indicator_class[] = 'carousel-indicator-' . $dot_orientation;
    $indicator_class = implode(' ', $indicator_class);
  }
?>

<div id='<?php print $carousel_id; ?>' class="carousel slide" data-ride="carousel" data-interval="<?php print $interval; ?>">

<?php
  if( have_rows('carousel_items') ) :
      ob_start();
      print '<div class="carousel-inner" role="listbox">';

      $elegance_carousel_block->carousel_item_iter = 0;
       // loop through the rows of data
      while ( have_rows('carousel_items') ) : the_row();
          if( 0 === $elegance_carousel_block->carousel_item_iter ){
            print '<div class="item active">';
          }else{
            print '<div class="item">';
          }
          $layout = get_row_layout();
          do_action('elegance_block_render_' . $layout);
          print '</div>';
          $elegance_carousel_block->carousel_item_iter++;
      endwhile;

      print '</div>';

      $result = ob_get_clean();
      print $result;

  endif;

  if( $show_dots ){
    printf('<ol class="%1$s">', $indicator_class);
    printf('<li data-target="#%1$s" data-slide-to="0" class="active"></li>', $carousel_id);
    for( $i = 1; $i < $elegance_carousel_block->carousel_item_iter; $i++ ){
      printf('<li data-target="#%1$s" data-slide-to="%2$s"></li>', $carousel_id, $i);
    }
    print '</ol>';
  }

  if( $show_arrows ){
    $controls = <<<'EOD'
<a class="left carousel-control" href="#%1$s" role="button" data-slide="prev">
  <span class="icon-prev" aria-hidden="true"></span>
  <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#%1$s" role="button" data-slide="next">
  <span class="icon-next" aria-hidden="true"></span>
  <span class="sr-only">Next</span>
</a>
EOD;

    printf($controls, $carousel_id);
  }
?>
</div>
<?php
  elegance_get_block_footer();
