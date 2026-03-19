<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include("inc/header-link.php"); ?>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">
	<style>
		:root {
			--primary: #6366f1;
			--primary-hover: #4f46e5;
			--bg-subtle: #f8fafc;
		}

		body {
			font-family: 'Plus Jakarta Sans', sans-serif;
			background-color: var(--bg-subtle);
		}

		.change-password-card {
			border: none;
			border-radius: 24px;
			box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
			overflow: hidden;
			background: #fff;
			max-width: 500px;
			width: 100%;
		}

		.form-control {
			border-radius: 12px;
			padding: 12px 20px;
			border: 1px solid #e2e8f0;
			font-size: 0.95rem;
			transition: all 0.3s;
		}

		.form-control:focus {
			border-color: var(--primary);
			box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
		}

		.btn-submit {
			background: var(--primary);
			border: none;
			border-radius: 12px;
			padding: 14px;
			font-weight: 700;
			font-size: 1rem;
			color: #fff;
			transition: all 0.3s;
			width: 100%;
			margin-top: 10px;
		}

		.btn-submit:hover {
			background: var(--primary-hover);
			transform: translateY(-2px);
			box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
		}

		.password-wrapper {
			position: relative;
			display: flex;
			align-items: center;
		}

		.password-wrapper .form-control {
			padding-right: 50px;
		}

		.toggle-password {
			position: absolute;
			right: 16px;
			cursor: pointer;
			color: #94a3b8;
			font-size: 1.2rem;
			transition: all 0.3s;
			z-index: 10;
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100%;
		}

		.toggle-password:hover {
			color: var(--primary);
			transform: scale(1.1);
		}

		.icon-bg {
			width: 70px;
			height: 70px;
			background: rgba(99, 102, 241, 0.1);
			color: var(--primary);
			border-radius: 20px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 32px;
			margin: 0 auto 25px;
		}

		.animate-up {
			animation: slideUp 0.8s ease-out;
		}

		@keyframes slideUp {
			from {
				opacity: 0;
				transform: translateY(20px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
	</style>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
	<div class="wrapper">
		<?php include("inc/sidebar.php"); ?>

		<div class="page-wrapper">
			<?php include("inc/header.php"); ?>

			<div class="content-wrapper">
				<div class="content d-flex justify-content-center align-items-center"
					style="min-height: calc(100vh - 150px);">
					<div class="change-password-card p-5 animate-up">
						<div class="text-center">
							<div class="icon-bg">
								<i class="mdi mdi-shield-key-outline"></i>
							</div>
							<h3 class="fw-extrabold text-dark mb-2">Security Settings</h3>
							<p class="text-muted mb-5">Update your password regularly to keep your account secure.</p>
						</div>

						<form action="<?= base_url('User/ChangePasswordAction') ?>" method="POST">
							<div class="mb-4">
								<label class="form-label fw-bold text-dark small text-uppercase">Current
									Password</label>
								<div class="password-wrapper">
									<input type="password" class="form-control" name="opass" id="opass"
										placeholder="Enter current password" required>
									<span class="toggle-password" onclick="togglePasswordVisibility('opass', this)">
										<i class="mdi mdi-eye-outline"></i>
									</span>
								</div>
							</div>
							<div class="mb-4">
								<label class="form-label fw-bold text-dark small text-uppercase">New Password</label>
								<div class="password-wrapper">
									<input type="password" class="form-control" name="npass" id="npass"
										placeholder="Enter new password" required>
									<span class="toggle-password" onclick="togglePasswordVisibility('npass', this)">
										<i class="mdi mdi-eye-outline"></i>
									</span>
								</div>
							</div>
							<div class="mb-5">
								<label class="form-label fw-bold text-dark small text-uppercase">Confirm New
									Password</label>
								<div class="password-wrapper">
									<input type="password" class="form-control" name="cpass" id="cpass"
										placeholder="Confirm new password" required>
									<span class="toggle-password" onclick="togglePasswordVisibility('cpass', this)">
										<i class="mdi mdi-eye-outline"></i>
									</span>
								</div>
							</div>
							<button type="submit" class="btn btn-submit">
								Update Password <i class="mdi mdi-arrow-right ms-2"></i>
							</button>
						</form>
					</div>
				</div>
			</div>

			<?php include("inc/footer.php"); ?>
		</div>
	</div>
	<script>
		function togglePasswordVisibility(inputId, iconElement) {
			const passwordInput = document.getElementById(inputId);
			const icon = iconElement.querySelector('i');

			if (passwordInput.type === 'password') {
				passwordInput.type = 'text';
				icon.classList.remove('mdi-eye-outline');
				icon.classList.add('mdi-eye-off-outline');
			} else {
				passwordInput.type = 'password';
				icon.classList.remove('mdi-eye-off-outline');
				icon.classList.add('mdi-eye-outline');
			}
		}
	</script>
	<?php include("inc/footer-link.php"); ?>
</body>

</html>