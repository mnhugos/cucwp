<?php
/**
 * Created by PhpStorm.
 * User: mgold
 * Date: 1/30/14
 * Time: 3:03 PM
 */

/* This preprocessor will allow Drupal to render ALL child items for all parent elements in the main menu
   The default for Drupal is that it renders child elements only for the current page's menu item */
function cuc7_preprocess_page( &$variables) {
    $main_menu_tree = menu_tree_all_data('main-menu');
    $variables['menu_expanded'] = menu_tree_output($main_menu_tree);

    if (isset ($variables['node'])){
      if ($variables['node']->nid == '432') {  // Pledge Form
        drupal_add_js( path_to_theme() . '/webform/js/pledge_form.js');
      }
      if ($variables['node']->nid == '437') {  // RE Registration Form
        drupal_add_library('system','ui.tabs');
        drupal_add_js( path_to_theme() . '/webform/js/re_registration_form.js');
        drupal_add_css( path_to_theme() . '/css/webform-re-registration.css');
      }
    }
}

// Customize menu links for just the Main Menu
//  This hook will be called for each Main Menu item and will iteratively be called for each sub-menu item
function cuc7_menu_link__main_menu( $variables)
{
    $element    = $variables['element'];
    $sub_menu   = '';

    if ($element['#below']) {
        $sub_menu = drupal_render($element['#below']);   // rendering will also call this function, fyi
    }

    $link = l($element['#title'], $element['#href']);
    $link_text = '<li' . drupal_attributes($element['#attributes']) . '>' . $link . $sub_menu . "</li>";
    return $link_text;
}

function cuc7_form_alter( &$form, &$form_state, $form_id) {
    if ($form_id == 'webform_client_form_432') {  // Pledge Form
        $form['#attributes']['class'][] = 'pledge-form';
    }
}

function cuc7_preprocess_node( &$variables) {
  if ($variables['teaser']) {
    // Add a custom teaser template to theme suggestions array.  This will cause Drupal
    // to look for that template if we are in teaser mode.
    $variables['theme_hook_suggestions'][] = 'node__' . $variables['node']->type . '_teaser';
  }
}

//*** override of core's theme_field for the photo-gallery body (insert a 'clearfix' class)
function cuc7_field__body__photo_gallery( $variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';
  }

  // Render the items.
  $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
  foreach ($variables['items'] as $delta => $item) {
    $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
    $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
  }
  $output .= '</div>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . ' clearfix"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
}