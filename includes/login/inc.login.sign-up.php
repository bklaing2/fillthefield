<?php

session_start();

if(isset($_POST['submit']))
{
	include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);
	$pwd_con = mysqli_real_escape_string($conn, $_POST['password_confirm']);

	if(empty($username) || empty($email) || empty($pwd) || empty($pwd_con))
		header("Location: ../../sign-up?register=empty");
	elseif($pwd != $pwd_con)
		header("Location: ../../sign-up?register=password-mismatch");
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
		header("Location: ../../sign-up?register=email");
	else
	{
		$sql_user_id = "SELECT username FROM user_info WHERE username = '".$username."'";
		$res_pass_id = mysqli_query($conn, $sql_user_id);

		if(@mysqli_num_rows($res_pass_id) > 0)
			header("Location: ../../sign-up?register=username-taken");
		else
		{
			$pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);

			$sql_ins_user = "INSERT INTO user_info (username, email, pwd) VALUES ('".$username."', '".$email."', '".$pwd_hash."');";
			mysqli_query($conn, $sql_ins_user);

			$sql_username = "SELECT id FROM user_info WHERE username = '".$username."'";
			$res_username = mysqli_query($conn, $sql_username);
			$row_username = mysqli_fetch_assoc($res_username);
			$_SESSION['id'] = $row_username['id'];

			header("Location: ../../tickets?register=success");
		}
	}
}
else
	header("Location: ../../sign-up?register=error");

exit();