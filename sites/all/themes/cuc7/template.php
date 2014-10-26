<?php
/**
 * Created by PhpStorm.
 * User: mgold
 * Date: 1/30/14
 * Time: 3:03 PM
 */


function cuc7_preprocess_page( &$variables) {
    // Allow Drupal to render ALL child items for all parent elements in the main menu
    // The default for Drupal is that it renders child elements only for the current page's menu item */
    $main_menu_tree = menu_tree_all_data('main-menu');
    $variables['menu_expanded'] = menu_tree_output($main_menu_tree);

    // Do processing based on if a form is currently being displayed
    if (isset ($variables['node'])){
      if ($variables['node']->nid == '432') {  // Pledge Form
        drupal_add_js(path_to_theme() . '/js/functions.js');
        drupal_add_js( path_to_theme() . '/webform/js/pledge_form.js');
        drupal_add_css( path_to_theme() . '/css/cuc7-webform-pledge.css');
      }
      if ($variables['node']->nid == '437') {  // RE Registration Form
        drupal_add_library('system','ui.tabs');
        drupal_add_js( path_to_theme() . '/webform/js/re_registration_form.js');
        drupal_add_css( path_to_theme() . '/css/cuc7-webform-re-registration.css');
      }
      if ($variables['node']->title == 'Journey Group Signup') {  // Journey Group Signup Form
        drupal_add_css( path_to_theme() . '/css/cuc7-webform-journey-group-signup.css');

      }
    }
    if ($_SERVER['REQUEST_URI'] == '/journey-groups') {
      $variables['theme_hook_suggestions'][] = 'page__journeygroups';
    }
    if ($_SERVER['REQUEST_URI'] == '/cucs-goods-services-auction') {
      $variables['theme_hook_suggestions'][] = 'page__auction';
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

/**
 * Implements hook_form_alter.
 * node id's on both my local and production are the same (got lucky)
 */
function cuc7_form_alter( &$form, &$form_state, $form_id) {
  // *****  P L E D G E   F O R M  ********
  if ($form_id == 'webform_client_form_432') {
        $form['#attributes']['class'][] = 'pledge-form';
    }

  // *****  R E   R E G I S T R A T I O N   F O R M  ******
  // form_id = 'webform_client_form_437'
  // add custom class to the child info fieldsets, to be make them easier to identify for jQuery
  // Form_alter runs for ALL formS, so must check for which form is currently being processed.
  // NOTE: Possible to implement "hook_form_FORM_ID_alter" to create separate functions for specified forms, but won't yet...
  if ($form['#node']->title == 'RE Registration') {
    for( $i=1; $i<5; $i++ ){
      if ($form['submitted']['childchildren_information']['child_'.$i]) {  // if this child exists
        $form['submitted']['childchildren_information']['child_'.$i]['#attributes']['class'][] = "re-child";
      }
      else {
        $i = 5;
      }
    }
    // check Volunteer rows and add a class
    for( $i=1; $i<7; $i++ ){
      $form['submitted']['parent_participation']['row_'.$i]['col_1']['#prefix'] =  "<div class=\"option-rating\">";
      $form['submitted']['parent_participation']['row_'.$i]['col_1']['#suffix'] =  "</div>";
      $form['submitted']['parent_participation']['row_'.$i]['col_2']['#prefix'] =  "<div class=\"option-rating\">";
      $form['submitted']['parent_participation']['row_'.$i]['col_2']['#suffix'] =  "</div>";
      $form['submitted']['parent_participation']['row_'.$i]['col_3']['#prefix'] =  "<div class=\"option-desc\">";
      $form['submitted']['parent_participation']['row_'.$i]['col_3']['#suffix'] =  "</div>";
    }
  }
}

function cuc7_preprocess_node( &$variables) {
  if ($variables['teaser']) {
    // Add a custom teaser template to theme suggestions array.
    // (specifically included for photo gallery teaser mode)
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

function cuc7_breadcrumb( $variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Use CSS to hide titile .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // comment below line to hide current page to breadcrumb
//	$breadcrumb[] = drupal_get_title();  // Don't want this for cuc7 theme
    $output .= '<div class="breadcrumb">' . implode('<span class="sep">»</span>', $breadcrumb) . '</div>';
    return $output;
  }
}