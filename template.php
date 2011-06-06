<?php
/**
 * @file
 * Theme override and preprocess functions for Doune.
 */

/**
 * Implements hook_css_alter(). Borrowed from Tao.
 *
 * Omitted:
 * - color.css
 * - contextual.css
 * - dashboard.css
 * - field_ui.css
 * - image.css
 * - locale.css
 * - shortcut.css
 * - simpletest.css
 * - toolbar.css
 */
function doune_css_alter(&$css) {
  $exclude = array(
    'misc/vertical-tabs.css' => FALSE,
    'modules/aggregator/aggregator.css' => FALSE,
    'modules/block/block.css' => FALSE,
    'modules/book/book.css' => FALSE,
    'modules/comment/comment.css' => FALSE,
    'modules/dblog/dblog.css' => FALSE,
    'modules/file/file.css' => FALSE,
    'modules/filter/filter.css' => FALSE,
    'modules/forum/forum.css' => FALSE,
    'modules/help/help.css' => FALSE,
    'modules/menu/menu.css' => FALSE,
    'modules/node/node.css' => FALSE,
    'modules/openid/openid.css' => FALSE,
    'modules/poll/poll.css' => FALSE,
    'modules/profile/profile.css' => FALSE,
    'modules/search/search.css' => FALSE,
    'modules/statistics/statistics.css' => FALSE,
    'modules/syslog/syslog.css' => FALSE,
    'modules/system/admin.css' => FALSE,
    'modules/system/maintenance.css' => FALSE,
    'modules/system/system.css' => FALSE,
    'modules/system/system.admin.css' => FALSE,
    'modules/system/system.base.css' => FALSE,
    'modules/system/system.maintenance.css' => FALSE,
    'modules/system/system.menus.css' => FALSE,
    'modules/system/system.messages.css' => FALSE,
    'modules/system/system.theme.css' => FALSE,
    'modules/taxonomy/taxonomy.css' => FALSE,
    'modules/tracker/tracker.css' => FALSE,
    'modules/update/update.css' => FALSE,
    'modules/user/user.css' => FALSE,
  );
  $css = array_diff_key($css, $exclude);
}

/**
 * Implements hook_html_head_alter().
 * Overwrite the default meta character type tag with HTML5 version.
 */
function doune_html_head_alter(&$head_elements) {
  // Borrowed from Boron
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Preprocess variables for html.tpl.php.
 */
function doune_preprocess_html(&$vars) {
  // Borrowed from AdaptiveTheme
  $vars['rdf'] = new stdClass();
  if (module_exists('rdf')) {
    $vars['doctype'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML+RDFa 1.1//EN">' . "\n";
    $vars['rdf']->version = ' version="HTML+RDFa 1.1"';
    $vars['rdf']->namespaces = $vars['rdf_namespaces'];
    $vars['rdf']->profile = ' profile="' . $vars['grddl_profile'] . '"';
  } else {
    $vars['doctype'] = '<!DOCTYPE html>' . "\n";
    $vars['rdf']->version = '';
    $vars['rdf']->namespaces = '';
    $vars['rdf']->profile = '';
  }
}

/**
 * Preprocesses variables for page template.
 */
function doune_preprocess_page(&$vars) {
  $vars['main_menu_rendered'] = theme('links__system_main_menu', array(
    'links' => $vars['main_menu'],
    'attributes' => array(
      'id' => 'main-menu',
      'class' => array('links', 'inline', 'clearfix'),
    ),
    'heading' => array(
      'text' => t('Main menu'),
      'level' => 'h2',
      'class' => array('element-invisible'),
    ),
  ));

  $vars['secondary_menu_rendered'] = theme('links__system_secondary_menu', array(
    'links' => $vars['secondary_menu'],
    'attributes' => array(
      'id' => 'secondary-menu',
      'class' => array('links', 'inline', 'clearfix'),
    ),
    'heading' => array(
      'text' => t('Secondary menu'),
      'level' => 'h2',
      'class' => array('element-invisible'),
    ),
  ));

  $vars['title_tabs_content_wrapper_classes'] = implode(' ', _doune_region_classes('title_tabs_content'));
}

/**
 * Determines classes for a region wrapper based on current layout.
 */
function _doune_region_classes($region) {
  $layouts = _doune_layouts();
  $layout = doune_active_layout();
  return isset($layouts[$layout][$region]) ? $layouts[$layout][$region] : array();
}

/**
 * Retrieves the name of the currently active layout.
 */
function doune_active_layout() {
  static $layout;
  // determine the layout
  if (!isset($layout)) {
    $layout = 'default';
    if (module_exists('context_layouts') && ($layout_info = context_layouts_get_active_layout())) {
      $layout = $layout_info['layout'];
    }
  }
  return $layout;
}

/**
 * Returns all Doune layouts registered by modules and themes.
 */
function _doune_layouts() {
  static $layouts;
  if (!isset($layouts)) {
    // We supply default layouts
    $layouts = array(
      'default' => array(
        'title_tabs_content' => array('eight', 'columns', 'push-by-four'),
        'sidebar_first' => array('four', 'columns', 'pull-by-eight'),
        'sidebar_second' => array('four', 'columns'),
      ),
      'thin_and_thick' => array(
        'title_tabs_content' => array('eight', 'columns', 'push-by-three'),
        'sidebar_first' => array('three', 'columns', 'pull-by-eight'),
        'sidebar_second' => array('five', 'columns'),
      ),
    );

    // Give other extensions a chance to add and modify layouts
    drupal_alter('doune_layouts', $layouts);
  }
  return $layouts;
}

/**
 * Preprocesses variables for regions.
 */
function doune_preprocess_region(&$vars) {
  $vars['classes_array'] = array_merge($vars['classes_array'], _doune_region_classes($vars['region']));
}

/**
 * Changes the search form to use the "search" input element of HTML5.
 */
function doune_preprocess_search_block_form(&$vars) {
  // Borrowed from Boron
  $vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
  $vars['search_form'] = str_replace('value=""', 'placeholder="Search"', $vars['search_form']);
}

