<?php

if(isset($_GET['vaksuyego83u4']))
	if($_GET['vaksuyego83u4'] == "ais7egbreas35")
	{
		include_once $_SERVER['DOCUMENT_ROOT'].'/includes/inc.dbh.php';

		//$header = "From: tickets@fillthefield.com";

		$sql_sched = "SELECT id, day FROM schedule WHERE season = '".$season."'";
		$res_sched = mysqli_query($conn, $sql_sched);

		if(@mysqli_num_rows($res_sched) > 0)
			while($row_sched = mysqli_fetch_assoc($res_sched))
			{
				$game_time = strtotime($row_sched['day']);

				if($game_time <= time() + (6 * 24 * 60 * 60) && $game_time >= time())
				{
					$sql_tick = "SELECT id, user_give, user_get FROM tickets WHERE game = '".$row_sched['id']."'";
					$res_tick = mysqli_query($conn, $sql_tick);

					if(@mysqli_num_rows($res_tick) > 0)
						while($row_tick = mysqli_fetch_assoc($res_tick))
						{
							$user_give = $row_tick['user_give'];
							$user_get = $row_tick['user_get'];

							//Ticket was paired
							if($user_give != 0 && $user_get != 0)
							{
								//Make conversations
								$sql_conv = "INSERT INTO conversations (game, user_give, user_get, last_updated) VALUES ('".$row_sched['id']."', '".$user_give."', '".$user_get."', '".time()."');";
								mysqli_query($conn, $sql_conv);

								//Send success emails
								$sql_user_give = "SELECT username, email FROM user_info WHERE id = '".$user_give."'";
								$res_user_give = mysqli_query($conn, $sql_user_give);
								$row_user_give = mysqli_fetch_assoc($res_user_give);

								$sql_user_get = "SELECT username, email FROM user_info WHERE id = '".$user_get."'";
								$res_user_get = mysqli_query($conn, $sql_user_get);
								$row_user_get = mysqli_fetch_assoc($res_user_get);


								$sub_succ_give = "You get to give a ticket!";
								$sub_succ_get = "You get a ticket!";

								$mess_succ_give = $row_user_get['username']." would like to use your ticket. You can now message ".$row_user_get['username']." to figure out how y'all will trade the ticket.";
								$mess_succ_get = "Congratulations ".$row_user_get['username'].", there is a ticket available! You can now message ".$row_user_give['username']." to figure out how y'all will trade the ticket.";

								//echo mail($row_user_give['email'], $sub_succ_give, $mess_succ_give, $header);
								//echo mail($row_user_get['email'], $sub_succ_get, $mess_succ_get, $header);

								//echo $row_user_give['email']." ".$row_user_get['email'];
							}

							//Ticket wasn't paired
							else
								if($user_give != 0)
								{
									//Send giver fail email
									/*$sql_user_give = "SELECT email FROM user_info WHERE id = '".$user_give."'";
									$res_user_give = mysqli_query($conn, $sql_user_give);
									$row_user_give = mysqli_fetch_assoc($res_user_give);
									@$user_give_email = implode($row_user_give);

									$sub_fail_give = "You don't have to give your ticket";
									$mess_fail_give = "You don't have to give out your ticket for this game.";*/

									// echo mail($user_give_email, $sub_fail_give, $mess_fail_give, $header);

									// echo $user_give_email;
								}
								elseif($user_get != 0)
								{
									//Send getter fail email
									/*$sql_user_get = "SELECT email FROM user_info WHERE id = '".$user_get."'";
									$res_user_get = mysqli_query($conn, $sql_user_get);
									$row_user_get = mysqli_fetch_assoc($res_user_get);
									@$user_get_email = implode($row_user_get);

									$sub_fail_get = "There was no ticket";
									$mess_fail_get = "There were not enough tickets for this game for everyone to get one.";*/

									//echo mail($user_get_email, $sub_fail_get, $mess_fail_get, $header);

									//echo $user_get_email;
								}


							//Put into tickets_old
							/*$sql_tick_old = "INSERT INTO tickets_old (id, game, user_give, user_get) VALUES ('".$row_tick['id']."', '".$row_sched['id']."', '".$user_give."', '".$user_get."');";
							mysqli_query($conn, $sql_tick_old);

							//Delete from tickets
							$sql_tick_del = "DELETE FROM tickets WHERE id = '".$row_tick['id']."'";
							mysqli_query($conn, $sql_tick_del);*/
						}
				}
			}
	}

/*$headers = "Reply-To: Fill the Field <tickets@fillthefield.com>\r\n"; 
$headers .= "Return-Path: Fill the Field <tickets@fillthefield.com>\r\n";
$headers .= "From: Fill the Field <tickets@fillthefield.com>\r\n";
$headers .= "Organization: Fill the Field\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n";

echo mail("bklaing2@gmail.com", "You got a ticket!", "Congratulations, you got a ticket!!!", $headers);*/