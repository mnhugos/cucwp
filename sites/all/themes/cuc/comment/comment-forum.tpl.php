<?php
// $Id: comment.tpl.php,v 1.10 2008/01/04 19:24:24 goba Exp $
/***********************************************************************************************************************
*    mhg: Copied from comment.tpl.php                                                       				
*         Prints individual comment
 ***********************************************************************************************************************/
/**
 * Available variables:
 * - $author: Comment author. Can be link or plain text.
 * - $content: Body of the post.
 * - $date: Date and time of posting.
 * - $links: Various operational links.
 * - $new: New comment marker.
 * - $picture: Authors picture.
 * - $signature: Authors signature.
 * - $status: Comment status. Possible values are:
 *   comment-unpublished, comment-published or comment-preview.
 * - $submitted: By line with date and time.
 * - $title: Linked title.
 *
 * These two variables are provided for context.
 * - $comment: Full comment object.
 * - $node: Node object the comments are attached to.
 *
 * @see template_preprocess_comment()
 * @see theme_comment()
# ------------ Modification History ----------------------------------------------
#
# Date			Ref# 	By 		Description
# --------	----	---		------------------------------------------------------
# ?					#1		MHG		Add divs for rounded corners
# 						
#================================================================================

 */
?>
<div class="cuc-forum-comment<?php print ($comment->new) ? ' comment-new' : ''; print ' '. $status; print ' '. $zebra; ?>">
<?php /*<div class="w1">
<div class="w2">
<div class="w3">
<div class="w4">*/
?>

<?php  /*print_r($node); */   /*  Use this to print info on the node */      ?>

  <div class="clear-block">
  <?php if ($submitted): ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>

  <?php if ($comment->new) : ?>
    <span class="new"><?php print drupal_ucfirst($new) ?></span>
  <?php endif; ?>

  <?php print $picture ?>

    <h3><?php /* print $title */ ?></h3>

    <div class="content">
      <?php print $content ?>
      <?php if ($signature): ?>
      <div class="clear-block">
        <div>—</div>
        <?php print $signature ?>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <?php if ($links): ?>
    <div class="links"><?php print $links ?></div>
  <?php endif; ?>
  
<?php /*</div>
</div>
</div>
</div>*/ ?>
</div>
