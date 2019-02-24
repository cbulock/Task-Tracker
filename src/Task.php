<?php
namespace cbulock\task_tracker;

/**
 * Listing and completing tasks.
 *
 */
class Task {

	private $db;

	public function __construct() {
		$this->db = new DB;
	}

	public function available() {
		$query = new \Peyote\Select('tasks t');
		$query->columns('*, t.id task_id, t.value task_value')
					->join('(SELECT MAX(id) max_id, task FROM history GROUP BY task) history_new', 'left')
					->on('t.id', '=', 'history_new.task')
					->join('history h', 'left')
					->on('h.id', '=', 'history_new.max_id')
					->where('h.date IS NULL OR (DATEDIFF(NOW(), h.date) - t.repeat)', '>=', '0')
					->where('active', '=', '1')
					->orderBy('t.priority DESC, t.value', 'desc');
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

	public function add($name, $desc, $priority = 3, $value = 10, $repeat = 7) {
		$query = new \Peyote\Insert('tasks');
		$query->columns(['name', '`desc`', 'priority', 'value', '`repeat`'])
					->values([$name, $desc, $priority, $value, $repeat]);
		return $this->db->put($query);
	}

	public function edit($id, $name, $desc, $priority = 3, $value = 10, $repeat = 7, $active = 1) {
		$query = new \Peyote\Update('tasks');
		$query->set([
			'name'     => $name,
			'`desc`'   => $desc,
			'priority' => $priority,
			'value'    => $value,
			'`repeat`' => $repeat,
			'active'   => $active
		])->where('id', '=', $id);
		return $this->db->update($query);
	}

	public function record($id) {
		$user = (new User)->current();
		$notify = new Notifications;
		$settings = new Settings;

		$task = $this->get($id);

		$query = new \Peyote\Insert('history');
		$query->columns(['task', 'user', 'date', 'value'])
					->values([$id, $user['id'], date('Y-m-d'), $task['value']]);
		$history_id = $this->db->put($query);

		$message = $user['name'] . ' has completed the ' . strtolower($settings->get('task_name')) . ' ' . $task['name'] . ' and it\'s ready to be approved.';
		$message .= ' https://chores.bulock.house/history/item/' . $history_id;

		return $notify->messageAdmins($message);
	}
}
