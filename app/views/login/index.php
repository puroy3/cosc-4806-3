<?php require_once 'app/views/templates/headerPublic.php'?>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center">You are not logged in</h2>
							<h1 class="text-center">Login Page</h1>
            </div>
        </div>
    </div>

	<?php
	if (isset($_SESSION['failedAuth'])) {
		echo "<p class='text-center'>Unsuccessful attempt number " . $_SESSION['failedAuth'] . ".</p>";
	}
	if (isset($_SESSION['created_account'])) {
		echo "<p class='text-center'>" . $_SESSION['created_account'] . "</p>";
		unset($_SESSION['created_account']);
	}
		if (isset($_SESSION['locked_text'])) {
			echo "<p class='text-center'>" . $_SESSION['locked_text'] . "</p>";
			unset($_SESSION['locked_text']);
		}
	?>
<div class="row justify-content-center">
    <div class="col-sm-auto">
		<form action="/login/verify" method="post" >
		<fieldset>
			<div class="form-group">
				<br>
				<label for="username">Username:</label>
				<input required type="text" class="form-control" name="username">
			</div>
			<div class="form-group">
				<br>
				<label for="password">Password:</label>
				<input required type="password" class="form-control" name="password">
			</div>
            <br>
			<div class="text-center">
		    <button type="submit" class="btn btn-primary">Login</button>
			</div>
						<br>
				<p class="text-center"><a href="/create/index"> Create an Account here </a></p>
		</fieldset>
		</form> 
	</div>
</div>
    <?php require_once 'app/views/templates/footer.php' ?>
