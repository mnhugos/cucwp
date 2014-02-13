<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
/*
# ------------ Modification History ---------------------------------------------
#
# Date         Ref#   By 	Description
# -----------  ----  ---	-------------------------------------------------------
# 8-20-09      1     MHG	Print title if on individual blog entry, but not on summary teaser node
# 
#================================================================================
*/
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">

<?php print $picture ?>

<?php if ($page == 0): /* If this is the Front Page */?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>


<?php
/*******
#1:  Print title on the individual blog node, not the teaser summary blog node
*******/
	if ((!$teaser) && ($node->type == "blog"))
	{
		print( "<h1>" . $title . "</h1>");
	}
?>
  
	<?php
		// to use the standard drupal date format 'medium'
		//$formatted_date = format_date($node->created, 'medium');
		
		// to use a different drupal date such as 'small' or 'large'
		//$formatted_date = format_date($node->created, 'small');
		//$formatted_date = format_date($node->created, 'large');
		
		// to use a custom format
		//format_date($node->created, 'custom', 'D, j M, Y \a\\t G:i' );
		$formatted_date = format_date($node->created, 'custom', 'D, M/j/Y' );
	?>

 <span class="submitted"><?php print "posted " . $formatted_date ?></span>
  
  <div class="content clear-block">
    <?php print $content ?>
  </div>

  <div class="clear-block">
    <div class="meta">
    <?php if ($taxonomy): ?>
      <div class="terms"><?php print $terms ?></div>
    <?php endif;?>
    </div>

    <?php if ($links): ?>
      <div class="links"><?php print $links; ?></div>
    <?php endif; ?>
  </div>

</div>
