<?php

if (isset($_GET['conv']))
{
	include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/includes/table/inc.table.parts.php';

	$session_id = @$_SESSION['id'] ? $_SESSION['id'] : 0;

	$conv = $_GET['conv'];

	$sql_conv = "SELECT game, user_give, user_get, closed FROM conversations WHERE id = '".$conv."'";
	$res_conv = mysqli_query($conn, $sql_conv);
	$row_conv = mysqli_fetch_assoc($res_conv);

	if($session_id == $row_conv["user_give"] || $session_id == $row_conv["user_get"])
	{

		$sql_mess = "SELECT user, message FROM messages WHERE conversation = '".$conv."'";
		$res_mess = mysqli_query($conn, $sql_mess);

		echo '<table class="table table-sm table-dark" style="background-color: #000;">
			<tbody>';

			while($row_mess = mysqli_fetch_assoc($res_mess))
			{
				echo '<tr>';
					if($row_mess["user"] == $session_id)
						echo '<td class="float-right rounded border border-primary">'.$row_mess["message"].'</td>';
					else
						echo '<td class="float-left rounded border border-secondary">'.$row_mess["message"].'</td>';				
				echo '</tr>';
			}

			echo '</tbody>
		</table>';
	}
	else
		echo '<div><p><br></p></div><h3 class="text-light">You are not a part of this conversation</h3>';

	if($session_id == $row_conv["user_give"])
		$sql_conv = "UPDATE conversations SET read_give = '".time()."' WHERE id = '".$conv."';";
	elseif($session_id == $row_conv["user_get"])
		$sql_conv = "UPDATE conversations SET read_get = '".time()."' WHERE id = '".$conv."';";
	mysqli_query($conn, $sql_conv);
}
else
	echo 'ERROR';