<?php
require_once('../constant.php');
require_once('database.php');
class Auth{
    private $db;
    public $error_message;

    function __construct(){
        $this->db = new Database('test', 'localhost', 'root', 'quan1234');
    }

    public function check_login(){
        if(isset($_POST['submit'])){
            if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))){
                $this->error_message = 'Username and Password cannot be empty!';
            }else{
                $username = mysqli_real_escape_string($this->db->conn, stripslashes($_POST['username']));
                $password = sha1(mysqli_real_escape_string($this->db->conn, stripslashes($_POST['password'])));
                //echo "SELECT COUNT(user_id) AS num_rows FROM users WHERE user_name = '$username' AND user_password = '$password' AND user_status = ".ENABLE;
                $result = $this->db->query("SELECT COUNT(user_id) AS num_rows FROM users WHERE user_name = '$username' AND user_password = '$password' AND user_status = ".ENABLE, true);
                if($result['num_rows'] == 1){
                    $this->set_user($username, $password);
                    return true;
                }else{
                    $this->error_message = 'Username or Password is invalid!';
                    return false;
                }
            }
        }
        return false;
    }

    public function set_user($username, $password){
        $result = $this->db->query("SELECT * FROM users WHERE user_name = '$username' AND user_password = '$password' AND user_status = ".ENABLE, true);
        $_SESSION['login_userid']          = $result['user_id'];
        $_SESSION['login_username']        = $result['user_name'];
        $_SESSION['login_user_permission'] = $result['user_permission'];
        $_SESSION['login_user_status']     = $result['user_status'];
    }
}   
?>