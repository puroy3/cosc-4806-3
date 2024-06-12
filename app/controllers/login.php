<?php

class Login extends Controller {

    public function index() {		
	    $this->view('login/index');
    }
    
    public function verify(){
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
		
			$user = $this->model('User');
			if ($user->authenticate($username, $password)){
				header('Location: /home');
				exit;
			}
			else {
				header('Location: /login');
				exit;
			}
    }
	public function create() {
		// Checking if any data is sent.
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			$password2 = $_REQUEST['password2'];
			// Connect to database.
			$db = db_connect();
			$user = $this->model('User');
			// Check if password length is less than 11.
			if (strlen($password) < 11) {
				$this->view('create/index');
				// If less, print the message.
				echo "Password has to be at minimum 11 characters.";
			}
			// Check if the two inputted passwords match.
			else if ($password !== $password2) {
				// If they don't, print the message.
				echo "Passwords don't match.";
			}
			else {
				// Check if the username already exists in the database by querying database.
				$statement = $db->prepare("select * from users where username = '$username'");
				$statement->execute();
				// Check if any matches occur.
				if ($statement->fetchAll()) {
					// If matches occur, then the username is already taken, so print the message.
					$this->view('create/index');
					echo "This username is already taken. Choose a different one.";
				}
				else {
					$user->create_user($username, $password);
					// Hash the password and insert it into the database.
					$hash = password_hash($password, PASSWORD_DEFAULT);
					$statement = $db->prepare("insert into users (username, password_hash) VALUES ('$username', '$hash')");
					$statement->execute();
					// Tell the user that the account was created.
					echo "Your account was created successfully. Press login here.";
				}
			}
		}
	}

}
?>