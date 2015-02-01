<?php
/**
 * @file
 * ruauu_and_login.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function ruauu_and_login_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'block_ruauu_body';
  $strongarm->value = array(
    'value' => '<div class="questions"><strong><span>Do you want a place that&hellip;</span></strong>
	<ul>
		<li>respects <em>differences</em><span style="color:#FFFFFF;"><em> </em></span>between people and affirms every person as an individual?</li>
		<li>values <em>children</em>, welcomes them on their own terms, and offers a place they are eager to attend?</li>
		<li>cherishes <em>freedom </em>and encourages <em>open dialogue</em> on questions of faith?</li>
		<li>affirms spiritual exploration and <em>reason </em>as ways of finding truth?</li>
		<li>accepts a <em>diversity </em>of theology, and welcomes people who may or may not believe in a higher power?</li>
		<li>acts <em>locally </em>and thinks <em>globally </em>on the great issues of our time:&nbsp; world peace; women&rsquo;s rights; racial justice; homelessness; LBGT rights; and protection of the environment?</li>
		<li>reveres <em>nature </em>as a part of its principles?</li>
		<li>provides <em>comfort and support</em> so you can carry on when difficult things happen in your life or in the world?</li>
		<li><em>honors </em>the differing religious beliefs of you and your loved one?</li>
		<li>welcomes your <em>non-traditional</em> family?</li>
	</ul>
	<strong><span><em><strong>If your answer is &ldquo;yes&rdquo; to a number of these questions, come explore Community Unitarian Church at White Plains. Our <a href="visitors-newcomers">visitors page</a> contains helpful information.</strong></em></span></strong></div>
',
    'format' => '2',
  );
  $export['block_ruauu_body'] = $strongarm;

  return $export;
}
