<?php
	$page = 2.0;
	include_once 'header.php';

	if(!isset($_SESSION['id']))
		echo '<script>window.location = "../../login"</script>';
?>


<div class="col-xs-12 col-md-6 col-lg-6"><br>
	<div class="container" id="cont_conv">
		<div class="row justify-content-start">
			<div class="col">
				<h1>Messages</h1>
			</div>
		</div>

		<br>

		<div class="row justify-content-start d-none" id="cont_none">
			<div class="col">
				<h5 class="text-muted float-left">Messages will become available when you match with someone for a ticket.</h5>
			</div>
		</div>

		<div class="row justify-content-center">
			<?php include_once 'includes/messages/inc.messages.conversations.php'; ?>
		</div>
	</div><br>
</div>


<script>
	function row_click(id)
	{
		location.replace("messages-conversation?conv="+id);
	}
</script>

<?php
	include_once 'footer.php';
?>