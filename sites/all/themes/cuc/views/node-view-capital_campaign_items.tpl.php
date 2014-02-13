<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
/*
# ------------ Modification History ---------------------------------------------
#
# Date         Ref#   By 	Description
# -----------  ----  ---	-------------------------------------------------------
# 1-16-10      1     MHG	Modify the way the Capital Campaigns summary list is displayed
# 
#================================================================================
*/

?>
<div id="node-<?php print $node->nid; ?>" class="node-report-teaser<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">
<div class="w1">
<div class="w2">
<div class="w3">
<div class="w4">

<?php print $picture ?>

<h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>

  <?php if ($submitted): 									/* mhg: Remove time and username, and leave just the day and date */
  		$pos = strpos( $submitted, "-");
		$submitted = substr( $submitted, 0, ($pos-1));
  ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>

  <div class="content clear-block">
    <?php print $content ?>
  </div>

  <div class="clear-block">
    <?php if ($links): ?>
      <div class="links"><?php print str_replace( "Read more", "Read entire report...", $links); 	/* mhg: replace the "read more" text */?>
	  </div>		
    <?php endif; ?>
</div>

</div>
</div>
</div>
</div>
</div>