<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/table/inc.table.parts.php';

$session_id = @$_SESSION['id'] ? $_SESSION['id'] : 0;

$sql_conv = "SELECT * FROM conversations WHERE user_give = '".$session_id."' OR user_get = '".$session_id."' ORDER BY last_updated DESC";
$res_conv = mysqli_query($conn, $sql_conv);

if(@mysqli_num_rows($res_conv) > 0)
{
	echo '<table class="table table-sm table-dark table-striped table-hover"><tbody>';

	while($row_conv = mysqli_fetch_assoc($res_conv))
	{
		if($session_id == $row_conv["user_give"])
		{
			$user = "give";
			$user_id = $row_conv["user_get"];
		}
		elseif($session_id == $row_conv["user_get"])
		{
			$user = "get";
			$user_id = $row_conv["user_give"];
		}

		$sql_user = "SELECT username FROM user_info WHERE id = '".$user_id."'";
		$res_user = mysqli_query($conn, $sql_user);
		$row_user = mysqli_fetch_assoc($res_user);
		@$username = implode($row_user);

		$sql_sched = "SELECT opponent FROM schedule WHERE id = '".$row_conv['game']."'";
		$res_sched = mysqli_query($conn, $sql_sched);
		$row_sched = mysqli_fetch_assoc($res_sched);

		echo '<tr style="cursor: pointer;" onclick="row_click('.$row_conv["id"].');">
			<td';
			if($row_conv["read_".$user] < $row_conv["last_updated"])
				echo ' class="border border-light"';
			echo '>'.$username.' <span class="text-muted">- '.$row_sched["opponent"].'</span></td>
		</tr>';


		/*$sql_mess = "SELECT message FROM messages WHERE conversation = '".$conv."' ORDER BY id DESC LIMIT 1";
		$res_mess = mysqli_query($conn, $sql_conv);
		$row_mess = mysqli_fetch_assoc($res_conv);*/
	}

	echo '</tbody></table>';
}
else
{
	echo '<script>document.getElementById("cont_none").classList.remove("d-none");</script>';
}