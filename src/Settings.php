<?php
namespace cbulock\task_tracker;

/**
 * Load stored site settings.
 *
 */
class Settings {

	private $settings;

	public function __construct() {
		$this->settings = json_decode(file_get_contents(__DIR__ . '/../settings.json'));
	}

	public function get($setting) {
		return $this->settings->{$setting};
	}

}