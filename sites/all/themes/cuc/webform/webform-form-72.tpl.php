<?php
// $Id: 
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++  mhg:  copied from webform-form.tpl.php,v 1.1.2.4 2009/01/11 23:09:35 quicksketch Exp $
// ++        and modified to:
// ++          1-  include the javascript file
// ++          2- remove the label for word count field
// ++ 
// ++ 
// ++ 
// ++ 
// ++ 
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * @file
 * Customize the display of a complete webform.
 *
 * This file may be renamed "webform-form-[nid].tpl.php" to target a specific
 * webform on your site. Or you can leave it "webform-form.tpl.php" to affect
 * all webforms on your site.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 */
?>
<?php
  $module_path = drupal_get_path('theme', 'cuc');
  drupal_add_js($module_path . '/6-word-memoir.js');		/* mhg */

  // If editing or viewing submissions, display the navigation at the top.
  if (isset($form['submission_info']) || isset($form['navigation'])) {
    print drupal_render($form['navigation']);
    print drupal_render($form['submission_info']);
  }


  // mhg 3/28/09:  Remove label for word count field.
	unset($form['submitted']['word_count']['#title']);
  // mhg 4/1/09:  add calls to javascript functions
  	$form['submitted']['your_memoir']['#attributes'] = array( 'onChange' => 'wordcount( 6, \'edit-submitted-your-memoir\', event)',
																														'onKeyPress' => 'wordcount( 6, \'edit-submitted-your-memoir\', event)'
																													);
  // Print out the main part of the form.
  /*print drupal_render($form['submitted']);*/

  // Always print out the entire $form. This renders the remaining pieces of the
  // form that haven't yet been rendered above.
  print drupal_render($form);

  // Print out the navigation again at the bottom.
  if (isset($form['submission_info']) || isset($form['navigation'])) {
    unset($form['navigation']['#printed']);
    print drupal_render($form['navigation']);
  }
