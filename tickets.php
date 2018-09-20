<?php
	$page = 1.0;	
	include_once 'header.php';

	if(!isset($_SESSION['id']))
		echo '<script>window.location = "../../login"</script>';
?>


<div class="col-xs-12 col-md-6 col-lg-6"><br>
	<div class="container d-none" id="cont_welcome">
		<div class="row justify-content-start">
			<div class="col">
				<h1>Howdy!</h1>
			</div>
		</div>

		<br>

		<div class="row justify-content-start">
			<div class="col">
				<h5 class="text-muted">Here you can select the games for which you want to give or get tickets.<br>
				<br>You will get an email the week of the game if you match with someone, and you will be able to message them to figure out how you want to get the tickets to each other.<br>
				<br>If you do not have a Sports Pass and there is a game you would like to attend, Fill the Field will give you a chance to get a ticket.</h5>
			</div>
		</div>

		<br>

		<div class="row justify-content-center">
			<div class="col">
				<button type="button" class="btn btn-small btn-block btn-primary" style="cursor: pointer;" onclick="welcome();">Okay</button>
			</div>
		</div>

		<br>
		<br>
	</div>

	<div class="container" id="cont_tickets">
		<div class="row justify-content-start">
			<h1 id="label_header">Give tickets:</h1>
		</div>

		<form action="includes/tickets/inc.tickets.edit.php" method="POST">
			<div class="row">
				<?php include 'includes/tickets/tickets.edit.php'; ?>
			</div>
		</form>
	</div><br>
</div>


<script>
	if("<?php if(isset($_GET['register'])){echo $_GET['register'];} ?>" == "success")
	{
		document.getElementById("cont_welcome").classList.remove('d-none');
		//document.getElementById("cont_tickets").classList.add('d-none');
	}

	function welcome()
	{
		document.getElementById("cont_welcome").classList.add('d-none');
		document.getElementById("cont_tickets").classList.remove('d-none');
	}
	
	function row_click(game, type)
	{
		document.getElementById("cb_" + type + "_" + game).checked = !document.getElementById("cb_" + type + "_" + game).checked;
	}
</script>

<?php
	include_once 'footer.php';
?>