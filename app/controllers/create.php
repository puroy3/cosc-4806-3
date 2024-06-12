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
        $message_text = '';
        
        // Check if password length is less than 11.
        if (strlen($password) < 11) {
          // If less, print the message.
          $message_text = "Password has to be at minimum 11 characters.";
        }
        // Check if the two inputted passwords match.
        else if ($password !== $password2) {
          // If they don't, print the message.
          $message_text = "Passwords don't match.";
        }
        elseif ($user->usernameExists($username)) {
          $message_text = "This username is already taken. Choose a different one.";
        }
        else { 
        if ($user->create_user($username, $password)) {
          $_SESSION['created_account'] = "Account was created. Login to the system.";
          header('Location: /login');
          die();
        }
        else {
            $message_text = "Account was not created. Try again.";
        }
    }
        if (!empty($message_text)) {
          echo $message_text;
          $this->view('create/index');
        }
  }
      else {
      $this->view('create/index');
}
    }
}
?>