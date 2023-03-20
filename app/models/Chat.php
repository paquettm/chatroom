<?php
namespace app\models;

class Chat extends \app\core\Model{
	public $chat_id;
	public $author;
	public $message;
	public $timestamp;

	public function insert(){
		$SQL = "INSERT INTO chat (author, message) value (:author, :message)";
		$STH = $this->connection->prepare($SQL);
		$data = ['author'=>$this->author,
					'message'=>$this->message];
		$STH->execute($data);
		$this->client_id = $this->connection->lastInsertId();
	}


	public function getAll(){
		$SQL = "SELECT * FROM chat ORDER BY timestamp DESC LIMIT 100";
		$STH = $this->connection->prepare($SQL);
		$STH->execute();
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Chat');
		return $STH->fetchAll();
	}

}