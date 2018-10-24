<div class="background"></div>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="navbar-inner">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php 
        printf('<a class="navbar-brand" href="%1$s">', get_home_url());
        $header_image = get_header_image();
        if($header_image){
          printf('<img src="%1$s" alt="%2$s"/>', $header_image, get_bloginfo('name'));
        }else{
          print(get_bloginfo('name'));
        }
        print('</a>');

        wp_nav_menu(array(
            'theme_location'  => 'header-menu',
            'container_class' => 'navbar-collapse collapse',
            'container_id' => 'header-nav',
            'menu_class' => 'navbar-nav mr-auto',
            'fallback_cb' => null,
            'walker' => new NavbarWalker
        ));
      ?>
    </div>

  </nav>
</header>