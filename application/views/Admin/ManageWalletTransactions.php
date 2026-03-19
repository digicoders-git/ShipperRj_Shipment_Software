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
							<h2>Manage Pending Transactions</h2>
						</div>
						<div class="card-body">
							<div class="collapse" id="collapse-data-tables">
							</div>
							<table id="pendingtxn" class="table table-hover table-product table-responsive-lg"
								style="width:100%">
								<thead>
									<tr>
										<th>S no</th>
										<th>User ID</th>
										<th>Action</th>
										<th>Amount</th>
										<th>Status</th>
										<th>Txn ID</th>
										<th>Payment UTR</th>
										<th>Reciept</th>
										<th>DateTime</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$sr = 1;
									if (!empty($pendingtxndata)) {
										foreach ($pendingtxndata as $item) {
											?>
											<tr>
												<td><?= $sr ?></td>
												<td>
													<?php
													$user_id = $item->user_id;
													$userdata = $this->db->query("SELECT * FROM `registration` WHERE id='$user_id'")->row();
													echo $userdata->name;
													?>
												</td>
												<td>
													<div class="d-flex align-items-center gap-2">
														<button type="button"
															onclick="topuprequest(<?php echo $item->id; ?>,'Accept')"
															class="btn btn-sm btn-success btn-pill mdi mdi-check"
															title="Accept"></button>
														<button type="button"
															onclick="topuprequest(<?php echo $item->id; ?>,'Reject')"
															class="btn btn-sm btn-danger btn-pill mdi mdi-close"
															title="Reject"></button>
													</div>
												</td>

												<td><?= $item->amount ?></td>
												<td>
													<span class="badge badge-pill bg-warning">
														<?= $item->status ?>
													</span>
												</td>
												<td><?= $item->txn_id ?></td>
												<td><?= $item->payment_utr ?></td>
												<td>
													<a href="<?= base_url('assets/admin_assets/images/') . $item->reciept; ?>"
														target="_blank">
														<img src="<?= base_url('assets/admin_assets/images/') . $item->reciept; ?>"
															alt="Reciept" class="img-thumbnail" style="max-height: 50px;">
													</a>
												</td>
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


			<div class="content-wrapper">
				<div class="content"><!-- For Components documentaion -->


					<!-- Category Inventory -->
					<div class="card card-default">
						<div class="card-header">
							<h2>Manage Accepted Transactions</h2>
						</div>
						<div class="card-body">
							<div class="collapse" id="collapse-data-tables">
							</div>
							<table id="accepttxn" class="table table-hover table-product table-responsive-lg"
								style="width:100%">
								<thead>
									<tr>
										<th>S no</th>
										<th>User ID</th>
										<th>Amount</th>
										<th>Status</th>
										<th>Txn ID</th>
										<th>Payment UTR</th>
										<th>Reciept</th>
										<th>DateTime</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$sr = 1;
									if (!empty($accepttxndata)) {
										foreach ($accepttxndata as $item) {
											?>
											<tr>
												<td><?= $sr ?></td>
												<td>
													<?php
													$user_id = $item->user_id;
													$userdata = $this->db->query("SELECT * FROM `registration` WHERE id='$user_id'")->row();
													echo $userdata->name;
													?>
												</td>
												<td><?= $item->amount ?></td>
												<td>
													<span
														class="badge badge-pill <?= ($item->status == 'Accept') ? 'bg-success' : (($item->status == 'Reject') ? 'bg-danger' : 'bg-warning') ?>">
														<?= $item->status ?>
													</span>
												</td>
												<td><?= $item->txn_id ?></td>
												<td><?= $item->payment_utr ?></td>
												<td>
													<a href="<?= base_url('assets/admin_assets/images/') . $item->reciept; ?>"
														target="_blank">
														<img src="<?= base_url('assets/admin_assets/images/') . $item->reciept; ?>"
															alt="Reciept" class="img-thumbnail" style="max-height: 50px;">
													</a>
												</td>
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


			<div class="content-wrapper">
				<div class="content"><!-- For Components documentaion -->


					<!-- Category Inventory -->
					<div class="card card-default">
						<div class="card-header">
							<h2>Manage Rejected Transactions</h2>
						</div>
						<div class="card-body">
							<div class="collapse" id="collapse-data-tables">
							</div>
							<table id="rejecttxn" class="table table-hover table-product table-responsive-lg"
								style="width:100%">
								<thead>
									<tr>
										<th>S no</th>
										<th>User ID</th>
										<th>Amount</th>
										<th>Status</th>
										<th>Txn ID</th>
										<th>Payment UTR</th>
										<th>Reciept</th>
										<th>DateTime</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$sr = 1;
									if (!empty($rejecttxndata)) {
										foreach ($rejecttxndata as $item) {
											?>
											<tr>
												<td><?= $sr ?></td>
												<td>
													<?php
													$user_id = $item->user_id;
													$userdata = $this->db->query("SELECT * FROM `registration` WHERE id='$user_id'")->row();
													echo $userdata->name;
													?>
												</td>
												<td><?= $item->amount ?></td>
												<td>
													<span
														class="badge badge-pill <?= ($item->status == 'Accept') ? 'bg-success' : (($item->status == 'Reject') ? 'bg-danger' : 'bg-warning') ?>">
														<?= $item->status ?>
													</span>
												</td>
												<td><?= $item->txn_id ?></td>
												<td><?= $item->payment_utr ?></td>
												<td>
													<a href="<?= base_url('assets/admin_assets/images/') . $item->reciept; ?>"
														target="_blank">
														<img src="<?= base_url('assets/admin_assets/images/') . $item->reciept; ?>"
															alt="Reciept" class="img-thumbnail" style="max-height: 50px;">
													</a>
												</td>
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

			<!-- Footer -->
			<?php
			include("inc/footer.php")
				?>

		</div>
	</div>
	<!-- add user Model  -->

	<?php
	include("inc/footer-link.php")
		?>

	<script>
		$(document).ready(function () {
			$('#pendingtxn').DataTable();
		});

		$(document).ready(function () {
			$('#accepttxn').DataTable();
		});

		$(document).ready(function () {
			$('#rejecttxn').DataTable();
		});
	</script>

</body>

</html>