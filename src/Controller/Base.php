<?php
namespace cbulock\task_tracker\Controller;

class Base {

	public $route;
	protected $interface;

	public function __construct($route) {
		$this->route = $route;

		//TODO: Need to make a whitelist for URL's that bypass this
		if ( !$_COOKIE['user'] && ($this->route->get_data(0) != 'who' && $this->route->get_data(0) != 'api' && $this->route->get_data(0) != 'enter_pin' && $this->route->get_data(0) != 'manifest.json') ) {
			header('Location: /who');
		}

		$this->setupInterface();
	}

	protected function setupInterface() {
		$this->interface = new \cbulock\task_tracker\SiteInterface\Base;
	}

	public function setTemplate($template) {
		$this->interface->template($template);
	}

	public function addData($data) {
		$this->interface->addData($data);
	}

	public function setContentType($content_type) {
		$this->interface->setContentType($content_type);
	}

	public function setRefresh($secs) {
		$this->interface->setRefresh($secs);
	}

	public function get_user_data() {
		$user = new \cbulock\task_tracker\User;
		$settings = new \cbulock\task_tracker\Settings;
		$week = new \cbulock\task_tracker\Week;
		$this->addData(
			[
				'user' => $user->current(),
				'task_name' => $settings->get('task_name'),
				'site_name' => $settings->get('site_name'),
				'progress'  => $week->current()
			]
		);
	}

	public function load() {
		$this->get_user_data();
		$this->process();
		$this->interface->output();
	}

}
