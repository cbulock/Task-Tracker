<?php
namespace cbulock\task_tracker;

/**
 * Current week progress and completion.
 *
 */
class Week {

	private $db;

	public function __construct() {
		$this->db = new DB;
	}

	public function current() {
		return [
			'start'           => $this->startOfWeek(),
			'end'             => $this->endOfWeek(),
			'type'            => $this->typeOfWeek(),
			'values'          => $this->userValues()
		];

	}

	public function close() {
		$users = (new User)->nonAdmins();
		$notify = new Notifications;
		$settings = new Settings;

		foreach($users as $user) {
			$values = $this->userValues($user['id']);
			$diff = $values['completed'] - $values['needed'];

			$results[] = [
				'user'      => $user,
				'completed' => $values['completed'],
				'needed'    => $values['needed'],
				'diff'      => $diff,
			];

			$query = new \Peyote\Update('users');
			$query->set([
				'prev_week_diff' => $diff
			])->where('id', '=', $user['id']);
			$this->db->update($query);

			//TODO: probably send an email report here to the user

		}
		$message = [
			'subject'  => $settings->get('task_name') . ' Weekly Results',
			'template' => 'admin_report',
			'results'  => $results,
		];
		
		$notify->messageAdmins($message, 'email');

	}

	private function today() {
		return date('Y-m-d');
	}

	// Weeks are considered Thur - Wed
	private function startOfWeek() {
		$day_of_week = date('D', strtotime( $this->today() ));

		if ( $day_of_week == 'Thu' ) return $this->today();

		$date = \DateTime::createFromFormat( 'Y-m-d', $this->today() )->modify('previous Thursday');
		return $date->format('Y-m-d');
	}

	private function endOfWeek() {
		$date = \DateTime::createFromFormat( 'Y-m-d', $this->startOfWeek() )->modify('next Wednesday');
		return $date->format('Y-m-d');
	}

	private function valueNeeded() {
		$query = new \Peyote\Select('week');
		$query->where('type', '=', $this->typeOfWeek());
		return (int)$this->db->fetch($query)[0]['total_value'];
	}

	private function userValues($user_id = NULL) {
		$user = $user_id ? (new User)->get($user_id) : (new User)->current();

		$histories = (new History)->get_user_range($user['id'], $this->startOfWeek(), $this->endOfWeek());
		$needed = $this->valueNeeded();
		$needed = ($user['prev_week_diff'] * -1) + $needed;

		$completed = 0;
		$approved = 0;
		foreach ($histories as $history) {
			$completed += $history['value'];
			if ( $history['approved'] ) $approved += $history['value'];
		}

		$completed_percent = 100;
		$approved_percent = 100;
		if ($needed) {
			$completed_percent = ($completed / $needed) * 100;
			$approved_percent = ($approved / $needed) * 100;
		}

		return [
			'needed'            => $needed,
			'completed'         => $completed,
			'approved'          => $approved,
			'completed_percent' => $completed_percent,
			'approved_percent'  => $approved_percent
		];
	}

	private function typeOfWeek() {
		$this_saturday = \DateTime::createFromFormat( 'Y-m-d', $this->startOfWeek() )->modify('next Saturday')->format('Y-m-d');

		$second_saturday = date('Y-m-d', strtotime('Second Saturday of ' . date('F Y', strtotime($this->today()))));
		$fourth_saturday = date('Y-m-d', strtotime('Fourth Saturday of ' . date('F Y', strtotime($this->today()))));

		/* Every week that contains the second or forth Saturday requires a full set of chores */
		if ($this_saturday == $second_saturday || $this_saturday == $fourth_saturday) {
			return 'full';
		}

		return 'partial';
	}

}