<?php

elegance_get_block_header();

$width = get_sub_field('card_width');
$justify = get_sub_field('card_justify');
// check if the repeater field has rows of data
if( have_rows('cards') ):

    printf('<div class="row mt-5 mb-5 justify-content-%1$s">', $justify);
    // loop through the rows of data
   while ( have_rows('cards') ) : the_row();
   
        printf('<div class="card ml-5" style="width: %1$srem;">', $width);
        $image_id = get_sub_field('card_image');
        $icon = get_sub_field('card_icon');
        if(null !== $image_id && 0 !== $image_id){
            $image = wp_get_attachment_image_src($image_id, 'small-4-3');
            printf('<img class="card-img-top" src="%1$s" alt="%2$s">', $image[0], '');
        }elseif(null !== $icon && '' != $icon){
                //TODO: Handle Icons
        }

        $body = get_sub_field('card_body');
        printf('<div class="card-body">%1$s</div>', $body);
        print('</div>');
   
   endwhile;

   print('</div>');
else :

   // no rows found

endif;

elegance_get_block_footer();