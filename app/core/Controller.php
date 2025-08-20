<?php
class Controller{ protected function render($view,$data=[]){ extract($data); $viewPath=__DIR__.'/../views/'.$view.'.php'; require __DIR__.'/../views/layout.php'; }
protected function redirect($p){ header('Location: '.$p); exit; } protected function isPost(){ return $_SERVER['REQUEST_METHOD']==='POST'; }}