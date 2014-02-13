<?php
// $Id: template.php,v 1.16.2.1 2009/02/25 11:47:37 goba Exp $

/**
 * Sets the body-tag class attribute.
 *
 * Adds 'sidebar-left', 'sidebar-right' or 'sidebars' classes as needed.
 */
/**
 * Format a username.
 *
 * @param $object
 *   The user object to format, usually returned from user_load().
 * @return
 *   A string containing an HTML link to the user's page if the passed object
 *   suggests that this is a site user. Otherwise, only the username is returned.
 */
 /******************************************************************************
8-12-09 #1 	Override core function for creating username.  Want to get rid of
               "not verified" after anonymous username
9-22-09 #2	Override filefield function in order to add target attribute to <a> tag
1-18-10 #3  If in forum comments wrapper, make div id "comments-forum"
3-03-10 #4  Added "cuc_theme" and a hook: "cuc_comment_form"


*******************************************************************************/
drupal_add_css('sites/all/libraries/jquery.ui/themes/default/ui.all.css');

/* development versions */
//drupal_add_js('sites/all/libraries/jquery.ui/ui/jquery.ui.all.js');
//drupal_add_js('sites/all/libraries/jquery.ui/ui/ui.core.js');
//drupal_add_js('sites/all/libraries/jquery.ui/ui/ui.tabs.js');

/* minified versions*/
drupal_add_js('sites/all/libraries/jquery.ui/ui/minified/jquery.ui.all.min.js');
drupal_add_js('sites/all/libraries/jquery.ui/ui/minified/ui.core.min.js');
drupal_add_js('sites/all/libraries/jquery.ui/ui/minified/ui.tabs.min.js');




/************************  O V E R R I D E   F U N C T I O N S  ************************/

/*----------------------------   C U C _ T H E M E    ---------------------------------
/**
 * Implementation of HOOK_theme().
 */
