
<footer>
    <div class="footer-inner">
        <?php
            /* A sidebar in the footer? Yep. You can can customize
             * your footer with three columns of widgets.
             */
            if(!dynamic_sidebar( 'footer' )):
                wp_nav_menu(array(
                    'theme_location'  => 'footer-menu',
                    'container_class' => 'footer-menu',
                    'menu_class' => 'nav',
                    'fallback_cb' => null,
                ));
            endif; ?>
    </div>
</footer>
<?php wp_footer(); ?>

</body>
</html>
