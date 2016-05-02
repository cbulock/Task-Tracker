<?php
namespace cbulock\task_tracker;

class Chore {

	private $db;
	
	public function __construct() {
		$this->db = new DB;
	}

	public function available() {
		$query = new \Peyote\Select('chores c');
		$query->columns('*, c.id chore_id')
					->join('(SELECT MAX(id) max_id, chore FROM history GROUP BY chore) history_new', 'left')
					->on('c.id', '=', 'history_new.chore')
					->join('history h', 'left')
					->on('h.id', '=', 'history_new.max_id')
					->where('h.date IS NULL OR ((DATE(NOW()) - h.date) - c.repeat)', '>=', '0')
					->orderBy('c.priority', 'desc');
		return $this->db->fetch($query);
	}

	public function get($id) {
		$query = new \Peyote\Select('chores');
		$query->where('id', '=', $id);
		return $this->db->fetch($query)[0];
	}

	public function add($name, $desc, $priority = 3, $repeat = 7) {
		$query = new \Peyote\Insert('chores');
		$query->columns(['name', '`desc`', 'priority', '`repeat`'])
					->values([$name, $desc, $priority, $repeat]);
		return $this->db->put($query);
	}

	public function record($chore_id) {
		$user = new User;

		$query = new \Peyote\Insert('history');
		$query->columns(['chore', 'user', 'date'])
					->values([$chore_id, $user->current()['id'], date('Y-m-d')]);
		return $this->db->put($query);
	}
}