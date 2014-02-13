<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
/*

This handles the display of the forum topic node.  Comments underneath are handled by
"comment-forum.tpl.php"


# ------------ Modification History ---------------------------------------------
#
# Date         Ref#   By 	Description
# -----------  ----  ---	-------------------------------------------------------
# 1-16-10      1     MHG	Modified posted info to not display username or time
# 3-5-10			 2		 MHG	Removed submitted date altogether.  Paste the following back if wanted, and place '<' & '>' where needed:
#													?php if ($submitted):
												  		$pos = strpos( $submitted, "-");
														$submitted = substr( $submitted, 0, ($pos-1));
												  ?
												  	<span class="submitted">?php print $submitted;?</span>
												  ?php endif;  ?

#================================================================================
*/
?>
<div id="node-<?php print $node->nid; ?>" class="cuc-forum<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; }?>">

<?php print $picture ?>

<?php  /*  #2: I've removed submitted date altogether   */  ?>
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
    <?php endif; 	?>
	
  </div>

</div>