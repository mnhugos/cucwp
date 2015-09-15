<?php
/**
 * Created by PhpStorm.
 * User: mhugos
 * Date: 9/23/14
 * Time: 11:35 AM
 */
?>
<div id="wrap">
    <div class="container">

        <!------------------------------------------------------ #header-top -->
        <?php if ($page['header_top_left'] || $page['header_top_right']): ?>
        <div id="header-top" class="sixteen columns clearfix">

            <?php if ($page['header_top_left'] && $page['header_top_right']) { ?>
            <div class="one_third">
            <?php print render($page['header_top_left']); ?>
            </div>

            <div class="two_thirds last">
            <?php print render($page['header_top_right']); ?>
            </div>
            <?php } else { ?>

            <?php print render($page['header_top_left']); ?>
            <?php print render($page['header_top_right']); ?>

            <?php } ?>

        </div><!-- /#header-top -->
        <?php endif; ?>

        <div class="clear"></div>

        <!------------------------------------------------------- #header -->
        <?php if ($page['header_right']) { ?>
          <div id="header" class="five columns clearfix">
		    <?php } else { ?>
          <div id="header" class="sixteen columns clearfix">
        <?php } ?>
        <?php
          if (!drupal_is_front_page()) {
            print "<a id='header-home-link' href='" . $front_page . "'><img src='/sites/all/themes/cuc7/images/head-logo-cuuc.png'></a>";
          }
          else {
            $block = module_invoke( 'views', 'block_view', 'header_slideshow_images-block_1');
            print render($block);
          }
        ?>
            <div class="inner">
                <?php if ($logo): ?>
                  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
                    <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
                  </a>
                <?php endif; ?>
                <?php if ($site_name || $site_slogan): ?>
                <div id="name-and-slogan"<?php if ($hide_site_name && $hide_site_slogan) { print ' class="element-invisible"'; } ?>>

                    <?php if ($site_name): ?>
                    <div id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a>
                    </div>
                    <?php endif; ?>

                    <?php if ($site_slogan): ?>
                    <div id="site-slogan"<?php if ($hide_site_slogan) { print ' class="element-invisible"'; } ?>>
                    <?php print $site_slogan; ?>
                    </div>
                    <?php endif; ?>

                </div>
                <?php endif; ?>
            </div>
        </div><!-- /#header -->

        <!----------------------------------------- #header-right -->
        <?php if ($page['header_right']) : ?>
          <div id="header-right" class="eleven columns clearfix">
            <div class="inner">
			        <?php print render($page['header_right']); ?>
        	  </div>
          </div><!-- /#header-right -->
        <?php endif; ?>

        <div class="clear"></div>

        <!--------------------------------------------- #navigation -->
        <div id="navigation" class="fourteen columns">

            <div class="menu-header">
            <?php if ($page['header']) : ?>
                <?php print drupal_render($page['header']); ?>
                <?php else : ?>
                <?php
