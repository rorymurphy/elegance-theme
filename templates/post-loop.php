<article class="post-loop">
  <div class="row">
    <?php
      if(has_post_thumbnail()) :
        print('<div class="col-md-2"><div class="post-thumbnail">');
        the_post_thumbnail('large');
        print('</div></div><div class="col-md-10">');
      else :
        print('<div class="col-md-12">');
      endif;
    ?>
      <h2 class="post-title"><a href="<?php print the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="post-meta">
          <span class="post-author">Posted By <?php the_author(); ?></span> on
          <span class="post-date"><?php the_date() ?></span>
      </div>
      <div class="post-content"><?php the_excerpt(); ?></div>
    </div>
  </div>
</article>