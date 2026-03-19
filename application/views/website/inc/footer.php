<style>
	.footer-premium {
		background-color: #0f172a;
		color: #94a3b8;
		font-family: 'Plus Jakarta Sans', sans-serif;
	}

	.footer-premium h5 {
		color: #ffffff;
		font-weight: 700;
		position: relative;
		padding-bottom: 15px;
		margin-bottom: 25px;
	}

	.footer-premium h5::after {
		content: '';
		position: absolute;
		left: 0;
		bottom: 0;
		width: 30px;
		height: 2px;
		background: #fc9300ff;
		border-radius: 2px;
	}

	.footer-link {
		color: #94a3b8;
		transition: all 0.3s ease;
		text-decoration: none;
		display: inline-block;
		margin-bottom: 12px;
	}

	.footer-link:hover {
		color: #fc9300ff;
		transform: translateX(5px);
	}

	.social-icon {
		width: 38px;
		height: 38px;
		background: rgba(255, 255, 255, 0.05);
		border-radius: 10px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		color: #fff;
		margin-right: 10px;
		transition: all 0.3s ease;
		text-decoration: none;
	}

	.social-icon:hover {
		background: #fc9300ff;
		color: #0f172a;
		transform: translateY(-3px);
	}

	.contact-item {
		display: flex;
		align-items: flex-start;
		margin-bottom: 20px;
	}

	.contact-icon {
		width: 35px;
		height: 35px;
		background: rgba(252, 194, 0, 0.1);
		border-radius: 8px;
		display: flex;
		align-items: center;
		justify-content: center;
		color: #fc9300ff;
		margin-right: 15px;
		flex-shrink: 0;
	}

	.copyright-bar {
		background: #0a0f1d;
		border-top: 1px solid rgba(255, 255, 255, 0.05);
	}
</style>

<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="footer-premium pb-5 pt-6">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-4 col-lg-4 mb-5 pe-lg-5">
				<a class="text-decoration-none d-inline-block mb-4" href="<?= base_url('Home') ?>">
					<img src="<?= base_url('assets/web_assets/img/gallery/logo.png') ?>" height="50" alt="ShipperRJ">
				</a>
				<p class="mb-4 text-justify" style="line-height: 1.8;">ShipperRJ is the most trusted courier and logistics partner in the region. We specialize in providing lightning-fast delivery solutions for corporate goods, documents, and personal packages with maximum safety and transparency.</p>
				<div class="mt-4">
					<a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
					<a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
					<a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
					<a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
				</div>
			</div>
			
			<div class="col-6 col-md-2 col-lg-2 mb-4">
				<h5>Our Services</h5>
				<ul class="list-unstyled">
					<li><a class="footer-link" href="<?= base_url('Home/services') ?>">Corporate Goods</a></li>
					<li><a class="footer-link" href="<?= base_url('Home/services') ?>">Document Delivery</a></li>
					<li><a class="footer-link" href="<?= base_url('Home/services') ?>">E-commerce Logistics</a></li>
					<li><a class="footer-link" href="<?= base_url('Home/services') ?>">International Shipping</a></li>
					<li><a class="footer-link" href="<?= base_url('Home/services') ?>">Warehouse Solutions</a></li>
				</ul>
			</div>

			<div class="col-6 col-md-2 col-lg-2 mb-4">
				<h5>Quick Links</h5>
				<ul class="list-unstyled">
					<li><a class="footer-link" href="<?= base_url('Home') ?>">Home</a></li>
					<li><a class="footer-link" href="<?= base_url('Home/contact') ?>">About Us</a></li>
					<li><a class="footer-link" href="<?= base_url('Home/services') ?>">Our Services</a></li>
					<li><a class="footer-link" href="<?= base_url('Home/contact') ?>">Contact Us</a></li>
					<li><a class="footer-link" href="<?= base_url('Home/register') ?>">Register Now</a></li>
					<li><a class="footer-link" href="<?= base_url('Home/login') ?>">Login</a></li>
					<li><a class="footer-link" href="<?= base_url('Home/book_now') ?>">Book a Shipment</a></li>
				</ul>
			</div>

			<div class="col-12 col-md-4 col-lg-4 mb-4">
				<h5>Contact Info</h5>
				<div class="contact-item">
					<div class="contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
					<div>
						<span class="d-block text-white fw-bold mb-1">Our Location</span>
						Plot No. 12, Transport Nagar, Phase III, Near Railway Station.
					</div>
				</div>
				<div class="contact-item">
					<div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
					<div>
						<span class="d-block text-white fw-bold mb-1">Phone Number</span>
						+91 98765-43210 (Support)<br>+91 12345-67890 (Toll Free)
					</div>
				</div>
				<div class="contact-item">
					<div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
					<div>
						<span class="d-block text-white fw-bold mb-1">Support Email</span>
						support@shipperrj.com<br>info@shipperrj.com
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Copyright Bar -->
<section class="py-4 copyright-bar">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
				<p class="mb-0 small fw-medium" style="color: #64748b;">
					&copy; <?= date('Y') ?> <span style="color: #fc9300ff;">ShipperRJ</span>. All Rights Reserved.
				</p>
			</div>
			<div class="col-md-6 text-center text-md-end">
				<p class="mb-0 small fw-medium" style="color: #64748b;">
					Designed & Developed with&nbsp;<i class="bi bi-suit-heart-fill text-danger"></i>&nbsp;by&nbsp;
					<a class="text-white text-decoration-none fw-bold hover-primary" href="https://digicoders.in/" target="_blank">Team DigiCoders</a>
				</p>
			</div>
		</div>
	</div>
</section>
<!-- <section> close ============================-->
<!-- ============================================-->