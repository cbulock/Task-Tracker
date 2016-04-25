<?php
namespace cbulock\task_tracker;

class User {

	private $db;
	
	public function __construct() {
		$this->db = new DB();
	}

	public function all() {
		$query = new \Peyote\Select('users');
		return $this->db->fetch($query);
	}

	public function current() {
		$user = $_COOKIE['user'];

		$query = new \Peyote\Select('users');
		$query->where('id', '=', $user);
		return $this->db->fetch($query)[0];
	}
}
