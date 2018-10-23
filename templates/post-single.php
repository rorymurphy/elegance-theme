<article class="post-single">
        <div class="row">
            <div class="col-md-12">
                <h1 class="post-title"><?php the_title(); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="post-meta">
                        <span class="post-author">Posted By <?php the_author(); ?></span> on
                        <span class="post-date"><?php the_date() ?></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php if(has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <? the_post_thumbnail('large'); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="post-content"><?php the_content(); ?></div>
            </div>
        </div>


</article>