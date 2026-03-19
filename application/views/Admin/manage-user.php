<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
	<?php
	include("inc/header-link.php")
		?>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
	<script>
		NProgress.configure({ showSpinner: false });
		NProgress.start();
	</script>
	<div id="toaster"></div>


	<!-- ====================================
			——— WRAPPER
		===================================== -->
	<div class="wrapper">


		<!-- ====================================
				——— LEFT SIDEBAR WITH OUT FOOTER
			===================================== -->
		<?php
		include("inc/sidebar.php")
			?>



		<!-- ====================================
				——— PAGE WRAPPER
			===================================== -->
		<div class="page-wrapper">

			<!-- Header -->
			<?php
			include("inc/header.php")
				?>

			<!-- ====================================
					——— CONTENT WRAPPER
				===================================== -->

			<div class="content-wrapper">
				<div class="content"><!-- For Components documentaion -->


					<!-- Category Inventory -->
					<div class="card card-default">
						<div class="card-header">
							<h2>Manage User</h2>
						</div>
						<div class="card-body">
							<div class="mb-4 d-flex justify-content-between align-items-center">
								<div class="filter-group">
									<label class="mr-2">Filter by Booking Status:</label>
									<select id="statusFilter" class="form-control d-inline-block w-auto">
										<option value="">All Users</option>
										<option value="Active">Active (Booked within 7 days)</option>
										<option value="Need Attention">Need Attention (7-30 days ago)</option>
										<option value="Inactive">Inactive (30+ days ago)</option>
										<option value="Never Booked">Never Booked</option>
									</select>
								</div>
							</div>
							<div class="table-responsive">
								<table id="user" class="table table-hover table-product" style="width:100%">
									<thead>
										<tr>
											<th>S no</th>
											<th>Account Status</th>
											<th>Booking Status</th>
											<th>Action</th>
											<th>Contact</th>
											<th>Name</th>
											<th>Last Booking</th>
											<th>Email</th>
											<th>Mobile Number</th>
											<th>Password</th>
											<th>Wallet</th>
											<th>Reg. Date</th>
										</tr>
									</thead>
									<tbody>
										<?php

										$sr = 1;
										if (!empty($User)) {
											foreach ($User as $item) {
												?>
												<tr>
													<?php
													$booking_status = "Never Booked";
													$badge_class = "badge-secondary";
													$last_booking_display = "No Booking";
													$days_text = "New User";
													$days = null;

													if (!empty($item->last_booking_date)) {
														$last_booking_date = $item->last_booking_date;
														$last_booking_display = date("d-m-Y", strtotime($last_booking_date));
														$now = time();
														$booking_time = strtotime($last_booking_date);
														$diff = $now - $booking_time;
														$days = floor($diff / (60 * 60 * 24));

														if ($days <= 7) {
															$booking_status = "Active";
															$badge_class = "badge-success";
															$days_text = ($days == 0) ? "Active today" : $days . " days since last book";
														} elseif ($days <= 30) {
															$booking_status = "Need Attention";
															$badge_class = "badge-warning";
															$days_text = $days . " days since last book";
														} else {
															$booking_status = "Inactive";
															$badge_class = "badge-danger";
															$days_text = $days . " days since last book";
														}
													}

													// Professional WhatsApp Message
													$wa_msg = "";
													if ($booking_status == "Active") {
														$wa_msg = "Hi " . $item->name . ", Hope you are doing well! Thank you for your recent trust in ShipperRJ. Let us know if you need any help with your next shipment!";
													} elseif ($booking_status == "Need Attention") {
														$wa_msg = "Hi " . $item->name . ", It's been " . $days . " days since your last booking on ShipperRJ. We've missed serving you! Is there any shipment we can help you with today? Book here: " . base_url();
													} elseif ($booking_status == "Inactive") {
														$wa_msg = "Hi " . $item->name . ", We noticed you haven't booked with ShipperRJ in " . ($days ?? 'many') . " days. We'd love to have you back! Check out our latest rates and services here: " . base_url();
													} else {
														$wa_msg = "Hi " . $item->name . ", Welcome to ShipperRJ! We noticed you haven't made your first booking yet. Sending packages across India is now easier than ever. Start today: " . base_url();
													}
													$wa_link = "https://wa.me/91" . $item->mobile . "?text=" . urlencode($wa_msg);
													?>
													<td><?= $sr ?></td>
													<td>
														<label
															class="switch switch-outline-alt-primary switch-pill form-control-label">
															<input type="checkbox" class="switch-input form-check-input"
																value="on"
																onchange="return Status(this,'registration','id','<?= $item->id; ?>','status')"
																<?php if ($item->status == 'true') {
																	echo 'checked';
																} ?>
																id="switch-id<?= $sr; ?>">
															<span class="switch-label"></span>
															<span class="switch-handle"></span>
														</label>
													</td>
													<td>
														<span class="badge <?= $badge_class ?> text-white">
															<?= $booking_status ?>
														</span>
														<br>
														<small class="text-muted fw-bold"
															style="font-size: 10px;"><?= $days_text ?></small>
													</td>
													<td class="d-flex" style="gap:10px">
														<button class="btn btn-sm btn-info btn-pill mdi mdi-pencil"
															onclick="EditUser('<?= $item->id; ?>')" title="Edit"></button>
														<button class="btn btn-sm btn-warning btn-pill mdi mdi-wallet"
															onclick="UpdateWalletModal('<?= $item->id; ?>', '<?= $item->name; ?>', '<?= $item->wallet; ?>')"
															title="Update Wallet"></button>
														<button class="btn btn-sm btn-danger btn-pill mdi mdi-delete"
															onclick="return Delete('registration','<?= $item->id; ?>')"
															title="Delete"></button>
													</td>
													<td>
														<div class="d-flex" style="gap: 15px;">
															<a href="<?= $wa_link ?>" target="_blank" class="text-success"
																title="WhatsApp Message" style="font-size: 20px;">
																<i class="mdi mdi-whatsapp"></i>
															</a>
															<a href="tel:<?= $item->mobile ?>" class="text-primary"
																title="Direct Call" style="font-size: 20px;">
																<i class="mdi mdi-phone"></i>
															</a>
														</div>
													</td>
													<td><?= $item->name ?></td>
													<td>
														<span class="small font-weight-bold"><?= $last_booking_display ?></span>
													</td>
													<td><?= $item->email ?></td>
													<td><?= $item->mobile ?></td>
													<td><?= $item->password ?></td>
													<td><b>₹<?= number_format($item->wallet, 2) ?></b></td>
													<td><?= $item->date ?> 		<?= $item->time ?></td>
												</tr>
												<?php
												$sr++;
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>

				<!-- Wallet Update Modal -->
				<div class="modal fade" id="walletModal" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Update Wallet - <span id="walletUserName"></span></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('Admin/UpdateUserWallet') ?>" method="POST">
								<input type="hidden" name="user_id" id="walletUserId">
								<div class="modal-body">
									<div class="mb-4 text-center">
										<p class="text-muted mb-1">Current Balance</p>
										<h2 class="text-primary fw-bold">₹<span id="currentWalletBalance"></span></h2>
									</div>
									<div class="form-group mb-3">
										<label>Transaction Type</label>
										<div class="d-flex gap-3">
											<div class="custom-control custom-radio">
												<input type="radio" id="typeCredit" name="type" value="Credit"
													class="custom-control-input" checked>
												<label class="custom-control-label text-success font-weight-bold"
													for="typeCredit">Credit (Add)</label>
											</div>
											<div class="custom-control custom-radio ml-4">
												<input type="radio" id="typeDebit" name="type" value="Debit"
													class="custom-control-input">
												<label class="custom-control-label text-danger font-weight-bold"
													for="typeDebit">Debit (Deduct)</label>
											</div>
										</div>
									</div>
									<div class="form-group mb-3">
										<label>Amount (₹)</label>
										<input type="number" step="0.01" name="amount" class="form-control"
											placeholder="0.00" required>
									</div>
									<div class="form-group mb-0">
										<label>Reason / Note</label>
										<textarea name="reason" class="form-control" rows="3"
											placeholder="Explain why this adjustment is being made..."
											required></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger btn-pill"
										data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary btn-pill">Update Balance</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Footer -->
				<?php
				include("inc/footer.php")
					?>

			</div>
		</div>

		<?php
		include("inc/footer-link.php")
			?>
		<script>
			$(document).ready(function () {
				var table = $('#user').DataTable({
					"order": [[6, "desc"]], // Sort by Last Booking by default (now at index 6)
					"columnDefs": [{
						"searchable": false,
						"orderable": false,
						"targets": 0
					}]
				});

				// Sequential Numbering
				table.on('order.dt search.dt', function () {
					table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
						cell.innerHTML = i + 1;
					});
				}).draw();

				// Filter Logic
				$('#statusFilter').on('change', function () {
					table.column(2).search(this.value).draw();
				});
			});

			function UpdateWalletModal(id, name, balance) {
				$('#walletUserId').val(id);
				$('#walletUserName').text(name);
				$('#currentWalletBalance').text(parseFloat(balance).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
				$('#walletModal').modal('show');
			}
		</script>

</body>

</html>