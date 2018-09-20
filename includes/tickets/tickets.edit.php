<div class="container" id="tickets_give">
	<div class="row justify-content-center">
		<?php $tick_type = "give"; include 'includes/table/inc.table.schedule.php'; ?>
	</div>
</div>


<div class="container d-none" id="tickets_get">
	<div class="row justify-content-center">
		<?php $tick_type = "get"; include 'includes/table/inc.table.schedule.php'; ?>
	</div>
</div>


<div class="row" id="btn_group_passes">
	<div class="col btn-group" role="group">
		<button type="button" class="col btn btn-secondary" onclick="btn_give();">Give Tickets</button>
		<button type="button" class="col btn btn-secondary" onclick="btn_get();">Get Tickets</button>
	</div>

	<br>

	<div class="col">
		<button type="submit" name="submit" class="btn btn-block btn-small btn-primary" style="cursor: pointer;">Confirm</button>
	</div>
</div>


<script>
	function btn_give()
	{
		document.getElementById("label_header").innerHTML = "Give tickets:";

		document.getElementById("tickets_give").classList.remove('d-none');
		document.getElementById("tickets_get").classList.add('d-none');
	}

	function btn_get()
	{
		document.getElementById("label_header").innerHTML = "Get tickets:";

		document.getElementById("tickets_give").classList.add('d-none');
		document.getElementById("tickets_get").classList.remove('d-none');
	}
</script>