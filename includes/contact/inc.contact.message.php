<?php

if (isset($_POST['submit']) || isset($_GET['reason']))
	$reason_num = isset($_POST['submit']) ? $_POST['contact_radios'] : $_GET['reason'];
else
	$reason_num = 4;

include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';

$session_id = @$_SESSION['id'] ? $_SESSION['id'] : 0;

$reasons = ["Problem", "Suggestion" , "Report User", "Business Inquiry", "Other"];
$reason = $reasons[$reason_num];

if($session_id != 0)
{
	$sql_user = "SELECT email FROM user_info WHERE id = '".$session_id."'";
	$res_user = mysqli_query($conn, $sql_user);

	if(@mysqli_num_rows($res_user) < 1)
		$email = "";
	else
	{
		$row_user = mysqli_fetch_assoc($res_user);
		$email = $row_user['email'];
	}
}
else
	$email = "";

$rep_user = $reason_num == 2 ? '<div class="form-group"><label id="label_username" for="user">Name of User</label><input type="text" class="form-control" name="user" id="user" placeholder="Name of User"></div><br>' : '';
$message = $reason_num == 2 ? 'Reason for Reporting' : 'Message';