<?php
namespace cbulock\task_tracker;

class History {

	private $db;
	
	public function __construct() {
		$this->db = new DB;
	}

	public function all() {
		$query = new \Peyote\Select('history h');
		$query->columns('h.id history_id, t.name task_name, date, t.id task_id, u.name username, u.id user_id, approved, h.value task_value')
					->join('tasks t', 'left')
					->on('t.id', '=', 'h.task')
					->join('users u', 'left')
					->on('u.id', '=', 'h.user')
					->orderBy('date', 'desc')
					->limit(50);
		return $this->db->fetch($query);
	}

	public function user($user) {
		$query = new \Peyote\Select('history h');
		$query->columns('h.id history_id, t.name task_name, date, t.id task_id, approved, h.value task_value')
					->join('tasks t', 'left')
					->on('t.id', '=', 'h.task')
					->join('users u', 'left')
					->on('u.id', '=', 'h.user')
					->where('h.user', '=', $user)
					->orderBy('date', 'desc')
					->limit(30);
		return $this->db->fetch($query);
	}

	public function get_user_range($user, $start, $end) {
		$query = new \Peyote\Select('history');
		$query->where('user', '=', $user)
					->where('date', '>=', $start)
					->where('date', '<=', $end);
		return $this->db->fetch($query);
	}

	public function get($id) {
		$query = new \Peyote\Select('history');
		$query->where('id', '=', $id);
		return $this->db->fetch($query)[0];
	}

	public function by_task($task) {
		$query = new \Peyote\Select('history');
		$query->columns('COUNT(u.name) count, u.name username, u.id user_id')
					->join('users u', 'left')
					->on('u.id', '=', 'history.user')
					->where('task', '=', $task)
					->groupBy('u.id');
		$result['users'] = $this->db->fetch($query);
		$query = new \Peyote\Select('history h');
		$query->columns('h.id history_id, t.name task_name, date, t.id task_id, u.name username, u.id user_id')
					->join('tasks t', 'left')
					->on('t.id', '=', 'h.task')
					->join('users u', 'left')
					->on('u.id', '=', 'h.user')
					->orderBy('date', 'desc')
					->where('task', '=', $task);
		$result['logs'] = $this->db->fetch($query);
		return $result;
	}

	public function edit($id, $task, $user, $date) {
		$query = new \Peyote\Update('history');
		$query->set([
			'task'     => $task,
			'user'   => $user,
			'date' => $date
		])->where('id', '=', $id);
		return $this->db->update($query);
	}

	public function approve($id) {
		$user = (new User)->current();
		if (!$user['is_admin']) throw new \Exception('Only admins can approve', 401);

		$query = new \Peyote\Update('history');
		$query->set([
			'approved' => 1
		])->where('id', '=', $id);
		return $this->db->update($query);
	}
}