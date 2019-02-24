<?php
namespace cbulock\task_tracker\Notifications;

class Text {

	private $settings;
	private $sid;
	private $token;

	public function __construct() {
		$this->settings = new \cbulock\task_tracker\Settings;
		$this->sid = $this->settings->get('twilio_sid');
		$this->token = $this->settings->get('twilio_token');
	}
	
	public function send($user_id, $message) {
		$user = (new \cbulock\task_tracker\User)->get($user_id);

		$client = new \Twilio\Rest\Client($this->sid, $this->token);
		$text = $client->messages->create(
			'+' . $user['phone'],
			[
				'from' => '+' . $this->settings->get('twilio_number'),
				'body' => $message
			]
		);
		return $text->sid;
	}

}