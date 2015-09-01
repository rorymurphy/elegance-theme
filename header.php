<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon"  href="<?php print get_favicon_url(); ?>" />
<?php
$qobj = get_queried_object();
if($qobj):
    setup_postdata($qobj);?>
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:description" content="<?php print get_the_excerpt(); ?>" />
<?php
wp_reset_postdata();
endif; ?>
<title><?php wp_title(''); ?></title>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
    wp_enqueue_script('modernizr');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap');

    wp_enqueue_style('theme');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array('bootstrap'));
    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
            wp_enqueue_script( 'comment-reply' );

    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();

    $body_style='';
    $bgImage = get_background_image();
    //var_dump('Background: ' . $bgImage);
    if($bgImage != null && $bgImage != ''): ?>
    <style type="text/css">
        body.custom-background{
            min-height: 100%;
            background: none;
        }
        #container{
            position: relative;
        }
        .background {
            position: fixed;
            height: 100%;
            width: 100%;
            top:0;
            left:0;
            background-image: url(<?php print get_background_image_size('background-medium'); ?>);
            background-size: cover;
        }

        @media (min-width: 1921px) {
            .background {
                background-image: url(<?php print $bgImage; ?>);
            }
        }

        @media (max-width: 1920px) {
            .background {
                background-image: url(<?php print get_background_image_size('background-larger'); ?>);
            }
        }
        @media (max-width: 1368px) {
            .background {
                background-image: url(<?php print get_background_image_size('background-large'); ?>);
            }
        }
        @media (max-width: 1280px) {
            .background {
                background-image: url(<?php print get_background_image_size('background-medium'); ?>);
            }
        }
        @media (max-width: 1024px) {
            .background {
                background-image: url(<?php print get_background_image_size('background-small'); ?>);
            }
        }
        @media (max-width: 640px) {
            .background {
                background-image: url(<?php print get_background_image_size('background-phone'); ?>);
            }
        }
    </style>
    <?php endif; ?>
</head>

<body <?php body_class();?>>
