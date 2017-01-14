<?php
namespace cbulock\task_tracker\PublicAPI;

class User {

	private $user;
	
	public function __construct() {
		$this->user = new \cbulock\task_tracker\User;
	}

	public function all() {
		return $this->user->all();
	}

	public function get($id) {
		return $this->user->get($id);
	}

	public function set($id, $pin = NULL) {
		$this->user->set($id, $pin);
		$user = $this->user->get($id);
		return ['message' => 'Logged in as ' . $user['name']];
	}

	public function current() {
		return $this->user->current();
	}

	public function update($id, $pin) {
		$this->user->update($id, $pin);
		return ['message' => 'User updated'];
	}

	public function logout() {
		$this->user->logout();
		return ['message' => 'Logged out'];
	}
}