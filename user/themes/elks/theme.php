<?php

class ElksTheme extends Theme
{
	function action_template_header($theme) {
		// Add the HTML5 shiv for IE < 9
		Stack::add('template_header_javascript', StackItem::get('html5_shiv'));
		Stack::add('template_header_javascript', StackItem::get('less-js'));
		Stack::add('template_header_javascript', '$(function(){$("#masthead").click(function(){location.href=$("#home").attr("href");})})', 'homelink', 'jquery');
		Stack::add('template_stylesheet', $theme->get_url('/fonts/new_athena_unicode.css'), 'new_athena_unicode');
		Stack::add('template_stylesheet', $theme->get_url('/fonts/ss-standard.css'), 'ss-standard');
		//Stack::add('template_stylesheet', $theme->get_url('/css/style.css'), 'style');
		Stack::add('template_stylesheet', array($theme->get_url('/less/style.less'), null, array('type'=> null, 'rel' => 'stylesheet/less')), 'style');

		// Add this line to your config.php to show an error and a notice
		if(defined('DEBUG_THEME')) {
			Session::error('This is a <b>sample error</b>');
			Session::notice('This is a <b>sample notice</b> for ' . $_SERVER['REQUEST_URI']);
		}
	}


	function action_init_theme() {
		StackItem::register( 'less-js', $this->get_url('/less/less-1.3.0.min.js'), '1.3.0' );
		StackItem::register( 'html5_shiv', array('http://cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.js', null, '<!--[if lt IE 9]>%s<![endif]-->') );
	}

	public function filter_get_scopes($scopes)
	{
		$scope = new StdClass();
		$scope->id = 40000;
		$scope->name = 'Home Page';
		$scope->priority = 15;
		$scope->criteria = array(
			array('request', 'display_home'),
		);
		$scopes[] = $scope;
		return $scopes;
	}

}

?>