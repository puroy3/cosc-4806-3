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
      // Create an SQL statement to insert the new user into the database using the username and the password hash.
      $statement = $db->prepare("INSERT into users (username, password_hash) VALUES ('$username', '$hash')");
      // Hash the password.
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $statement->execute();
    }

    public function authenticate($username, $password) {
        /*
         * if username and password good then
         * $this->auth = true;
         */
		$username = strtolower($username);
		$db = db_connect();
        $statement = $db->prepare("select * from users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
		
		if (password_verify($password, $rows['password'])) {
			$_SESSION['auth'] = 1;
			$_SESSION['username'] = ucwords($username);
			unset($_SESSION['failedAuth']);
			header('Location: /home');
			die;
		} else {
			if(isset($_SESSION['failedAuth'])) {
				$_SESSION['failedAuth'] ++; //increment
        echo "This is unsuccessful attempt number " . $_SESSION['failedAuth'] . ".";
			}
      else {
				$_SESSION['failedAuth'] = 1;
			}
			header('Location: /login');
			die;
		}
    }

}
