<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Detail Pemesanan Konsumsi</button>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <?php
          date_default_timezone_set('UTC');
	$date = $_SESSION["InputProgramMulai"];
	$end_date = $_SESSION["InputProgramSelesai"];
	// var_dump($date);
	// var_dump($end_date);
	while (strtotime($date) <= strtotime($end_date)) 
	{
                //echo "$date\n";
                ?>
                <div  class="panel ">
					<div class="panel-heading">
						<h3 class="panel-title"><?=$date?></h3>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
						<tr>
							<th>Coffee Break Pagi</th>
							<th>&#9658</th>
							<td><input type="number" name="CoffeBreak_Pagi"></td>
						</tr>
						<tr>
							<th>Makan Siang</th>
							<th>&#9658</th>
							<td><input type="number" name="Makan_Siang"></td>
						</tr>
						<tr>
							<th>Coffee Break Siang</th>
							<th>&#9658</th>
							<td><input type="number" name="CoffeBreak_Siang"></td>

						</tr>
						</table>
					</div>
				</div>
				<?php
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                echo "<br>";
	}
	?>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
