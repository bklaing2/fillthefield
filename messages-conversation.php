<?php
	$page = 3.0;


	/*include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';

	$session_id = @$_SESSION['id'] ? $_SESSION['id'] : 0;

	$conv = $_GET['conv'];

	$sql_conv = "SELECT user_give, user_get FROM conversations WHERE id = '".$conv."'";
	$res_conv = mysqli_query($conn, $sql_conv);
	$row_conv = mysqli_fetch_assoc($res_conv);

	if($session_id == $row_conv["user_give"])
		$sql_conv = "UPDATE conversations SET read_give = '".time()."' WHERE id = '".$conv."';";
	elseif($session_id == $row_conv["user_get"])
		$sql_conv = "UPDATE conversations SET read_get = '".time()."' WHERE id = '".$conv."';";
	mysqli_query($conn, $sql_conv);*/


	include_once 'header.php';
?>


<div class="col-xs-12 col-md-6"><br>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xs-12 col-md-10 col-lg-6">
				<h1 class="text-light">Messages</h1>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-xs-12 col-md-10 col-lg-6">
				<div class="row justify-content-center">
					<h5 class="text-muted float-left" id="label_game">Zoop</h5>
				</div>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-xs-12 col-md-10 col-lg-6">
				<?php include_once 'includes/messages/inc.messages.conversation.php'; ?>
			</div>
		</div>

		<div class="row justify-content-center" id="cont_type">
			<div class="col-xs-12 col-md-10 col-lg-6">
				<div class="row justify-content-center">
					<input type="text" class="col-8 form-control" id="message" placeholder="New message">
					<button class="col-3 btn btn-primary" onclick="send()">Send</button>
				</div>
			</div>
		</div>

		<div class="row justify-content-center d-none" id="cont_closed">
			<div class="col-xs-12 col-md-10 col-lg-6">
				<div class="row justify-content-center">
					<h5 class="text-muted float-left">This transaction has been cancelled.</h5>
				</div>
			</div>
		</div>
	</div><br>
</div>


<script>
	<?php
		$sql_user_give = "SELECT username FROM user_info WHERE id = '".$row_conv["user_give"]."'";
		$res_user_give = mysqli_query($conn, $sql_user_give);
		$row_user_give = mysqli_fetch_assoc($res_user_give);
		$name_user_give = implode($row_user_give);

		$sql_user_get = "SELECT username FROM user_info WHERE id = '".$row_conv["user_get"]."'";
		$res_user_get = mysqli_query($conn, $sql_user_get);
		$row_user_get = mysqli_fetch_assoc($res_user_get);
		$name_user_get = implode($row_user_get);

		$sql_sched = "SELECT opponent FROM schedule WHERE id = '".$row_conv["game"]."'";
		$res_sched = mysqli_query($conn, $sql_sched);
		$row_sched = mysqli_fetch_assoc($res_sched);
		$name_game = $row_sched["opponent"];

		echo "document.getElementById('label_game').innerHTML = '".$name_user_give." is giving ".$name_user_get." a ticket for the ".$name_game." game.';";


		if($row_conv["closed"] == 1)
		{
			echo "document.getElementById('cont_closed').classList.remove('d-none');";
			echo "document.getElementById('cont_type').classList.add('d-none');";
		}
	?>

	function send()
	{
		var conv = <?php echo $conv; ?>;
		var message = document.getElementById("message").value;
		location.replace("includes/messages/inc.messages.send.php?conv="+conv+"&message="+message);
	}
</script>

<?php
	include_once 'footer.php';
?>