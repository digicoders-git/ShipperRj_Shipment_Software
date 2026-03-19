<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include("inc/header-link.php"); ?>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">
	<style>
		:root {
			--primary: #0061f2;
			--secondary: #0045ab;
			--success: #10b981;
			--warning: #f59e0b;
			--danger: #ef4444;
			--info: #0ea5e9;
			--background: #f8fafc;
			--surface: #ffffff;
			--text-main: #1e293b;
			--text-muted: #64748b;
			--primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
			--success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
			--warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
			--info-gradient: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
			--card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
			--glass-border: rgba(255, 255, 255, 0.2);
		}

		body {
			font-family: 'Plus Jakarta Sans', sans-serif;
			background-color: var(--background);
			color: var(--text-main);
		}

		.dashboard-header {
			background: var(--primary-gradient) !important;
			position: relative;
			overflow: hidden;
			border-radius: 24px !important;
			border: none;
		}

		.dashboard-header::before {
			content: '';
			position: absolute;
			top: -50%;
			right: -20%;
			width: 400px;
			height: 400px;
			background: rgba(255, 255, 255, 0.08);
			border-radius: 50%;
			z-index: 0;
		}

		.stat-card {
			border: 1px solid var(--glass-border);
			border-radius: 20px;
			transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
			box-shadow: var(--card-shadow);
			overflow: hidden;
			background: var(--surface);
			position: relative;
		}

		.stat-card:hover {
			transform: translateY(-8px);
			box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
		}

		.stat-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 4px;
			background: transparent;
		}

		.stat-card.primary::before {
			background: var(--primary-gradient);
		}

		.stat-card.success::before {
			background: var(--success-gradient);
		}

		.stat-card.warning::before {
			background: var(--warning-gradient);
		}

		.stat-card.info::before {
			background: var(--info-gradient);
		}

		.stat-icon {
			width: 60px;
			height: 60px;
			border-radius: 16px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 26px;
			margin-bottom: 20px;
			transition: all 0.4s;
		}

		.stat-card:hover .stat-icon {
			transform: scale(1.1);
		}

		.icon-primary {
			background: rgba(99, 102, 241, 0.1);
			color: var(--primary);
		}

		.icon-success {
			background: rgba(16, 185, 129, 0.1);
			color: var(--success);
		}

		.icon-warning {
			background: rgba(245, 158, 11, 0.1);
			color: var(--warning);
		}

		.icon-info {
			background: rgba(14, 165, 233, 0.1);
			color: var(--info);
		}

		.stat-value {
			font-size: 2rem;
			font-weight: 800;
			color: var(--text-main);
			margin-bottom: 5px;
			letter-spacing: -1px;
		}

		.stat-label {
			color: var(--text-muted);
			font-weight: 600;
			font-size: 0.85rem;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.chart-card {
			border-radius: 20px;
			border: none;
			box-shadow: var(--card-shadow);
			background: #fff;
		}

		.animate-up {
			animation: slideUp 0.7s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
			opacity: 0;
		}

		@keyframes slideUp {
			from {
				transform: translateY(20px);
				opacity: 0;
			}

			to {
				transform: translateY(0);
				opacity: 1;
			}
		}

		.delay-1 {
			animation-delay: 0.1s;
		}

		.delay-2 {
			animation-delay: 0.2s;
		}

		.delay-3 {
			animation-delay: 0.3s;
		}


		.navbar-right {
			margin-left: auto;
		}
	</style>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
	<script>
		NProgress.configure({ showSpinner: false });
		NProgress.start();
	</script>

	<div class="wrapper">
		<?php include("inc/sidebar.php"); ?>

		<div class="page-wrapper">
			<?php include("inc/header.php"); ?>

			<div class="content-wrapper p-4">
				<?php
				// Data Preparation
				$total_users = $this->db->count_all('registration');
				$total_boys = $this->db->count_all('delivery_boy');
				$total_bookings = $this->db->count_all('booking');

				$revenue_query = $this->db->query("SELECT SUM(amount) as total FROM `booking` WHERE order_status='Delivered'");
				$total_revenue = $revenue_query->row()->total ?? 0;

				// Granular Booking Statuses
				$placed_bookings = $this->db->where('order_status', 'Placed')->count_all_results('booking');
				$assigned_bookings = $this->db->where('order_status', 'Confirmed')->count_all_results('booking');
				$pending_bookings_active = $this->db->where('order_status !=', 'Delivered')->count_all_results('booking');
				$delivered_bookings = $this->db->where('order_status', 'Delivered')->count_all_results('booking');
				$in_transit_bookings = $this->db->where('order_status', 'In Transit')->count_all_results('booking');
				$dispatched_bookings = $this->db->where('order_status', 'Dispatched')->count_all_results('booking');
				$out_for_delivery_bookings = $this->db->where('order_status', 'Out for Delivery')->count_all_results('booking');

				// Monthly Revenue (Last 6 Months)
				$revenue_labels = [];
				$revenue_data = [];
				for ($i = 5; $i >= 0; $i--) {
					$month_start = date('Y-m-01', strtotime("-$i months"));
					$month_end = date('Y-m-t', strtotime("-$i months"));
					$label = date('M', strtotime("-$i months"));

					$r_query = $this->db->query("SELECT SUM(amount) as total FROM `booking` 
						WHERE order_status='Delivered' 
						AND STR_TO_DATE(date, '%d-%m-%Y') BETWEEN '$month_start' AND '$month_end'");

					$revenue_labels[] = $label;
					$revenue_data[] = (int) ($r_query->row()->total ?? 0);
				}

				// Daily Booking Trend (Current Month)
				$trend_labels = [];
				$trend_data = [];
				for ($i = 0; $i < 30; $i++) {
					$day = date('d-m-Y', strtotime("-$i days"));
					$trend_labels[] = date('d M', strtotime("-$i days"));
					$t_query = $this->db->query("SELECT COUNT(*) as count FROM `booking` WHERE date='$day'");
					$trend_data[] = (int) ($t_query->row()->count ?? 0);
				}
				$trend_labels = array_reverse($trend_labels);
				$trend_data = array_reverse($trend_data);
				?>

				<!-- Dashboard Header -->
				<div class="dashboard-header animate-up py-5 px-5 mb-5 text-white shadow-lg">
					<div style="position: relative; z-index: 1;">
						<span
							class="badge bg-white text-primary px-3 py-2 mb-3 fw-bold rounded-pill text-uppercase">Admin
							Portal</span>
						<h1 class="fw-extrabold mb-2 text-white display-5">Dashboard Overview</h1>
						<p class="mb-0 fs-5 opacity-90">Unified management system for shipments, partners, and users.
						</p>
					</div>
				</div>

				<!-- Statistics Grid - Row 1 -->
				<div class="row">
					<div class="col-xl-3 col-md-6 mb-4">
						<a href="<?= base_url('Admin/ManageUser') ?>" class="text-decoration-none">
							<div class="card stat-card primary animate-up delay-1 h-100">
								<div class="card-body p-4 text-center">
									<div class="stat-icon icon-primary mx-auto shadow-sm">
										<i class="mdi mdi-account-group-outline"></i>
									</div>
									<div class="stat-value"><?= $total_users ?></div>
									<div class="stat-label">Total Users</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-xl-3 col-md-6 mb-4">
						<a href="<?= base_url('Admin/ManageDeliveryBoy') ?>" class="text-decoration-none">
							<div class="card stat-card success animate-up delay-2 h-100">
								<div class="card-body p-4 text-center">
									<div class="stat-icon icon-success mx-auto shadow-sm">
										<i class="mdi mdi-truck-delivery"></i>
									</div>
									<div class="stat-value"><?= $total_boys ?></div>
									<div class="stat-label">Fleet Partners</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-xl-3 col-md-6 mb-4">
						<a href="<?= base_url('Admin/ManageBooking') ?>" class="text-decoration-none">
							<div class="card stat-card warning animate-up delay-3 h-100">
								<div class="card-body p-4 text-center">
									<div class="stat-icon icon-warning mx-auto shadow-sm">
										<i class="mdi mdi-package-variant-closed"></i>
									</div>
									<div class="stat-value"><?= $total_bookings ?></div>
									<div class="stat-label">Total Shipments</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card stat-card info animate-up delay-4 h-100">
							<div class="card-body p-4 text-center">
								<div class="stat-icon icon-info mx-auto shadow-sm">
									<i class="mdi mdi-currency-inr"></i>
								</div>
								<div class="stat-value">₹<?= number_format($total_revenue, 0) ?></div>
								<div class="stat-label">Total Revenue</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Statistics Grid - Row 2 (Granular) -->
				<div class="row">
					<div class="col-xl-2 col-md-4 col-sm-6 mb-4">
						<div class="card stat-card warning animate-up delay-1 h-100">
							<div class="card-body p-3 text-center">
								<div class="stat-icon icon-warning mx-auto shadow-sm"
									style="width: 45px; height: 45px; font-size: 20px;">
									<i class="mdi mdi-map-marker-plus"></i>
								</div>
								<div class="stat-value fs-4 mt-2"><?= $placed_bookings ?></div>
								<div class="stat-label small">New Placed</div>
							</div>
						</div>
					</div>
					<div class="col-xl-2 col-md-4 col-sm-6 mb-4">
						<div class="card stat-card primary animate-up delay-2 h-100">
							<div class="card-body p-3 text-center">
								<div class="stat-icon icon-primary mx-auto shadow-sm"
									style="width: 45px; height: 45px; font-size: 20px;">
									<i class="mdi mdi-account-check"></i>
								</div>
								<div class="stat-value fs-4 mt-2"><?= $assigned_bookings ?></div>
								<div class="stat-label small">Confirmed</div>
							</div>
						</div>
					</div>
					<div class="col-xl-2 col-md-4 col-sm-6 mb-4">
						<div class="card stat-card warning animate-up delay-3 h-100">
							<div class="card-body p-3 text-center">
								<div class="stat-icon icon-warning mx-auto shadow-sm"
									style="width: 45px; height: 45px; font-size: 20px;">
									<i class="mdi mdi-truck-fast"></i>
								</div>
								<div class="stat-value fs-4 mt-2"><?= $in_transit_bookings ?></div>
								<div class="stat-label small">In-Transit</div>
							</div>
						</div>
					</div>
					<div class="col-xl-2 col-md-4 col-sm-6 mb-4">
						<div class="card stat-card info animate-up delay-4 h-100">
							<div class="card-body p-3 text-center">
								<div class="stat-icon icon-info mx-auto shadow-sm"
									style="width: 45px; height: 45px; font-size: 20px;">
									<i class="mdi mdi-send"></i>
								</div>
								<div class="stat-value fs-4 mt-2"><?= $dispatched_bookings ?></div>
								<div class="stat-label small">Dispatched</div>
							</div>
						</div>
					</div>
					<div class="col-xl-2 col-md-4 col-sm-6 mb-4">
						<div class="card stat-card success animate-up delay-5 h-100">
							<div class="card-body p-3 text-center">
								<div class="stat-icon icon-success mx-auto shadow-sm"
									style="width: 45px; height: 45px; font-size: 20px;">
									<i class="mdi mdi-check-decagram"></i>
								</div>
								<div class="stat-value fs-4 mt-2"><?= $delivered_bookings ?></div>
								<div class="stat-label small">Delivered</div>
							</div>
						</div>
					</div>
					<div class="col-xl-2 col-md-4 col-sm-6 mb-4">
						<div class="card stat-card info animate-up delay-6 h-100">
							<div class="card-body p-3 text-center">
								<div class="stat-icon icon-info mx-auto shadow-sm"
									style="width: 45px; height: 45px; font-size: 20px;">
									<i class="mdi mdi-clock-outline"></i>
								</div>
								<div class="stat-value fs-4 mt-2"><?= $pending_bookings_active ?></div>
								<div class="stat-label small">Pending</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Charts Section -->
				<div class="row">
					<div class="col-xl-8 mb-4">
						<div class="card chart-card animate-up delay-4 p-4">
							<div class="d-flex justify-content-between align-items-center mb-4">
								<h5 class="fw-bold mb-0">Monthly Revenue Analysis</h5>
							</div>
							<div style="height: 350px;">
								<canvas id="revenueChart"></canvas>
							</div>
						</div>
					</div>
					<div class="col-xl-4 mb-4">
						<div class="card chart-card animate-up delay-4 p-4">
							<div class="mb-4">
								<h5 class="fw-bold mb-0">Booking Status Distribution</h5>
							</div>
							<div style="height: 350px;">
								<canvas id="statusDonutChart"></canvas>
							</div>

						</div>
					</div>
				</div>

				<!-- Booking Trend Section -->
				<div class="row">
					<div class="col-12 mb-4">
						<div class="card chart-card animate-up p-4" style="animation-delay: 0.5s;">
							<div class="mb-4">
								<h5 class="fw-bold mb-0">Daily Booking Trends (Last 30 Days)</h5>
							</div>
							<div style="height: 300px;">
								<canvas id="bookingTrendChart"></canvas>
							</div>
						</div>
					</div>
				</div>

				<script>
					document.addEventListener('DOMContentLoaded', function () {
						Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
						Chart.defaults.color = '#64748b';

						// Revenue Chart
						const revCtx = document.getElementById('revenueChart').getContext('2d');
						const revGradient = revCtx.createLinearGradient(0, 0, 0, 400);
						revGradient.addColorStop(0, 'rgba(16, 185, 129, 0.6)');
						revGradient.addColorStop(1, 'rgba(16, 185, 129, 0.05)');

						new Chart(revCtx, {
							type: 'bar',
							data: {
								labels: <?= json_encode($revenue_labels) ?>,
								datasets: [{
									label: 'Revenue',
									data: <?= json_encode($revenue_data) ?>,
									backgroundColor: revGradient,
									borderColor: '#10b981',
									borderWidth: 2,
									borderRadius: 10
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								plugins: { legend: { display: false } },
								scales: {
									y: { grid: { borderDash: [5, 5] } },
									x: { grid: { display: false } }
								}
							}
						});

						// Status Donut Chart
						const statusCtx = document.getElementById('statusDonutChart').getContext('2d');
						new Chart(statusCtx, {
							type: 'doughnut',
							data: {
								labels: ['Placed', 'Confirmed', 'Dispatched', 'In-Transit', 'Out for Delivery', 'Delivered'],
								datasets: [{
									data: [
										<?= $placed_bookings ?>,
										<?= $assigned_bookings ?>,
										<?= $dispatched_bookings ?>,
										<?= $in_transit_bookings ?>,
										<?= $out_for_delivery_bookings ?>,
										<?= $delivered_bookings ?>
									],
									backgroundColor: ['#64748b', '#6366f1', '#17a2b8', '#f59e0b', '#f53e10ff', '#10b981'],
									borderWidth: 0,
									hoverOffset: 15
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								cutout: '75%',
								plugins: {
									legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
								}
							}
						});

						// Booking Trend Chart
						const trendCtx = document.getElementById('bookingTrendChart').getContext('2d');
						const trendGradient = trendCtx.createLinearGradient(0, 0, 0, 300);
						trendGradient.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
						trendGradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

						new Chart(trendCtx, {
							type: 'line',
							data: {
								labels: <?= json_encode($trend_labels) ?>,
								datasets: [{
									label: 'Bookings',
									data: <?= json_encode($trend_data) ?>,
									borderColor: '#6366f1',
									backgroundColor: trendGradient,
									fill: true,
									tension: 0.4,
									pointRadius: 4,
									pointBackgroundColor: '#6366f1',
									borderWidth: 3
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								plugins: { legend: { display: false } },
								scales: {
									y: { beginAtZero: true, grid: { borderDash: [5, 5] }, ticks: { stepSize: 1 } },
									x: { grid: { display: false } }
								}
							}
						});
					});
				</script>
			</div>

			<?php include("inc/footer.php"); ?>
		</div>
	</div>
	<?php include("inc/footer-link.php"); ?>
</body>

</html>