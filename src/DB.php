<?php
namespace cbulock\task_tracker;

class DB extends \PDO {

	public function __construct() {
		$settings = new Settings;
		parent::__construct('mysql:host=' . $settings->get('db_host') . ';dbname=' . $settings->get('db_name'), $settings->get('db_user'), $settings->get('db_pass'));
		$this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
	}

	public function fetch(\Peyote\Query $query) {
		$q = $query->compile();
		$s = $this->prepare($q);
		$s->execute($query->getParams());
		return $s->fetchAll();
	}

	public function update(\Peyote\Query $query) {
		$q = $query->compile();
		$s = $this->prepare($q);
		return $s->execute($query->getParams());
	}

	public function put(\Peyote\Query $query) {
		$q = $query->compile();
		$s = $this->prepare($q);
		$s->execute($query->getParams());
		return $this->lastInsertId();
	}

}
