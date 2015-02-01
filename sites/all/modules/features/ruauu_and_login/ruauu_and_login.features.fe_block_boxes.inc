<?php
/**
 * @file
 * ruauu_and_login.features.fe_block_boxes.inc
 */

/**
 * Implements hook_default_fe_block_boxes().
 */
function ruauu_and_login_default_fe_block_boxes() {
  $export = array();

  $fe_block_boxes = new stdClass();
  $fe_block_boxes->info = 'Homepage content -- topmost';
  $fe_block_boxes->format = '2';
  $fe_block_boxes->machine_name = 'homepage_main_block';
  $fe_block_boxes->body = '<div id="home-content-top">
	<div class="one_third" id="home_chalice"><img alt="" src="/sites/default/files/images/cuc-chalice-logo.png" /></div>

	<div class="two_thirds center" id="title">
		<h1>Community Unitarian Church at White Plains</h1>

		<div class="boxed center rtecenter" style="margin: 1em 0em;"><strong>Worship &amp; Childcare<br />
			&nbsp;Sundays at 10:00am</strong></div>
	</div>
</div>

<div class="clearfix">&nbsp;</div>

<div>
	<p>Community Unitarian Church (CUC) is a Welcoming Congregation committed to affirming and purposefully including all regardless of age, race, ethnicity, national origin, disability, gender, gender identity or expression, and sexual or affectional orientation.</p>

	<div id="mission">
		<p><span>Our mission</span></p>

		<div class="rteindent1"><strong>Nurture each other in our spiritual journeys,</strong><br />
			<strong>Foster compassion and understanding within and beyond our community, and</strong><br />
			<strong>Engage in service to transform ourselves and our world.</strong></div>
	</div>

	<div class="clearfix">&nbsp;</div>
</div>
';

  $export['homepage_main_block'] = $fe_block_boxes;

  $fe_block_boxes = new stdClass();
  $fe_block_boxes->info = 'Minister and DLRE Pictures';
  $fe_block_boxes->format = '2';
  $fe_block_boxes->machine_name = 'ministers';
  $fe_block_boxes->body = '<div class="page-section" id="minister-dre">
	<h2>Minister and LRE Director</h2>

	<ul>
		<li class="one_half"><a href="minister-and-staff#meredith-garmon"><img alt="Rev. Meredith Garmon" src="/sites/default/files/images/meredith-garmon.jpg" /></a><br />
			<strong><a href="minister-and-staff#meredith-garmon">Reverend Meredith Garmon</a></strong></li>
		<li class="one_half"><a href="minister-and-staff#perry-montrose"><img alt="" src="/sites/default/files/images/perry-montrose.jpg" /></a><br />
			<a href="minister-and-staff#perry-montrose"><strong>Perry Montrose</strong></a><br />
			Director of Lifespan <a href="religious-education">Religious Education</a> and Faith Development</li>
	</ul>
</div>
';

  $export['ministers'] = $fe_block_boxes;

  return $export;
}
