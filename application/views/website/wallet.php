<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<?php include('inc/header-link.php') ?>
	<style>
		:root {
			--primary-color: #1a237e;
			--secondary-color: #fcc200;
			--primary-gradient: linear-gradient(135deg, #1a237e 0%, #3949ab 100%);
			--accent-gradient: linear-gradient(135deg, #fcc200 0%, #f57f17 100%);
			--glass-bg: rgba(255, 255, 255, 0.95);
			--card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
		}

		body {
			background-color: #f8f9fa;
		}

		.page-header {
			position: relative;
			padding: 160px 0 80px;
			overflow: hidden;
		}

		.bg-holder {
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			z-index: -1;
		}

		.breadcrumb-item a {
			color: var(--primary-color);
			text-decoration: none;
			font-weight: 600;
		}

		.balance-card {
			background: white;
			border-radius: 20px;
			padding: 30px;
			box-shadow: var(--card-shadow);
			border: none;
			transition: transform 0.3s ease;
			position: relative;
			z-index: 1;
			overflow: hidden;
		}

		.balance-card::before {
			content: '';
			position: absolute;
			top: -50%;
			right: -20%;
			width: 300px;
			height: 300px;
			background: var(--secondary-color);
			opacity: 0.1;
			border-radius: 50%;
		}

		.balance-card {
			border-top: 4px solid var(--primary-color) !important;
		}

		.balance-amount {
			font-size: 3rem;
			font-weight: 800;
			color: #2d3436;
			margin: 10px 0;
			display: flex;
			align-items: center;
		}

		.balance-label {
			color: #636e72;
			text-transform: uppercase;
			letter-spacing: 2px;
			font-size: 0.8rem;
			font-weight: 600;
		}

		.add-money-card {
			background: white;
			border-radius: 20px;
			padding: 30px;
			box-shadow: var(--card-shadow);
			border: none;
			height: 100%;
		}

		.form-control-premium {
			border: 2px solid #eee;
			border-radius: 12px;
			padding: 12px 20px;
			font-weight: 500;
			transition: all 0.3s ease;
		}

		.form-control-premium:focus {
			border-color: var(--primary-color);
			box-shadow: 0 0 0 0.2rem rgba(26, 35, 126, 0.1);
		}

		.btn-add-money {
			background: var(--accent-gradient);
			border: none;
			border-radius: 12px;
			padding: 14px 30px;
			color: var(--primary-color);
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 1px;
			width: 100%;
			margin-top: 20px;
			transition: all 0.3s ease;
			box-shadow: 0 10px 20px rgba(252, 194, 0, 0.2);
		}

		.btn-add-money:hover {
			transform: translateY(-2px);
			box-shadow: 0 15px 25px rgba(252, 194, 0, 0.3);
			color: var(--primary-color);
			filter: brightness(1.05);
		}

		.transaction-card {
			background: white;
			border-radius: 20px;
			padding: 30px;
			box-shadow: var(--card-shadow);
			border: none;
			margin-top: 40px;
			margin-bottom: 60px;
		}

		.table thead th {
			border-top: none;
			background: #f8f9fa;
			color: #636e72;
			font-weight: 600;
			text-transform: uppercase;
			font-size: 0.75rem;
			letter-spacing: 1px;
			padding: 15px;
		}

		.table tbody td {
			padding: 15px;
			vertical-align: middle;
			color: #2d3436;
			font-weight: 500;
			border-bottom: 1px solid #f1f2f6;
		}

		.status-badge {
			padding: 6px 12px;
			border-radius: 10px;
			font-size: 0.8rem;
			font-weight: 600;
			text-transform: capitalize;
		}

		.status-success {
			background: #e1fef1;
			color: #10b981;
		}

		.status-pending {
			background: #fff8e1;
			color: #f59e0b;
		}

		.status-failed {
			background: #fef2f2;
			color: #ef4444;
		}

		.section-title {
			font-weight: 700;
			color: #2d3436;
			margin-bottom: 25px;
			display: flex;
			align-items: center;
		}

		.section-title i {
			margin-right: 15px;
			color: var(--primary-color);
		}

		.amount-display {
			font-family: 'Inter', sans-serif;
		}

		@media (max-width: 768px) {
			.balance-amount {
				font-size: 2.2rem;
			}
		}
	</style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar">
	<main class="main" id="top">
		<?php include('inc/header.php'); ?>

		<!-- Page Header -->
		<div class="page-header">
			<div class="bg-holder bg-size"
				style="background-image:url(<?= base_url('assets/web_assets/img/gallery/hero-header-bg.png') ?>);background-position:top center;background-size:cover;">
			</div>
			<div class="container">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-2">
						<li class="breadcrumb-item"><a href="<?= base_url('Home') ?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Wallet</li>
					</ol>
				</nav>
				<h1 class="fw-bolder text-dark mb-0 fs-4 fs-lg-6">My Wallet Dashboard</h1>
				<p class="text-muted fw-semi-bold">Manage your funds and track your spending with ease</p>
			</div>
		</div>

		<div class="container py-5">
			<div class="row g-4 justify-content-center">
				<!-- Balance View -->
				<div class="col-lg-5">
					<div class="balance-card h-100">
						<div class="balance-label">Available Balance</div>
						<div class="balance-amount">
							<span class="fs-2 me-2">₹</span>
							<span
								class="amount-display"><?= isset($userdata) && isset($userdata->wallet) ? number_format($userdata->wallet, 2) : '0.00'; ?></span>
						</div>
						<div class="mt-4 pt-3 border-top">
							<div class="d-flex justify-content-between text-muted small">
								<span>Recent Load</span>
								<span class="fw-bold">₹
									<?= !empty($txndata) ? number_format($txndata[0]->amount, 2) : '0.00' ?></span>
							</div>
						</div>
					</div>
				</div>

				<!-- Add Money Form -->
				<div class="col-lg-5">
					<div class="add-money-card">
						<h5 class="section-title"><i class="bi bi-plus-circle-fill"></i>Add Money</h5>
						<form action="<?= base_url('Home/AddMoneyToWallet') ?>" method="POST">
							<div class="mb-3">
								<label class="form-label small fw-bold text-muted">Amount (₹)</label>
								<div class="input-group">
									<span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3"><i
											class="bi bi-currency-rupee"></i></span>
									<input type="number"
										class="form-control form-control-premium rounded-end-pill border-start-0"
										placeholder="Enter Amount" name="amount" min="10" required>
								</div>
								<div class="mt-2">
									<button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2"
										onclick="setAmount(500)">+ ₹500</button>
									<button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2"
										onclick="setAmount(1000)">+ ₹1000</button>
									<button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3"
										onclick="setAmount(2000)">+ ₹2000</button>
								</div>
							</div>
							<button type="submit" class="btn btn-add-money">Proceed to Pay</button>
						</form>
					</div>
				</div>
			</div>

			<!-- Transaction History -->
			<div class="transaction-card">
				<h5 class="section-title"><i class="bi bi-clock-history"></i>Transaction History</h5>
				<div class="table-responsive">
					<table id="example" class="table table-hover w-100">
						<thead>
							<tr>
								<th>#</th>
								<th>Source</th>
								<th>ID / Ref</th>
								<th>Description</th>
								<th>Amount</th>
								<th>Date & Time</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($txndata)): ?>
								<?php $sr = 1;
								foreach ($txndata as $item): ?>
									<tr>
										<td><?= $sr++ ?></td>
										<td>
											<span class="badge rounded-pill bg-light text-dark border ps-2 pe-2">
												<?= $item->source ?>
											</span>
										</td>
										<td class="text-primary fw-bold"><?= $item->id ?></td>
										<td>
											<div class="small fw-bold"><?= $item->description ?></div>
										</td>
										<td>
											<?php if ($item->type == 'Credit' || $item->type == 'Accept'): ?>
												<span class="text-success fw-bold">+ ₹<?= number_format($item->amount, 2) ?></span>
											<?php else: ?>
												<span class="text-danger fw-bold">- ₹<?= number_format($item->amount, 2) ?></span>
											<?php endif; ?>
										</td>
										<td class="text-muted"><?= $item->date ?> | <?= $item->time ?></td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="6" class="text-center py-5 text-muted">No transactions found.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<?php include('inc/footer.php') ?>
	</main>

	<?php include('inc/footer-link.php') ?>

	<script>
		function setAmount(amt) {
			document.getElementsByName('amount')[0].value = amt;
		}

		$(document).ready(function () {
			if ($('#example').length) {
				$('#example').DataTable({
					"pageLength": 10,
					"ordering": false,
					"language": {
						"search": "_INPUT_",
						"searchPlaceholder": "Search transactions..."
					}
				});
			}
		});
	</script>
</body>

</html>