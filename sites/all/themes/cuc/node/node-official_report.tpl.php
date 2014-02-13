<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
/*
# ------------ Modification History ---------------------------------------------
#
# Date         Ref#   By 	Description
# -----------  ----  ---	-------------------------------------------------------
# 1-16-10      1     MHG	Modified posted info to not display username or time
# 
#================================================================================
*/
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">

<?php print $picture ?>

<?php if ($page == 0): /* If this is the Front Page */?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>

  <?php if ($submitted): 									/* mhg: #1 -- Remove time and username, and leave just the day and date */
  		$pos = strpos( $submitted, "-");
		$submitted = substr( $submitted, 0, ($pos-1));
  ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>

  <div class="content clear-block">
    <?php print $content ?>
  </div>

<?php  /*  mhg: removed printing of any taxonomy links.  To reinsert, copy code from node.tpl.php   */   ?>

	<?php if ($links): ?>
      <div class="links"><?php print $links; ?></div>
    <?php endif; 	?>
	
  </div>

</div>