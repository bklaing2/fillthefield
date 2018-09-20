<?php

session_start();

if (isset($_POST['submit']))
{	
	include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);

	if(empty($username) || empty($pwd))
		header("Location: ../../login?login=empty");
	else
	{
		$sql_user = "SELECT id, pwd FROM user_info WHERE username = '".$username."'";
		$res_user = mysqli_query($conn, $sql_user);

		if(@mysqli_num_rows($res_user) < 1)
			header("Location: ../../login?login=username");
		else
		{
			$row_user = mysqli_fetch_assoc($res_user);

			if(password_verify($pwd, $row_user['pwd']))
			{
				$_SESSION['id'] = $row_user['id'];

				header("Location: ../../index?login=success");
			}
			else
				header("Location: ../../login?login=pwd");
				
		}
	}
}
else
	header("Location: ../../login?login=error");

exit();