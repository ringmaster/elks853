BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
BEGIN:VEVENT
UID:<?php echo $post->guid; ?>
DTSTAMP:<?php echo $post->updated->format('Ymd\THis'); ?>
DESCRIPTION:<?php echo preg_replace("#\n\r?#", '\n', $post->content); ?>
DTSTART:<?php echo HabariDateTime::date_create($post->info->event_start)->format('Ymd\THis'); ?>
DTEND:<?php echo HabariDateTime::date_create($post->info->event_end)->format('Ymd\THis'); ?>
SUMMARY:<?php echo $post->title; ?>
END:VEVENT
END:VCALENDAR
