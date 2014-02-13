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
    if ($variables['node']->nid == '432') {  // Pledge Form
        drupal_add_js( path_to_theme() . '/webform/js/pledge_form.js');
    }
}

function cuc7_form_alter( &$form, &$form_state, $form_id) {
    if ($form_id == 'webform_client_form_432') {  // Pledge Form
        $form['#attributes']['class'][] = 'pledge-form';
    }
}