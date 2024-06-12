<?php
class Create extends Controller {

    public function index() {		
	    $this->view('create/index');
    }

    public function create() {
      // Checking if any data is sent.
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $password2 = $_REQUEST['password2'];

        $user = $this->model('User');

        // Check if password length is less than 11.
        if (strlen($password) < 11) {
          // If less, print the message.
          echo "Password has to be at minimum 11 characters.";
          $this->view('create/index');
        }
        // Check if the two inputted passwords match.
        else if ($password !== $password2) {
          // If they don't, print the message.
          echo "Passwords don't match.";
          $this->view('create/index');
        }
        else if ($user->usernameExists($username)) {
          echo "This username is already taken. Choose a different one.";
        }
        else { 
        if ($user->create_user($username, $password)) {
          echo "Account was created. Press login.";
          header('Location: /login');
          die();
        }
        else {
          echo "Account was not created. Try again.";
        }
    }
  }
      else {
      $this->view('create/index');
}
    }
}
?>