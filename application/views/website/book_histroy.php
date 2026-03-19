<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<?php
	include('inc/header-link.php')
		?>
	<style>
		body {
			font-family: 'Plus Jakarta Sans', sans-serif;
			background-color: #f8fafc;
		}

		.history-card {
			border: none;
			border-radius: 20px;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
			background: #fff;
			transition: all 0.3s ease;
			margin-bottom: 20px;
			border: 1px solid #f1f5f9;
			overflow: hidden;
		}

		.history-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
		}

		.card-header-premium {
			background: #fff;
			padding: 20px;
			border-bottom: 1px solid #f8fafc;
		}

		.card-body-premium {
			padding: 20px;
		}

		.status-chip {
			padding: 6px 14px;
			border-radius: 100px;
			font-size: 0.7rem;
			font-weight: 800;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.shipment-id {
			font-size: 0.85rem;
			color: #3b82f6;
			font-weight: 700;
			background: #eff6ff;
			padding: 4px 10px;
			border-radius: 8px;
		}

		.label-small {
			font-size: 0.7rem;
			color: #94a3b8;
			text-transform: uppercase;
			font-weight: 700;
			margin-bottom: 2px;
			display: block;
		}

		.value-dark {
			font-weight: 600;
			color: #1e293b;
			font-size: 0.95rem;
		}

		.btn-premium-details {
			background: #3b82f6;
			color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 12px;
			font-weight: 700;
			font-size: 0.85rem;
			transition: all 0.3s;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 100%;
			text-decoration: none;
		}

		.btn-premium-details:hover {
			background: #2563eb;
			color: #fff;
			box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
			text-decoration: none;
		}

		.location-dot {
			width: 8px;
			height: 8px;
			border-radius: 50%;
			margin-right: 8px;
		}

		.animate-card {
			animation: cardSlide 0.5s ease-out forwards;
			opacity: 0;
		}

		@keyframes cardSlide {
			from {
				transform: translateY(20px);
				opacity: 0;
			}

			to {
				transform: translateY(0);
				opacity: 1;
			}
		}

		.empty-state {
			text-align: center;
			padding: 60px 20px;
			background: #fff;
			border-radius: 30px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
		}
	</style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar">
	<main class="main" id="top">
		<?php include('inc/header.php') ?>

		<section class="py-7 position-relative">
			<div class="bg-holder bg-size"
				style="background-image:url(<?= base_url('assets/web_assets/img/gallery/hero-header-bg.png') ?>);background-position:top center;background-size:cover;">
			</div>

			<div class="container mt-5">
				<div class="d-flex justify-content-between align-items-end mb-5">
					<div>
						<h2 class="fw-bold text-dark mb-2">My Bookings</h2>
						<p class="text-muted m-0">View and track all your delivery orders in one place.</p>
					</div>
					<div class="d-flex gap-2">
						<a href="<?= base_url('Home/dispute_history') ?>"
							class="btn btn-outline-primary rounded-pill px-4 fw-bold shadow-sm">
							<i class="bi bi-clock-history me-2"></i>Dispute History
						</a>
						<a href="<?= base_url('Home/book_now') ?>"
							class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
							<i class="bi bi-plus-circle me-2"></i>New Shipment
						</a>
					</div>
				</div>

				<div class="row g-4">
					<?php
					if (!empty($booking)) {
						foreach ($booking as $index => $item) {
							$status_class = 'bg-primary text-white';
							if ($item->order_status == 'Delivered')
								$status_class = 'bg-success text-white';
							if ($item->order_status == 'Cancelled')
								$status_class = 'bg-danger text-white';
							if ($item->order_status == 'Placed')
								$status_class = 'bg-info text-white';
							?>
							<div class="col-lg-4 col-md-6 animate-card" style="animation-delay: <?= $index * 0.1 ?>s">
								<div class="history-card">
									<div class="card-header-premium d-flex justify-content-between align-items-center">
										<span class="shipment-id">#<?= str_pad($item->id, 5, '0', STR_PAD_LEFT) ?></span>
										<span class="status-chip <?= $status_class ?>"><?= $item->order_status ?></span>
									</div>
									<div class="card-body-premium">
										<div class="mb-4 d-flex align-items-center">
											<div class="flex-grow-1">
												<span class="label-small">Shipment Date</span>
												<div class="value-dark"><i
														class="bi bi-calendar3 me-2 text-primary"></i><?= $item->date ?></div>
											</div>
											<div class="text-end">
												<span class="label-small">Weight</span>
												<div class="value-dark"><?= $item->weight ?> KG</div>
											</div>
										</div>

										<div class="p-3 bg-light rounded-4 mb-4">
											<div class="mb-2">
												<span class="label-small">Route</span>
												<div class="d-flex align-items-center">
													<div class="location-dot bg-danger"></div>
													<div class="small fw-bold"><?= $item->sender_pincode ?></div>
													<i class="bi bi-arrow-right mx-2 text-muted"></i>
													<div class="location-dot bg-success"></div>
													<div class="small fw-bold"><?= $item->receiver_pincode ?></div>
												</div>
											</div>
											<div class="pt-2 border-top">
												<span class="label-small">Content</span>
												<div class="small text-truncate fw-medium"><?= $item->package_contents ?></div>
											</div>
										</div>

										<div class="d-flex gap-2">
											<a href="<?= base_url('Home/booking_details/' . $item->id) ?>"
												class="btn-premium-details flex-grow-1">
												<i class="bi bi-eye-fill me-2"></i>Details
											</a>
											<?php if ($item->order_status != 'Cancelled'): ?>
												<a href="<?= base_url('Home/disputeraise/' . $item->id) ?>"
													class="btn btn-outline-danger rounded-3 fw-bold small py-3 px-3 d-flex align-items-center justify-content-center"
													title="Raise Dispute">
													<i class="bi bi-exclamation-triangle-fill"></i>
												</a>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					} else {
						?>
						<div class="col-12">
							<div class="empty-state">
								<img src="<?= base_url('assets/web_assets/img/gallery/searching.png') ?>" alt="Empty"
									width="120" class="mb-4 opacity-50">
								<h4 class="fw-bold">No Bookings Found</h4>
								<p class="text-muted">You haven't made any shipments yet. Start your first delivery today!
								</p>
								<a href="<?= base_url('Home/book_now') ?>"
									class="btn btn-primary rounded-pill px-5 mt-2">Book Now</a>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</section>

		<?php include('inc/footer.php') ?>
	</main>

	<?php include('inc/footer-link.php') ?>
</body>

</html>