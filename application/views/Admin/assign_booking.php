<!DOCTYPE html>

<html lang="en" dir="ltr">
	
	<head>
		<?php
			include ("inc/header-link.php")
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
				include ("inc/sidebar.php")
			?>
			
			
			
			<!-- ====================================
				——— PAGE WRAPPER
			===================================== -->
			<div class="page-wrapper">
				
				<!-- Header -->
				<?php
					include ("inc/header.php")
				?>
				
				<!-- ====================================
					——— CONTENT WRAPPER
				===================================== -->
				
				<div class="content-wrapper">
					<div class="content"><!-- For Components documentaion -->
						
						
						<!-- Category Inventory -->
						<div class="card card-default">
							<div class="card-header">
								<h2>Send Red Alert</h2>
							</div>
							<div class="card-body">
								<div class="collapse" id="collapse-data-tables">
								</div>
								<table id="user" class="table table-hover table-product table-responsive-lg"
                                style="width:100%">
									<thead>
										<tr>
											<th>S no</th>
											<th>Status</th>
											<!-- <th>Action</th> -->
											<th>Name</th>
											<th>Email</th>
											<th>Mobile Number</th>
											<th>DOB</th>
											<th>Gender</th>
											<th>Send Red Alert</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>
												<label
                                                class="switch switch-outline-alt-primary switch-pill form-control-label">
													<input type="checkbox" class="switch-input form-check-input" value="on"
                                                    checked>
													<span class="switch-label"></span>
													<span class="switch-handle"></span>
												</label>
											</td>
											<!-- <td>
												<button class="btn py-1 px-3 btn-info mdi mdi-18px mdi-table-edit me-3"
                                                data-toggle="modal" data-target="#modal-edit-user"></button>
												<button class="btn py-1 px-3 btn-danger mdi mdi-18px mdi-delete"></button>
											</td> -->
											<td>Advtez</td>
											<td>advtez@gmail.com</td>
											<td>0987654321</td>
											<td>12/07/2024</td>
											<td>Male</td>
											<td><button class="btn py-1 px-3 btn-danger mdi mdi-18px mdi-alert"></button>
											</td>
										</tr>
									</tbody>
								</table>
								
							</div>
						</div>
					</div>
					
				</div>
				
				
				<!-- Footer -->
				<?php
					include ("inc/footer.php")
				?>
				
			</div>
		</div>
		
		
		<?php
			include ("inc/footer-link.php")
		?>
		<script>
			$(document).ready(function () {
				$('#user').DataTable();
			});
		</script>
		
	</body>
	
</html>