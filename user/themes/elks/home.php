<?php $theme->display('header'); ?>

	<section class="features">
		<div class="feature">
			<h1>Events</h1>

			<p>The Elks organize regular <a href="#">charitable events</a> both locally and nationally.</p>
		</div>
		<div class="feature">
			<h1>Rental</h1>

			<p>Our banquet hall and party room are a great place to <a href="#">host your next special occasion</a>.</p>
		</div>
		<div class="feature">
			<h1>Membership</h1>

			<p>Members of our fraternal organization <a href="#">gather to promote good</a>.</p>
		</div>
	</section>

	<aside id="sidebar">
		<?php echo $theme->area('home'); ?>
	</aside>

<?php $theme->display('footer'); ?>