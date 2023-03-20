<?php
namespace app\controllers;

class Chat extends \app\core\Controller{
	public function index(){
		//select the username
		if(isset($_POST['action'])){
			$_SESSION['username'] = htmlentities($_POST['username']);
			header('location:/Chat/viewChat');
		}else{
			$this->view('Chat/index');
		}
	}

	#[\app\filters\HasName]
	public function viewChat(){
		//select the username
		$chat = new \app\models\Chat();
		$chats = $chat->getAll();
		$this->view('Chat/viewChat', $chats);
	}

	#[\app\filters\HasName]
	public function speak(){
		if(isset($_POST['action'])){
			//make a new chat
			$chat = new \app\models\Chat();
			//populate the chat
			$chat->author = $_SESSION['username'];
			$file = $this->saveFile($_FILES['picture']);
			$message = htmlentities($_POST['message']);
			if($file){
				$chat->message = "<figure><a target='_blank' href='/Chat/showPic/$file'><img style='max-width:250px;' src='/images/$file' /></a><figcaption>$message</figcaption></figure>";
			}else{
				$chat->message = $message;
			}
			//invoke the insert method
			$chat->insert();
			//back to the chat view
		}
		header('location:/Chat/viewChat');
	}

	public function saveFile($file){
		if(empty($file['tmp_name']))
			return false;

		$check = getimagesize($file['tmp_name']);
		$allowed_types = ['image/jpeg'=>'jpg', 'image/png'=>'png'];
		if(in_array($check['mime'], array_keys($allowed_types))){
			 $ext = $allowed_types[$check['mime']];
			 $filename = uniqid() . ".$ext";
			 move_uploaded_file($file['tmp_name'], 'images/'.$filename);
			 return $filename;
		}else
			return false;
	}

	public function showPic($pic){
		$this->view('Chat/showPic',$pic);
	}

	public function logout(){
		session_destroy();
		header('location:/Chat/index');
	}

}