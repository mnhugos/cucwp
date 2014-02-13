<?php
// $Id: block.tpl.php,v 1.3 2007/08/07 08:39:36 goba Exp $
// mhg, 3/13/09: Copied this from sites/all/themes/cuc/block.tpl.php. and added the word "blackblock" to the class list in the div section.
?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="clear-block block block-<?php print $block->module ?> slideshow">

<?php if (!empty($block->subject)): ?>  
	<?php if ($block->delta == "AnniversaryItems-block_1")
			print "<div class=''><a href='anniversary-item-list'>"
	?>
	<?php print $block->subject ?></a></div>
<?php endif;?>

<div class="content"><?php print $block->content ?></div>
<?php

// foreach ($block as $key => $val) /*  print out contents of block array  */
//{
//    print "$key = $val\n";
//} 
?>
</div>
