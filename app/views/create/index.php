<?php require_once 'app/views/templates/headerPublic.php'?>
<!DOCTYPE html>
<html>
  <head>
    <main role="main" class="container">
        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-12">
    <title>Signup</title>
                </div>
            </div>
        </div>
  </head>

  <body>

    <h1>Signup Form</h1>

    <form method="post">
      
      <!-- Ask for 3 things: Username-->
      <label for="username">Username:</label>
      <br>
      <input type="text" id="username" name="username" required>
      <br>
      <br>
      <!-- Password -->
      <label for="password">Enter a Password with at least 11 characters:</label>
      <br>
      <input type="password" id="password" name="password" required>
      <br>
      <br>
      <!-- Confirm Password -->
      <label for="password2">Confirm Password:</label>
      <br>
      <input type="password" id="password2" name="password2" required>
      <br>
      <br>
      <input type="submit" value="Create">
      <br>
      <br>
    </form>
    <p><a href="/login/index"> Login here </a></p>
  </body>    
</html>