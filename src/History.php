<?php
namespace cbulock\task_tracker;

class History {

	private $db;
	
	public function __construct() {
		$this->db = new DB;
	}

	public function all() {
		$query = new \Peyote\Select('history h');
		$query->columns('t.name task_name, date, t.id task_id, u.name username, u.id user_id')
					->join('tasks t', 'left')
					->on('t.id', '=', 'h.task')
					->join('users u', 'left')
					->on('u.id', '=', 'h.user')
					->orderBy('date', 'desc');
		return $this->db->fetch($query);
	}

	public function user($user) {
		$query = new \Peyote\Select('history h');
		$query->columns('t.name task_name, date, t.id task_id')
					->join('tasks t', 'left')
					->on('t.id', '=', 'h.task')
					->join('users u', 'left')
					->on('u.id', '=', 'h.user')
					->where('h.user', '=', $user)
					->orderBy('date', 'desc');
		return $this->db->fetch($query);
	}
}