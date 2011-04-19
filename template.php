<?php
// $Id: template.php,v 1.1.2.7 2010/06/29 18:01:28 grendzy Exp $

/**
 * @file
 * Contains theme override functions and preprocess functions for the Boron theme.
 */

/**
 * Implements hook_html_head_alter().
 * We are overwriting the default meta character type tag with HTML5 version.
 */
function doune_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Changes the search form to use the "search" input element of HTML5.
 */
function doune_preprocess_search_block_form(&$vars) {
	$vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
	$vars['search_form'] = str_replace('value=""', 'placeholder="Search"', $vars['search_form']);
}

