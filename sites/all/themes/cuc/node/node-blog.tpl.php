<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
/*
  
  This prints the summary teasers page as well as each full individual blog entry page.


# ------------ Modification History ---------------------------------------------
#
# Date         Ref#   By 	Description
# -----------  ----  ---	-------------------------------------------------------
# 8-20-09      1     MHG	Print title if on individual blog entry, but not on summary teaser node
# 9-03-09			 		Copied this from node.tpl.php in order to custom theme the blog node
# 9-03-09					Use "blog-teaser-title" class for h2
#							Use "cuc-blog" class for node
#11-02-09		2	MHG		Comment out the title logic. Now using built-in logic for printing titles
#================================================================================
*/
?>
<div id="node-<?php print $node->nid; ?>" class="cuc-blog<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">
<div class="w1">
<div class="w2">
<div class="w3">
<div class="w4">

<?php print $picture ?>

  <h2 id="blog-teaser-title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>

<?php
/*******
#1:  Print <h1> title only on the individual blog node, not on the teaser blog node which lists all entries
*******/
/*	if (!$teaser)
	{
		print( "<h1>" . "Carol's Blog" . "</h1>");
	}*/
?>
  <?php if ($submitted): ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>

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
</div>
</div>
</div>
</div>
