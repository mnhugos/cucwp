<?php
/**
 * @file
 * header_slideshow.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function header_slideshow_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "flexslider" && $api == "flexslider_default_preset") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function header_slideshow_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_image_default_styles().
 */
function header_slideshow_image_default_styles() {
  $styles = array();

  // Exported image style: header_slideshow_image.
  $styles['header_slideshow_image'] = array(
    'name' => 'header_slideshow_image',
    'label' => 'header_slideshow_image',
    'effects' => array(
      2 => array(
        'label' => 'Scale',
        'help' => 'Scaling will maintain the aspect-ratio of the original image. If only a single dimension is specified, the other dimension will be calculated.',
        'effect callback' => 'image_scale_effect',
        'dimensions callback' => 'image_scale_dimensions',
        'form callback' => 'image_scale_form',
        'summary theme' => 'image_scale_summary',
        'module' => 'image',
        'name' => 'image_scale',
        'data' => array(
          'width' => 940,
          'height' => '',
          'upscale' => 1,
        ),
        'weight' => 1,
      ),
      3 => array(
        'label' => 'Crop',
        'help' => 'Cropping will remove portions of an image to make it the specified dimensions.',
        'effect callback' => 'image_crop_effect',
        'dimensions callback' => 'image_resize_dimensions',
        'form callback' => 'image_crop_form',
        'summary theme' => 'image_crop_summary',
        'module' => 'image',
        'name' => 'image_crop',
        'data' => array(
          'width' => 940,
          'height' => 250,
          'anchor' => 'center-center',
        ),
        'weight' => 2,
      ),
    ),
  );

  return $styles;
}

/**
 * Implements hook_node_info().
 */
function header_slideshow_node_info() {
  $items = array(
    'header_slideshow_image' => array(
      'name' => t('Header Slideshow Image'),
      'base' => 'node_content',
      'description' => t('Images specifically for the header slideshow'),
      'has_title' => '1',
      'title_label' => t('Image Name'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
