<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include("inc/header-link.php"); ?>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">
	<style>
		:root {
			--primary: #6366f1;
			--secondary: #4f46e5;
			--success: #10b981;
			--warning: #f59e0b;
			--danger: #ef4444;
			--background: #f8fafc;
			--surface: #ffffff;
			--text-main: #1e293b;
			--text-muted: #64748b;
			--primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
			--secondary-gradient: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);
			--success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
			--warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
			--info-gradient: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
			--card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
			--glass-bg: rgba(255, 255, 255, 0.8);
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
			right: -10%;
			width: 300px;
			height: 300px;
			background: rgba(255, 255, 255, 0.1);
			border-radius: 50%;
			z-index: 0;
		}

		.dashboard-header::after {
			content: '';
			position: absolute;
			bottom: -20%;
			left: 10%;
			width: 150px;
			height: 150px;
			background: rgba(255, 255, 255, 0.05);
			border-radius: 30px;
			transform: rotate(45deg);
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
			z-index: 1;
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
			transition: background 0.3s;
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

		.stat-icon {
			width: 64px;
			height: 64px;
			border-radius: 18px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 28px;
			margin-bottom: 24px;
			transition: all 0.5s ease;
		}

		.stat-card:hover .stat-icon {
			transform: scale(1.1) rotate(5deg);
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

		.stat-value {
			font-size: 2.25rem;
			font-weight: 800;
			color: var(--text-main);
			line-height: 1;
			margin-bottom: 8px;
			letter-spacing: -1px;
		}

		.stat-label {
			color: var(--text-muted);
			font-weight: 600;
			font-size: 0.95rem;
			text-transform: uppercase;
			letter-spacing: 0.8px;
		}

		.chart-card {
			border-radius: 24px;
			border: none;
			box-shadow: var(--card-shadow);
			background: #fff;
			transition: transform 0.3s ease;
		}

		.animate-up {
			animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
			opacity: 0;
		}

		@keyframes slideUp {
			from {
				transform: translateY(30px);
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

		.delay-4 {
			animation-delay: 0.4s;
		}

		.activity-item {
			padding: 15px;
			border-radius: 12px;
			transition: background 0.2s;
			display: flex;
			align-items: center;
			gap: 15px;
		}

		.activity-item:hover {
			background: #f1f5f9;
		}

		.btn-premium {
			background: var(--primary-gradient);
			color: white !important;
			border: none;
			padding: 12px 24px;
			border-radius: 12px;
			font-weight: 700;
			transition: all 0.3s;
			box-shadow: 0 4px 15px rgba(99, 102, 241, 0.2);
			text-decoration: none;
		}

		.btn-premium:hover {
			transform: translateY(-3px);
			box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
			color: white !important;
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
				<!-- Data Preparation -->
				<?php
				$Delivery_BoyID = $this->session->userdata("Delivery_Boy");
				$userData = $this->db->where('id', $Delivery_BoyID)->get('delivery_boy')->row();

				// Stats Calculation
				$pending_query = $this->db->query("SELECT * FROM `booking` WHERE order_status!='Delivered' AND delivery_boy_id='$Delivery_BoyID'");
				$pending_count = $pending_query->num_rows();

				$delivered_query = $this->db->query("SELECT * FROM `booking` WHERE order_status='Delivered' AND delivery_boy_id='$Delivery_BoyID'");
				$delivered_count = $delivered_query->num_rows();

				$earnings_query = $this->db->query("SELECT SUM(amount) as total FROM `booking` WHERE order_status='Delivered' AND delivery_boy_id='$Delivery_BoyID'");
				$total_earnings = $earnings_query->row()->total ?? 0;

				// Graph Data: Monthly Deliveries (Last 6 Months)
				$monthly_labels = [];
				$monthly_data = [];
				for ($i = 5; $i >= 0; $i--) {
					$month_start = date('Y-m-01', strtotime("-$i months"));
					$month_end = date('Y-m-t', strtotime("-$i months"));
					$label = date('M', strtotime("-$i months"));

					$m_query = $this->db->query("SELECT COUNT(*) as count FROM `booking` 
						WHERE delivery_boy_id='$Delivery_BoyID' 
						AND order_status='Delivered' 
						AND STR_TO_DATE(date, '%d-%m-%Y') BETWEEN '$month_start' AND '$month_end'");

					$monthly_labels[] = $label;
					$monthly_data[] = (int) $m_query->row()->count;
				}

				// Graph Data: Status Distribution
				$status_labels = ['Delivered', 'Pending', 'In Transit', 'Out For Delivery'];
				$s_delivered = $delivered_count;
				$s_pending = $this->db->query("SELECT COUNT(*) as count FROM `booking` WHERE delivery_boy_id='$Delivery_BoyID' AND order_status!='Delivered'")->row()->count;
				$s_transit = $this->db->query("SELECT COUNT(*) as count FROM `booking` WHERE delivery_boy_id='$Delivery_BoyID' AND order_status='In Transit'")->row()->count;
				$s_cancelled = $this->db->query("SELECT COUNT(*) as count FROM `booking` WHERE delivery_boy_id='$Delivery_BoyID' AND order_status='Out for Delivery'")->row()->count;
				$status_data = [(int) $s_delivered, (int) $s_pending, (int) $s_transit, (int) $s_cancelled];
				?>

				<!-- Dashboard Header -->
				<div class="dashboard-header animate-up py-5 px-5 mb-5 text-white shadow-lg">
					<div style="position: relative; z-index: 1;">
						<span class="badge bg-white text-primary px-3 py-2 mb-3 fw-bold rounded-pill text-uppercase"
							style="letter-spacing: 1px;">Fleet Partner</span>
						<h1 class="fw-extrabold mb-2 text-white display-4">Hello,
							<?= explode(' ', $userData->name)[0] ?>! 👋
						</h1>
						<p class="mb-0 fs-5 opacity-90 fw-medium">Great job! You delivered <span
								class="fw-bold"><?= $delivered_count ?></span> packages so far this month.</p>
					</div>
				</div>

				<!-- Statistics Grid -->
				<div class="row">
					<div class="col-xl-4 col-md-6 mb-4">
						<a href="<?= base_url('User/receive_booking') ?>" class="text-decoration-none">
							<div class="card stat-card primary animate-up delay-1 h-100">
								<div class="card-body p-4">
									<div class="stat-icon icon-primary shadow-sm">
										<i class="mdi mdi-truck-delivery"></i>
									</div>
									<div class="stat-value"><?= $pending_count ?></div>
									<div class="stat-label">Pending Shipments</div>
									<hr class="opacity-10 my-3">
									<div class="d-flex justify-content-between align-items-center">
										<span class="text-primary small fw-bold">Action Required</span>
										<i class="mdi mdi-chevron-right text-primary"></i>
									</div>
								</div>
							</div>
						</a>
					</div>

					<div class="col-xl-4 col-md-6 mb-4">
						<a href="<?= base_url('User/booking_history') ?>" class="text-decoration-none">
							<div class="card stat-card success animate-up delay-2 h-100">
								<div class="card-body p-4">
									<div class="stat-icon icon-success shadow-sm">
										<i class="mdi mdi-check-decagram"></i>
									</div>
									<div class="stat-value"><?= $delivered_count ?></div>
									<div class="stat-label">Total Deliveries</div>
									<hr class="opacity-10 my-3">
									<div class="d-flex justify-content-between align-items-center">
										<span class="text-success small fw-bold">Performance High</span>
										<i class="mdi mdi-trending-up text-success"></i>
									</div>
								</div>
							</div>
						</a>
					</div>

					<div class="col-xl-4 col-md-12 mb-4">
						<div class="card stat-card warning animate-up delay-3 h-100">
							<div class="card-body p-4">
								<div class="stat-icon icon-warning shadow-sm">
									<i class="mdi mdi-wallet"></i>
								</div>
								<div class="stat-value">₹<?= number_format($total_earnings, 0) ?></div>
								<div class="stat-label">Estimated Earnings</div>
								<hr class="opacity-10 my-3">
								<div class="d-flex justify-content-between align-items-center">
									<span class="text-warning small fw-bold">Updated Just Now</span>
									<i class="mdi mdi-refresh text-warning spin-on-hover"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Performance Charts Area -->
				<div class="row mb-4">
					<div class="col-xl-8 mb-4">
						<div class="card chart-card animate-up delay-4">
							<div
								class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
								<h5 class="fw-bold mb-0">Delivery Performance</h5>
								<select class="form-select form-select-sm border-0 bg-light rounded-pill px-3"
									style="width: 140px;">
									<option>Last 6 Months</option>
								</select>
							</div>
							<div class="card-body px-4 pb-4">
								<div style="height: 350px;">
									<canvas id="performanceChart"></canvas>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 mb-4">
						<div class="card chart-card animate-up delay-4">
							<div class="card-header bg-transparent border-0 pt-4 px-4">
								<h5 class="fw-bold mb-0">Status Ratio</h5>
							</div>
							<div class="card-body px-4 pb-4">
								<div style="height: 350px;">
									<canvas id="statusDonutChart"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Quick Actions & Recent Fleet Activity -->
				<div class="row mb-4">
					<div class="col-lg-6 mb-4">
						<div class="card chart-card animate-up" style="animation-delay: 0.5s;">
							<div class="card-header bg-transparent border-0 pt-4 px-4">
								<h5 class="fw-bold mb-0">Fleet Quick Actions</h5>
							</div>
							<div class="card-body p-4">
								<div class="row g-3">
									<div class="col-6">
										<a href="<?= base_url('User/receive_booking') ?>"
											class="btn-premium d-flex flex-column align-items-center text-center w-100 p-4">
											<i class="mdi mdi-package-variant-closed fs-2 mb-2"></i>
											<span>Process Packages</span>
										</a>
									</div>
									<div class="col-6">
										<a href="<?= base_url('User/booking_history') ?>"
											class="btn-premium d-flex flex-column align-items-center text-center w-100 p-4"
											style="background: var(--secondary-gradient)">
											<i class="mdi mdi-history fs-2 mb-2"></i>
											<span>View History</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 mb-4">
						<div class="card chart-card animate-up" style="animation-delay: 0.6s;">
							<div class="card-header bg-transparent border-0 pt-4 px-4">
								<h5 class="fw-bold mb-0">Recent Status Updates</h5>
							</div>
							<div class="card-body p-4">
								<div class="activity-list">
									<?php
									$recent_activities = $this->db->query("SELECT jo.* FROM `track_order` jo 
										JOIN `booking` b ON b.id = jo.booking_id 
										WHERE b.delivery_boy_id='$Delivery_BoyID' 
										ORDER BY jo.id DESC LIMIT 4")->result();

									if (!empty($recent_activities)) {
										foreach ($recent_activities as $act) {
											?>
											<div class="activity-item">
												<div class="rounded-circle bg-light p-2">
													<i class="mdi mdi-clock-outline text-primary"></i>
												</div>
												<div class="flex-grow-1">
													<p class="mb-0 fw-bold"><?= $act->order_status ?></p>
													<small class="text-muted">Order #<?= $act->booking_id ?></small>
												</div>
												<div class="text-end">
													<small class="d-block fw-medium"><?= $act->date ?></small>
													<small class="text-muted"><?= $act->time ?></small>
												</div>
											</div>
										<?php }
									} else {
										echo "<p class='text-center py-4 text-muted'>No recent updates found.</p>";
									} ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<script>
					document.addEventListener('DOMContentLoaded', function () {
						// Setup Chart.js Defaults
						Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
						Chart.defaults.color = '#64748b';

						// Performance Chart (Bar)
						const perfCtx = document.getElementById('performanceChart').getContext('2d');
						const gradient = perfCtx.createLinearGradient(0, 0, 0, 400);
						gradient.addColorStop(0, 'rgba(99, 102, 241, 0.8)');
						gradient.addColorStop(1, 'rgba(99, 102, 241, 0.05)');

						new Chart(perfCtx, {
							type: 'bar',
							data: {
								labels: <?= json_encode($monthly_labels) ?>,
								datasets: [{
									label: 'Deliveries',
									data: <?= json_encode($monthly_data) ?>,
									backgroundColor: gradient,
									borderColor: '#6366f1',
									borderWidth: 2,
									borderRadius: 12,
									hoverBackgroundColor: '#4f46e5'
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								plugins: {
									legend: { display: false },
									tooltip: {
										backgroundColor: '#1e293b',
										padding: 15,
										cornerRadius: 12,
										bodyFont: { size: 14 }
									}
								},
								scales: {
									y: {
										beginAtZero: true,
										grid: { borderDash: [5, 5], color: '#e2e8f0' },
										ticks: { stepSize: 5 }
									},
									x: { grid: { display: false } }
								}
							}
						});

						// Status Donut Chart
						const statusCtx = document.getElementById('statusDonutChart').getContext('2d');
						new Chart(statusCtx, {
							type: 'doughnut',
							data: {
								labels: <?= json_encode($status_labels) ?>,
								datasets: [{
									data: <?= json_encode($status_data) ?>,
									backgroundColor: ['#10b981', '#6366f1', '#f59e0b', '#ef4444'],
									borderWidth: 0,
									hoverOffset: 15
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								cutout: '75%',
								plugins: {
									legend: {
										position: 'bottom',
										labels: {
											usePointStyle: true,
											padding: 20,
											font: { weight: '600' }
										}
									}
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