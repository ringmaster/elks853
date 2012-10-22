<?php

class EventOnePlugin extends Plugin
{
	function action_init()
	{
		$this->add_template( 'block.eventone_upcoming', __DIR__ . '/block.eventone_upcoming.php' );
		$this->add_template( 'eventone.ics', __DIR__ . '/eventone.ics.php' );
		$this->add_rule('slug/"event.ics"', 'event_ics');
	}

	public function action_plugin_activation( $plugin_file )
	{
		Post::add_new_type( 'event' );
	}

	public function action_plugin_deactivation( $plugin_file )
	{
		Post::deactivate_post_type( 'event' );
	}

	public function filter_post_type_display($type, $foruse)
	{
		$names = array(
			'event' => array(
				'singular' => _t( 'Event', 'eventone' ),
				'plural' => _t( 'Events', 'eventone' ),
			)
		);
		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type;
	}

	public function action_form_publish_event(FormUI $form, $post, $context)
	{
		$event_data = $form->insert( 'publish_controls', new FormControlFieldset('event_data', _t('Event Data'), 'admincontrol_fieldset'));

		$start = $event_data->append( new FormControlTags('event_start', $post, 'Event Start', 'optionscontrol_text') );
		$start->add_validator('validate_datetime')->add_validator('validate_required');
		$end = $event_data->append( new FormControlTags('event_end', $post, 'Event End', 'optionscontrol_text') );
		$end->add_validator('validate_datetime')->add_validator('validate_required');
	}

	public function filter_validate_datetime(array $valid, $value, $control, $container)
	{
		try {
			$date = HabariDateTime::date_create($value);
		}
		catch(Exception $e) {
			$valid[] = _t('The supplied date and time value could not be understood.  Please enter dates in the form "YYYY-MM-DD HH:MM am/pm"');
		}
		if($date->int == 0) {
			$valid[] = _t('The supplied date and time value could not be understood.  Please enter dates in the form "YYYY-MM-DD HH:MM am/pm"');
		}
		return $valid;
	}

	public function filter_post_field_save($value, $key)
	{
		switch($key) {
			case 'event_start':
			case 'event_end':
				return HabariDateTime::date_create($value)->int;
		}
		return $value;
	}


	public function filter_post_field_load($value, $key)
	{
		switch($key) {
			case 'event_start':
			case 'event_end':
				return HabariDateTime::date_create($value)->text_format('{M} {j}, {Y} {g}:{i}{a}');
		}
		return $value;
	}

	public function filter_block_list($block_list)
	{
		$block_list['eventone_upcoming'] = _t('Upcoming Events');
		return $block_list;
	}

	public function action_block_content_eventone_upcoming($block, $theme)
	{
		$criteria = array(
			'status' => Post::status('published'),
		);
		$criteria['content_type'] = Post::type('event');
		if($block->limit != '') {
			$criteria['limit'] = $block->limit;
		}
		$criteria['has:info'] = array('event_start', 'event_end');
		$criteria['orderby'] = 'info_event_start_value ASC';
		$criteria['on_query_built'] = function(Query $query) {
			$query->where()->add("date(hipi1.value, 'unixepoch') > date('now')");
		};

		$block->posts = Posts::get($criteria);
		$block->criteria = $criteria;
	}

	public function theme_route_event_ics($theme, $handler)
	{
		$slug = Controller::get_var('slug');
		$theme->post = Post::get(array('slug' => $slug));
		header('Content-type: text/x-vcalendar; charset=utf-8');
		header('content-disposition: inline; filename=' . $slug . '.ics');
		ob_end_clean();
		$theme->display('eventone.ics');
	}

}
?>