<?php $theme->display('header'); ?>

<div id="maincontent">
	<?php echo $theme->content($post); ?>
</div>

<aside id="sidebar">
	<?php echo $theme->area('sidebar'); ?>
	<section class="upcoming">
		<h1>Upcoming Events</h1>
		<ol>
			<li><b>Oct 25<sup>th</sup></b> - <a href="/user/themes/elks/events/lodgemeeting.ics">Lodge Meeting</a>
				<small>8:00 pm</small>
			</li>
			<li><b>Oct 28<sup>th</sup></b> - <a href="#">Kids Halloween Party</a>
				<small>noon</small>
			</li>
			<li><b>Oct 28<sup>th</sup></b> - <a href="#">SB Party -bring a covered dish</a>
				<small>1:05 pm</small>
			</li>
			<li><b>Oct 30<sup>th</sup></b> - <a href="#">Burger Night</a>
				<small>6:00 pm</small>
			</li>
		</ol>
	</section>
</aside>


<?php $theme->display('footer'); ?>