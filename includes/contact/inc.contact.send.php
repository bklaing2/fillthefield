<?php

if (isset($_POST['submit']) && isset($_POST['message']))
{
	session_start();

	include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';

	$session_id = @$_SESSION['id'] ? $_SESSION['id'] : 0;

	if($session_id != 0)
	{
		$sql_user = "SELECT username FROM user_info WHERE id = '".$session_id."';";
		$res_user = mysqli_query($conn, $sql_user);
		$row_user = mysqli_fetch_assoc($res_user);
		@$user = implode($row_user);
	}
	else
	{
		$user = "Anonymous";
	}

	$reasons = ["problems", "suggestions" , "report_user", "business", "other"];
	$type_num = $_POST['submit'];
	$type = $reasons[$type_num];

	$message = $_POST['message']."\n\nEmail: " . (($_POST['email'] != "") ? $_POST['email'] : "N/A") ."\nUser ID: ". (($session_id == 0) ? "N/A" : $session_id);
	$subject = $typenum == 2 ? "Report User: ".$_POST['user'] : $type;
	$header = "From: ".$user."@fillthefield.com";

	mail($type."@fillthefield.com", $subject, $message, $header);
}
else
	echo 'ERROR';

header("Location: ../../contact?message=sent");