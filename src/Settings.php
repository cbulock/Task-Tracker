<?php
namespace cbulock\task_tracker;

class Settings {

	private $settings;

	public function __construct() {
		$this->settings = json_decode(file_get_contents('settings.json'));
	}

	public function get($setting) {
		return $this->settings->{$setting};
	}

}