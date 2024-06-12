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
				}
?>