<?php
	$page = -1;
	include_once 'header.php';
?>

<div class="container text-light"><br>
	<div class="row justify-content-center">
		<h2>Login</h2>
	</div>

	<br>

	<div class="row justify-content-center">
		<form action="includes/login/inc.login.login.php" method="POST">
			<div class="form-group">
				<label id="label_username" for="username">Username</label>
				<input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Username">
			</div>

			<br>

			<div class="form-group">
				<label id="label_pwd" for="password">Password</label>
				<input type="password" name="password" class="form-control" id="password" placeholder="Password">
			</div>
			
			<br>

			<div class="row justify-content-center">
				<button type="submit" name="submit" class="btn btn-primary" style="cursor: pointer;">Login</button>
			</div>
		</form>
	</div>

	<div><p><br></p></div>

	<div class="row justify-content-center">
		<a class="text-muted" href="sign-up"><small>Hold up I don't got an account fam</small></a>
	</div>

	<br>

	<div class="row justify-content-center">
		<a class="text-muted" href="#"><small>Um I forgot my password...</small></a>
	</div>
</div>

<script>
	document.getElementById("label_<?php echo $_GET['login']; ?>").classList.add('text-danger');
</script>


<?php
	include_once 'footer.php';
?>