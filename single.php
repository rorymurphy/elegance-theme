<?php
get_header();
get_template_part('templates/page-header');
?>
<div id="main-content">
    <?php if(have_posts()):
        the_post();
        get_template_part('templates/post', 'single');
    endif; ?>
</div>
<?php
get_footer();
