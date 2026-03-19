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
	<style>
		.welcome-glass-card {
			background: rgba(255, 255, 255, 0.7);
			backdrop-filter: blur(15px);
			-webkit-backdrop-filter: blur(15px);
			border: 1px solid rgba(255, 255, 255, 0.5);
			border-radius: 20px;
			box-shadow: 0 8px 32px rgba(31, 38, 135, 0.07);
			max-width: 600px;
		}

		.welcome-avatar {
			width: 48px;
			height: 48px;
			background: var(--primary-color);
			color: white;
			border-radius: 12px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-weight: 800;
			font-size: 1.2rem;
			box-shadow: 0 4px 12px rgba(26, 35, 126, 0.2);
		}
	</style>
	<main class="main" id="top">
		<?php
		include('inc/header.php')
			?>


		<section class="py-xxl-8 py-7 pb-0" id="home">
			<div class="bg-holder bg-size"
				style="background-image:url(<?= base_url('assets/web_assets/img/gallery/hero-header-bg.png') ?>);background-position:top center;background-size:cover;">
			</div>
			<!--/.bg-holder-->
			<div class="container animate-fade-in">
				<?php
				if (!empty($User_id)) {
					$userData = $this->db->where('id', $User_id)->get('registration')->row();
					?>
					<div class="row mb-5">
						<div class="col-12">
							<div class="welcome-glass-card p-4 animate__animated animate__fadeInDown">
								<div class="d-flex align-items-center">
									<div class="welcome-avatar me-3">
										<?= strtoupper(substr($userData->name, 0, 1)) ?>
									</div>
									<div>
										<h4 class="mb-1 fw-bold text-primary">Welcome back, <?= $userData->name ?>! 👋</h4>
										<p class="mb-0 text-muted small">We're ready to deliver your next shipment with
											speed and care.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
				?>
				<div class="row align-items-center">
					<div class="col-md-5 col-xl-6 col-xxl-7 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 w-100"
							src="<?= base_url('assets/web_assets/img/illustrations/hero.png') ?>" alt="hero-header">
					</div>
					<div class="col-md-75 col-xl-6 col-xxl-5 text-md-start text-center py-8">
						<h1 class="fw-normal fs-6 fs-xxl-7 text-primary">A trusted provider of </h1>
						<h1 class="fw-bolder fs-6 fs-xxl-7 mb-2">courier services.</h1>
						<p class="fs-1 mb-5 text-muted">We deliver your products safely to <br>your home in a reasonable
							time. </p>
						<?php
						$User_id = $this->session->userdata("User");
						if (!empty($User_id)) {
							?>
							<a class="btn btn-premium px-5 py-3" href="<?= base_url('Home/book_now') ?>" role="button">
								Book Now<i class="fas fa-arrow-right ms-2"></i>
							</a>

							<?php
						} else {
							?>
							<a class="btn btn-premium px-5 py-3" href="<?= base_url('Home/login') ?>" role="button">
								Book Now<i class="fas fa-arrow-right ms-2"></i>
							</a>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</section>

		<!-- ============================================-->
		<!-- <section> begin ============================-->
		<section class="py-7" id="services" container-xl="container-xl">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-5 text-center mb-3">
						<h5 class="text-danger fw-bold">SERVICES</h5>
						<h2 class="fw-bold">Our Logistics Solutions</h2>
						<p class="text-muted">Explore our professional shipping services designed for speed and
							reliability.</p>
					</div>
				</div>
				<div class="row h-100 justify-content-center">
					<div class="col-md-4 pt-4 px-md-2 px-lg-3">
						<div class="card h-100 px-lg-4 card-premium shadow-sm border-0"
							style="transform: scale(1.05); z-index: 1; border-top: 4px solid var(--primary-color) !important;">
							<div class="card-body d-flex flex-column justify-content-around text-center">
								<div class="pt-4 mb-4">
									<i class="bi bi-briefcase display-3 text-primary"></i>
									<h5 class="fw-bold mt-4">Business Shipping</h5>
								</div>
								<p class="text-muted small">Comprehensive logistics for corporate bulk shipments.</p>
								<div class="d-grid mt-3">
									<a href="<?= base_url('Home/services') ?>" class="btn btn-premium btn-sm">View
										Details</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 pt-4 px-md-2 px-lg-3">
						<div class="card h-100 px-lg-4 card-premium shadow-sm border-0 active"
							style="transform: scale(1.05); z-index: 1; border-top: 4px solid var(--primary-color) !important;">
							<div class="card-body d-flex flex-column justify-content-around text-center">
								<div class="pt-4 mb-4">
									<i class="bi bi-truck display-3 text-primary"></i>
									<h5 class="fw-bold mt-4">Express Delivery</h5>
								</div>
								<p class="text-muted small">Fast door-to-door delivery across states.</p>
								<div class="d-grid mt-3">
									<a href="<?= base_url('Home/services') ?>" class="btn btn-premium btn-sm">Book
										Express</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 pt-4 px-md-2 px-lg-3">
						<div class="card h-100 px-lg-4 card-premium shadow-sm border-0"
							style="transform: scale(1.05); z-index: 1; border-top: 4px solid var(--primary-color) !important;">
							<div class="card-body d-flex flex-column justify-content-around text-center">
								<div class="pt-4 mb-4">
									<i class="bi bi-box-seam display-3 text-primary"></i>
									<h5 class="fw-bold mt-4">Personal Courier</h5>
								</div>
								<p class="text-muted small">Safe delivery for your personal parcels.</p>
								<div class="d-grid mt-3">
									<a href="<?= base_url('Home/services') ?>" class="btn btn-premium btn-sm">View
										Details</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="pt-7 pb-0">
			<div class="container">
				<div class="row">
					<div class="col-6 col-lg mb-5">
						<div class="text-center">
							<img class="img-fluid" src="<?= base_url('assets/web_assets/img/icons/awards.png') ?>"
								alt="..." />
							<h1 class="text-primary mt-4">150+</h1>
							<h5 class="text-800">Awards</h5>
						</div>
					</div>
					<div class="col-6 col-lg mb-5">
						<div class="text-center">
							<img class="img-fluid" src="<?= base_url('assets/web_assets/img/icons/goods.png') ?>"
								alt="..." />
							<h1 class="text-primary mt-4">100+</h1>
							<h5 class="text-800">Project Delivered</h5>
						</div>
					</div>
					<div class="col-6 col-lg mb-5">
						<div class="text-center">
							<img class="img-fluid" src="<?= base_url('assets/web_assets/img/icons/clients.png') ?>"
								alt="..." />
							<h1 class="text-primary mt-4">103+</h1>
							<h5 class="text-800">Active Customer</h5>
						</div>
					</div>
					<div class="col-6 col-lg mb-5">
						<div class="text-center">
							<img class="img-fluid" src="<?= base_url('assets/web_assets/img/icons/business.png') ?>"
								alt="..." />
							<h1 class="text-primary mt-4">130M+</h1>
							<h5 class="text-800">Business hours</h5>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="card bg-dark text-white py-4 py-sm-0 shadow-lg border-0 rounded-4 overflow-hidden">
							<img class="w-100 fit-cover"
								src="<?= base_url('assets/web_assets/img/gallery/video.png') ?>" alt="video"
								style="height: 400px; object-position: center;">
							<div class="card-img-overlay bg-dark-gradient d-flex flex-column flex-center"><img
									src="<?= base_url('assets/web_assets/img/icons/play.png') ?>" width="80" alt="play">
								<h5 class="text-primary">FASTEST DELIVERY</h5>
								<p class="text-center">You can get your valuable item in the fastest period of<br
										class="d-none d-sm-block">time with safety. Because your emergency<br
										class="d-none d-sm-block">is
									our first priority.</p><a class="stretched-link" href="#" data-bs-toggle="modal"
									data-bs-target="#exampleModal"></a>
								<div class="modal fade" id="exampleModal" tabindex="-1"
									aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg modal-dialog-centered">
										<div class="modal-content overflow-hidden">
											<div class="modal-header p-0">
												<div class="ratio ratio-16x9" id="exampleModalLabel"><iframe
														src="https://www.youtube.com/embed/TlcP2aTOp-Q"
														title="YouTube video"
														allowfullscreen="allowfullscreen"></iframe></div>
											</div>
											<div class="modal-footer"><button class="btn btn-primary" type="button"
													data-bs-dismiss="modal">Close</button></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- end of .container-->
		</section><!-- <section> close ============================-->
		<!-- ============================================-->



		<!-- ============================================-->
		<!-- <section> begin ============================-->
		<section class="py-7">
			<div class="container-fluid">
				<div class="row flex-center">
					<div class="bg-holder bg-size"
						style="background-image:url(<?= base_url('assets/web_assets/img/gallery/quote.png') ?>);background-position:top;background-size:auto;margin-left:-270px;margin-top:-45px;">
					</div>
					<!--/.bg-holder-->
					<div class="col-md-8 col-lg-5 text-center">
						<h5 class="text-danger">TESTIMONIAL</h5>
						<h2>Our Awesome Clients</h2>
					</div>
				</div>
			</div><!-- end of .container-->
		</section><!-- <section> close ============================-->
		<!-- ============================================-->



		<!-- ============================================-->
		<!-- <section> begin ============================-->
		<section class="overflow-hidden">
			<div class="container-fluid">
				<div class="row bg-offcanvas">
					<div class="col-12">
						<div class="swiper-container" data-pagination-target="pagination1">
							<div class="swiper-wrapper">
								<div class="swiper-slide h-auto">
									<div class="card h-100 card-span p-3">
										<div class="card-body">
											<h5 class="mb-0 text-primary">Fantastic service!</h5>
											<p class="card-text pt-3">I'm loving the look and the very useful included
												complete page
												templates. Such a time saver!I'm also glad to see Bootstrap v5 support
												coming. Highly
												recommended.</p>
											<div class="d-xl-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center mb-3"><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i>
												</div>
												<div class="d-flex align-items-center"><img
														src="<?= base_url('assets/web_assets/img/icons/user-1.png') ?>"
														alt="...">
													<div class="flex-1 ms-3">
														<h6 class="mb-0 fs--1 text-1000 fw-medium">John Adams</h6>
														<p class="fs--2 fw-normal mb-0">Ceo</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="swiper-slide h-auto">
									<div class="card h-100 card-span p-3">
										<div class="card-body">
											<h5 class="mb-0 text-primary">Fantastic service!</h5>
											<p class="card-text pt-3">This is my first bootstrap template and I've had
												quite a few questions,
												mostly driven by my own lack of experience. Nevertheless have received
												excellent support from
												the author, even to my noob question And my project is starting now to
												take shape nicely.</p>
											<div class="d-xl-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center mb-3"><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i>
												</div>
												<div class="d-flex align-items-center"><img
														src="<?= base_url('assets/web_assets/img/icons/user-2.png') ?>"
														alt="...">
													<div class="flex-1 ms-3">
														<h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
														<p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="swiper-slide h-auto">
									<div class="card h-100 card-span p-3">
										<div class="card-body">
											<h5 class="mb-0 text-primary">Fantastic service!</h5>
											<p class="card-text pt-3">I purchased a phone from an e-commerce site, and
												this courier service
												provider assisted me in getting it delivered to my home. I received my
												phone within one day, and
												I was really satisfied with their service when I received it. </p>
											<div class="d-xl-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center mb-3"><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i>
												</div>
												<div class="d-flex align-items-center"><img
														src="<?= base_url('assets/web_assets/img/icons/user-3.png') ?>"
														alt="...">
													<div class="flex-1 ms-3">
														<h6 class="mb-0 fs--1 text-1000 fw-medium">Austin Min</h6>
														<p class="fs--2 fw-normal mb-0">Designer</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="swiper-slide h-auto">
									<div class="card h-100 card-span p-3">
										<div class="card-body">
											<h5 class="mb-0 text-primary">Fantastic service!</h5>
											<p class="card-text pt-3">We’re looking for someone interested in business
												theory and research
												that’ll help us bridge the gap between our s...</p>
											<div class="d-xl-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center mb-3"><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i>
												</div>
												<div class="d-flex align-items-center"><img
														src="<?= base_url('assets/web_assets/img/icons/user-1.png') ?>"
														alt="...">
													<div class="flex-1 ms-3">
														<h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
														<p class="fs--2 fw-normal mb-0">Ceo</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="swiper-slide h-auto">
									<div class="card h-100 card-span p-3">
										<div class="card-body">
											<h5 class="mb-0 text-primary">Fantastic service!</h5>
											<p class="card-text pt-3">Review our community chat for the most frequently
												asked questions and
												document answers for our product docs.</p>
											<div class="d-xl-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center mb-3"><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i>
												</div>
												<div class="d-flex align-items-center"><img
														src="<?= base_url('assets/web_assets/img/icons/user-2.png') ?>"
														alt="...">
													<div class="flex-1 ms-3">
														<h6 class="mb-0 fs--1 text-1000 fw-medium">John Adams</h6>
														<p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="swiper-slide h-auto">
									<div class="card h-100 card-span p-3">
										<div class="card-body">
											<h5 class="mb-0 text-primary">Fantastic service!</h5>
											<p class="card-text pt-3">I purchased a phone from an e-commerce site, and
												this courier service
												provider assisted me in getting it delivered to my home. I received my
												phone within one day, and
												I was really satisfied with their service when I received it. </p>
											<div class="d-xl-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center mb-3"><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i><i
														class="fas fa-star text-primary me-1"></i>
												</div>
												<div class="d-flex align-items-center"><img
														src="<?= base_url('assets/web_assets/img/icons/user-3.png') ?>"
														alt="...">
													<div class="flex-1 ms-3">
														<h6 class="mb-0 fs--1 text-1000 fw-medium">Austin Min</h6>
														<p class="fs--2 fw-normal mb-0">Designer</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="swiper-pagination" id="pagination1"></div>
					</div>
				</div>
			</div><!-- end of .container-->
		</section><!-- <section> close ============================-->
		<!-- ============================================-->


		<section class="py-7 bg-light">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6">
						<h2 class="fw-bold mb-4">Ready to ship with us?</h2>
						<p class="text-muted mb-5">Get in touch with our team or start your booking now for the fastest
							delivery experience.</p>
						<div class="d-flex gap-3">
							<a href="<?= base_url('Home/contact') ?>" class="btn btn-premium px-5">Contact Us</a>
							<a href="<?= base_url('Home/book_now') ?>" class="btn btn-premium-outline px-5">Book Now</a>
						</div>
					</div>
					<div class="col-md-6 text-center">
						<img class="img-fluid rounded-4 shadow-sm"
							src="<?= base_url('assets/web_assets/img/gallery/cta_logistics_bg.png') ?>" alt="CTA"
							style="max-height: 300px; width: auto; object-fit: contain;">
					</div>
				</div>
			</div>
		</section>

		<?php
		include('inc/footer.php')
			?>

	</main><!-- ===============================================-->
	<!--    End of Main Content-->
	<!-- ===============================================-->



	<!-- ===============================================-->
	<!--    JavaScripts 8318079307-->
	<!-- ===============================================-->
	<?php
	include('inc/footer-link.php')
		?>

</body>

</html>