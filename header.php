<html lang="en">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?></title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap.css" media="screen">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5shiv.min.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/assets/js/respond.min.js"></script>
    <![endif]-->
	<?php wp_head(); ?>
  <?php $options = get_option('theme_options'); ?>
	</head>
	<body>
    <!-- Navbar
    ================================================== -->
    <div class="page-navbar clearfix">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="navbar navbar-inverse">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="glyphicon glyphicon-home"></span></a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
                <?php
                wp_nav_menu( array(
                  'menu' => 'primary',
                  'theme_location' => 'primary',
                  'depth' => 0,
                  'container' => 'div',
                  'container_class' => 'navbar-collapse collapse navbar-inverse-collapse',
                  'menu_class' => 'nav navbar-nav',
                  'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                  //Process nav menu using our custom nav walker
                  'walker' => new wp_bootstrap_navwalker())
                );
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>
		<div class="page-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-5 col-sm-6">
						<img src="<?php header_image(); ?>" title="<?php bloginfo('name'); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" class="img-responsive" alt="<?php bloginfo('name'); ?>">
					</div>
					<div class="col-lg-8 col-md-7 col-sm-6">
						<div class="well well-lg">Need help or someone to talk to?<br /> Call our crisis line anytime on <a class="btn btn-phone btn-lg btn-block" href="tel:<?php echo $options['localphone_setting']; ?>"><?php echo $options['localphone_setting']; ?></a> or freephone <a class="btn btn-phone btn-lg btn-block" href="tel:<?php echo $options['freephone_setting']; ?>"><?php echo $options['freephone_setting']; ?></a></div>
					</div>
				</div>
			</div>
		</div>

		<?php if( is_home() ) :  ?>
		<div class="refuge-banner">
			<div class="container">
				<div class="row">
					<?php echo do_shortcode('[image-carousel]'); ?>
				</div>
			</div>
		</div>
		<?php else : ?>
		<?php endif; ?>
		<div class="page-main">
			<div class="container">
