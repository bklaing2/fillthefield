<?php
	$page = 0.0;	
	include_once 'header.php';
?>


<div class="col-xs-12 col-md-6 col-lg-6"><br>
	<div class="container d-none" id="cont_welcome">
		<div class="row justify-content-start">
			<div class="col">
				<h1 id="label_header">Welcome to Fill&nbsp;the&nbsp;Field!</h1>
			</div>
		</div>

		<br>

		<div class="row justify-content-start">
			<div class="col">
				<h5 class="text-muted">The purpose of this project is to help get A&amp;M students to football games!<br>
				<br>Students with Sports Passses can post their unused tickets here.<br>
				<br>Students without Sports Passses can request tickets.</h5>
			</div>
		</div>

		<br>

		<div class="row justify-content-center">
			<div class="col">
				<a class="col btn btn-small btn-secondary" style="cursor: pointer;" href="login">Login</a>
			</div>
			<div class="col">
				<a class="col btn btn-small btn-primary" style="cursor: pointer;" href="sign-up">Sign Up Now!</a>
			</div>
		</div>

		<br>
		<br>
	</div>
	

	<div class="container" id="cont_sched">
		<div class="row justify-content-start">
			<h1>Schedule</h1>
		</div>

		<div class="row">
			<?php include_once 'includes/table/inc.table.schedule.php'; ?>
		</div>
	</div><br>
</div>


<script>
	<?php
		if(!isset($_SESSION['id']))
			echo "document.getElementById('cont_welcome').classList.remove('d-none');";
	?>
</script>

<?php
	include_once 'footer.php';
?>