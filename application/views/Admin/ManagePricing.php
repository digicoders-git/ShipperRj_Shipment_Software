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
							<h2>Add Pincode & Pricing</h2>

							<a class="btn mdi mdi-plus mdi-24px" data-toggle="modal" data-target="#add-routes">Add new
							</a>

						</div>
						<div class="card-body">
							<div class="collapse" id="collapse-data-tables">
							</div>
							<table id="coin" class="table table-hover table-product table-responsive-lg"
								style="width:100%">
								<thead>
									<tr>
										<th>#</th>
										<th>From Pin</th>
										<th>To Pin</th>
										<th>Weight Slot</th>
									
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sr = 1;
									if (!empty($list)) {
										foreach ($list as $item) {
											?>
											<tr>
												<td><?= $sr ?></td>
												<td><?= $item->from_pin ?></td>
												<td><?= $item->to_pin ?></td>
												<td>
													<div class="d-flex flex-wrap" style="gap:5px">
														<?php foreach ($item->slots as $slot): ?>
															<span class="badge badge-info"
																title="<?= $slot->min_weight ?>kg - <?= $slot->max_weight ?>kg">
																<?= $slot->slot_name ?>: ₹<?= $slot->price_per_kg ?>
															</span>
														<?php endforeach; ?>
													</div>
												</td>
												<td>
													<span class="badge badge-success">Active</span>
												</td>
												<td class="d-flex" style="gap:10px">
													<button class="btn btn-sm btn-info btn-pill mdi mdi-pencil"
														onclick="EditPrice('<?= $item->from_pin; ?>', '<?= $item->to_pin; ?>')"
														title="Edit Route"></button>

													<button class="btn btn-sm btn-danger btn-pill mdi mdi-delete"
														onclick="return DeleteRoute('<?= $item->from_pin; ?>', '<?= $item->to_pin; ?>')"
														title="Delete Route"></button>
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
	<!-- add routes  -->
	<div class="modal fade" id="add-routes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered " role="document">
			<div class="modal-content">
				<form action="<?= base_url('Admin/ManagePricing/Add') ?>" method="POST">
					<div class="modal-header px-4">
						<h5 class="modal-title" id="exampleModalCenterTitle">Add New Pincode Route</h5>
					</div>
					<div class="modal-body px-4">
						<div class="row mb-2">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-md-6 text-left">
										<div class="form-group">
											<label for="From">From Pincode</label>
											<input type="number" class="form-control" id="From" placeholder="000000"
												name="from" oninput="if(this.value.length > 6) this.value = this.value.slice(0, 6);" required>
										</div>
									</div>
									<div class="col-md-6 text-left">
										<div class="form-group">
											<label for="to">To Pincode</label>
											<input type="number" class="form-control" id="to" placeholder="000000"
												name="to" oninput="if(this.value.length > 6) this.value = this.value.slice(0, 6);" required>
										</div>
									</div>
								</div>
								<div class="form-group text-left">
									<label class="fw-bold mb-3">Set Prices for Weight Slots</label>
									<div class="table-responsive border rounded"
										style="max-height: 250px; overflow-y: auto;">
										<table class="table table-bordered table-sm text-center mb-0">
											<thead class="bg-light">
												<tr>
													<th>Weight Range</th>
													<th>Price (₹)</th>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($slots)):
													foreach ($slots as $s): ?>
														<tr>
															<td class="align-middle">
																<span class="badge badge-info"><?= $s->slot_name ?></span>
																<br><small class="text-muted"><?= $s->min_weight ?>kg -
																	<?= $s->max_weight ?>kg</small>
															</td>
															<td>
																<input type="number" step="0.01"
																	class="form-control form-control-sm mx-auto"
																	style="max-width: 120px;" name="prices[<?= $s->id ?>]"
																	placeholder="0.00">
															</td>
														</tr>
													<?php endforeach; endif; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer px-0 pb-0">
						<button type="button" class="btn btn-light btn-pill px-4" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary btn-pill px-4">Create Route</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
	include("inc/footer-link.php")
		?>
	<script>
		$(document).ready(function () {
			$('#coin').DataTable({
				// dom: 'Blfrtip', 
				// buttons: [
				//     'excel',
				//     'pdf'
				// ],
				lengthMenu: [10, 25, 50, 75, 100]
			});
		});
	</script>

</body>

</html>