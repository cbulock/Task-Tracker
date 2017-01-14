<?php
namespace cbulock\task_tracker;

class User {

	private $db;
	
	public function __construct() {
		$this->db = new DB;
	}

	public function all() {
		$query = new \Peyote\Select('users');
		return $this->db->fetch($query);
	}

	public function get($id) {
		$query = new \Peyote\Select('users');
		$query->where('id', '=', $id);
		return $this->db->fetch($query)[0];
	}

	public function set($id, $pin = NULL) {
		$user = $this->get($id);
		if ($pin === $user['pin']) return setcookie('user', $id, time() + (86400 * 365), '/');
		throw new \Exception('Invalid pin', 401);
	}

	public function current() {
		$user = $_COOKIE['user'];

		$query = new \Peyote\Select('users');
		$query->where('id', '=', $user);
		return $this->db->fetch($query)[0];
	}

	public function update($id, $pin) {
		$query = new \Peyote\Update('users');
		$query->set([
			'pin' => $pin
		])->where('id', '=', $id);
		return $this->db->put($query);
	}

	public function logout() {
		return setcookie('user', '', time() - 3600, '/');
	}
}
