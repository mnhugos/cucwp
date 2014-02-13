<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
/*
# ------------ Modification History ---------------------------------------------
#
# Date         Ref#   By 	Description
# -----------  ----  ---	-------------------------------------------------------
# 11-02-10      1     MHG	Create
# 
#================================================================================
*/
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">

<?php print $picture ?>

<?php if ($page == 0): /* If this is the Front Page */?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>

  <?php if ($submitted): ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>

	<div class="field field-type-text field-field-sermon-author">
  	<div class="field-items">
      <div class="field-item" style="text-align:center;"><?php print $node->field_sermon_author[0]['view'] ?></div>
  	</div>
	</div>
	<div style="text-align:center;">Community Unitarian Church at White Plains<br />
    <?php 
			print $node->field_sermon_date[0]['view'];
		?>
		<p>&nbsp;<p>
	</div>
	<div><?php print $node->content['body']['#value']	?></div>
	
	<?php if ($links): ?>
      <div class="links"><?php print $links; ?></div>
    <?php endif; 	?>
	
  </div>

</div>