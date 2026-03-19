<?php defined("BASEPATH") or exit("No direct scripts allowed here"); ?>
<?php
	if (isset($action)) 
	{
		switch ($action) 
		{
			
			case 'TrackOrder':
		?>
		<!-- SWEETALERT 2 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.16.6/sweetalert2.min.css"/>
		<style>
			.dot {
			width: 10px;
			height: 10px;
			border-radius: 50%;
			background-color: #ccc; /* Default color */
			position: relative;
			}
			
			.dot.completed {
			background-color: #28a745; /* Green for completed */
			}
			
			.track-line {
			height: 2px;
			background-color: #ccc; /* Default color */
			flex-grow: 1;
			}
			
			.track-line.completed {
			background-color: #28a745; /* Green for completed */
			}
			
			.track_order_date {
			text-align: center;
			width: 100px; /* Adjust width as needed */
			margin-top: 5px;
			}
			
		</style>
		<section class="p-0">
			<div class="container">
				<div class="row d-flex justify-content-center ">
					<div class="col">
						<div class="card card-stepper border-0">
							<div class="card-body ">
								<div class="d-flex justify-content-between align-items-center">
									<div class="d-flex flex-column">
										<?php
											$booking_id=$list[0]->id;
											$lastdata = $this->db->query("SELECT * FROM `track_order` WHERE booking_id='$booking_id' ORDER BY id DESC LIMIT 1")->row();
											if(!empty($lastdata))
											{
												$timestamp = strtotime($lastdata->date);
												$formattedDate = date('d F Y', $timestamp);
												
												$bookstatus=$lastdata->order_status;
												
											}
											else
											{
												$bookstatus='';
												$formattedDate='';
											}
										?>
										<span class="lead fw-normal">Your order has been <?= $bookstatus?></span>
										<span class="text-muted small">by DHFL on <?= $formattedDate?></span>
									</div>
									<?php
										if($bookstatus=='Placed')
										{
										?>
										<button class="btn btn-danger btn-sm" onclick="return order_status('<?= $booking_id ?>','Cancelled')">Cancle Order</button>
										<?php
										}
									?>
									
									
									
								</div>
								<hr class="my-4">
								
								
								<!------------------------------ Here Tracking line start -------------->
								
								<?php
									// Sample data for demonstration
									$booking_id = $list[0]->id;
									$booking = $this->db->order_by("id", "ASC")->where('booking_id', $booking_id)->get('track_order')->result();
									$statuses = ['Placed', 'Confirmed', 'Dispatched', 'In Transit', 'Out for Delivery', 'Delivered'];
									$completedStatus = []; // Array to hold the completed statuses
									
									if (!empty($booking)) {
										foreach ($booking as $item) {
											$completedStatus[] = $item->order_status; // Collecting completed statuses
										}
									}
								?>
								
								<div class="d-flex flex-column">
									<div class="d-flex flex-row justify-content-between align-items-center align-content-center">
										<?php
											foreach ($statuses as $index => $status) {
												$isCompleted = in_array($status, $completedStatus);
											?>
											<span class="dot <?= $isCompleted ? 'completed' : '' ?>"></span>
											<?php if ($index < count($statuses) - 1) { ?>
												<hr class="flex-fill track-line <?= $isCompleted ? 'completed' : '' ?>">
											<?php } ?>
											<?php
											}
										?>
									</div>
									
									<div class="d-flex flex-row justify-content-between align-items-center">
										<?php
											foreach ($statuses as $status) {
												$dateString = '';
												foreach ($booking as $item) {
													if ($item->order_status == $status)
													{
														$dateString = $item->date;
														break;
													}
												}
												$formattedDate = $dateString ? date('d F Y', strtotime($dateString)) : '';
											?>
											<div class="d-flex flex-column align-items-center track_order_date">
												<span><?= $formattedDate ?></span>
												<span><?= $status ?></span>
											</div>
											<?php
											}
										?>
									</div>
								</div>
								<!-------------------------------- Here Tracking line end -------------->
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
			break;
		}
	} 
	else 
	{
		echo 'Action is required.';
	}
?>		

<!-- SWEETALERT 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
	function order_status(id,value) 
	{
		// alert('Are You Sur Want To Change Status !');
		
		var status = true;
		swal({
			title: "Are you sure?",
			text: "You want to "+value+" this Order !",
			icon: "warning",
			buttons: true,
			dangerMode: true
			}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "<?php echo base_url("Home/ChangeOrderStatus"); ?>",
					type: "post",
					data: {
						'id': id,
						'value': value
					},
					success: function(response) {
						swal("Order Status Changed successfully !", {
							icon: "success",
						});
						location.reload();
					}
				});
			}
		});
		return status;
	}
</script>							