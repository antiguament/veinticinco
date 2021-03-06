<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title" style="text-align: center;">
				<h4>Subscription history </h4>
				<br>
				<select class="select2" name="month" style="width:200px;" id="month">
					<option value="January" 	<?php if($month == 'January')echo 'selected';?>>January</option>
					<option value="February" 	<?php if($month == 'February')echo 'selected';?>>February</option>
					<option value="March" 		<?php if($month == 'March')echo 'selected';?>>March</option>
					<option value="April" 		<?php if($month == 'April')echo 'selected';?>>April</option>
					<option value="May" 		<?php if($month == 'May')echo 'selected';?>>May</option>
					<option value="June" 		<?php if($month == 'June')echo 'selected';?>>June</option>
					<option value="July" 		<?php if($month == 'July')echo 'selected';?>>July</option>
					<option value="August" 		<?php if($month == 'August')echo 'selected';?>>August</option>
					<option value="September" 	<?php if($month == 'September')echo 'selected';?>>September</option>
					<option value="October" 	<?php if($month == 'October')echo 'selected';?>>October</option>
					<option value="November" 	<?php if($month == 'November')echo 'selected';?>>November</option>
					<option value="December" 	<?php if($month == 'December')echo 'selected';?>>December</option>
				</select>
				<select class="select2" style="width:200px;" id="year">
					<option value="2019" <?php if($year == '2019')echo 'selected';?>>2019</option>
					<option value="2018" <?php if($year == '2018')echo 'selected';?>>2018</option>
					<option value="2017" <?php if($year == '2017')echo 'selected';?>>2017</option>
				</select>
				<button type="button" onClick="submit()" class="btn btn-success btn-cons" style="margin:0px;">Filter</button>
				<script>
					function submit()
					{
						year  = document.getElementById("year").value;
						month = document.getElementById("month").value;
						window.location = "<?php echo base_url();?>index.php?admin/report/" + month + "/" + year;
					}
				</script>
			</div>
			<div class="grid-body ">
				<table class="table table-hover table-condensed" >
					<thead>
						<tr>
							<th>
								#
							</th>
							<th>Date</th>
							<th>Purchased Package</th>
							<th>Paid Amount</th>
							<th>Method</th>
							<th>User</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$subscriptions	=	$this->crud_model->get_subscription_report($month, $year);
							         $counter 		=	1;
							$total_sale		=	0;
							         foreach ($subscriptions as $row):
							  $total_sale	+=	$row['paid_amount'];
							           ?>
						<tr>
							<td><?php echo $counter++;?></td>
							<td><?php echo date("d M, Y" , $row['payment_timestamp']);?></td>
							<td><?php echo $this->db->get_where('plan', array('plan_id'=>$row['plan_id']))->row()->name;?></td>
							<td><?php echo '$' . $row['paid_amount'];?></td>
							<td><?php echo $row['payment_method'];?></td>
							<td><?php echo $this->db->get_where('user', array('user_id'=>$row['user_id']))->row()->email;?></td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				<hr>
				<div style="text-align: center;">
					Total sale : <?php echo '$' . $total_sale;?>
				</div>
			</div>
		</div>
	</div>
</div>