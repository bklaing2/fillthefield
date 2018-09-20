<?php
	$page = -1;
	include_once 'header.php';
?>

<div class="container text-light"><br>
	<div class="row justify-content-center">
		<h2 id="label_header">Sign Up</h2>
	</div>

	<br>

	<div class="row justify-content-center">
		<form action="includes/login/inc.login.sign-up.php" method="POST">
			<div class="form-group">
				<label id="label_username" for="username">Username</label>
				<input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Username">
			</div>

			<br>

			<div class="form-group">
				<label id="label_email" for="email">Email Address</label>
				<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="example@email.com">
			</div>

			<br>

			<div class="form-group">
				<label id="label_password" for="password">Password</label>
				<input type="password" name="password" class="form-control" id="password" placeholder="Password">
			</div>

			<br>

			<div class="form-group">
				<label id="label_password_conf" for="pass_conf">Confirm Password</label>
				<input type="password" name="password_confirm" class="form-control" id="pass_conf" placeholder="Password">
			</div>
			<!--<div class="form-check">
				<label class="form-check-label">
					<input type="checkbox" name="remember_me" class="form-check-input">
					Remember Me
				</label>
			</div>-->
			
			<br>

			<div class="row justify-content-center">
				<button type="submit" name="submit" class="btn btn-primary" style="cursor: pointer;">Register</button>
			</div>
		</form>
	</div>

	<div><p><br></p></div>

	<div class="row justify-content-center">
		<a class="text-muted" href="login"><small>Oh wait I do got an account lol</small></a>
	</div>
</div>

<script>
	switch("<?php echo $_GET['register']; ?>")
	{
		case "username-taken":
			document.getElementById("label_username").classList.add('text-danger');
			document.getElementById("label_username").innerHTML = "Username Taken";
			break;

		case "password-mismatch":
			document.getElementById("label_password_conf").classList.add('text-danger');
			document.getElementById("label_password_conf").innerHTML = "Passwords Didn't Match";
			break;

		case "empty":
			document.getElementById("label_header").classList.add('text-danger');
			document.getElementById("label_header").innerHTML = "Please fill in all the information";
			break;

		case "error":
			document.getElementById("label_header").classList.add('text-danger');
			document.getElementById("label_header").innerHTML = "Something went wrong, please try again";
			break;
	}
</script>

<?php
	include_once 'footer.php';
?>