<?php
  $block_classes = array('carousel-item');
  $block_classes = apply_filters('elegance_carousel_item_classes', $block_classes);
?>
<div class="<?php print implode(' ', $block_classes); ?>">
