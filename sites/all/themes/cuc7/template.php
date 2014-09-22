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
        drupal_add_js(path_to_theme() . '/js/functions.js');
        drupal_add_js( path_to_theme() . '/webform/js/pledge_form.js');
        drupal_add_css( path_to_theme() . '/css/cuc7-webform-pledge.css');
      }
      if ($variables['node']->nid == '437') {  // RE Registration Form
        drupal_add_library('system','ui.tabs');
//        drupal_add_js( path_to_theme() . '/webform/js/re_registration_form.js');
//        drupal_add_css( path_to_theme() . '/css/cuc7-webform-re-registration.css');
        drupal_add_js( path_to_theme() . '/webform/js/re_registration_form.js');
        drupal_add_css( path_to_theme() . '/css/cuc7-webform-re-registration.css');
      }
       if ($variables['node']->nid == '484') {  // RE Registration Form
        drupal_add_css( path_to_theme() . '/css/cuc7-webform-journey-group-signup.css');
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
  if ($form_id == 'webform_client_form_437') {
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
    // *****  J O U R N E Y   G R O U P   R E G I S T R A T I O N   F O R M  ******

  if ($form_id == 'webform_client_form_484') {
//    $form['submitted']['email']['#attributes']['class'][] = "one_fifth";
//    $form['submitted']['telephone']['#attributes']['class'][] = "one_fifth";
//    $form['submitted']['first_group_choice']['#attributes']['class'][] = "full-width";
  }
}

// this theme function was copied from modules/contrib/webform/webform.module and overridden
function cuc7_webform_element($variables) {
  // Ensure defaults.
  $variables['element'] += array(
    '#title_display' => 'before',
  );

  $element = $variables['element'];

  // All elements using this for display only are given the "display" type.
  if (isset($element['#format']) && $element['#format'] == 'html') {
    $type = 'display';
  }
  else {
    $type = (isset($element['#type']) && !in_array($element['#type'], array('markup', 'textfield', 'webform_email', 'webform_number'))) ? $element['#type'] : $element['#webform_component']['type'];
  }

  // Convert the parents array into a string, excluding the "submitted" wrapper.
  $nested_level = $element['#parents'][0] == 'submitted' ? 1 : 0;
  $parents = str_replace('_', '-', implode('--', array_slice($element['#parents'], $nested_level)));

  $wrapper_classes = array(
   'form-item',
   'webform-component',
   'webform-component-' . $type,
  );
  if (($element['#webform_component']['nid'] == 484)  && (in_array( $element['#title'], array( 'Email', 'Telephone')))) {
    $wrapper_classes[] = 'one_third';
  }
  if (($element['#webform_component']['nid'] == 484)  && (in_array( $element['#title'], array( 'First Group Choice')))) {
    $wrapper_classes[] = 'full-width';
  }
  if (isset($element['#title_display']) && strcmp($element['#title_display'], 'inline') === 0) {
    $wrapper_classes[] = 'webform-container-inline';
  }
  $output = '<div class="' . implode(' ', $wrapper_classes) . '" id="webform-component-' . $parents . '">' . "\n";

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }
  $prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . _webform_filter_xss($element['#field_prefix']) . '</span> ' : '';
  $suffix = isset($element['#field_suffix']) ? ' <span class="field-suffix">' . _webform_filter_xss($element['#field_suffix']) . '</span>' : '';

  switch ($element['#title_display']) {
    case 'inline':
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', $variables);
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;

    case 'after':
      $output .= ' ' . $prefix . $element['#children'] . $suffix;
      $output .= ' ' . theme('form_element_label', $variables) . "\n";
      break;

    case 'none':
    case 'attribute':
      // Output no label and no required marker, only the children.
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
  }

  if (!empty($element['#description'])) {
    $output .= ' <div class="description">' . $element['#description'] . "</div>\n";
  }

  $output .= "</div>\n";

  return $output;
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