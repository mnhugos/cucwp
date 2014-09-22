<?php

/**
 * @file
 * Template for displaying the agenda in a block
 */

drupal_add_js("/sites/all/modules/contrib/jquery_update/replace/ui/ui/jquery-ui.js");
// Build some neat dates.
$dates[date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1))] = t('Yesterday' . ' (' . date('F jS') . ')');
$dates[date('Y-m-d', mktime(0, 0, 0))] = t('Today' . ' (' . date('F jS') . ')');
$dates[date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 1))] = t('Tomorrow' . ' (' . date('F jS',  mktime(0, 0, 0, date("m"), date("d") + 1)) . ')');

// List of keys to display.
$keys    = array_map('trim', explode(',', $block->display_keys));
$nolabel = array_map('trim', explode(',', $block->hide_labels));
?>

<div>
  <button id="say_it">Say "Hello!"</button>
  <div id="hello" title="Hello  World!"><p>Hey, world, I just said "Hello!"</p></div>
  <strong>​For additional events and details, read our&nbsp;<a href="newsletters">MONTHLY NEWSLETTER</a></strong>
</div>
<hr />
<div class="agenda-block">
  <?php foreach ($events as $day): ?>
  <?php
  $date = $day[0]['start date'];

  // Substitute today/yesterday/tomorrow.
  if (isset($dates[$day[0]['when']])) {
    $date = $dates[$day[0]['when']];
  }
  ?>
  <p><?php echo $date; ?></p>
  <ol>
  <?php foreach ($day as $event): ?>
    <li class="cal_<?php echo $event['index']; ?>">
      <span class="calendar_title"><?php echo $event['title']; ?></span>
      <ul class="moreinfo">
        <?php foreach ($keys as $key): ?>
          <?php if (!empty($event[$key])): ?>
            <li class=" <?php echo strtolower(str_replace( ' ', '-', _agenda_translate($key))); ?> "
                        <?php if ($key == 'where') echo ' style="display:none;"'?>
            >
            <?php if (!in_array($key, $nolabel)): ?>
              <em><?php echo _agenda_translate($key); ?></em>:
            <?php endif; ?>
            <?php echo $event[$key]; ?>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>

      </ul>
    </li>
  <?php endforeach; ?>
  </ol>
<?php endforeach; ?>
</div>
