<?php
/**
 * @file
 * Theme override and preprocess functions for Doune.
 */

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
 * Changes the search form to use the "search" input element of HTML5.
 */
function doune_preprocess_search_block_form(&$vars) {
  // Borrowed from Boron
  $vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
  $vars['search_form'] = str_replace('value=""', 'placeholder="Search"', $vars['search_form']);
}

