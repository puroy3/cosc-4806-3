<?php require_once 'app/views/templates/headerPublic.php'?>
<!DOCTYPE html>
<html>
  <head>
    <title>Signup</title>
  </head>

  <body>
    <main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Signup Page</h1>
            </div>
        </div>
    </div>
    
    <?php
    if (isset($_SESSION['message_text'])) {
      echo "<p class='text-center'>" . $_SESSION['message_text'] . "</p>";
      unset($_SESSION['message_text']); 
    }
?>
<div class="row justify-content-center">
  <div class="col-sm-auto">
    <form action="/create/create" method="POST">
    <fieldset>
      <div class="form-group">
      <!-- Ask for 3 things: Username-->
      <label for="username">Username:</label>
      <br>
      <input class="form-control" type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
      <br>
      <!-- Password -->
      <label for="password">Enter a Password with at least 11 characters:</label>
      <br>
      <input class="form-control" type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
      <br>
      <!-- Confirm Password -->
      <label for="password2">Confirm Password:</label>
      <br>
      <input class="form-control" type="password" id="password2" name="password2" required>
      </div>
      <br>
      <div class="text-center">
      <button type="submit" class="btn btn-primary">Create</button>
      </div>
      <br>
    </form>
    <p class="text-center"><a href="/login/index"> Login here </a></p>
    </fieldset>
    </form>
  </div>
</div>
  </body>    
</html>
      <?php require_once 'app/views/templates/footer.php' ?>