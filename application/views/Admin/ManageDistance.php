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
							<h2>Add Distance & Pricing</h2>

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
										<th>S no</th>
										<th>Distance(km)</th>
										<th>Weight</th>
										<th>Price(₹)</th>
										<th>DateTime</th>
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
												<td><?= $item->distance ?></td>
												<td><?= $item->weight ?></td>
												<td><?= $item->price ?></td>
												<td><?= $item->date ?> 		<?= $item->time ?></td>
												<td class="d-flex" style="gap:10px">
													<button class="btn py-1 px-3 btn-info mdi mdi-18px mdi-table-edit"
														onclick="EditDistance('<?= $item->id; ?>')" title="Edit"></button>
													<button class="btn py-1 px-3 btn-danger mdi mdi-18px mdi-delete"
														onclick="return Delete('price','<?= $item->id; ?>')"
														title="Delete"></button>
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
				<form action="<?= base_url('Admin/ManageDistance/Add') ?>" method="POST">
					<div class="modal-header px-4">
						<h5 class="modal-title" id="exampleModalCenterTitle">Add New Distance & Price</h5>
					</div>
					<div class="modal-body px-4">
						<div class="row mb-2">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="Distance">Distance(km)</label>
									<input type="number" class="form-control" id="Distance" placeholder="Enter Distance"
										name="distance">
								</div>
								<div class="form-group">
									<label for="Weight">Weight</label>
									<input type="number" class="form-control" id="Weight" placeholder="Enter Weight"
										name="weight">
								</div>
								<div class="form-group">
									<label for="Price">Price(₹)</label>
									<input type="number" class="form-control" id="Price" placeholder="Enter Price"
										name="price">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer px-4">
						<button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary btn-pill">Save</button>
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