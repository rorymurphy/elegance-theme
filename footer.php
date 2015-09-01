</div><!-- #container -->
<footer>
    <div class="footer-inner">
        <?php
            /* A sidebar in the footer? Yep. You can can customize
             * your footer with three columns of widgets.
             */
            if(!dynamic_sidebar( 'footer' )):?>
            <div class="navbar">
                <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'footer-menu',
                        'container_class' => 'navbar-inner',
                        'menu_class' => 'nav',
                        'fallback_cb' => null,
                        'walker' => new NavbarWalker
                    ));
                ?>
            </div>
        <?php endif; ?>
    </div>
</footer>
<?php wp_footer(); ?>

</body>
</html>
