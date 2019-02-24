<?php
namespace cbulock\task_tracker\Notifications;

// TODO:  THis doesn't make any sense.  Emails need subjects, templates, content to fill those templates

//  It's not anything like sending a text.  Redo all this.


class Email {

	private $settings;

	public function __construct() {
		$this->settings = new \cbulock\task_tracker\Settings;
	}
	
	public function send($user_id, $message) {
		$user = (new \cbulock\task_tracker\User)->get($user_id);
		
		$task_name = $this->settings->get('task_name');

		$transport = \Swift_SmtpTransport::newInstance($this->settings->get('smtp_host'), 465, 'ssl')
			->setUsername($this->settings->get('smtp_user'))
			->setPassword($this->settings->get('smtp_pass'));
		$mailer = new \Swift_Mailer($transport);

		$email_data = [
			'user'      => $user,
			'message'   => $message,
			'task_name' => $task_name
		];

		$text_template = $this->_loadTemplate($message['template'], 'text');
		$html_template = $this->_loadTemplate($message['template'], 'html');

		$message = (new \Swift_Message($message['subject']))
			->setFrom(['cameron@bulock.com' => $task_name])
			->setTo([$user['email'] => $user['name']])
			->setBody($text_template->render($email_data));

		$message->addPart($html_template->render($email_data), 'text/html');

		return $mailer->send($message);
	}

	private function _loadTemplate ($template, $type) {
		$loader = new \Twig_Loader_Filesystem([__DIR__ . '/../../templates/email/' . $type]);
		$twig = new \Twig_Environment($loader);
		return $twig->loadTemplate ($template . '.twig');
	}

}