<?php
namespace app\filters;

#[\Attribute]
class HasName implements \app\core\AccessFilter{
	public function execute(){
		if(!isset($_SESSION['username'])){
		 	header('location:/Chat/index');
		 	return true; //not enough, we have to tell the router to do something
		}
		return false;
	}
}