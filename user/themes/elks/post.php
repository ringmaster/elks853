<article id="post-<?php echo $content->id; ?>" class="post" >

	<header>
		<h1><a href="<?php echo $content->permalink; ?>"><?php echo $content->title_out; ?></a></h1>
	</header>

	<div class="content">
		<?php echo $content->content_out; ?>
	</div>

</article>
