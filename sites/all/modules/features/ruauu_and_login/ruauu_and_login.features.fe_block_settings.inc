<?php
/**
 * @file
 * ruauu_and_login.features.fe_block_settings.inc
 */

/**
 * Implements hook_default_fe_block_settings().
 */
function ruauu_and_login_default_fe_block_settings() {
  $export = array();

  $export['version'] = '2.0';

  $export['block-homepage_main_block'] = array(
    'cache' => -1,
    'custom' => 0,
    'machine_name' => 'homepage_main_block',
    'module' => 'block',
    'node_types' => array(),
    'pages' => '<front>',
    'roles' => array(),
    'themes' => array(
      'cuc7' => array(
        'region' => 'content',
        'status' => 1,
        'theme' => 'cuc7',
        'weight' => -46,
      ),
      'garland' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'garland',
        'weight' => 0,
      ),
      'skeletontheme' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'skeletontheme',
        'weight' => 0,
      ),
    ),
    'title' => '',
    'visibility' => 1,
  );

  $export['block-ministers'] = array(
    'cache' => -1,
    'custom' => 0,
    'machine_name' => 'ministers',
    'module' => 'block',
    'node_types' => array(),
    'pages' => '<front>',
    'roles' => array(),
    'themes' => array(
      'cuc7' => array(
        'region' => 'content',
        'status' => 1,
        'theme' => 'cuc7',
        'weight' => -44,
      ),
      'garland' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'garland',
        'weight' => 0,
      ),
      'skeletontheme' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'skeletontheme',
        'weight' => 0,
      ),
    ),
    'title' => '',
    'visibility' => 1,
  );

  $export['ruauu-ruauu'] = array(
    'cache' => 1,
    'custom' => 0,
    'delta' => 'ruauu',
    'module' => 'ruauu',
    'node_types' => array(),
    'pages' => '<front>',
    'roles' => array(),
    'themes' => array(
      'cuc7' => array(
        'region' => 'content',
        'status' => 1,
        'theme' => 'cuc7',
        'weight' => -45,
      ),
      'garland' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'garland',
        'weight' => 0,
      ),
      'skeletontheme' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'skeletontheme',
        'weight' => 0,
      ),
    ),
    'title' => 'Are you a Unitarian Universalist?  Find out...',
    'visibility' => 1,
  );

  return $export;
}
