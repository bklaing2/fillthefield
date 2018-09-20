<?php
	$page = -1;
	include_once 'header.php';
	include_once 'includes/contact/inc.contact.message.php'
?>

<br>
<br>

<div class="container text-light"><br>
	<div class="row justify-content-center">
		<h2><?php echo $reason; ?></h2>
	</div>

	<br>

	<div class="row justify-content-center">
		<form action="includes/contact/inc.contact.send.php" method="POST">
			<div class="form-group">
				<label id="label_email" for="email">Your Email <small class="text-muted">(optional)</small></label>
				<input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" value="<?php echo $email; ?>">
			</div>

			<br>

			<?php echo $rep_user; ?>

			<div class="form-group">
				<label id="label_message" for="message"><?php echo $message; ?></label>
				<textarea class="form-control" rows="5" name="message" id="message" placeholder="Your message"></textarea>
			</div>
			
			<br>

			<div class="row justify-content-center">
				<button type="submit" name="submit" class="btn btn-primary" value="<?php echo $reason_num; ?>" style="cursor: pointer;">Send Message</button>
			</div>
		</form>
	</div>
</div>

<?php
	include_once 'footer.php';
?>