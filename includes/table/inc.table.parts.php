<?php

$table_head = '<table class="table table-sm table-dark table-striped">
	<thead class="thead-dark text">
		<tr>';
$table_head_hover = '<table class="table table-sm table-dark table-striped table-hover">
	<thead class="thead-dark text">
		<tr>';

$table_body = '</tr>
	</thead>
	<tbody>';

$table_footer = '</tbody>
</table>';



	$table_home_head = $table_head.'<th scope="col">Date</th>
	<th scope="col">Playing</th>
	<th scope="col">Tickets</th>'.$table_body;

	$table_tick_head = $table_head_hover.'<th scope="col"></th>
	<th scope="col">Date</th>
	<th scope="col">Playing</th>'.$table_body;