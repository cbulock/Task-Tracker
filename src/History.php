<?php
namespace cbulock\task_tracker;

class History {

	private $db;
	
	public function __construct() {
		$this->db = new DB;
	}

	public function all() {
		$query = new \Peyote\Select('history h');
		$query->columns('c.name chore_name, date, c.id chore_id, u.name username, u.id user_id')
					->join('chores c', 'left')
					->on('c.id', '=', 'h.chore')
					->join('users u', 'left')
					->on('u.id', '=', 'h.user')
					->orderBy('date', 'desc');
		return $this->db->fetch($query);
	}

	public function user($user) {
		$query = new \Peyote\Select('history h');
		$query->columns('c.name chore_name, date, c.id chore_id')
					->join('chores c', 'left')
					->on('c.id', '=', 'h.chore')
					->join('users u', 'left')
					->on('u.id', '=', 'h.user')
					->where('h.user', '=', $user)
					->orderBy('date', 'desc');
		return $this->db->fetch($query);
	}
}