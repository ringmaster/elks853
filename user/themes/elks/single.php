<?php $theme->display('header'); ?>

<div id="maincontent">
	<?php echo $theme->content($post); ?>
</div>

<aside id="sidebar">
	<?php echo $theme->area('sidebar', 'sidebar'); ?>
</aside>


<?php $theme->display('footer'); ?>