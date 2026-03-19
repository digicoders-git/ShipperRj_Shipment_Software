<nav class="navbar navbar-expand-lg navbar-light fixed-top py-0 navbar-custom"
	data-navbar-on-scroll="data-navbar-on-scroll">
	<div class="container"><a class="navbar-brand" href="<?= base_url('Home') ?>"><img
				src="<?= base_url('assets/web_assets/img/gallery/logo.png') ?>" height="45" alt="logo"></a><button
			class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
				class="navbar-toggler-icon"> </span></button>
		<div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto align-items-center">
				<?php
				$segment = $this->uri->segment(2);
				$is_home = (empty($segment) || $segment == 'index');
				?>
				<li class="nav-item">
					<a class="nav-link px-3 <?= $is_home ? 'active' : '' ?>" href="<?= base_url('Home') ?>">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link px-3 <?= ($segment == 'services') ? 'active' : '' ?>"
						href="<?= base_url('Home/services') ?>">Our Services</a>
				</li>
				<li class="nav-item">
					<a class="nav-link px-3 <?= ($segment == 'contact') ? 'active' : '' ?>"
						href="<?= base_url('Home/contact') ?>">Find Us</a>
				</li>
				<?php
				$User_id = $this->session->userdata("User");
				if (!empty($User_id)) {
					?>
					<li class="nav-item">
						<a class="nav-link px-3 <?= ($segment == 'book_histroy') ? 'active' : '' ?>"
							href="<?= base_url('Home/book_histroy') ?>">My Booking</a>
					</li>

					<li class="nav-item ms-lg-3">
						<a class="btn btn-premium px-4 <?= ($segment == 'book_now') ? 'active' : '' ?>"
							href="<?= base_url('Home/book_now') ?>">Book Now</a>
					</li>
					<li class="nav-item ms-2">
						<a class="btn btn-premium-outline px-4 <?= ($segment == 'wallet') ? 'active' : '' ?>"
							href="<?= base_url('Home/wallet') ?>">
							<i class="bi bi-wallet2 me-2"></i>Wallet
						</a>
					</li>
					<li class="nav-item"><a class="nav-link px-3" href="javascript:void(0)"
						onclick="LogoutConfirm('<?= base_url('Home/LogOut') ?>')">Logout</a></li>
					<?php
				} else {
					?>
					<li class="nav-item">
						<a class="nav-link px-3 <?= ($segment == 'register') ? 'active' : '' ?>"
							href="<?= base_url('Home/register') ?>">Register</a>
					</li>
					<li class="nav-item ms-lg-3">
						<a class="btn btn-premium px-4 <?= ($segment == 'login') ? 'active' : '' ?>"
							href="<?= base_url('Home/login') ?>">Book Now</a>
					</li>
				
					<?php
				}
				?>
			

			</ul>
		</div>
	</div>
</nav>