<?php require_once 'app/views/templates/headerPublic.php'?>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>You are not logged in</h1>
            </div>
        </div>
    </div>

	<?php
	if (isset($_SESSION['failedAuth'])) {
		echo "Unsuccessful attempt number " . $_SESSION['failedAuth'] . ". ";
	}
	if (isset($_SESSION['created_account'])) {
		echo $_SESSION['created_account'];
		unset($_SESSION['created_account']);
	}
	?>
<div class="row">
    <div class="col-sm-auto">
		<form action="/login/verify" method="post" >
		<fieldset>
			<div class="form-group">
				<br>
				<label for="username">Username</label>
				<input required type="text" class="form-control" name="username">
			</div>
			<div class="form-group">
				<br>
				<label for="password">Password</label>
				<input required type="password" class="form-control" name="password">
			</div>
            <br>
		    <button type="submit" class="btn btn-primary">Login</button>
						<br>
						<br>
				<p><a href="/create/index"> Create an Account here </a></p>
		</fieldset>
		</form> 
	</div>
</div>
    <?php require_once 'app/views/templates/footer.php' ?>
