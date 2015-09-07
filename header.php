<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
  <head>
    <meta charset="utf-8" />
    <meta name='robots' content='noindex,follow' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if ( is_category() ) {
      echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
    } elseif ( is_tag() ) {
      echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
    } elseif ( is_archive() ) {
      wp_title(''); echo ' Archive | '; bloginfo( 'name' );
    } elseif ( is_search() ) {
      echo 'Search for &quot;'.esc_html($s).'&quot; | '; bloginfo( 'name' );
    } elseif ( is_home() || is_front_page() ) {
      bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
    }  elseif ( is_404() ) {
      echo 'Error 404 Not Found | '; bloginfo( 'name' );
    } elseif ( is_single() ) {
      wp_title('');
    } else {
      echo wp_title( ' | ', 'false', 'right' ); bloginfo( 'name' );
    } ?></title>
    
  <script src="//www.washington.edu/static/alert.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ; ?>/css/app.css" />
      
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri() ?>/assets/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri() ?>/assets/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/assets/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri() ?>/assets/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/assets/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri() ?>/assets/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/assets/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri() ?>/assets/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() ?>/assets/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri() ?>/assets/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() ?>/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri() ?>/assets/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() ?>/assets/img/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri() ?>/assets/img/manifest.json">
    <meta name="msapplication-TileColor" content="#4b2e84">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri() ?>/assets/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#4b2e84">
      
    <!--<script type="text/javascript" src="//use.typekit.net/dyq8fxo.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>-->

  
    <?php wp_head(); ?>
      
    
  </head>
  <body <?php body_class(); ?>>
  
  <div class="skipnav"><a href="#main-col">Skip to main content</a> <a href="#footer">Skip to footer unit links</a></div>
  <?php do_action('foundationPress_after_body'); ?>
  
  <div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">
  
  <?php do_action('foundationPress_layout_start'); ?>
  
  <nav class="tab-bar hide-for-medium-up">
    <div class="left-small mobile-logo-container">
        <a href="<?php bloginfo('url') ?>" rel="home" title="<?php bloginfo('name') ?>"><svg id="mobile-logo" width="73" height="49" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 73 49" xml:space="preserve">
              <path id="XMLID_14_" class="st0" d="M53.5,0c0,0.6,0,8.3,0,8.8c0.6,0,6.2,0,6.2,0l-6.9,25.8c0,0-8.5-34.2-8.6-34.6c-0.5,0-8.5,0-9,0
  c-0.1,0.5-9.3,34.6-9.3,34.6L19.5,8.8c0,0,5.9,0,6.5,0c0-0.6,0-8.3,0-8.8C25.3,0,0.6,0,0,0c0,0.6,0,8.3,0,8.8c0.6,0,5.7,0,5.7,0
  s9.9,39.7,10,40.2c0.5,0,13.5,0,13.9,0c0.1-0.5,6.6-25.3,6.6-25.3s6.2,24.8,6.3,25.3c0.5,0,13.5,0,13.9,0
  c0.1-0.5,10.6-40.2,10.6-40.2s5.1,0,5.7,0c0-0.6,0-8.3,0-8.8C72.3,0,54.1,0,53.5,0z"/>
