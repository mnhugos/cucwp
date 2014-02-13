<?php
// $Id: block.tpl.php,v 1.3 2007/08/07 08:39:36 goba Exp $
// mhg, 3/13/09: Copied this from sites/all/themes/cuc/block.tpl.php. and added the word "redblock" to the class list in the div section.?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="clear-block block block-<?php print $block->module ?> weatherwatch">

<?php if (!empty($block->subject)): ?>
  <h2><?php print $block->subject ?></h2>	<!-- This is "Block Title" in block edit page -->
<?php endif;?>

  <div class="content"><?php print $block->content ?></div>
</div>
