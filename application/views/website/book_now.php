<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<?php
	include('inc/header-link.php')
		?>
	<style>
		.glass-form-container {
			background: rgba(255, 255, 255, 0.85);
			backdrop-filter: blur(12px);
			border: 1px solid rgba(255, 255, 255, 0.4);
			border-radius: 24px;
			padding: 2.5rem;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
		}

		.premium-form-section {
			background: rgba(255, 255, 255, 0.6);
			border: 1px solid rgba(226, 232, 240, 0.8);
			border-radius: 20px;
			padding: 2rem;
			transition: all 0.3s ease;
		}

		.premium-form-section:hover {
			border-color: var(--primary-color);
			background: rgba(255, 255, 255, 0.9);
			box-shadow: 0 5px 15px rgba(26, 35, 126, 0.05);
		}

		.section-header-modern {
			display: flex;
			align-items: center;
			gap: 1.25rem;
			margin-bottom: 2rem;
		}

		.section-number {
			width: 48px;
			height: 48px;
			background: var(--primary-color);
			color: #fff;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 14px;
			font-weight: 800;
			font-size: 1.1rem;
			box-shadow: 0 4px 12px rgba(26, 35, 126, 0.2);
		}

		.form-label-premium {
			font-size: 0.825rem;
			font-weight: 700;
			color: #4a5568;
			margin-bottom: 0.6rem;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.form-control-premium,
		.form-select-premium {
			border: 2px solid #eaedf2;
			border-radius: 12px;
			padding: 0.75rem 1rem;
			font-size: 0.95rem;
			font-weight: 500;
			width: 100%;
			transition: all 0.2s ease;
		}

		.form-control-premium:focus,
		.form-select-premium:focus {
			outline: none;
			border-color: var(--primary-color);
			background: #fff;
			box-shadow: 0 0 0 4px rgba(26, 35, 126, 0.08);
		}

		.input-with-icon {
			position: relative;
		}

		.input-with-icon i {
			position: absolute;
			left: 1rem;
			top: 50%;
			transform: translateY(-50%);
			color: #a0aec0;
			font-size: 1.1rem;
		}

		.input-with-icon .form-control-premium {
			padding-left: 2.8rem;
		}

		.input-group-premium {
			display: flex;
			align-items: center;
			background: #fff;
			border: 2px solid #eaedf2;
			border-radius: 12px;
			overflow: hidden;
		}

		.input-group-premium .form-control-premium {
			border: none;
		}

		.input-unit,
		.input-label-inner {
			padding: 0 1rem;
			font-weight: 700;
			color: #718096;
			background: #f7fafc;
			border-left: 2px solid #eaedf2;
			height: 100%;
			display: flex;
			align-items: center;
		}

		.input-label-inner {
			border-left: none;
			border-right: 2px solid #eaedf2;
		}

		/* Digital Receipt Styling */
		.digital-receipt-card {
			background: rgba(255, 255, 255, 0.95);
			backdrop-filter: blur(10px);
			border-radius: 24px;
			overflow: hidden;
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.5);
		}

		.receipt-header {
			background: var(--primary-color);
			padding: 1.75rem;
			color: #fff;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.phone-error-msg {
			color: #dc3545;
			font-size: 0.75rem;
			margin-top: 4px;
			display: none;
			font-weight: 600;
			animation: fadeInError 0.3s ease;
		}

		@keyframes fadeInError {
			from {
				opacity: 0;
				transform: translateY(-5px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		.receipt-body {
			padding: 2rem;
		}

		.receipt-row {
			display: flex;
			justify-content: space-between;
			margin-bottom: 1.25rem;
			font-size: 0.95rem;
			color: #4a5568;
		}

		.receipt-row.highlight {
			background: rgba(26, 35, 126, 0.04);
			padding: 0.75rem 1rem;
			border-radius: 10px;
			margin: 1.5rem 0;
		}

		.receipt-divider {
			height: 2px;
			background: repeating-linear-gradient(to right, #eaedf2 0, #eaedf2 8px, transparent 8px, transparent 12px);
			margin: 2rem 0;
		}

		.receipt-row.total {
			align-items: center;
			color: #1a202c;
		}

		.receipt-footer-pattern {
			height: 12px;
			background-image: radial-gradient(#eaedf2 20%, transparent 20%);
			background-position: 0 0;
			background-size: 24px 24px;
			opacity: 0.5;
		}

		.btn-premium-gradient {
			background: linear-gradient(135deg, var(--primary-color) 0%, #303f9f 100%);
			color: #fff;
			border: none;
			font-weight: 700;
			letter-spacing: 0.5px;
			box-shadow: 0 10px 20px rgba(26, 35, 126, 0.2);
			transition: all 0.3s ease;
		}

		.btn-premium-gradient:hover {
			transform: translateY(-2px);
			box-shadow: 0 12px 25px rgba(26, 35, 126, 0.3);
			color: #fff;
		}

		.alert-danger-soft {
			background: #fff5f5;
			color: #c53030;
			border-left: 4px solid #fc8181;
		}

		.x-small {
			font-size: 0.75rem;
		}

		@media (max-width: 991.98px) {
			.glass-form-container {
				padding: 1.5rem;
			}

			.premium-form-section {
				padding: 1.5rem;
			}

			.sticky-top {
				position: relative !important;
				top: 0 !important;
				margin-top: 2rem;
			}
		}

		.page-section {
			position: relative;
			padding: 5rem 0;
			background: #f8fafc;
		}

		.bg-holder {
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			z-index: -1;
		}

		.pincode-results-container {
			position: absolute;
			top: 100%;
			left: 0;
			right: 0;
			background: #fff;
			border: 1px solid #eaedf2;
			border-radius: 12px;
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
			z-index: 1000;
			max-height: 200px;
			overflow-y: auto;
			display: none;
			margin-top: 5px;
		}

		.pincode-item {
			padding: 10px 15px;
			cursor: pointer;
			transition: all 0.2s ease;
			border-bottom: 1px solid #f8fafc;
			font-weight: 500;
			color: #2d3748;
		}

		.pincode-item:last-child {
			border-bottom: none;
		}

		.pincode-item:hover {
			background: #f7fafc;
			color: var(--primary-color);
			padding-left: 20px;
		}

		.pincode-no-results {
			padding: 10px 15px;
			color: #e53e3e;
			font-weight: 600;
			font-size: 0.85rem;
			text-align: center;
		}

		.weight-error-msg {
			color: #e53e3e;
			font-size: 0.85rem;
			font-weight: 600;
			margin-top: 8px;
			display: none;
			padding: 8px 12px;
			background: #fff5f5;
			border-radius: 8px;
			border: 1px solid #feb2b2;
		}
	</style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar">
	<!-- ===============================================-->
	<!--    Main Content-->
	<!-- ===============================================-->
	<main class="main" id="top">
		<?php
		include('inc/header.php')
			?>
		<!-- Unified Hero & Booking Section -->
		<section class="hero-banner-section pt-8 pb-6" id="home">
			<div class="bg-holder bg-size"
				style="background-image:url(<?= base_url('assets/web_assets/img/gallery/hero-header-bg.png') ?>);background-position:top center;background-size:cover;">
			</div>
			<div class="container animate__animated animate__fadeIn">
				<!-- Header Text -->
				<div class="row align-items-center mb-5">
					<div class="col-12 text-center text-md-start">
						<h1 class="fw-normal fs-4 fs-xxl-5 text-primary mb-1">Ship with Confidence</h1>
						<h1 class="fw-bolder fs-5 fs-xxl-6 mb-2">Book Your Shipment</h1>
						<p class="fs-1 mb-0 text-muted">Premium logistics solutions at your fingertips.</p>
					</div>
				</div>

				<!-- Form Content -->
				<form action="<?= base_url('Home/BookingPayment') ?>" method="POST">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="row g-4">
								<!-- Main Form Section -->
								<div class="col-lg-8 animate__animated animate__fadeInLeft">
									<div class="glass-form-container">
										<!-- Section 01: Sender -->
										<div class="premium-form-section mb-4">
											<div class="section-header-modern">
												<span class="section-number">01</span>
												<div>
													<h4 class="fw-bold mb-1">Sender Details</h4>
													<p class="text-muted small mb-0">Where is the package being picked
														up from?</p>
												</div>
											</div>

											<div class="row g-3">
												<div class="col-md-6">
													<label class="form-label-premium">Sender Name</label>
													<div class="input-with-icon">
														<i class="bi bi-person"></i>
														<input type="text" class="form-control-premium" id="senderName"
															name="senderName" required placeholder="Full Name">
													</div>
												</div>
												<div class="col-md-6">
													<label class="form-label-premium">Phone Number</label>
													<div class="input-with-icon">
														<i class="bi bi-telephone"></i>
														<input type="tel" class="form-control-premium phone-input"
															id="senderPhone" name="senderPhone" required
															placeholder="Start with 6-9" maxlength="10">
													</div>
													<div class="phone-error-msg" id="senderPhoneError">
														<i class="bi bi-exclamation-circle me-1"></i> Phone number must
														start with 6, 7, 8, or 9
													</div>
												</div>
												<div class="col-md-6">
													<label class="form-label-premium">Pincode</label>
													<div class="input-with-icon position-relative">
														<i class="bi bi-geo-alt"></i>
														<input type="text" class="form-control-premium pincode-search"
															id="senderPincode" name="senderPincode" required
															placeholder="Search Pickup Pincode" autocomplete="off"
															maxlength="6" inputmode="numeric">
														<div id="senderPincodeResults"
															class="pincode-results-container"></div>
													</div>
												</div>
												<div class="col-md-3 col-6">
													<label class="form-label-premium">City</label>
													<input type="text" class="form-control-premium" id="senderCity"
														name="senderCity" placeholder="Auto">
												</div>
												<div class="col-md-3 col-6">
													<label class="form-label-premium">State</label>
													<input type="text" class="form-control-premium" id="senderState"
														name="senderState" placeholder="Auto">
												</div>
												<div class="col-12">
													<label class="form-label-premium">Full Pickup Address</label>
													<textarea class="form-control-premium" id="senderAddress"
														name="senderAddress" rows="2" required
														placeholder="House No, Street, Landmark..."></textarea>
												</div>
											</div>
										</div>

										<!-- Section 02: Receiver -->
										<div class="premium-form-section mb-4">
											<div class="section-header-modern">
												<span class="section-number">02</span>
												<div>
													<h4 class="fw-bold mb-1">Receiver Details</h4>
													<p class="text-muted small mb-0">Where should we deliver the
														package?</p>
												</div>
											</div>

											<div class="row g-3">
												<div class="col-md-6">
													<label class="form-label-premium">Receiver Name</label>
													<div class="input-with-icon">
														<i class="bi bi-person-check"></i>
														<input type="text" class="form-control-premium"
															id="receiverName" name="receiverName" required
															placeholder="Full Name">
													</div>
												</div>
												<div class="col-md-6">
													<label class="form-label-premium">Receiver Phone</label>
													<div class="input-with-icon">
														<i class="bi bi-telephone"></i>
														<input type="tel" class="form-control-premium phone-input"
															id="receiverPhone" name="receiverPhone" required
															placeholder="Start with 6-9" maxlength="10">
													</div>
													<div class="phone-error-msg" id="receiverPhoneError">
														<i class="bi bi-exclamation-circle me-1"></i> Phone number must
														start with 6, 7, 8, or 9
													</div>
												</div>
												<div class="col-md-6">
													<label class="form-label-premium">Pincode</label>
													<div class="input-with-icon position-relative">
														<i class="bi bi-geo"></i>
														<input type="text" class="form-control-premium pincode-search"
															id="receiverPincode" name="receiverPincode" required
															placeholder="Search Destination Pincode" autocomplete="off"
															maxlength="6" inputmode="numeric">
														<div id="receiverPincodeResults"
															class="pincode-results-container"></div>
													</div>
												</div>
												<div class="col-md-3 col-6">
													<label class="form-label-premium">City</label>
													<input type="text" class="form-control-premium" id="receiverCity"
														name="receiverCity" placeholder="Auto">
												</div>
												<div class="col-md-3 col-6">
													<label class="form-label-premium">State</label>
													<input type="text" class="form-control-premium" id="receiverState"
														name="receiverState" placeholder="Auto">
												</div>
												<div class="col-12">
													<label class="form-label-premium">Full Delivery Address</label>
													<textarea class="form-control-premium" id="receiverAddress"
														name="receiverAddress" rows="2" required
														placeholder="Building, Street, Area..."></textarea>
												</div>
											</div>
										</div>

										<!-- Section 03: Package -->
										<div class="premium-form-section mb-4">
											<div class="section-header-modern">
												<span class="section-number">03</span>
												<div>
													<h4 class="fw-bold mb-1">Package Info</h4>
													<p class="text-muted small mb-0">Help us understand what we are
														carrying</p>
												</div>
											</div>

											<div class="row g-4">
												<div class="col-md-4">
													<label class="form-label-premium">Actual Weight (kg)</label>
													<div class="input-group-premium">
														<input type="number" class="form-control-premium"
															id="packageWeight" name="packageWeight" step="0.1" required
															placeholder="0.0">
														<span class="input-unit">kg</span>
													</div>
												</div>
												<div class="col-md-8">
													<label class="form-label-premium">Dimensions (cm)</label>
													<div class="d-flex gap-2">
														<div class="input-group-premium flex-fill">
															<span class="input-label-inner">L</span>
															<input type="number" class="form-control-premium dim-input"
																name="length" id="length" required placeholder="0">
														</div>
														<div class="input-group-premium flex-fill">
															<span class="input-label-inner">W</span>
															<input type="number" class="form-control-premium dim-input"
																name="width" id="width" required placeholder="0">
														</div>
														<div class="input-group-premium flex-fill">
															<span class="input-label-inner">H</span>
															<input type="number" class="form-control-premium dim-input"
																name="height" id="height" required placeholder="0">
														</div>
													</div>
												</div>
												<div class="col-12">
													<label class="form-label-premium">Describe Contents</label>
													<input type="text" class="form-control-premium" id="packageContents"
														name="packageContents" required
														placeholder="e.g., Electronic Items, Documents, Apparel">
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Sticky Summary Section -->
								<div class="col-lg-4">
									<div class="sticky-top" style="top: 100px;">
										<div class="digital-receipt-card animate__animated animate__fadeInRight">
											<div class="receipt-header">
												<h5 class="fw-bold mb-1 text-white"><i
														class="bi bi-receipt me-2"></i>Order Summary</h5>
												<span class="badge bg-white text-primary rounded-pill">New
													Booking</span>
											</div>

											<div class="receipt-body">
												<div class="receipt-row">
													<span>Actual Weight</span>
													<span class="fw-bold text-dark" id="actualWeight">0.00 kg</span>
												</div>
												<div class="receipt-row">
													<span>Dimensional Weight</span>
													<span class="fw-bold text-dark" id="volWeight">0.00 kg</span>
												</div>
												<div class="receipt-row highlight">
													<span>Chargable Weight</span>
													<span class="fw-bold text-primary" id="finalWeight">0.00 kg</span>
												</div>

												<div class="receipt-divider"></div>

												<div class="receipt-row total">
													<span class="fw-bold text-dark">Estimated Cost</span>
													<h3 class="fw-bold text-primary mb-0" id="totalDisplay">₹ 0.00</h3>
												</div>

												<?php
												$u_id = $this->session->userdata("User");
												$u_data = $this->db->where('id', $u_id)->get('registration')->row();
												$current_wallet = isset($u_data->wallet) ? $u_data->wallet : 0;
												?>

												<div class="wallet-status-bar mt-4">
													<div class="d-flex justify-content-between small mb-1">
														<span class="text-muted">Available Balance</span>
														<span class="fw-bold text-dark">₹
															<?= number_format($current_wallet, 2) ?></span>
													</div>

												</div>

												<div id="wallet-warning"
													class="alert alert-danger-soft small mt-3 border-0 animate__animated animate__headShake"
													style="display:none;">
													<i class="bi bi-exclamation-circle-fill me-2"></i> Insufficient
													Balance. <a href="<?= base_url('Home/wallet') ?>"
														class="fw-bold">Recharge</a>
												</div>

												<button type="submit" id="book-btn"
													class="btn btn-premium-gradient w-100 py-3 rounded-3 mt-4">
													Confirm & Book Now <i class="bi bi-arrow-right-circle ms-2"></i>
												</button>

												<p class="text-center text-muted x-small mt-3 mb-0">
													<i class="bi bi-shield-check me-1"></i> Secure 256-bit Encrypted
													Booking
												</p>
											</div><!-- end of .row-->
				</form>
			</div><!-- end of .container-->
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
		$(document).ready(function () {
			let pricePerKg = 0;
			let isFlatRate = false;

			// Add weight error container after charging weight display
			$('#finalWeight').parent().after('<div id="weightRangeError" class="weight-error-msg"></div>');

			function calculateWeight() {
				const sender = $('#senderPincode').val();
				const receiver = $('#receiverPincode').val();

				if (sender && receiver && sender === receiver) {
					swal("Error", "Sender and Receiver pincodes cannot be the same.", "error");
					$('#receiverPincode').val("");
					return;
				}

				const weight = parseFloat($('#packageWeight').val()) || 0;
				$('#actualWeight').text(weight.toFixed(2) + ' kg');

				const length = parseFloat($('#length').val()) || 0;
				const width = parseFloat($('#width').val()) || 0;
				const height = parseFloat($('#height').val()) || 0;

				const volWeight = (length * width * height) / 5000;
				$('#volWeight').text(volWeight.toFixed(2) + ' kg');

				const finalWeight = Math.max(weight, volWeight);
				$('#finalWeight').text(finalWeight.toFixed(2) + ' kg');

				if (pricePerKg > 0) {
					let total = 0;
					if (isFlatRate) {
						total = pricePerKg;
					} else {
						total = Math.ceil(finalWeight * pricePerKg);
					}

					$('#totalDisplay').text('₹ ' + total.toFixed(2));
					$('#total_amount').val(total);
					$('#weightRangeError').fadeOut();

					const walletBalance = <?= $current_wallet ?>;
					if (total > walletBalance) {
						$('#wallet-warning').show();
						$('#book-btn').addClass('opacity-50').prop('disabled', true).prop('title', 'Insufficient balance');
					} else {
						$('#wallet-warning').hide();
						$('#book-btn').removeClass('opacity-50').prop('disabled', false).prop('title', '');
					}
				} else {
					$('#totalDisplay').text('₹ 0.00');
				}
			}

			function fetchPrice() {
				const from = $('#senderPincode').val();
				const to = $('#receiverPincode').val();
				const weight = $('#finalWeight').text().split(' ')[0];

				if (from && to && parseFloat(weight) > 0) {
					$.ajax({
						url: "<?= base_url('Home/GetPincodePrice') ?>",
						type: "POST",
						data: { from: from, to: to, weight: weight },
						dataType: "json",
						success: function (res) {
							if (res.status) {
								pricePerKg = parseFloat(res.price);
								isFlatRate = res.is_flat_rate;
								$('#weightRangeError').fadeOut();
								calculateWeight();
							} else {
								pricePerKg = 0;
								isFlatRate = false;
								$('#totalDisplay').text('₹ 0.00');
								$('#weightRangeError').text(res.msg).fadeIn();
								$('#book-btn').addClass('opacity-50').prop('disabled', true);
							}
						}
					});
				}
			}

			function handlePincodeSearch(inputId, resultsId, fromPin = null) {
				const resultsContainer = $(`#${resultsId}`);

				function performSearch(query = '') {
					$.ajax({
						url: "<?= base_url('Home/SearchPincodes') ?>",
						type: "POST",
						data: { query: query, from_pin: fromPin ? $(`#${fromPin}`).val() : null },
						dataType: "json",
						success: function (res) {
							let html = '';
							if (res.length > 0) {
								res.forEach(item => {
									html += `<div class="pincode-item" data-pin="${item.pin}">${item.pin}</div>`;
								});
							} else {
								html = '<div class="pincode-no-results">Pincode not found!</div>';
							}
							resultsContainer.html(html).fadeIn();
						}
					});
				}

				$(`#${inputId}`).on('focus', function () {
					performSearch($(this).val());
				});

				$(`#${inputId}`).on('input', function () {
					const val = $(this).val();
					performSearch(val);
					if (val.length === 6) {
						if (inputId === 'senderPincode') {
							fetchPincodeDetails(val, 'senderCity', 'senderState', 'senderAddress');
						} else {
							fetchPincodeDetails(val, 'receiverCity', 'receiverState', 'receiverAddress');
							fetchPrice();
						}
					}
				});

				$(document).on('click', `#${resultsId} .pincode-item`, function () {
					const pin = $(this).data('pin');
					$(`#${inputId}`).val(pin);
					$(`#${resultsId}`).fadeOut();

					// Trigger change logic
					if (inputId === 'senderPincode') {
						// Clear all receiver data on sender change
						$('#receiverPincode').val('');
						$('#receiverCity').val('');
						$('#receiverState').val('');
						$('#receiverAddress').val('');
						fetchPincodeDetails(pin, 'senderCity', 'senderState', 'senderAddress');
					} else {
						fetchPincodeDetails(pin, 'receiverCity', 'receiverState', 'receiverAddress');
						fetchPrice();
					}
					calculateWeight();
				});
			}

			handlePincodeSearch('senderPincode', 'senderPincodeResults');
			handlePincodeSearch('receiverPincode', 'receiverPincodeResults', 'senderPincode');

			// Close results when clicking outside
			$(document).on('click', function (e) {
				if (!$(e.target).closest('.pincode-search, .pincode-results-container').length) {
					$('.pincode-results-container').fadeOut();
				}
			});

			function fetchPincodeDetails(pincode, cityId, stateId, addressId) {
				const pinStr = pincode.toString().trim();
				if (pinStr.length === 6) {
					// Set temporary placeholder to show something is happening
					const cityField = $(`#${cityId}`);
					const stateField = $(`#${stateId}`);
					if (!cityField.val()) cityField.val('...');
					if (!stateField.val()) stateField.val('...');

					$.getJSON(`https://api.postalpincode.in/pincode/${pinStr}`, function (data) {
						if (data && data[0] && data[0].Status === "Success" && data[0].PostOffice) {
							const details = data[0].PostOffice[0];
							$(`#${cityId}`).val(details.District);
							$(`#${stateId}`).val(details.State);

							// Auto-fill address field
							const addressField = $(`#${addressId}`);
							addressField.val(`${details.Name}, ${details.District}, ${details.State}`);
						} else {
							// Clear the temporary placeholders if API fails
							if (cityField.val() === '...') cityField.val('');
							if (stateField.val() === '...') stateField.val('');
						}
					}).fail(function () {
						if (cityField.val() === '...') cityField.val('');
						if (stateField.val() === '...') stateField.val('');
					});
				}
			}

			$('#packageWeight, .dim-input').on('input', function () {
				calculateWeight();
				fetchPrice();
			});

			$('.phone-input').on('input', function () {
				var val = $(this).val().replace(/\D/g, '');
				var errorId = $(this).attr('id') + 'Error';

				if (val.length > 0 && !['6', '7', '8', '9'].includes(val.charAt(0))) {
					$(this).val('');
					$(`#${errorId}`).fadeIn();
				} else {
					$(this).val(val);
					$(`#${errorId}`).fadeOut();
				}
			});
		});
	</script>

</body>

</html>