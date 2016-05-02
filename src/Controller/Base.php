<?php
namespace cbulock\task_tracker\Controller;

class Base {

 public $route;
 protected $interface;

 public function __construct($route) {
  $this->route = $route;

  if ( !$_COOKIE['user'] && ($this->route->get_data(0) != 'who' && $this->route->get_data(0) != 'api') ) {
   header('Location: /who');
  }

  $this->setupInterface();
 }

 protected function setupInterface() {
  $this->interface = new \cbulock\task_tracker\SiteInterface\Base;
 }

 public function setTemplate($template) {
  $this->interface->template($template);
 }

 public function addData($data) {
  $this->interface->addData($data);
 }

 public function setContentType($content_type) {
  $this->interface->setContentType($content_type);
 }

 public function get_user_data() {
 	$user = new \cbulock\task_tracker\User;
 	$this->addData(
		[
			'user' => $user->current()
		]
	);
 }

 public function load() {
 	$this->get_user_data();
  $this->process();
  $this->interface->output();
 }

}
