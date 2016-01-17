<?php
  $block_classes = array('eblock');
  $block_classes = apply_filters('elegance_block_classes', $block_classes);
?>
<div class="<?php print implode(' ', $block_classes); ?>">
  <div class="eblock-inner">
