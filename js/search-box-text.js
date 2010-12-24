// $Id$

/**
 * Autofills search box with 'Search this site' when empty
 * and clears 'Search this site' when focused.
 */
Drupal.behaviors.searchFormText = function(context) {
  var searchText = Drupal.t('Search this site'),
      $input = $('.block-search .form-text'),
      faded = '#999',
      color = $input.css('color');

  $input.val('').bind('load blur', function() {
    if ($(this).val() == '' ) {
      $(this).val(searchText).css('color', faded);
    }
  });
  $input.val(searchText).css('color', faded).focus(function() {
    if ($(this).val() == searchText) {
      $(this).val('').css('color', color);
    }
  });
}
