<?php
namespace cbulock\task_tracker\Controller;

class Base {

 public $route;
 protected $interface;

 public function __construct($route) {
  $this->route = $route;
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

 public function load() {
  $this->process();
  $this->interface->output();
 }

}
