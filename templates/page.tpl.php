<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 */
?>

  <div id="page" class="container">

    <header role="banner" class="<?php print $header_banner_classes; ?>">

      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <?php if ($site_name || $site_slogan): ?>
        <hgroup id="name-and-slogan">
          <?php if ($site_name): ?>
            <h1 id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
            </h1>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <h2 id="site-slogan"><?php print $site_slogan; ?></h2>
          <?php endif; ?>
        </hgroup> <!-- /#name-and-slogan -->
      <?php endif; ?>

      <?php print render($page['header']); ?>

    </header> <!-- /header -->

    <div id="navigation-wrapper" class="<?php print $navigation_wrapper_classes; ?>">
      <?php if ($main_menu || $secondary_menu): ?>
        <nav role="navigation">
          <?php print $main_menu_rendered; ?>
          <?php print $secondary_menu_rendered; ?>
        </nav> <!-- /nav -->
      <?php endif; ?>

      <?php if ($breadcrumb): ?>
        <nav id="breadcrumb"><?php print $breadcrumb; ?></nav>
      <?php endif; ?>
    </div>

    <?php print $messages; ?>

    <div id="main-wrapper" class="clearfix">

      <div role="main" class="<?php print $main_classes; ?>">
        <?php print render($page['highlighted']); ?>
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if ($tabs = render($tabs)): ?><div class="tabs"><?php print $tabs; ?></div><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links = render($action_links)): ?><ul class="action-links"><?php print $action_links; ?></ul><?php endif; ?>
        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
      </div> <!-- /main -->

      <?php print render($page['sidebar_first']); ?>

      <?php print render($page['sidebar_second']); ?>

    </div> <!-- /#main -->

    <?php print render($page['footer']); ?>

  </div> <!-- /#page -->
