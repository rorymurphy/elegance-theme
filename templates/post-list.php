<?php
$template = <<<'EOD'
<article class="post-list">
  <h2><a href="%1$s">%2$s</h2>
  <div class="post-meta">
    <div class="post-author">By %3$s</div>
    <div class="post-date">%4$s</div>
  </div>
  <div class="post-body">%5$s</div>
</article>
EOD;

printf($template, get_permalink(), get_the_title(), get_the_author(), get_the_date(), get_the_content());
