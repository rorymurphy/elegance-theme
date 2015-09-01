<div class="background"></div>
<section class="header">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-nav" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Brand</a>
      </div>

      <?php
        wp_nav_menu(array(
            'theme_location'  => 'header-menu',
            'container_class' => 'navbar-collapse collapse',
            'container_id' => 'header-nav',
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => null,
            'walker' => new NavbarWalker
        ));
      ?>
    </div><!-- /.container-fluid -->
  </nav>
</section>
<div class="container">
