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
						<div class="card-header d-flex justify-content-between align-items-center">
							<h2>All Booking</h2>
							<a href="<?= base_url('Admin/export_bookings') ?>" class="btn btn-success">
								<i class="mdi mdi-file-export me-1"></i> Export to CSV
							</a>
						</div>
						<div class="card-body table-responsive">
							<table id="notification" class="table table-hover table-product table-responsive-lg"
								style="width:100%">
								<thead>
									<tr>
										<th>S no</th>
										<th>Assign Delivary Boy</th>
										<th>Booking Status</th>
										<th>Booking Amount</th>
										<th>Sender Name</th>
										<th>Sender Address</th>
										<th>Sender Pincode</th>
										<th>Sender Mobile Number</th>
										<th>Date</th>
										<th>Reciver Name</th>
										<th>Reciver Address</th>
										<th>Reciver Pincode</th>
										<th>Reciver Mobile Number</th>
										<th>Package Weight</th>
										<th>Package Dimension</th>
										<th>Package Contents</th>
										<th>Proof</th>

									</tr>
								</thead>
								<tbody>
									<?php

									$sr = 1;
									if (!empty($booking)) {
										foreach ($booking as $item) {
											?>
											<tr>
												<td><?= $sr ?></td>
												<td class="text-center">
													<?php
													if (!empty($item->delivery_boy_id)) {
														$delivery_boy = $this->db->where('id', $item->delivery_boy_id)->get('delivery_boy')->row();
														?>

														<p class="badge bg-warning fs--2 px-2 py-1 text-white">
															<?= $delivery_boy->name ?>
														</p>
														<?php
													} else {
														?>
														<button class="btn btn-sm btn-success btn-pill mdi mdi-plus"
															onclick="AssignDelvieryBoy('<?= $item->id; ?>')"
															title="Assign Delivery Boy"></button>
														<?php
													}
													?>
												</td>
												<td>
													<span class="badge bg-success text-white" data-toggle="tooltip"
														title="<?= $item->order_status ?>">
														<?= $item->order_status ?>
													</span>
												</td>
												<td><?= $item->amount ?></td>
												<td><?= $item->sender ?></td>
												<td><?= $item->sender_address ?></td>
												<td><?= $item->sender_pincode ?></td>
												<td><?= $item->sender_mobile ?></td>
												<td><?= $item->date ?></td>
												<td><?= $item->receiver ?></td>
												<td><?= $item->receiver_address ?></td>
												<td><?= $item->receiver_pincode ?></td>
												<td><?= $item->receiver_mobile ?></td>
												<td><?= $item->weight ?></td>
												<td><?= $item->length ?>cm , <?= $item->width ?>cm , <?= $item->height ?>cm</td>
												<td><?= $item->package_contents ?></td>
												<td>
													<?php if (!empty($item->delivery_proof)): ?>
														<div class="cursor-pointer"
															onclick="viewImage('<?= base_url('assets/admin_assets/images/proof/') . $item->delivery_proof; ?>')"
															style="cursor: pointer;">
															<img src="<?= base_url('assets/admin_assets/images/proof/') . $item->delivery_proof; ?>"
																alt="Proof" class="img-thumbnail" style="max-height: 100px;">
														</div>
													<?php else: ?>
														<span class="text-muted small">No Proof</span>
													<?php endif; ?>
												</td>
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

			<!-- Footer -->
			<?php
			include("inc/footer.php")
				?>

		</div>
	</div>
	<!-- add Notification  -->

	<?php
	include("inc/footer-link.php")
		?>
	<!-- Premium Image Preview Modal -->
	<div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-hidden="true"
		style="backdrop-filter: blur(5px);">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content border-0" style="background: transparent;">
				<div class="modal-body p-0 text-center">
					<div class="position-relative d-inline-block shadow-lg rounded-4 overflow-hidden bg-dark">
						<!-- Close button pinned to image top-right -->
						<button type="button"
							class="btn btn-light rounded-circle position-absolute d-flex align-items-center justify-content-center"
							data-bs-dismiss="modal" data-dismiss="modal"
							style="top: 15px; right: 15px; width: 35px; height: 35px; z-index: 10; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
							<i class="mdi mdi-close fs-4 text-dark"></i>
						</button>
						<!-- Label pinned to image top-left -->
						<div class="position-absolute px-3 py-2 text-white fw-bold d-flex align-items-center"
							style="top: 0; left: 0; background: rgba(0,0,0,0.6); border-bottom-right-radius: 15px; z-index: 5; backdrop-filter: blur(4px);">
							<i class="mdi mdi-image-search-outline me-2"></i>Proof Preview
						</div>
						<!-- The Image -->
						<img src="" id="fullPreviewImage" class="img-fluid"
							style="max-height: 80vh; min-width: 300px; display: block;">
					</div>
					<div class="mt-4">
						<button type="button" class="btn btn-primary rounded-pill px-5 fw-bold shadow-lg"
							data-bs-dismiss="modal" data-dismiss="modal">
							CLOSE PREVIEW
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		function viewImage(src) {
			$('#fullPreviewImage').attr('src', src);
			$('#imagePreviewModal').modal('show');
		}

		$(document).ready(function () {
			$('#notification').DataTable();
		});
	</script>
</body>

</html>