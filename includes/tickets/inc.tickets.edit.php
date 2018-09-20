<?php
	session_start();
?>

<!doctype html>
<html>
	<head>
		<title>Fill the Field</title>

		<link rel="icon" href="logo_small.png">
		
		<link rel="stylesheet" href="../../css/bootstrap.min.css">
		<link rel="stylesheet" href="../../css/bootstrap-theme.min.css">
	</head>

	<body class="text-light bg-dark">
		<div class="row justify-content-center" style="padding: 20% 0;">
			<h1>Updating<br>Tickets...</h1>
		</div>
	</body>
</html>

<?php

if(isset($_SESSION['id']))
	if(isset($_POST['submit']))
	{	
		include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';

		tickets($conn, $season, $_POST, "give");
		tickets($conn, $season, $_POST, "get");

		echo '<script>window.location = "../../tickets?update=success"</script>';
	}
	else
	{
		echo '<script>window.location = "../../tickets?update=error"</script>';
	}
else
{
	echo '<script>window.location = "../../login"</script>';
}

exit();

function tickets($conn, $season, $post, $type)
{
	if($type == "give")
		$not_type = "get";
	elseif($type == "get")
		$not_type = "give";

	$sql_sched = "SELECT id FROM schedule WHERE season = '".$season."'";
	$res_sched = mysqli_query($conn, $sql_sched);
	$row_sched = mysqli_fetch_assoc($res_sched);

	$offset = $row_sched['id'];

	for ($i = $offset; $i < @mysqli_num_rows($res_sched) + $offset; $i++)
	{
		//If they want a ticket for that game
		if(@isset($post['cb_'.$type.'_'.$i]))
		{
			/*
			If not in database 1.1 ✓
				If ticket availabe 1.1.1 ✓
					Pair tickets ✓
					Make conversation ✓
				If ticket unavailable 1.1.2 ✓
					Make new ticket ✓

			If in database 1.2 ✓
				Do nothing ✓
			*/
			
			$sql_test_tick = "SELECT id FROM tickets WHERE game = '".$i."' AND user_".$type." = '".$_SESSION['id']."';";
			$res_test_tick = mysqli_query($conn, $sql_test_tick);

			//If not in database
			if(@mysqli_num_rows($res_test_tick) < 1)
			{
				$sql_get_tick = "SELECT id, user_".$not_type." FROM tickets WHERE game = '".$i."' AND user_".$type." = '0' AND user_".$not_type." <> '".$_SESSION['id']."' ORDER BY RAND() LIMIT 1";
				$res_get_tick = mysqli_query($conn, $sql_get_tick);

				//If ticket availabe
				if(@mysqli_num_rows($res_get_tick) > 0)
				{
					$row_get_tick = mysqli_fetch_assoc($res_get_tick);

					//Pair tickets
					$sql_up_tick = "UPDATE tickets SET user_".$type." = '".$_SESSION['id']."' WHERE id = ".$row_get_tick['id'].";";
					mysqli_query($conn, $sql_up_tick);

					//Make conversation
					$sql_conv = "INSERT INTO conversations (game, user_".$type.", user_".$not_type.", last_updated) VALUES ('".$i."', '".$_SESSION['id']."', '".$row_get_tick['user_'.$not_type]."', '".time()."');";
					mysqli_query($conn, $sql_conv);
				}

				//If ticket unavailabe
				else
				{
					//Make new ticket
					$sql_new_tick = "INSERT INTO tickets (game, user_".$type.", user_".$not_type.") VALUES ('".$i."', '".$_SESSION['id']."', '0');";
					mysqli_query($conn, $sql_new_tick);
				}
			}

			//If in database
			else
			{
				//Do nothing
			}
		}

		//If they don't want a ticket
		else
		{
			/*
			If not in database 2.1 ✓
				Do nothing ✓

			If in database 2.2 ✓
				If paired 2.2.1 ✓
					Set user to 0 ✓
					Close conversation
				If not paired 2.2.2 ✓
					Delete ✓
			*/

			$sql_test_tick = "SELECT id, user_".$not_type." FROM tickets WHERE game = '".$i."' AND user_".$type." = '".$_SESSION['id']."';";
			$res_test_tick = mysqli_query($conn, $sql_test_tick);

			//If not in database
			if(@mysqli_num_rows($res_test_tick) < 1)
			{
				//Do nothing
			}

			//If in database
			else
			{
				$row_test_tick = mysqli_fetch_assoc($res_test_tick);

				//If paired
				if($row_test_tick['user_'.$not_type] != 0)
				{
					//Set user to 0
					$sql_up_tick = "UPDATE tickets SET user_".$type." = '0' WHERE id = ".$row_test_tick['id'].";";
					mysqli_query($conn, $sql_up_tick);


					//Close conversation
					$sql_conv = "SELECT id FROM conversations WHERE game = '".$i."' AND user_".$type." = '".$_SESSION['id']."';";
					$res_conv = mysqli_query($conn, $sql_conv);
					$row_conv = mysqli_fetch_assoc($res_conv);

					$sql_update_conv = "UPDATE conversations SET read_get = '".time()."' WHERE id = '".$row_conv['id']."';";
					mysqli_query($conn, $sql_update_conv);
				}

				//If not paired
				else
				{
					//Delete
					$sql_del_tick = "DELETE FROM tickets WHERE id = ".$row_test_tick['id'].";";
					mysqli_query($conn, $sql_del_tick);
				}
			}
		}
	}
}