<?php
class Database{
	private $hostname; // MySQL Hostname
	private $username; // MySQL Username
	private $password; // MySQL Password
	private $database; // MySQL Database
	public $conn;

	function __construct($database = 'test', $hostname = 'localhost', $username = 'root', $password = 'quan1234'){
		$this->hostname = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
		$this->conn = mysqli_connect($this->hostname, $this->username, $this->password);
		if(!$this->conn){
			die("Connection failed: " . mysqli_error($this->conn));
		}
		mysqli_select_db($this->conn, $this->database);

	}

	public function query($sql, $single_row = false, $return = true){
		if(trim($sql) == '')
			return false;
		$result = mysqli_query($this->conn, $sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error($this->conn));
		}
		if($return)
		{
			$rows = array();
			while($row = mysqli_fetch_array($result)){
				$rows[] = $row;
			}
			if($single_row)
				return $rows[0];
			return $rows;
		}
	}

	public function getPosts($limit = 10, $offset = 0){
		$sql = "SELECT * FROM posts LIMIT $offset, $limit";
		return $this->query($sql);
	}

	public function toggleStatus($current_status, $post_id){
		if($current_status == ENABLE){
			$this->query("UPDATE posts SET post_status = ".DISABLE." WHERE post_id = $post_id", false, false);
		}else{
			$this->query("UPDATE posts SET post_status = ".ENABLE." WHERE post_id = $post_id", false, false);
		}
	}
	public function insertPost($data = array()){
		if(!empty($data)){
			$sql = "INSERT INTO posts (post_title, post_content, post_status) VALUES ('{$data['post_title']}', '{$data['post_content']}', '{$data['post_status']}')";
			$this->query($sql, false, false);
		}
	}
	public function delPost($post_id){
		if(is_numeric($post_id)){
			$sql = "DELETE FROM posts WHERE post_id = $post_id";
			$this->query($sql, false, false);
		}
	}
	public function getPostById($post_id){
		if(is_numeric($post_id)){
			$sql = "SELECT * FROM posts WHERE post_id = $post_id";
			$result = $this->query($sql, true);
			
			return $result;
		}
		
		return false;
	}
	public function updatePost($post_id, $data = array()) 
	{
		if(is_numeric($post_id)){
			$sql = "UPDATE posts SET post_title = '{$data['post_title']}', post_content = '{$data['post_content']}', post_status = '{$data['post_status']}' WHERE post_id = $post_id";
			$this->query($sql, false, false);
		}
	}
}
?>