</svg>
</svg></a>
    </div>
    <div class="middle tab-bar-section">
      <h1 class="title"><a href="<?php bloginfo('url') ?>" rel="home" title="<?php bloginfo('name') ?>"><?php bloginfo( 'name' ); ?></a></h1>
    </div>
    <div class="right-small">
      <a class="right-off-canvas-toggle menu-icon" ><span><i></i></span></a>
    </div>
  </nav>

  <aside class="right-off-canvas-menu">
    <nav class="mobile-menu">
            <?php
            echo '<ul class="off-canvas-list"><li>';
            get_search_form();
            echo '</li></ul>';
            
            add_filter( 'page_css_class', 'add_parent_class', 10, 4 );
            $exclude = implode(',',coenv_base_menu_exclude());
            wp_list_pages( array(
                'depth' => 0,
                'walker' => new top_bar_mobile_walker(),
                'title_li' => false,
                'sort_column' => 'menu_order, post_title',
                'post_type'    => 'page',
                'exclude' => $exclude,
            ) );
            remove_filter( 'page_css_class', 'add_parent_class', 10, 4 );
            echo '<ul class="off-canvas-list"><li>';
           ?>


          
                <a class="primary-link columns small-9" href="/intranet/quicklinks/">
                    <div class="parent">Quick Links</div>
                </a>
                <div class="accordion" data-accordion="">
                  <div class="accordion-navigation">
                      <a class="right columns small-3 expander-link" href="#accordion-50"> </a>
                  </div>
                </div>
           



       



                
    </nav>
    <?php foundationPress_mobile_off_canvas(); ?>
  </aside>

  <nav id="top-nav" class="show-for-medium-up">
    <div class="row">
      <div class="top-menu normal-top-menu">
        <?php wp_nav_menu(array(
          'theme_location' => 'uw-links',
          'depth' => 1,
          'menu_id' => 'menu-university',
          'container' => false,
          'fallback_cb' => false
        )) ?> 
        
          <?php wp_nav_menu(array(
          'theme_location' => 'top-links', 
          'depth' => 1,
          'menu_id' => 'menu-top',
          'container' => false, 
          'walker' => new CoEnv_Top_Menu_Walker(),
          'fallback_cb' => false
        )); ?>

        <?php get_search_form() ?>

        <?php wp_nav_menu(array(
          'theme_location' => 'top-buttons', 
          'depth' => 1, 
          'menu_id' => 'menu-buttons',
          'container' => false,
          'fallback_cb' => false
        )); ?>

      </div><!-- .top-menu -->
    </div><!-- .row -->
  </nav><!-- #top-nav -->
  <div class="full-header show-for-medium-up">
    <div class="row title-row">
      <div class="columns large-12">
          <div id="desktop-logo">
          <a href="<?php bloginfo('url') ?>" rel="home" title="<?php bloginfo('name') ?>">
            <!--[if gte IE 9 | !IE]><!-->
                <svg class="left" width="157" height="106" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 108 73" enable-background="new 0 0 108 73" xml:space="preserve">
                  <path d="M79.343,0.112c0,0.858,0,12.238,0,13.098c0.856,0,9.206,0,9.206,0L78.271,51.461
                    c0,0-12.577-50.636-12.756-51.349c-0.687,0-12.626,0-13.303,0c-0.188,0.696-13.796,51.352-13.796,51.352L28.95,13.21
                    c0,0,8.726,0,9.585,0c0-0.859,0-12.239,0-13.098c-0.919,0-37.532,0-38.451,0c0,0.858,0,12.238,0,13.098c0.851,0,8.52,0,8.52,0
                    s14.703,58.809,14.88,59.522c0.708,0,19.942,0,20.639,0c0.183-0.697,9.852-37.454,9.852-37.454s9.188,36.747,9.364,37.454
                    c0.707,0,19.941,0,20.639,0C84.164,72.03,99.635,13.21,99.635,13.21s7.6,0,8.449,0c0-0.859,0-12.239,0-13.098
                    C107.176,0.112,80.251,0.112,79.343,0.112z"/>
                </svg></a>
            <!-- <![endif]-->
            <!--[if lte IE 8]>
                <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/W.png" id="desktop-logo">
            <![endif]-->
            </div>
            <div class="unit-name left">
            <h1 class="left"><a href="<?php bloginfo('url') ?>" rel="home" title="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a></h1> 
            </div>
          <div class="unit-wrapper show-for-large-up left">
              <div class="units">
                <a class="logotype-college" href="http://coenv.uw.edu" title="UW College of the Environment"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/logotype-college.png" class="right" alt="UW College of the Environment"></a><br />
                <a class="logotype-uw" href="http://uw.edu" title="University of Washington"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/logotype-uw.png" class="right uw-name" alt="University of Washington"></a>
              </div>
          </div> 
      </div>
    </div>
  </div>
  
        <div class="top-bar-container show-for-medium-up">
            <nav class="top-bar" data-topbar="">
                <div class="top-bar-section">
                    <ul id="menu-main-menu" class="top-bar-menu">
                    <?php
                      $exclude = implode(',',coenv_base_menu_exclude());
                      add_filter( 'page_css_class', 'add_parent_class', 10, 4 );
                      wp_list_pages( array(
                          'depth' => 3,
                          'walker' => new top_bar_new_walker(),
                          'title_li' => false,
                          'sort_column' => 'menu_order, post_title',
                          'post_type'    => 'page',
                          'exclude' => $exclude,
                      ) );
                      remove_filter( 'page_css_class', 'add_parent_class', 10, 4 );
                      wp_reset_query();
                      ?>
                    </ul>
                </div>
            </nav>
        </div>

<?php if (!is_front_page()) : ?>
<div class="container">
<?php 
        $banner = coenv_banner();
        $banner_class = $banner ? 'has-banner' : '';
        $banner_class .= ' template-print';
        $coenv_post = get_post($id);
        $coenv_post_section = get_post(array_pop(get_post_ancestors($id)));
?>
    <?php 
        if (is_search()) {
          $banner_style = '';
        } elseif (($banner) && (!is_single())) {
            $banner_style = 'style="background-image: url(' . $banner['url'] . ')"';
        } elseif ($coenv_post->post_type == 'faculty' || $coenv_post->post_type == 'post') {
            $banner_style = 'style="background-image: url(' . $banner['url'] . ')"';
        } elseif ($coenv_post->post_type == 'post') {
            $banner_style = 'style="background-image: url(\'../uploads/sites/4/2014/08/SAFS_News.jpg\')"';
        }
     ?>
    <div class="section-row" <?php echo $banner_style; ?>>
      <div class="container-section-title">
        <?php 
        
        if (is_404()) {
          $section_title = '<h1>Not Found (404)</h1>';
        } elseif (is_search()) {
          $section_title = '<h1>Search Results</h1>';
        } elseif (!is_front_page() && !is_single() && ($coenv_post_section->ID == $coenv_post->ID)) {
          $section_title = '<h1><a href="/' . $coenv_post_section->post_name . '">' . $coenv_post_section->post_title . '</a></h1>';
        } elseif ($coenv_post->post_type == 'faculty') {
          $section_title = '<h2><a href="/faculty-research">Faculty &amp; Research</a></h2>';
        } elseif ($coenv_post->post_type == 'student_blog') {
          $section_title = '<h2><a href="/news-events/student-services-blog/">Student Services Blog</a></h2>';
        } elseif ($coenv_post->post_type == 'post') {
          $section_title = '<h2><a href="/news-events">News &amp; Events</a></h2>';
        } else {
          $section_title = '<h1>' . $coenv_post->post_title . '</h1>';
        }
        echo $section_title;
        ?>
      </div>
    </div>

</div>
<?php endif; ?>
<?php do_action('foundationPress_after_header'); ?>