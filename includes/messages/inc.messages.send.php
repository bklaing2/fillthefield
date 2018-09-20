<?php

if (isset($_GET['conv']) && isset($_GET['message']))
{
	session_start();

	include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';

	include_once $_SERVER['DOCUMENT_ROOT'].'/includes/table/inc.table.parts.php';

	$session_id = @$_SESSION['id'] ? $_SESSION['id'] : 0;

	$conv = $_GET['conv'];
	$message = $_GET['message'];

	$sql_conv = "SELECT user_give, user_get FROM conversations WHERE id = '".$conv."'";
	$res_conv = mysqli_query($conn, $sql_conv);
	$row_conv = mysqli_fetch_assoc($res_conv);

	if($session_id == $row_conv["user_give"] || $session_id == $row_conv["user_get"])
	{
		$sql_mess = "INSERT INTO messages (conversation, user, message) VALUES ('".$conv."', '".$session_id."', '".$message."');";
		mysqli_query($conn, $sql_mess);

		$sql_conv = "UPDATE conversations SET last_updated = '".time()."' WHERE id = '".$conv."';";
		mysqli_query($conn, $sql_conv);


		header("Location: ../../messages.conversation.php?conv=".$conv);
		exit();
	}
	else
		echo '<div><p><br></p></div><h3 class="text-light">You are not a part of this conversation</h3>';
}
else
	echo 'ERROR';