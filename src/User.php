<?php
namespace cbulock\task_tracker;

/**
 * Access to user data.
 *
 */
class User {

	private $db;
	
	public function __construct() {
		$this->db = new DB;
	}

	public function all() {
		$query = new \Peyote\Select('users');
		return $this->db->fetch($query);
	}

	public function admins() {
		$query = new \Peyote\Select('users');
		$query->where('is_admin', '=', 1);
		return $this->db->fetch($query);
	}

	public function nonAdmins() {
		$query = new \Peyote\Select('users');
		$query->where('is_admin', '=', 0);
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
		$id = $_COOKIE['user'];
		return $this->get($id);
	}

	public function update($id, $pin) {
		$query = new \Peyote\Update('users');
		$query->set([
			'pin' => $pin
		])->where('id', '=', $id);
		return $this->db->update($query);
	}

	public function logout() {
		return setcookie('user', '', time() - 3600, '/');
	}
}