//				if (module_exists('i18n_menu')) {
//				    $main_menu_tree = i18n_menu_translated_tree( variable_get( 'menu_main_links_source', '$main_menu'));
//				} else {
//				    $main_menu_tree = menu_tree( variable_get( 'menu_main_links_source', '$main_menu'));
//				} ?>
<!--				<div class="content">-->
<!--				--><?php //print drupal_render($main_menu_tree); // MHG: this only renders child elements for current page's menu item
//                                                    // MHG: update -- except if "show expanded" is set within the list item page in admin > menu ?>
<!--<!--				-->--><?php ////print drupal_render( $variables['menu_expanded']); /// This renders child elements for all menu items (per cuc7_preprocess_page())
//                                                                          //     regardless of "show as expanded" setting ?>
        </div>
            <?php endif; ?>
            </div>
        </div><!-- /#navigation -->
        <div id="social" class="two columns clearfix">
          <ul>
            <li><a class="twitter" href="https://twitter.com/CUCWP" target="_blank">Twitter</a></li>
            <li><a class="facebook" href="https://www.facebook.com/pages/Community-Unitarian-Church/117976408214797" target="_blank">Facebook</a></li>
            <li><a class="googleplus" href="https://plus.google.com/110306245059058702672" target="_blank">Google+</a></li>
          </ul>
        </div>

        <!------------------------------------------ #sidebar-first -->
        <?php // this page can't have a left sidebar -- not enough room on the page ?>

        <!---- Set width of Main Content DIV -->
        <?php if ($page['sidebar_second']) { // page has right sidebar...?>
          <div id="content" class="eight columns">
		    <?php } else {  // page has no sidebars... ?>
          <div id="content" class="sixteen columns clearfix">
        <?php } ?>

          <!------------------------------------------ messages -->
            <?php if ($messages): ?>
                <div id="messages">
                <?php print $messages; ?>
                </div><!-- /#messages -->
            <?php endif; ?>

          <!------------------------------------------ #breadcrumb -->
            <?php if ($breadcrumb): ?>
                <div id="breadcrumb" class=""><?php print $breadcrumb; ?></div>
            <?php endif; ?>

          <!------------------------------------------ main content -->
            <div id="main">

                <?php if ($page['highlighted']): ?><div id="highlighted" class="clearfix"><?php print render($page['highlighted']); ?></div><?php endif; ?>

                <?php print render($title_prefix); ?>

                <?php if ($title): ?>
                <h1 class="title" id="page-title">
                    <?php print $title; ?>
                </h1>
                <div class="clearfix"></div>
                <?php endif; ?>

                <?php print render($title_suffix); ?>

             <?php if ($tabs): ?>
                <div class="tabs">
                  <?php print render($tabs); ?>
                </div>
                <?php endif; ?>

                <?php print render($page['help']); ?>

                <?php if ($action_links): ?>
                <ul class="action-links">
                  <?php print render($action_links); ?>
                </ul>
                <?php endif; ?>

                <?php print render($page['content']); ?>
                <?php print $feed_icons; ?>

            </div>

        </div><!-- /#content -->

        <!------------------------------------------ #sidebar-second -->
        <?php if ($page['sidebar_second']): ?>
        <!-- #sidebar-second -->
        <div id="sidebar-second" class="eight columns">
            <?php print render($page['sidebar_second']); ?>
        </div><!-- /#sidebar-second -->
        <?php endif; ?>

        <div class="clear"></div>

        <?php if ($page['featured_left'] || $page['featured_right']): ?>
        <!-- #featured -->
        <div id="featured" class="sixteen columns clearfix">

            <?php if ($page['featured_left'] && $page['featured_right']) { ?>
            <div class="one_half">
            <?php print render($page['featured_left']); ?>
            </div>

            <div class="one_half last">
            <?php print render($page['featured_right']); ?>
            </div>
            <?php } else { ?>

            <?php print render($page['featured_left']); ?>
            <?php print render($page['featured_right']); ?>

            <?php } ?>

        </div><!-- /#featured -->
        <?php endif; ?>

	</div>

	<div id="footer" >
        <div class="container">
        	<div class="sixteen columns clearfix">

                <div class="one_third">
                <?php if ($page['footer_first']): ?><?php print render($page['footer_first']); ?><?php endif; ?>
                </div>

                <div class="one_third">
                <?php if ($page['footer_second']): ?><?php print render($page['footer_second']); ?><?php endif; ?>
                </div>

                <div class="one_third last">
                <?php if ($page['footer_third']): ?><?php print render($page['footer_third']); ?><?php endif; ?>
                </div>

                <div class="clear"></div>

                <?php if ($page['footer']): print render($page['footer']); endif; ?>

                <div class="clear"></div>

                <div id="credits">
                    <?php print( 'Copyright ' . date('Y') . ' ');?>
                    <?php if (!empty($site_name)):
                        print $site_name;?>
                    <?php endif;?>
                    <?php
                      print ('All Rights Reserved');
                    ?>
                </div>
        	</div>
        </div>
    </div>

</div> <!-- /#wrap -->