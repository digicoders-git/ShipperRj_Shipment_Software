<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include("inc/header-link.php"); ?>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">
	<style>
		:root {
			--primary: #6366f1;
			--bg-subtle: #f8fafc;
			--card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
		}

		body {
			font-family: 'Plus Jakarta Sans', sans-serif;
			background-color: var(--bg-subtle);
		}

		.card {
			border: none;
			border-radius: 20px;
			box-shadow: var(--card-shadow);
			overflow: hidden;
		}

		.card-header {
			background: #fff !important;
			border-bottom: 1px solid #f1f5f9 !important;
			padding: 25px 30px !important;
		}

		.table thead th {
			background: #f8fafc;
			text-transform: uppercase;
			font-size: 0.75rem;
			letter-spacing: 1px;
			font-weight: 700;
			color: #64748b;
			padding: 15px 20px;
			border-bottom: none;
		}

		.table tbody td {
			padding: 20px;
			vertical-align: middle;
			border-bottom: 1px solid #f1f5f9;
		}

		.status-badge {
			padding: 6px 14px;
			border-radius: 100px;
			font-size: 0.75rem;
			font-weight: 700;
		}

		.btn-update {
			border-radius: 12px;
			padding: 10px 20px;
			font-weight: 700;
			font-size: 0.85rem;
			transition: all 0.3s;
			border: none;
			box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
		}

		.btn-update:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
		}

		.shipment-id {
			font-family: monospace;
			background: #f1f5f9;
			padding: 2px 8px;
			border-radius: 4px;
			color: #475569;
			font-weight: 600;
		}

		.info-label {
			font-size: 0.7rem;
			color: #94a3b8;
			text-transform: uppercase;
			margin-bottom: 4px;
			display: block;
			font-weight: 700;
		}

		.info-value {
			font-weight: 600;
			color: #1e293b;
			font-size: 0.9rem;
		}

		.animate-fade-in {
			animation: fadeIn 0.8s ease-out;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: translateY(10px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
	</style>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
	<script>
		NProgress.configure({ showSpinner: false });
		NProgress.start();
	</script>
	<div id="toaster"></div>

	<div class="wrapper">
		<?php include("inc/sidebar.php"); ?>

		<div class="page-wrapper">
			<?php include("inc/header.php"); ?>

			<div class="content-wrapper">
				<div class="content">
					<div class="card animate-fade-in">
						<div class="card-header d-flex justify-content-between align-items-center">
							<div>
								<h4 class="fw-extrabold mb-1 text-dark">Active Shipments</h4>
								<p class="text-muted small mb-0">Manage and update status of your assigned deliveries
								</p>
							</div>
							<span class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill fw-bold">
								<i class="mdi mdi-clock-outline me-1"></i> Real-time Sync
							</span>
						</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table id="history" class="table table-hover mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Action</th>
											<th class="text-center">Status</th>
											<th>Sender Details</th>
											<th>Receiver Details</th>
											<th>Package Info</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sr = 1;
										if (!empty($booking)) {
											foreach ($booking as $item) {
												?>
												<tr>
													<td><span
															class="shipment-id">#<?= str_pad($item->id, 5, '0', STR_PAD_LEFT) ?></span>
													</td>
													<td>
														<?php
														if ($item->order_status == 'Placed') {
															echo '<button class="btn btn-primary btn-update" onclick="return order_status(\'' . $item->id . '\',\'Confirmed\')"><i class="mdi mdi-check-circle-outline me-1"></i> Confirm Acceptance</button>';
														} elseif ($item->order_status == 'Confirmed') {
															echo '<button class="btn btn-info text-white btn-update" onclick="return order_status(\'' . $item->id . '\',\'Dispatched\')"><i class="mdi mdi-truck-fast me-1"></i> Start Dispatch</button>';
														} elseif ($item->order_status == 'Dispatched') {
															echo '<button class="btn btn-warning btn-update" onclick="return order_status(\'' . $item->id . '\',\'In Transit\')"><i class="mdi mdi-map-marker-distance me-1"></i> Mark In-Transit</button>';
														} elseif ($item->order_status == 'In Transit') {
															echo '<button class="btn btn-secondary btn-update" onclick="return order_status(\'' . $item->id . '\',\'Out for Delivery\')"><i class="mdi mdi-bike me-1"></i> Out for Delivery</button>';
														} elseif ($item->order_status == 'Out for Delivery') {
															echo '<button class="btn btn-success btn-update" onclick="return openProofModal(\'' . $item->id . '\')"><i class="mdi mdi-check-decagram me-1"></i> Mark Delivered</button>';
														}
														?>
													</td>
													<td class="text-center">
														<?php
														$badge_class = 'bg-primary';
														if ($item->order_status == 'Delivered')
															$badge_class = 'bg-success';
														if ($item->order_status == 'Placed')
															$badge_class = 'bg-info';
														if ($item->order_status == 'Confirmed')
															$badge_class = 'bg-warning';
														?>
														<span
															class="status-badge <?= $badge_class ?> text-white"><?= strtoupper($item->order_status) ?></span>
													</td>
													<td>
														<span class="info-label">Sender</span>
														<div class="info-value"><?= $item->sender ?></div>
														<div class="small text-muted pt-1"><i
																class="mdi mdi-phone-outline me-1"></i><?= $item->sender_mobile ?>
														</div>
														<div class="small text-truncate mt-1" style="max-width: 180px;"
															title="<?= $item->sender_address ?>">
															<i
																class="mdi mdi-map-marker-outline me-1"></i><?= $item->sender_address ?>
														</div>
													</td>
													<td>
														<span class="info-label">Receiver</span>
														<div class="info-value"><?= $item->receiver ?></div>
														<div class="small text-muted pt-1"><i
																class="mdi mdi-phone-outline me-1"></i><?= $item->receiver_mobile ?>
														</div>
														<div class="small text-truncate mt-1" style="max-width: 180px;"
															title="<?= $item->receiver_address ?>">
															<i
																class="mdi mdi-map-marker-outline me-1"></i><?= $item->receiver_address ?>
														</div>
													</td>
													<td>
														<div class="d-flex align-items-center mb-2">
															<span
																class="badge bg-light text-dark fw-bold border"><?= $item->weight ?>
																KG</span>
														</div>
														<div class="info-value small"><?= $item->package_contents ?></div>
														<div class="small text-muted mt-1"><i
																class="mdi mdi-calendar-outline me-1"></i><?= $item->date ?>
														</div>
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
			</div>

			<?php include("inc/footer.php"); ?>
		</div>
	</div>
	<div class="modal fade" id="proofModal" tabindex="-1" role="dialog" aria-labelledby="proofModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
				<div class="modal-header border-0 pt-4 px-4">
					<h5 class="modal-title fw-bold" id="proofModalLabel">Upload Delivery Proof</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="proofForm" enctype="multipart/form-data">
					<div class="modal-body p-4">
						<p class="text-muted small mb-4">Please upload an image as proof that the package has been successfully handed over to the receiver.</p>
						<input type="hidden" name="id" id="modal_booking_id">
						<input type="hidden" name="value" value="Delivered">
						
						<div class="mb-3">
							<label class="info-label mb-2">Proof Image</label>
							<div class="upload-area border-2 border-dashed rounded-4 p-4 text-center" style="border: 2px dashed #e2e8f0; background: #f8fafc; cursor: pointer;" onclick="document.getElementById('proofImage').click()">
								<i class="mdi mdi-camera fs-1 text-primary mb-2 d-block"></i>
								<span class="text-dark fw-bold d-block">Click to upload image</span>
								<span class="text-muted small">JPG, PNG or WEBP (Max 2MB)</span>
								<input type="file" name="proof_image" id="proofImage" class="d-none" accept="image/*" required onchange="previewImage(this)">
							</div>
							<div id="imagePreview" class="mt-3 d-none text-center">
								<img src="" class="img-thumbnail rounded-3" style="max-height: 200px;">
							</div>
						</div>
					</div>
					<div class="modal-footer border-0 pb-4 px-4">
						<button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Submit & Deliver</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php include("inc/footer-link.php"); ?>
	<script>
		function openProofModal(bookingId) {
			$('#modal_booking_id').val(bookingId);
			$('#proofModal').modal('show');
		}

		function previewImage(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#imagePreview img').attr('src', e.target.result);
					$('#imagePreview').removeClass('d-none');
					$('.upload-area i, .upload-area span:not(.d-none)').addClass('d-none');
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$('#proofForm').on('submit', function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			
			NProgress.start();
			$.ajax({
				url: "<?php echo base_url("User/ChangeOrderStatus"); ?>",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					NProgress.done();
					if(response == 1) {
						swal("Delivered!", "Order status updated with proof successfully.", "success").then(() => {
							location.reload();
						});
					} else {
						swal("Error", response || "Failed to update status", "error");
					}
				},
				error: function() {
					NProgress.done();
					swal("Error", "Something went wrong server-side", "error");
				}
			});
		});

		$(document).ready(function () {
			$('#history').DataTable({
				"pageLength": 10,
				"dom": '<"d-flex justify-content-between align-items-center px-4 py-3"f>t<"d-flex justify-content-between align-items-center px-4 py-3"ip>',
				"language": {
					"search": "",
					"searchPlaceholder": "Search shipments..."
				}
			});
		});
	</script>
</body>

</html>