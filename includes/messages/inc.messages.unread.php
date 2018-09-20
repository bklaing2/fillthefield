<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';

$session_id = @$_SESSION['id'] ? $_SESSION['id'] : 0;

$unread = 0;

$sql_conv = "SELECT user_give, user_get, read_give, read_get, last_updated FROM conversations WHERE user_give = '".$session_id."' OR user_get = '".$session_id."'";
$res_conv = mysqli_query($conn, $sql_conv);

while($row_conv = mysqli_fetch_assoc($res_conv))
{
	if($session_id == $row_conv["user_give"])
		$user = "give";
	elseif($session_id == $row_conv["user_get"])
		$user = "get";

	if($row_conv["read_".$user] < $row_conv["last_updated"])
		$unread++;
}

if($unread > 0)
	echo $unread;