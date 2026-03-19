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
			<div class="container mt-5">
				<div class="row justify-content-center">
					<div class="col-lg-11 col-xl-10">
						<div class="card border-0 shadow-lg overflow-hidden rounded-4">
							<div class="row g-0">
								<!-- Info Side -->
								<div
									class="col-md-5 d-none d-md-flex bg-auth-side text-white p-5 align-items-center justify-content-center">
									<div class="text-center">
										<img src="<?= base_url('assets/web_assets/img/illustrations/hero.png') ?>"
											class="auth-illustration mb-4" style="width: 250px;">
										<h2 class="fw-bold mb-3 text-white">Join ShipperRJ</h2>
										<p class="opacity-75 mb-4">Start your journey with the most reliable logistics
											partner.</p>

										<div class="d-flex align-items-center mb-3 justify-content-center">
											<i class="bi bi-clock-history me-2"></i>
											<span class="small">Real-time tracking</span>
										</div>
										<div class="d-flex align-items-center justify-content-center">
											<i class="bi bi-shield-check me-2"></i>
											<span class="small">Safe & Secure</span>
										</div>
									</div>
								</div>

								<!-- Form Side -->
								<div class="col-md-7 p-4 p-lg-5 bg-white">
									<div class="animate-fade-in">
										<h3 class="fw-bold mb-2">Create Account</h3>
										<p class="text-muted mb-4 small">Join the future of professional logistics
											today.</p>

										<form action="<?= base_url('Home/registeraction') ?>" method="POST">
											<div class="row g-3">
												<div class="col-12">
													<label class="form-label small fw-bold text-muted mb-1">Full
														Name</label>
													<div class="input-group">
														<span class="input-group-text bg-light border-0"><i
																class="bi bi-person text-primary"></i></span>
														<input
															class="form-control form-quriar-control bg-light border-0"
															type="text" placeholder="Enter your name" name="name"
															required="">
													</div>
												</div>
												<div class="col-md-6">
													<label class="form-label small fw-bold text-muted mb-1">Email
														Address</label>
													<div class="input-group">
														<span class="input-group-text bg-light border-0"><i
																class="bi bi-envelope text-primary"></i></span>
														<input
															class="form-control form-quriar-control bg-light border-0"
															type="email" placeholder="john@example.com" name="email"
															required="">
													</div>
												</div>
												<div class="col-md-6">
													<label class="form-label small fw-bold text-muted mb-1">Mobile
														Number</label>
													<div class="input-group pb-2">
														<span class="input-group-text bg-light border-0"><i
																class="bi bi-phone text-primary"></i></span>
														<input
															class="form-control form-quriar-control bg-light border-0"
															type="tel" placeholder="9140XXXXXX" name="mobile"
															minlength="10" maxlength="10" pattern="[6-9]{1}[0-9]{9}"
															title="Please enter 10 digits starting with 6, 7, 8 or 9"
															required oninput="validateMobile(this)">
													</div>
													<span class="mobile-msg small"></span>
												</div>
												<div class="col-12">
													<label
														class="form-label small fw-bold text-muted mb-1">Password</label>
													<div class="input-group">
														<span class="input-group-text bg-light border-0"><i
																class="bi bi-lock text-primary"></i></span>
														<input
															class="form-control form-quriar-control bg-light border-0"
															type="password" placeholder="Min. 8 characters"
															name="password" required="">
													</div>
												</div>

												<div class="col-12 mt-4">
													<button class="btn btn-premium w-100 py-3" type="submit">Create Free
														Account <i class="bi bi-arrow-right ms-2"></i></button>
												</div>

												<div class="col-12 text-center mt-3">
													<p class="small text-muted mb-0">Already a member? <a
															class="text-primary fw-bold text-decoration-none"
															href="<?= base_url('Home/login') ?>">Login here</a></p>
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

	</main>
	<?php
	include('inc/footer-link.php')
		?>
	<script>
		function validateMobile(input) {
			const val = input.value;
			const msg = $(input).closest('.col-md-6').find('.mobile-msg');
			const pattern = /^[6789][0-9]{9}$/;

			if (val.length === 0) {
				msg.html('');
			} else if (val.length !== 10) {
				msg.html('Mobile number must be exactly 10 digits').css('color', 'red');
			} else if (!pattern.test(val)) {
				msg.html('Must start with 6, 7, 8, or 9').css('color', 'red');
			} else {
				msg.html('Valid mobile number').css('color', 'green');
			}
		}
	</script>
</body>

</html>