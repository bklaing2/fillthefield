<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';

include_once 'inc.table.parts.php';

$sql_sched = "SELECT id, day, opponent FROM schedule WHERE season = '".$season."'";
$res_sched = mysqli_query($conn, $sql_sched);

if(@mysqli_num_rows($res_sched) > 0)
{
	////Table head///////////////////////////////////////////////////////
	if($page == 0.0)
		echo $table_home_head;
	elseif($page == 1.0)
		echo $table_tick_head;
	/////////////////////////////////////////////////////////////////////

	while($row_sched = mysqli_fetch_assoc($res_sched))
	{
		$time_threshold = time() + (1 * 12 * 60 * 60);

		$game_time = strtotime($row_sched["day"]);
		$date = date_create($row_sched["day"]);

		$sql_tick_game = "SELECT id FROM tickets WHERE game = '".$row_sched["id"]."' AND user_give <> '0';";
		$res_tick_game = mysqli_query($conn, $sql_tick_game);

		if($page != 0.0)
		{
			$sql_tick = "SELECT id FROM tickets WHERE game = '".$row_sched["id"]."' AND user_".$tick_type." = '".$_SESSION['id']."';";
			$res_tick = mysqli_query($conn, $sql_tick);
		}

		////Table row////////////////////////////////////////////////////////
		if($game_time < $time_threshold)
			echo '<tr style="background-color: #000;" class="text-muted";">';
		elseif($page == 1.0)
			if(@mysqli_num_rows($res_tick) > 0)
				echo '<tr class="border border-bottom-0 border-light" style="cursor: pointer;" onclick="row_click(\''.$row_sched["id"].'\', \''.$tick_type.'\')">';
			else
				echo '<tr style="cursor: pointer;" onclick="row_click(\''.$row_sched["id"].'\', \''.$tick_type.'\')">';
		else
			echo '<tr>';
		/////////////////////////////////////////////////////////////////////

		////Table data///////////////////////////////////////////////////////
		if($page == 1.0)
		{
			echo '<td><input style="cursor: pointer;" type="checkbox" name="cb_'.$tick_type.'_'.$row_sched["id"].'" id="cb_'.$tick_type.'_'.$row_sched["id"].'" value="'.$row_sched["id"].'" onclick="row_click(\''.$row_sched["id"].'\', \''.$tick_type.'\')"';
				if(@mysqli_num_rows($res_tick) > 0)
					echo ' checked';
				if($game_time < $time_threshold)
					echo ' disabled';
			echo '></td>';
		}

		echo '<td>'.date_format($date,"M. j").'</td><td>'.$row_sched["opponent"].'</td>';

		if($page == 1.0)
		{
			echo '<td><input type="number" max="40" onclick="row_click(\''.$row_sched["id"].'\', \''.$tick_type.'\')"';

			if($game_time < $time_threshold)
				echo ' disabled';

			echo '></td>';
		}

		if($page == 0.0)
			echo '<td>'.@mysqli_num_rows($res_tick_game).'</td>';
		/////////////////////////////////////////////////////////////////////

		echo '</tr>';
	}

	echo $table_footer;
}
else
	echo "0 results";