function cuc_theme(&$existing, $type, $theme, $path) {
  // Add your theme hooks like this:
  /*  $hooks['hook_name_here'] = array( // Details go here );  */
	
  $hooks['comment_form'] = array( 'arguments' => array( 'form' => NULL ));			// #4
  $hooks['forum_topic_navigation'] = array( 'arguments' => array( 'node' => NULL));			// #4
  $hooks['user_login_block'] = array( 'template' => 'user-login-block', 'arguments' => array('form' => NULL));
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/*----------------------------   C U C _ U S E R _ L O G I N _ B L O C K    ---------------------------------*/
function cuc_preprocess_user_login_block( &$variables)
{
    $variables['intro_text'] = t('Members only');
    $variables['rendered'] = drupal_render($variables['form']);
}
/*----------------------------   C U C _ C O M M E N T _ F O R M    ---------------------------------
/************************************************************
 #4:  This is a theme hook into the submit-a-comment form.  This form is contained within 'box' div.
      This hook is declared above in cuc_theme()
*************************************************************/
function cuc_comment_form( $form)
{
  // Wrap the intro in a div for themeing.
  $form['intro']['#prefix']  = '<div class="comment-guidelines">';
  $form['intro']['#suffix']  = '</div>';
  // Weight it so it floats to the top.
  $form['intro']['#weight']  = -40;
  
	// Make the text-area smaller.
  $form['comment_filter']['comment']['#rows']   = 5;
  // Change the text-area title
  $form['comment_filter']['comment']['#title']  = t('Your comment');
  // Add a div wrapper for themeing.
  $form['comment_filter']['comment']['#prefix'] = '<div class="comment-form-prefix">';
  $form['comment_filter']['comment']['#suffix'] = '</div>';
  // Remove input formats information.
  $form['comment_filter']['format'] = NULL;
  //dsm($form);
	
	/* print dvm($form); // For debugging only */
	unset ($form['homepage']);		// Remove homepage form element
	unset ($form['mail']);				// Remove email form element
	$form['name']['#description'] = '(Your name lends a little more weight to comments)';
	/*$form['submit']['#value'] = "Submit";*/
	
  return drupal_render($form);
}	

/*----------------------------   C U C _ F O R U M _ T O P I C _ N A V I G A T I O N    ---------------------------------
/************************************************************
 This is a theme hook into the submit-a-comment form.  This form is contained with 'box' div
 This hook is declared above in andi_theme()
*************************************************************/
function cuc_forum_topic_navigation()
{
	return "";   /* Basically, don't print the topic nav line.  Too cluttering and confusing */
}

/*----------------------------   C U C _ P R E P R O C E S S _ B O X    ---------------------------------
/************************************************************
 #2: Added: 3-9-10.  overrides 
*************************************************************/
function cuc_preprocess_box( &$vars, $hook)
{
	switch($vars['title']) 
	{
	  case 'Post new comment':
  		$vars['title'] = t('Add your thoughts...');
  }
}


/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function andi_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */


/*----------------------------   C U C _ F I L E F I E L D _ F I L E    ---------------------------------
/************************  PHPTEMPLATE_FILEFIELD  #2 ************************/
/**
 * Theme function for the 'generic' single file formatter.
 */
function cuc_filefield_file($file) {
  // Views may call this function with a NULL value, return an empty string.
  if (empty($file['fid'])) {
    return '';
  }

  $path = $file['filepath'];
  $url = file_create_url($path);
  $icon = theme('filefield_icon', $file);

  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  // TODO: Possibly move to until I move to the more complex format described 
  // at http://darrelopry.com/story/microformats-and-media-rfc-if-you-js-or-css
  $options = array(
    'attributes' => array(
      'type' => $file['filemime'] . '; length=' . $file['filesize'],
	  'target' => '_blank',				/*  #2:  added new window target */
    ),
  );

  // Use the description as the link text if available.
  if (empty($file['data']['description'])) {
    $link_text = $file['filename'];
  }
  else {
    $link_text = $file['data']['description'];
    $options['attributes']['title'] = $file['filename'];
  }

  return '<div class="filefield-file clear-block">'. $icon . l($link_text, $url, $options) .'</div>';
}


/************************  C U C _ U S E R N A M E  #1 ************************/
/**********************************************
*	This function was copied from "drupal/includes/theme.inc" where all theme functions exist.
*	I'm overriding "theme_username()" by calling this one "cuc_username", i.e. 'cuc' is the name of the theme used
*	on the site.
**********************************************/
function cuc_username($object) {

  if ($object->uid && $object->name) {
    // Shorten the name when it is too long or it will break many tables.
    if (drupal_strlen($object->name) > 20) {
      $name = drupal_substr($object->name, 0, 15) .'...';
    }
    else {
      $name = $object->name;
    }

    if (user_access('access user profiles')) {
      $output = l($name, 'user/'. $object->uid, array('attributes' => array('title' => t('View user profile.'))));
    }
    else {
      $output = check_plain($name);
    }
  }
  else if ($object->name) {
    // Sometimes modules display content composed by people who are
    // not registered members of the site (e.g. mailing list or news
    // aggregator modules). This clause enables modules to display
    // the true author of the content.
    if (!empty($object->homepage)) {
      $output = l($object->name, $object->homepage, array('attributes' => array('rel' => 'nofollow')));
    }
    else {
      $output = check_plain($object->name);
    }

//    $output .= ' ('. t('not verified') .')';   /* #1: commented this line out*/
  }
  else {
    $output = variable_get('anonymous', t('Anonymous'));
  }

  return $output;
}

/*******  B A S E   F U N C T I O N S  ****************/

/*----------------------------   P H P T E M P L A T E _ B O D Y _ C L A S S    ---------------------------------
*/
function phptemplate_body_class($left, $right) {
  if ($left != '' && $right != '') {
    $class = 'sidebars';
  }
  else {
    if ($left != '') {
      $class = 'sidebar-left';
    }
    if ($right != '') {
      $class = 'sidebar-right';
    }
  }

  if (isset($class)) {
    print ' class="'. $class .'"';
  }
}

/**
/*----------------------------   P H P T E M P L A T E _ B R E A D C R U M B    ---------------------------------
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' › ', $breadcrumb) .'</div>';
  }
}

/**
/*----------------------------   P H P T E M P L A T E _ C O M M E N T _ W R A P P E R     ---------------------------------
* This wraps the entire comments section (not including the comment submit form).
* This replaces any execution of comment-wrapper.tpl.php
*/
function phptemplate_comment_wrapper( $content, $node) 
{
	$text = 'Reader Comments ';
	$count = comment_num_all( $node->nid);		// Get count of all comments associated with this node
	if ($count > 0)                						// Display "Reader Comments (n)" only if comments exist
		$text .= '(' . $count . ')';
	else
		$text .= '(no reader comments, yet)';
		
  return '<div id="forum-comments">
  	        <h2>'. t($text) .'</h2>'	. 
						$content .
  			 '</div>';
}

/*----------------------------  C U C_ C O M M E N T _ S U B M I T T E D    ---------------------------------
/**
 * Theme a "Submitted by ..." notice.
 *
 * @param $comment
 *   The comment.
 * @ingroup themeable
/******************************************************
/*  Taken from 	modules/comment/comment.module
/*  mhg:   add class to username field & custom format the date
 *******************************************************/
function cuc_comment_submitted($comment) {
  return t('@datetime | <span class="username">submitted by <b>!username</b></span>',
    array(
      '!username' => theme('username', $comment),
      '@datetime' => format_date($comment->timestamp, $type = 'custom', $format = 'F j, Y')
    ));
}


/**
/*----------------------------   P H P T E M P L A T E _ P R E P R O C E S S _ P A G E    ---------------------------------
 * Override or insert PHPTemplate variables into the templates.
 */
function phptemplate_preprocess_page(&$vars) {
  $vars['tabs2'] = menu_secondary_local_tasks();

  // Hook into color.module
  if (module_exists('color')) {
    _color_page_alter($vars);
  }
}

/**
/*----------------------------   P H P T E M P L A T E _ M E N U _ L O C A L _ T A S K S    ---------------------------------
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs. Overridden to split the secondary tasks.
 *
 * @ingroup themeable
 */
function phptemplate_menu_local_tasks() {
  return menu_primary_local_tasks();
}


/*----------------------------   P H P T E M P L A T E _ N O D E _ S U B M I T T E D    ---------------------------------
*/
function phptemplate_node_submitted($node) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $node),
      '!datetime' => format_date($node->created),
    ));
}

/**
/*----------------------------   P H P T E M P L A T E _ G E T _ I E _ S Y T L E S    ---------------------------------
 * Generates IE CSS links for LTR and RTL languages.
 */
function phptemplate_get_ie_styles() {
  global $language;

  $iecss = '<link type="text/css" rel="stylesheet" media="all" href="'. base_path() . path_to_theme() .'/fix-ie.css" />';
  if ($language->direction == LANGUAGE_RTL) {
    $iecss .= '<style type="text/css" media="all">@import "'. base_path() . path_to_theme() .'/fix-ie-rtl.css";</style>';
  }

  return $iecss;
}
