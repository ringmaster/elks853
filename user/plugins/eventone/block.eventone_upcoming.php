<ol>
<?php foreach((array)$content->posts as $post): ?>
	<li>
		<a href="#.ics" class="ss-icon">adddate</a>
		<b><?php echo HabariDateTime::date_create($post->info_event_start_value)->text_format('{M} {j}<sup>{S}</sup>'); ?></b> -
		<a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?></a>
		<small><?php echo HabariDateTime::date_create($post->info_event_start_value)->format('g:ia'); ?></small>
	</li>
<?php endforeach; ?>
</ol>