<?php $segment2 = $this->uri->segment(2) ?? 'index'; ?>
<style>
	:root {
		--sidebar-bg: #0f172a;
		--nav-link-color: #94a3b8;
		--nav-link-active: #ffffff;
		--nav-link-hover-bg: rgba(255, 255, 255, 0.05);
		--brand-primary: #F57C20;
		--accent-gradient: linear-gradient(90deg, #F57C20 0%, #f1a469ff 100%);
		--sidebar-width: 250px;
		--sidebar-min-width: 65px;
		--header-height: 70px;
	}

	#left-sidebar {
		background-color: var(--sidebar-bg) !important;
		border-right: 1px solid rgba(255, 255, 255, 0.05);
		transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		z-index: 1040;
	}

	.sidebar-with-footer {
		display: flex;
		flex-direction: column;
		height: 100%;
		overflow-x: hidden;
	}

	.app-brand {

		border-bottom: 1px solid rgba(255, 255, 255, 0.05);
		background: transparent !important;
		overflow: hidden;
		transition: all 0.3s;
		height: var(--header-height) !important;
		display: flex;
		align-items: center;
	}

	.brand-icon-box {
		width: 38px;
		height: 38px;
		min-width: 38px;
		background: var(--accent-gradient);
		border-radius: 10px;
		display: flex;
		align-items: center;
		justify-content: center;
		box-shadow: 0 8px 16px -4px rgba(248, 194, 94, 0.4);
		transition: all 0.3s;
	}

	.brand-text {
		font-family: 'Plus Jakarta Sans', sans-serif;
		font-weight: 800;
		font-size: 1.25rem;
		letter-spacing: -0.5px;
		color: #fff;
		margin-left: 12px;
		white-space: nowrap;
		transition: opacity 0.3s, transform 0.3s;
	}

	.brand-text span {
		color: var(--brand-primary);
	}

	.sidebar-left {
		flex-grow: 1;
	}

	.nav.sidebar-inner {
		padding: 15px 10px !important;
	}

	.nav.sidebar-inner li {
		margin-bottom: 5px;
	}

	.sidenav-item-link {
		border-radius: 12px !important;
		padding: 12px 15px !important;
		margin: 0 !important;
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
		color: var(--nav-link-color) !important;
		display: flex !important;
		align-items: center !important;
		text-decoration: none !important;
		position: relative;
	}

	.sidenav-item-link i {
		font-size: 20px !important;
		min-width: 24px;
		margin-right: 12px !important;
		transition: transform 0.3s ease !important;
	}

	.sidenav-item-link:hover {
		background: var(--nav-link-hover-bg) !important;
		color: #fff !important;
	}

	.sidenav-item-link:hover i {
		transform: translateX(3px);
	}

	.sidebar-inner li.active>.sidenav-item-link {
		background: var(--nav-link-hover-bg) !important;
		color: #fff !important;
	}

	.sidebar-inner li.active>.sidenav-item-link::before {
		content: '';
		position: absolute;
		left: 0;
		top: 15%;
		height: 70%;
		width: 4px;
		background: var(--brand-primary);
		border-radius: 0 4px 4px 0;
		box-shadow: 4px 0 10px rgba(99, 102, 241, 0.5);
	}

	.sidebar-inner li.active>.sidenav-item-link i {
		color: var(--brand-primary) !important;
	}

	/* BOTTOM LOGOUT FOOTER - Strictly Full Width */
	.sidebar-footer {
		padding: 15px 10px !important;
		border-top: 1px solid rgba(255, 255, 255, 0.05) !important;
		margin-top: auto !important;
		width: 100% !important;
		display: block !important;
		box-sizing: border-box !important;
	}

	.logout-btn {
		color: #ef4444 !important;
		background: #251b1d !important;
		border-radius: 12px !important;
		border: 1px solid #4a2b2e !important;
		width: 100% !important;
		padding: 12px 5px !important;
		display: flex !important;
		align-items: center !important;
		justify-content: center !important;
		text-decoration: none !important;
		transition: all 0.3s ease !important;
		box-sizing: border-box !important;
		position: relative !important;
		overflow: hidden !important;
	}

	.logout-btn:hover {
		background: #ef4444 !important;
		color: #fff !important;
		border-color: #ef4444 !important;
		transform: translateY(-2px);
		box-shadow: 0 8px 16px rgba(239, 68, 68, 0.4);
	}

	.logout-btn i {
		color: #ef4444 !important;
		margin-right: 10px;
		transition: color 0.3s ease !important;
		flex-shrink: 0 !important;
	}

	.logout-btn:hover i {
		color: #fff !important;
	}

	/* COLLAPSED STATE (Minified) */
	.sidebar-minified #left-sidebar {
		width: var(--sidebar-min-width);
	}

	.sidebar-minified .brand-text,
	.sidebar-minified .nav-text,
	.sidebar-minified .logout-btn span {
		opacity: 0;
		width: 0;
		overflow: hidden;
		position: absolute;
		pointer-events: none;
	}

	.sidebar-minified .sidenav-item-link i,
	.sidebar-minified .logout-btn i {
		margin-right: 0 !important;
		margin-left: 0 !important;
	}

	.sidebar-minified .brand-icon-box {
		margin-right: 0;
		width: 32px;
		height: 32px;
		min-width: 32px;
	}

	.sidebar-minified .app-brand {
		justify-content: center;
		padding: 0 !important;
	}

	.sidebar-minified .sidebar-footer {
		padding: 15px 5px !important;
	}

	/* HOVER EXPAND BEHAVIOR */
	.sidebar-minified #left-sidebar:hover {
		width: var(--sidebar-width);
		box-shadow: 10px 0 30px rgba(0, 0, 0, 0.3);
	}

	.sidebar-minified #left-sidebar:hover .brand-text,
	.sidebar-minified #left-sidebar:hover .nav-text,
	.sidebar-minified #left-sidebar:hover .logout-btn span {
		opacity: 1;
		width: auto;
		position: static;
		pointer-events: auto;
	}

	.sidebar-minified #left-sidebar:hover .sidenav-item-link i,
	.sidebar-minified #left-sidebar:hover .logout-btn i {
		margin-right: 12px !important;
	}

	.sidebar-minified #left-sidebar:hover .brand-icon-box {
		margin-right: 12px;
		width: 38px;
		height: 38px;
		min-width: 38px;
	}

	.sidebar-minified #left-sidebar:hover .app-brand {
		justify-content: flex-start;
		padding: 0 25px !important;
	}

	.sidebar-minified #left-sidebar:hover .sidebar-footer {
		padding: 15px 10px !important;
	}

	/* MOBILE & TABLET RESPONSIVENESS */
	@media (max-width: 767px) {
		#left-sidebar {
			position: fixed !important;
			left: -100% !important;
			top: 0;
			bottom: 0;
			z-index: 9999 !important;
			transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
			box-shadow: 20px 0 50px rgba(0, 0, 0, 0.5);
			width: 250px !important;
		}

		body.sidebar-mobile-in #left-sidebar {
			left: 0 !important;
		}
	}

	#sidebar-close-btn {
		display: none;
		position: absolute;
		right: 15px;
		top: 20px;
		color: #fff;
		font-size: 24px;
		cursor: pointer;
		z-index: 10;
	}

	@media (max-width: 767px) {
		#sidebar-close-btn {
			display: block;
		}
	}
