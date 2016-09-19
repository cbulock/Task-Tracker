<?php
namespace cbulock\task_tracker\SiteInterface;

class Base {

 private $twig;
 private $template;
 protected $data = [];
 private $content_type;
 private $refresh;

 public function __construct() {

  $loader = new \Twig_Loader_Filesystem(['templates']);
  $this->twig = new \Twig_Environment($loader);

  $this->setContentType("Content-type: text/html; charset=UTF-8");
 }

 public function setContentType($content_type) {
  $this->content_type = $content_type;
 }

 public function setRefresh($secs) {
  $this->refresh = $secs;
 }

 public function template($template) {
  $this->template = $template;
 }

 public function addData($data) {
  $this->data = array_merge($this->data, $data);
 }

 public function render() {
  header($this->content_type);
  if ($this->refresh) header('Refresh: ' . $this->refresh);
  $template = $this->twig->loadTemplate($this->template . '.twig');
  return $template->render($this->data);
 }

 public function output() {
  echo $this->render();
 }

 public function exceptionHandler($e) {
  $code = $e->getCode();
  switch($code) {
   case 403:
   case 404:
    header("HTTP/1.0 ".$code);
    $_SERVER['REDIRECT_STATUS'] = $code;
    $this->addData([
     'number'	=>	$code,
     'rand'	=>	md5(uniqid(rand(), true))
    ]);
    $this->template('error');
    $this->output();
    die();
    break;
   default:
    $this->addData([
     'code'	=>	$code,
     'message'	=>	$e->getMessage()
    ]);
    $this->template('exception');
    $this->output();
    die();
    break;
  }
 }

}
