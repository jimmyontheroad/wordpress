<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <?php wp_head();?>
</head>

<body>

<!--  <div class="col-3 offset-1" style="position:absolute;z-index:-1;margin-top: 5%;">
  <img width="100%" src=">
</div> -->

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-8 col-md-9 col-sm-11 col-11 blog-masthead">
        <div class="blog-header">
          <h1 class="blog-title"><a href="<?php echo get_bloginfo( 'wpurl' );?>"><?php echo get_bloginfo( 'name' ); ?></a></h1>
          <p class="lead blog-description"><?php echo get_bloginfo( 'description' ); ?></p>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light" role="navigation">      
        <!-- Brand and toggle get grouped for better mobile display -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <?php
            wp_nav_menu( array(
              'theme_location'    => 'primary',
              'depth'             => 2,
              'container'         => 'div',
              'container_class'   => 'collapse navbar-collapse',
              'container_id'      => 'bs-example-navbar-collapse-1',
              'menu_class'        => 'nav navbar-nav',
              'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
              'walker'            => new WP_Bootstrap_Navwalker(),
            ) );
          ?>      
        </nav>
      </div>
    </div>

<!--  </div>
  <div class="col-xl-2 col-lg-2 col-md-2 col-0 offset-xl-8 offset-lg-9 offset-md-10" style="position:absolute;z-index:-1;margin-top:15%;">
  <img width="100%" src="">
</div> -->

    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-9 col-sm-11 col-11 offset-xl-3 offset-lg-2 blog-full">