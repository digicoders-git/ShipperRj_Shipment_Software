<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include("inc/header-link.php") ?>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
	<script>
		NProgress.configure({
			showSpinner: false
		});
		NProgress.start();
	</script>
	<div id="toaster"></div>

	<!-- ====================================
        ——— WRAPPER
    ===================================== -->
	<div class="wrapper">
		<!-- ====================================
            ——— LEFT SIDEBAR
        ===================================== -->
		<?php include("inc/sidebar.php") ?>

		<!-- ====================================
            ——— PAGE WRAPPER
        ===================================== -->
		<div class="page-wrapper">

			<!-- Header -->
			<?php include("inc/header.php") ?>

			<!-- ====================================
                ——— CONTENT WRAPPER
            ===================================== -->
			<div class="content-wrapper">
				<div class="content">

					<div class="card">
						<div class="card-header">
							<h4>Set Delivery Prices</h4>
						</div>
						<div class="card-body">

							<?php if ($this->session->flashdata('success')): ?>
								<div class="alert alert-success">
									<?= $this->session->flashdata('success'); ?>
								</div>
							<?php endif; ?>

							<form action="<?= base_url('Admin/insertDelivery') ?>" method="post">
								<div class="form-group mb-3">
									<label>Standard Delivery Price (₹)</label>
									<input type="number" step="0.01" name="standard_price" class="form-control" placeholder="Enter Standard Price">
								</div>

								<div class="form-group mb-3">
									<label>Express Delivery Price (₹)</label>
									<input type="number" step="0.01" name="express_price" class="form-control" placeholder="Enter Express Price">
								</div>

								<div class="form-group mb-3">
									<label>Overnight Delivery Price (₹)</label>
									<input type="number" step="0.01" name="overnight_price" class="form-control" placeholder="Enter Overnight Price">
								</div>

								<button type="submit" class="btn btn-success">Insert</button>
							</form>

						</div>
					</div>

				</div>
			</div>

			<!-- Footer -->
			<?php include("inc/footer.php") ?>
		</div>
	</div>

	<?php include("inc/footer-link.php") ?>

	<script>
		$(document).ready(function() {
			$('#user').DataTable();
		});
	</script>
</body>

</html>