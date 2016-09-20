<?php
namespace cbulock\task_tracker;

class Task {

	private $db;

	public function __construct() {
		$this->db = new DB;
	}

	public function available() {
		$query = new \Peyote\Select('tasks t');
		$query->columns('*, t.id task_id')
					->join('(SELECT MAX(id) max_id, task FROM history GROUP BY task) history_new', 'left')
					->on('t.id', '=', 'history_new.task')
					->join('history h', 'left')
					->on('h.id', '=', 'history_new.max_id')
					->where('h.date IS NULL OR (DATEDIFF(NOW(), h.date) - t.repeat)', '>=', '0')
					->where('active', '=', '1')
					->orderBy('t.priority', 'desc');
		return $this->db->fetch($query);
	}

	public function all() {
		$query = new \Peyote\Select('tasks');
		return $this->db->fetch($query);
	}

	public function get($id) {
		$query = new \Peyote\Select('tasks');
		$query->where('id', '=', $id);
		return $this->db->fetch($query)[0];
	}

	public function add($name, $desc, $priority = 3, $repeat = 7) {
		$query = new \Peyote\Insert('tasks');
		$query->columns(['name', '`desc`', 'priority', '`repeat`'])
					->values([$name, $desc, $priority, $repeat]);
		return $this->db->put($query);
	}

	public function edit($id, $name, $desc, $priority = 3, $repeat = 7, $active = 1) {
		$query = new \Peyote\Update('tasks');
		$query->set([
			'name'     => $name,
			'`desc`'   => $desc,
			'priority' => $priority,
			'`repeat`' => $repeat,
			'active'   => $active
		])->where('id', '=', $id);
		return $this->db->put($query);
	}

	public function record($id) {
		$user = new User;

		$query = new \Peyote\Insert('history');
		$query->columns(['task', 'user', 'date'])
					->values([$id, $user->current()['id'], date('Y-m-d')]);
		return $this->db->put($query);
	}
}
