<?php
/*************************************************************************  
 Modification History
 Date      Code By  		Description
 --------  ---- --- 		---------------------------------------------
 11-02-09		#1	mhg			Made necessary changes to format page with built-in title logic
 												Replace "Blogs" with "Minister's Blog"
 10-14-10	#2	mhg				Removed printing of secondary links in header.
**************************************************************************/
?>


<!doctype html>

<html>
<head>
    <title><?php print $head_title ?></title>
    <?php print "
              <meta name=\"description\" content=\"Community Unitarian Church at White Plains is a welcoming liberal religious organization which embodies the ideals of world unity, justice and cooperative living. All are welcome here without distinction of race, class, gender, sexual orientation or creed.\" />
              <meta name=\"keywords\" content=\"Unitarian Universalist Church, religion, White Plains NY, liberal religion, same sex marriage\"/>"
    ?>
    <?php print $head ?>
    <?php print $styles ?>
    <!--[if IE]>
    <style>
      div#menu-bar
      {
        width: 932px;
      }
      div#webform-component-other
      {
        height:20px;
      }
    </style>
    <![endif]-->
    <!--[if lt IE 9]>
    <style>
      fieldset {
        background-position-y: 15px;
      }
    </style>
    <![endif] -->
    <?php print $scripts ?>
</head>
<body>
<?php /******************************************* I E   C O N D I T I O N A L   W R A P P E R : MHG 08-04-09 ************************************/ ?>
	<!--[if IE]>  
		<div id="IEroot">
	<![endif]-->  

<div id="container">
<?php /******************************************* H E A D E R ************************************/ ?>
	<div id="header">
    <div id="logo-floater">
    <?php
      // Prepare header
      $site_fields = array();
      if ($site_name) {
        $site_fields[] = check_plain($site_name);
      }
      if ($site_slogan) {
        $site_fields[] = check_plain($site_slogan);
      }
      $site_title = implode(' ', $site_fields);
      if ($site_fields) {
        $site_fields[0] = '<span>'. $site_fields[0] .'</span>';
      }
      $site_html = implode(' ', $site_fields);

      if ($logo || $site_title) {
        print '<a href="'. check_url($front_page) .'" title="'. $site_title .'">';
        if ($logo) {
          print '<img src="'. check_url($logo) .'" alt="'. $site_title .'" id="logo" />';
        }
        print $site_html .'</a>';
      }
//	  print '<div class="pageTitle">' . "  " . '</div>';  /*Fluke-y, I know, but needed for proper positioning of header elements. #1#*/
    ?>
    </div>   
			<?php /*#2*/ ?>
	</div>  <!-- /header -->
	
	
	<?php /***************************************  M E N U   B A R   ************************************/ ?>
	<div id="menu-bar">
<!--		--><?php //print $breadcrumb; ?>
	  <div id="primaryLinks">
	  	<?php if (isset($primary_links)) : ?>
	    	<?php print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
	    <?php endif; ?>
		</div>
	</div>

	<?php if ($left): /***********************  L E F T   S I D E B A R **********************/?>
	<div id="sidebar-left" class="sidebar">
	<?php if ($search_box) : ?> 
		<div class="block block-theme">
			<?php print $search_box ?>
    </div>
		<?php endif; ?>
		<?php print $left ?>
    <?php
//        if (!$user->uid) {
//            print drupal_get_form( 'user_login_block');
//        }
    ?>
	</div>
	<?php endif; ?>

	<?php /*******************************************  M A I N   C O N T E N T   A R E A   ************************************/ ?>
	<?php   //mhg: 09-01-08: narrower text area if right sidebar present
		if ($right)  : print '<div id="centerWrapper-narrow">'; endif; ?>
		<?php   //mhg: 09-01-08
			if (!$right) : 
				print '<div id="centerWrapper-wide">'; endif; 
		?>
		<div id="squeeze">
      <div class="right-corner">
        <div class="left-corner">
          <?php if ($mission): 	print '<div id="mission">'. $mission .'</div>'; endif; ?>
          <?php if ($tabs): print '<div id="tabs-wrapper" class="clear-block">'; endif; ?>
          <?php if ($tabs): print '<ul class="tabs primary">'. $tabs .'</ul></div>'; endif; ?>
          <?php if ($tabs2): print '<ul class="tabs secondary">'. $tabs2 .'</ul>'; endif; ?>

          <?php if ($show_messages && $messages): 		
          											print $messages; endif; ?>
          <?php print $help; ?>
		  <?php                          //mhg: 09-02-08: If narrower text area, keep margins as is in class 'clear-block'
			if ($right)  : 	print '<div class="clear-block">'; endif; ?>
      	  <?php	                     //mhg: 09-02-08: If wider text area, use new class to create left padding
			if (!$right) : 	print '<div class="clear-block-wide">'  ; endif; ?>
          <?php
            if (!$is_front) 
			  print '<h1>' . $title . '</h1>';  // #1: uncommented....mhg 3-11-09: Write title. Use Title field entered when page was created. ?>
     	  <?php print $memoir /*mhg: Use this region to place anything above the main content area (ignore the name)*/ ?>
    	  <?php print $content ?>
		</div>
        <?php print $feed_icons ?>
        <div id="footer">
        	<?php print $footer_message . $footer ?></div>
        </div>
  		</div>
  	</div><!-- /.left-corner, /.right-corner, /#squeeze  -->
	</div>
	
	<div id="rightColumn">
    <?php if ($right): ?>
      <div id="sidebar-right" class="sidebar">
        <?php if (!$left && $search_box): ?>
					<div class="block block-theme">
						<?php print $search_box ?>
					</div>
				<?php endif; ?>
        <?php print $right ?>
      </div>
    <?php endif; ?>
	</div>


</div>  <!-- container -->
<?php /******************************************* E N D  I E   C O N D I T I O N A L   W R A P P E R : MHG 08-04-09 ************************************/ ?>
	<!--[if IE]>
	  </div>
	<![endif]--> 
<?php print $closure; ?>

</body></html>