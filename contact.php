<?php
	$page = 3.0;
	include_once 'header.php';
?>

<br>
<br>

<div class="container text-light"><br>
	<div class="row justify-content-center">
		<div class="col-xs-12 col-md-8 col-lg-6">
			<h1 class="float-left" id="label_header">Contact</h1>
		</div>
	</div>

	<br>

	<div class="row justify-content-center" id="cont_none">
		<div class="col-xs-12 col-md-8 col-lg-6">
			<h5 class="text-muted float-left">Select reason for contacting:</h5>
		</div>
	</div>

	<br>

	<div class="row justify-content-center">
		<div class="col col-xs-10 col-sm-10 col-md-9 col-lg-8 offset-1 offset-sm-2 offset-md-3 offset-lg-4">
			<form action="contact-message" method="POST">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="contact_radios" id="con_rad_problem" value="0" checked>
					<label class="form-check-label" for="con_rad_problem">
						I have a problem
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="contact_radios" id="con_rad_suggestion" value="1">
					<label class="form-check-label" for="con_rad_suggestion">
						I have a suggestion
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="contact_radios" id="con_rad_report_user" value="2">
					<label class="form-check-label" for="con_rad_report_user">
						I would like to report a user
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="contact_radios" id="con_rad_business" value="3">
					<label class="form-check-label" for="con_rad_business">
						I was wondering if you could make me a website
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="contact_radios" id="con_rad_other" value="4">
					<label class="form-check-label" for="con_rad_other">
						Other
					</label>
				</div>

				<br>

				<button type="submit" name="submit" class="btn btn-primary" style="cursor: pointer;">Next</button>
			</form>
		</div>
	</div>
</div>

<script>
	if("<?php if(isset($_GET['message'])){echo $_GET['message'];} ?>" == "sent")
	{
		document.getElementById("label_header").innerHTML = "Message sent!";

		document.getElementById("label_header").classList.add('text-success');
	}
</script>

<?php
	include_once 'footer.php';
?>