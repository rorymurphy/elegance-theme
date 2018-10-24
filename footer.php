<footer>
    <div class="footer-inner">
        <?php
            /* A sidebar in the footer? Yep. You can can customize
             * your footer with three columns of widgets.
             */
            if(!dynamic_sidebar( 'footer' )): ?>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="navbar-inner">               
                    <?php                
                        wp_nav_menu(array(
                            'theme_location'  => 'footer-menu',
                            'container_class' => 'navbar-collapse collapse',
                            'container_id' => 'footer-nav',
                            'menu_class' => 'navbar-nav mr-auto',
                            'fallback_cb' => null,
                            'walker' => new NavbarWalker
                        ));
                    ?>
                    </div>
            
                </nav>
            <?php endif; ?>
    </div>
</footer>
<?php wp_footer(); ?>

</body>
</html>