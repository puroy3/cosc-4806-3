<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        
    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function create_user($username, $password) {
      $db = db_connect();
      // Hash the password.
      $hash = password_hash($password, PASSWORD_DEFAULT);
      // Create an SQL statement to insert the new user into the database using the username and the password hash.
      $statement = $db->prepare("INSERT into users (username, password_hash) VALUES ('$username', '$hash')");
      return $statement->execute();
    }
    public function usernameExists($username) {
      // Connect to database.
      $db = db_connect();
      // Check if the username already exists in the database by querying database.
      $statement = $db->prepare("select * from users where username = :username");
      $statement->bindValue(':username', $username);
      $statement->execute();
      // Check if any matches occur and return either true or false.
      return $statement->fetch() ? true : false;
    }
    public function authenticate($username, $password) {
        /*
         * if username and password good then
         * $this->auth = true;
         */
		$username = strtolower($username);
    // Check if data is requested.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];
		$db = db_connect();
        $statement = $db->prepare("select * from users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
		
		if (password_verify($password, $rows['password_hash'])) {
			$_SESSION['auth'] = 1;
			$_SESSION['username'] = ucwords($username);
			unset($_SESSION['failedAuth']);
			header('Location: /home');
			die;
		} else {
			if(isset($_SESSION['failedAuth'])) {
				$_SESSION['failedAuth'] ++; //increment
			}
      else {
				$_SESSION['failedAuth'] = 1;
			}
			header('Location: /login');
			die;
		}
    }

}
}