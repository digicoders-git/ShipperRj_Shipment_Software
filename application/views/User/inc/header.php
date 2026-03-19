<!-- Header -->
<header class="main-header" id="header">
	<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
		<!-- Sidebar toggle button -->
		<button id="sidebar-toggler" class="sidebar-toggle">
			<span class="sr-only">Toggle navigation</span>
		</button>

		<span class="page-title">Delivery Boy Panel</span>

		<div class="d-none d-xl-flex align-items-center mx-auto text-dark clock-wrapper" style="font-family: 'Plus Jakarta Sans', sans-serif;">
			<div class="d-flex align-items-center bg-white border rounded-pill px-3 py-1 shadow-sm">
				<i class="mdi mdi-calendar-clock text-primary me-2 fs-5"></i>
				<span id="live-clock" class="fw-bold small text-uppercase" style="letter-spacing: 0.5px;"></span>
			</div>
		</div>

		<script>
			function updateClock() {
				const now = new Date();
				const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
				const day = days[now.getDay()];
				const date = now.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
				const time = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
				
				document.getElementById('live-clock').innerHTML = `${day}, ${date} | ${time}`;
			}
			setInterval(updateClock, 1000);
			updateClock();
		</script>

		<div class="navbar-right ">

			<!-- search form -->


			<ul class="nav navbar-nav">
				<!-- Offcanvas -->
				<!-- User Account -->
				<li class="dropdown user-menu">
					<button class="dropdown-toggle nav-link" data-toggle="dropdown">
						<img src="https://i.pinimg.com/originals/3e/aa/24/3eaa245d923949b6f662b8ba07b7a3b2.png"
							class="user-image rounded-circle" alt="User Image">

						<?php
						$Delivery_Boy = $this->session->userdata("Delivery_Boy");
						$query = $this->db->where('id', $Delivery_Boy)->get('delivery_boy')->row();
						?>
						<span class="d-none d-lg-inline-block"><?= $query->name ?></span>

					</button>
					<ul class="dropdown-menu dropdown-menu-right">
						<li>
							<a class="dropdown-link-item" href="<?= base_url('User/change_password') ?>">
								<i class="mdi mdi-account-outline"></i>
								<span class="nav-text">Change Password</span>
							</a>
						</li>
						<li>
							<a class="dropdown-link-item" href="javascript:void(0)"
								onclick="LogoutConfirm('<?= base_url('User/LogOut') ?>')">
								<i class="mdi mdi-logout"></i>
								<span class="nav-text">Log Out</span>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>