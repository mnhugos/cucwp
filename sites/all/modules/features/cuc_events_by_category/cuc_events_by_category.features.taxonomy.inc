<?php
/**
 * @file
 * cuc_events_by_category.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function cuc_events_by_category_taxonomy_default_vocabularies() {
  return array(
    'event_categories' => array(
      'name' => 'Event Categories',
      'machine_name' => 'event_categories',
      'description' => 'Types of events that may be listed on this site',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
    ),
  );
}
