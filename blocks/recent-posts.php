<?php

elegance_get_block_header();

$count = get_sub_field('post_count');
$posts = get_posts(array(
  'posts_per_page' => $count
));

global $post;
foreach ($posts as $p) {
  $old = $post;
  $post = $p;
  setup_postdata($post);
  get_template_part('templates/post', 'list');

  wp_reset_postdata();
  $post = $old;
}
elegance_get_block_footer();
