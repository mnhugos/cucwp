<?php
/**
 * @file
 * header_slideshow.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function header_slideshow_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'header_slideshow_images';
  $view->description = 'Shows images set for the header slideshow';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Header Slideshow Images';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Header Slideshow Images';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['style_plugin'] = 'flexslider';
  $handler->display->display_options['style_options']['optionset'] = 'homepage_flexslider';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['exclude'] = TRUE;
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['link_to_node'] = FALSE;
  /* Field: Content: Slideshow image */
  $handler->display->display_options['fields']['field_slideshow_image']['id'] = 'field_slideshow_image';
  $handler->display->display_options['fields']['field_slideshow_image']['table'] = 'field_data_field_slideshow_image';
  $handler->display->display_options['fields']['field_slideshow_image']['field'] = 'field_slideshow_image';
  $handler->display->display_options['fields']['field_slideshow_image']['label'] = '';
  $handler->display->display_options['fields']['field_slideshow_image']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_slideshow_image']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_slideshow_image']['settings'] = array(
    'image_style' => 'header_slideshow_image',
    'image_link' => '',
  );
  /* Field: Content: Image text */
  $handler->display->display_options['fields']['field_text_for_image']['id'] = 'field_text_for_image';
  $handler->display->display_options['fields']['field_text_for_image']['table'] = 'field_data_field_text_for_image';
  $handler->display->display_options['fields']['field_text_for_image']['field'] = 'field_text_for_image';
  $handler->display->display_options['fields']['field_text_for_image']['label'] = '';
  $handler->display->display_options['fields']['field_text_for_image']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_text_for_image']['element_wrapper_class'] = 'transparent_class';
  /* Field: Content: Sequence number */
  $handler->display->display_options['fields']['field_sequence_number']['id'] = 'field_sequence_number';
  $handler->display->display_options['fields']['field_sequence_number']['table'] = 'field_data_field_sequence_number';
  $handler->display->display_options['fields']['field_sequence_number']['field'] = 'field_sequence_number';
  $handler->display->display_options['fields']['field_sequence_number']['label'] = '';
  $handler->display->display_options['fields']['field_sequence_number']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_sequence_number']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_sequence_number']['settings'] = array(
    'thousand_separator' => ' ',
    'prefix_suffix' => 1,
  );
  /* Sort criterion: Content: Sequence number (field_sequence_number) */
  $handler->display->display_options['sorts']['field_sequence_number_value']['id'] = 'field_sequence_number_value';
  $handler->display->display_options['sorts']['field_sequence_number_value']['table'] = 'field_data_field_sequence_number';
  $handler->display->display_options['sorts']['field_sequence_number_value']['field'] = 'field_sequence_number_value';
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'header_slideshow_image' => 'header_slideshow_image',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;

  /* Display: Page */
  $handler = $view->new_display('page', 'Page', 'page');
  $handler->display->display_options['path'] = 'header-slideshow-images';

  /* Display: Frontpage header block */
  $handler = $view->new_display('block', 'Frontpage header block', 'block_1');
  $translatables['header_slideshow_images'] = array(
    t('Master'),
    t('Header Slideshow Images'),
    t('more'),
    t('Apply'),
    t('Reset'),
    t('Sort by'),
    t('Asc'),
    t('Desc'),
    t('Page'),
    t('Frontpage header block'),
  );
  $export['header_slideshow_images'] = $view;

  return $export;
}
