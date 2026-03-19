<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include("inc/header-link.php"); ?>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">
	<style>
		:root {
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
			background: rgba(16, 185, 129, 0.1);
			color: #10b981;
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

		.shipment-id {
			font-family: monospace;
			background: #f1f5f9;
			padding: 2px 8px;
			border-radius: 4px;
			color: #475569;
			font-weight: 600;
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
								<h4 class="fw-extrabold mb-1 text-dark">Delivery Logs</h4>
								<p class="text-muted small mb-0">Complete history of your successful deliveries</p>
							</div>
							<span class="badge bg-success-soft text-success px-3 py-2 rounded-pill fw-bold">
								<i class="mdi mdi-checkbox-marked-circle-outline me-1"></i> Verified Shipments
							</span>
						</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table id="history" class="table table-hover mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th class="text-center">Status</th>
											<th>Sender Details</th>
											<th>Receiver Details</th>
											<th>Delivery Info</th>
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
													<td><span
															class="shipment-id">#<?= str_pad($item->id, 5, '0', STR_PAD_LEFT) ?></span>
													</td>
													<td class="text-center">
														<span class="status-badge">
															<i class="mdi mdi-check-circle me-1"></i> DELIVERED
														</span>
													</td>
													<td>
														<span class="info-label">Sender</span>
														<div class="info-value"><?= $item->sender ?></div>
														<div class="small text-muted pt-1"><i
																class="mdi mdi-phone-outline me-1"></i><?= $item->sender_mobile ?>
														</div>
													</td>
													<td>
														<span class="info-label">Receiver</span>
														<div class="info-value"><?= $item->receiver ?></div>
														<div class="small text-muted pt-1"><i
																class="mdi mdi-phone-outline me-1"></i><?= $item->receiver_mobile ?>
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
																class="mdi mdi-calendar-check-outline me-1"></i><?= $item->date ?>
														</div>
													</td>
													<td>
														<?php if (!empty($item->delivery_proof)): ?>
															<div class="cursor-pointer" onclick="viewImage('<?= base_url('assets/admin_assets/images/proof/') . $item->delivery_proof; ?>')" style="cursor: pointer;">
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
			</div>

			<?php include("inc/footer.php"); ?>
		</div>
	</div>
	<?php include("inc/footer-link.php"); ?>
	<!-- Premium Image Preview Modal -->
	<div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-hidden="true" style="backdrop-filter: blur(5px);">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content border-0" style="background: transparent;">
				<div class="modal-body p-0 text-center">
					<div class="position-relative d-inline-block shadow-lg rounded-4 overflow-hidden bg-dark">
						<!-- Close button pinned to image top-right -->
						<button type="button" class="btn btn-light rounded-circle position-absolute d-flex align-items-center justify-content-center" 
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
						<img src="" id="fullPreviewImage" class="img-fluid" style="max-height: 80vh; min-width: 300px; display: block;">
					</div>
					<div class="mt-4">
						<button type="button" class="btn btn-primary rounded-pill px-5 fw-bold shadow-lg" data-bs-dismiss="modal" data-dismiss="modal">
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
			$('#history').DataTable({
				"pageLength": 10,
				"dom": '<"d-flex justify-content-between align-items-center px-4 py-3"f>t<"d-flex justify-content-between align-items-center px-4 py-3"ip>',
				"language": {
					"search": "",
					"searchPlaceholder": "Search logs..."
				}
			});
		});
	</script>
</body>

</html>