</style>

<aside class="left-sidebar sidebar-dark" id="left-sidebar">
	<div id="sidebar-close-btn" class="sidebar-toggle">
		<i class="mdi mdi-close"></i>
	</div>
	<div id="sidebar" class="sidebar sidebar-with-footer">
		<!-- Aplication Brand -->
		<div class="app-brand justify-content-center">
			<a href="<?= base_url('Admin/index') ?>"
				class="d-flex align-items-center justify-content-center text-decoration-none w-100">
				<img src="<?= base_url('assets/web_assets/img/gallery/logo.png') ?>" alt="Logo" style="height: 45px; width: auto; max-width: 100%; object-fit: contain;    margin-right: 25px;
">
			</a>
		</div>
		<!-- begin sidebar scrollbar -->
		<div class="sidebar-left" data-simplebar="" style="height: calc(100% - 150px);">
			<!-- sidebar menu -->
			<ul class="nav sidebar-inner" id="sidebar-menu">
				<li class="<?= $segment2 == 'index' ? 'active' : '' ?>">
					<a class="sidenav-item-link" href="<?= base_url('Admin/index') ?>">
						<i class="mdi mdi-view-dashboard-outline"></i>
						<span class="nav-text">Dashboard</span>
					</a>
				</li>
				<li class="<?= $segment2 == 'ManageUser' ? 'active' : '' ?>">
					<a class="sidenav-item-link" href="<?= base_url('Admin/ManageUser') ?>">
						<i class="mdi mdi-account-group-outline"></i>
						<span class="nav-text">Manage Users</span>
					</a>
				</li>
				<li class="<?= $segment2 == 'ManageUserWallets' ? 'active' : '' ?>">
					<a class="sidenav-item-link" href="<?= base_url('Admin/ManageUserWallets') ?>">
						<i class="mdi mdi-wallet"></i>
						<span class="nav-text">User Wallets</span>
					</a>
				</li>
				<!-- Pincode Pricing -->
				<li
					class="has-sub <?= ($segment2 == 'ManagePricing' || $segment2 == 'ManageWeightSlots') ? 'active expand' : '' ?>">
					<a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
						data-target="#pricing-menu" aria-expanded="false" aria-controls="pricing-menu">
						<i class="mdi mdi-cash-multiple"></i>
						<span class="nav-text">Pincode Pricing</span> <b class="caret"></b>
					</a>
					<ul class="collapse <?= ($segment2 == 'ManagePricing' || $segment2 == 'ManageWeightSlots') ? 'show' : '' ?>"
						id="pricing-menu" data-parent="#sidebar-menu">
						<div class="sub-menu">
							<li class="<?= $segment2 == 'ManageWeightSlots' ? 'active' : '' ?>">
								<a class="sidenav-item-link" href="<?= base_url('Admin/ManageWeightSlots') ?>">
									<span class="nav-text">Weight Range Slots</span>
								</a>
							</li>
							<li class="<?= $segment2 == 'ManagePricing' ? 'active' : '' ?>">
								<a class="sidenav-item-link" href="<?= base_url('Admin/ManagePricing') ?>">
									<span class="nav-text">Manage Route Pricing</span>
								</a>
							</li>
						</div>
					</ul>
				</li>
				<li class="<?= $segment2 == 'ManageBooking' ? 'active' : '' ?>">
					<a class="sidenav-item-link" href="<?= base_url('Admin/ManageBooking') ?>">
						<i class="mdi mdi-package-variant"></i>
						<span class="nav-text">All Bookings</span>
					</a>
				</li>
				<li class="<?= $segment2 == 'ManageDeliveryBoy' ? 'active' : '' ?>">
					<a class="sidenav-item-link" href="<?= base_url('Admin/ManageDeliveryBoy') ?>">
						<i class="mdi mdi-truck-delivery"></i> <span class="nav-text">Delivery Boys</span>
					</a>
				</li>
				<li class="<?= $segment2 == 'ManageManager' ? 'active' : '' ?>">
					<a class="sidenav-item-link" href="<?= base_url('Admin/ManageManager') ?>">
						<i class="mdi mdi-account-tie"></i> <span class="nav-text">Manage Managers</span>
					</a>
				</li>
				<!-- <li class="<?= $segment2 == 'ManageWalletTransactions' ? 'active' : '' ?>">
					<a class="sidenav-item-link" href="<?= base_url('Admin/ManageWalletTransactions') ?>">
						<i class="mdi mdi-wallet-outline"></i> <span class="nav-text">Wallet Requests</span>
					</a>
				</li> -->
				<li class="<?= $segment2 == 'inquiries' ? 'active' : '' ?>">
					<a class="sidenav-item-link" href="<?= base_url('Admin/inquiries') ?>">
						<i class="mdi mdi-email-open-outline"></i> <span class="nav-text">Contact Inquiries</span>
					</a>
				</li>
				<li class="<?= $segment2 == 'ManageDisputes' ? 'active' : '' ?>">
					<a class="sidenav-item-link" href="<?= base_url('Admin/ManageDisputes') ?>">
						<i class="mdi mdi-alert-circle-outline"></i> <span class="nav-text">Manage Disputes</span>
					</a>
				</li>
				<li class="<?= $segment2 == 'change_password' ? 'active' : '' ?>">
					<a class="sidenav-item-link" href="<?= base_url('Admin/change_password') ?>">
						<i class="mdi mdi-shield-lock-outline"></i> <span class="nav-text">Security Settings</span>
					</a>
				</li>
			</ul>
		</div>

		<div class="sidebar-footer">
			<a href="javascript:void(0)" onclick="LogoutConfirm('<?= base_url('Admin/LogOut') ?>')" class="logout-btn">
				<i class="mdi mdi-power"></i>
				<span class="nav-text">Logout</span>
			</a>
		</div>
	</div>
</aside>
<div class="sidebar-overlay"></div>