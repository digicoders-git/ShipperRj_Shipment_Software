<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<?php
	include('inc/header-link.php')
		?>

</head>

<body data-bs-spy="scroll" data-bs-target="#navbar">
	<!-- ===============================================-->
	<!--    Main Content-->
	<!-- ===============================================-->
	<main class="main" id="top">
		<?php
		include('inc/header.php')
			?>
		<section class="py-7 position-relative overflow-hidden" style="background: #f1f5f9;">
			<!-- Background Illustration -->
			<div class="position-absolute top-50 end-0 translate-middle-y d-none d-xl-block"
				style="z-index: -1; opacity: 0.05;">
				<img src="<?= base_url('assets/web_assets/img/illustrations/callback.png') ?>"
					style="width: 600px; transform: scaleX(-1);">
			</div>

			<div class="container mt-5">
				<div class="row justify-content-center">
					<div class="col-lg-11 col-xl-10">
						<div class="card border-0 shadow-lg overflow-hidden rounded-4">
							<div class="row g-0">
								<!-- Info Side (Mirrored) -->
								<div
									class="col-md-5 d-none d-md-flex bg-auth-side text-white p-5 align-items-center justify-content-center order-md-last">
									<div class="text-center">
										<img src="<?= base_url('assets/web_assets/img/illustrations/callback.png') ?>"
											class="auth-illustration mb-4" style="width: 250px;">
										<h2 class="fw-bold mb-3 text-white">Welcome Back</h2>
										<p class="opacity-75 mb-4">Access your shipments and manage your deliveries in
											one place.</p>

										<div class="d-flex align-items-center mb-3 justify-content-center">
											<i class="bi bi-speedometer2 me-2"></i>
											<span class="small">Live Analytics</span>
										</div>
										<div class="d-flex align-items-center justify-content-center">
											<i class="bi bi-headset me-2"></i>
											<span class="small">Direct Support</span>
										</div>
									</div>
								</div>

								<!-- Form Side -->
								<div class="col-md-7 p-4 p-lg-5 bg-white">
									<div class="animate-fade-in">
										<h3 class="fw-bold mb-2">Login Account</h3>
										<p class="text-muted mb-4 small">Enter your credentials to continue your
											journey.</p>

										<form action="<?= base_url('Home/UserAuthentication') ?>" method="POST">
											<div class="row g-4">
												<div class="col-12">
													<label class="form-label small fw-bold text-muted mb-1">Mobile
														Number</label>
													<div class="input-group">
														<span class="input-group-text bg-light border-0"><i
																class="bi bi-phone text-primary"></i></span>
														<input
															class="form-control form-quriar-control bg-light border-0"
															type="tel" placeholder="Enter Mobile Number" name="mobile"
															minlength="10" maxlength="12" required="">
													</div>
												</div>
												<div class="col-12">
													<div class="d-flex justify-content-between align-items-center">
														<label
															class="form-label small fw-bold text-muted mb-1">Password</label>
														<a href="#"
															class="small text-primary text-decoration-none">Forgot
															Password?</a>
													</div>
													<div class="input-group">
														<span class="input-group-text bg-light border-0"><i
																class="bi bi-lock text-primary"></i></span>
														<input
															class="form-control form-quriar-control bg-light border-0"
															type="password" placeholder="Enter Password" name="password"
															required="">
													</div>
												</div>

												<div class="col-12 mt-4">
													<button class="btn btn-premium w-100 py-3" type="submit">Sign In Now
														<i class="bi bi-box-arrow-in-right ms-2"></i></button>
												</div>

												<div class="col-12 text-center mt-3">
													<p class="small text-muted mb-0">Don't have an account? <a
															class="text-primary fw-bold text-decoration-none"
															href="<?= base_url('Home/register') ?>">Register now</a></p>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ============================================-->


		<?php
		include('inc/footer.php')
			?>

	</main><!-- ===============================================-->
	<!--    End of Main Content-->
	<!-- ===============================================-->



	<!-- ===============================================-->
	<!--    JavaScripts-->
	<!-- ===============================================-->
	<?php
	include('inc/footer-link.php')
		?>
</body>

</html>