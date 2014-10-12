<?php
/**
 * @file
 * cuc_events_by_category.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function cuc_events_by_category_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function cuc_events_by_category_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function cuc_events_by_category_node_info() {
  $items = array(
    'cuc_event' => array(
      'name' => t('CUC Event'),
      'base' => 'node_content',
      'description' => t('Any CUC event that has a day, time, or range of dates that should have a customized write-up (e.g. if the Google calendar entry is not enough)'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
