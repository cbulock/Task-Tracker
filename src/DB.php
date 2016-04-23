<?php
namespace cbulock\task_tracker;

class DB extends \PDO {

	public function __construct() {
		parent::__construct('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
		$this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
	}

	public function fetch(\Peyote\Query $query) {
		$q = $query->compile();
		$s = $this->prepare($q);
		$s->execute($query->getParams());
		return $s->fetchAll();
	}

}
