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
}
