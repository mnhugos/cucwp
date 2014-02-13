<div id="wrap">
    <div class="container">

        <div id="fb-root"></div>
        <div id="fb-root"></div>
        <div id="fb-root"></div>

        <?php // ---------------------------- social tags ---------------------?>
        <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <?php // --------------------------- END  social tags ---------------------?>


        <?php if ($page['header_top_left'] || $page['header_top_right']): ?>
        <!-- #header-top -->
        <div id="header-top" class="sixteen columns clearfix">
            
            <?php if ($page['header_top_left'] && $page['header_top_right']) { ?>
            <div class="one_half">
            <?php print render($page['header_top_left']); ?>
            </div>
            
            <div class="one_half last">
            <?php print render($page['header_top_right']); ?>
            </div>
            <?php } else { ?>
                
            <?php print render($page['header_top_left']); ?>
            <?php print render($page['header_top_right']); ?>
            
            <?php } ?>
            
        </div><!-- /#header-top -->
        <?php endif; ?>
        
        <div class="clear"></div>
        
        <!-- #header -->
        <?php if ($page['header_right']) { ?>
        <div id="header" class="five columns clearfix">
		<?php } else { ?>
        <div id="header" class="sixteen columns clearfix">   
        <?php } ?>
        <?php
            print "<a id='header-home-link' href='" . $front_page . "'></a>";
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
        
        <?php if ($page['header_right']) : ?>
        <!-- #header-right -->
        <div id="header-right" class="eleven columns clearfix">
        
        	 <div class="inner">
			<?php print render($page['header_right']); ?>
        	</div>
            
        </div><!-- /#header-right -->
        <?php endif; ?>
        
        <div class="clear"></div>
        
        <!-- #navigation -->
        <div id="navigation" class="sixteen columns clearfix">
        
            <div class="menu-header">
            <?php if ($page['header']) : ?>
                <?php print drupal_render($page['header']); ?>
                <?php else : ?>
                <?php 
				if (module_exists('i18n_menu')) {
				    $main_menu_tree = i18n_menu_translated_tree( variable_get( 'menu_main_links_source', '$main_menu'));
				} else {
				    $main_menu_tree = menu_tree( variable_get( 'menu_main_links_source', '$main_menu'));
				} ?>
				<div class="content">
<!--				--><?php //print drupal_render($main_menu_tree); // this only renders child elements for current page's menu item ?>
				<?php print drupal_render( $variables['menu_expanded']); /// This renders child elements for all menu items (per cuc7_preprocess_page())?>
                </div>
            <?php endif; ?>
            </div>
            
        </div><!-- /#navigation -->

        <!-- #social-follow-tabs -->
<!--        <div id="social-follow-tabs">-->
<!--            <ul class="social">-->
<!--                <li><div class="fb-like" data-href="https://www.facebook.com/pages/Community-Unitarian-Church/117976408214797" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div></li>-->
<!--                <li><a href="https://twitter.com/CUCWP" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @CUCWP</a>-->
<!--                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>-->
<!--                <li><div class="g-follow" data-href="https://plus.google.com/110306245059058702672" data-annotation="none" data-rel="publisher"></div></li>-->
<!--            </ul>-->
<!--        </div>-->
        <!-- /#social-follow-tabs -->
        <!-- #social-tabs -->
<!--        <div id="social-tabs">-->
<!--            <ul class="social">-->
<!--                <li><a href="https://twitter.com/CUCWP" class="twitter" target="_blank">Twitter</a></li>-->
<!--                <li><a href="https://www.facebook.com/pages/Community-Unitarian-Church/117976408214797" class="facebook" target="_blank">Facebook</a></li>-->
<!--                </li><li><a href="https://plus.google.com/110306245059058702672" class="googleplus" target="_blank">Google+</a></li>-->
<!--            </ul>-->
<!--        </div>-->
        <!-- /#social-tabs -->




        <?php if ($page['sidebar_first']): ?>
        <!-- #sidebar-first -->
        <div id="sidebar-first" class="five columns">
            <?php print render($page['sidebar_first']); ?>
        </div><!-- /#sidebar-first -->
        <?php endif; ?>
        
        <?php if ($page['sidebar_first'] && $page['sidebar_second']) { ?>
        <div id="content" class="six columns">
        <?php } elseif ($page['sidebar_first'] || $page['sidebar_second']) { ?>
        <div id="content" class="eleven columns">
		<?php } else { ?>
        <div id="content" class="sixteen columns clearfix">    
        <?php } ?>
        
            <?php if ($messages): ?>
                <div id="messages">
                <?php print $messages; ?>
                </div><!-- /#messages -->
            <?php endif; ?>
        
            <?php if ($breadcrumb): ?>
                <div id="breadcrumb"><?php print $breadcrumb; ?></div>
            <?php endif; ?>
            
            <div id="main">
            
                <?php if ($page['highlighted']): ?><div id="highlighted" class="clearfix"><?php print render($page['highlighted']); ?></div><?php endif; ?>
                
                <?php print render($title_prefix); ?>
                
                <?php if ($title && !drupal_is_front_page()): ?>
                <h1 class="title" id="page-title">
                  <?php print $title; ?>
                </h1>
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
        
        <?php if ($page['sidebar_second']): ?>
        <!-- #sidebar-first -->
        <div id="sidebar-second" class="five columns">
            <?php print render($page['sidebar_second']); ?>
        </div><!-- /#sidebar-first -->
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
                    <?php print(date('Y') . ' ');?>
                    <?php if (!empty($site_name)):
                        print $site_name;?>
                    <?php endif;?>
                </div>
        	</div>
        </div>
    </div>
    
</div> <!-- /#wrap -->