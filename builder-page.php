<?php
/**
 * Template Name: Builder Page
 *
 * @package Elegance
 * @subpackage Builder
 */

get_header();
get_template_part('templates/page-header');

global $__elegance_builder_framework;
$__elegance_builder_framework->render_blocks();

get_footer();
