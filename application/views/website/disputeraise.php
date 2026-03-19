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
		<section class="py-7 position-relative">
			<div class="bg-holder bg-size"
				style="background-image:url(<?= base_url('assets/web_assets/img/gallery/hero-header-bg.png') ?>);background-position:top center;background-size:cover;">
			</div>
			<!--/.bg-holder-->

			<div class="container mt-5">
				<div class="text-start mb-5 animate-fade-in">
					<h2 class="fw-bold text-primary mb-2">Raise Dispute</h2>
					<p class="text-muted">Report an issue with your shipment.</p>
				</div>

				<div class="row justify-content-center">
					<div class="col-lg-8">
						<div class="card border-0 shadow-sm rounded-4 overflow-hidden animate-fade-in">
							<div class="card-header bg-white border-bottom py-3">
								<h4 class="fw-bold mb-0 text-primary"><i
										class="bi bi-exclamation-triangle me-2"></i>Dispute
									Details</h4>
							</div>
							<div class="card-body p-4">
								<form id="disputeForm">
									<div class="mb-3">
										<label class="form-label fw-bold">Booking ID</label>
										<input type="text" class="form-control form-control-lg rounded-3"
											name="booking_id" value="<?= isset($booking_id) ? $booking_id : '' ?>"
											<?= !empty($booking_id) ? 'readonly' : '' ?>
											placeholder="Enter 5-digit Booking ID (e.g. 00042)">
									</div>

									<div class="mb-3">
										<label class="form-label fw-bold">Dispute Type</label>
										<select class="form-select form-select-lg rounded-3" name="dispute_type"
											required>
											<option value="">Select Dispute Type</option>
											<option value="Damage">Package Damaged</option>
											<option value="Delay">Delivery Delayed</option>
											<option value="Wrong Item">Wrong Item Delivered</option>
											<option value="Other">Other Issue</option>
										</select>
									</div>

									<div class="mb-3">
										<label class="form-label fw-bold">Description</label>
										<textarea class="form-control form-control-lg rounded-3" name="description"
											rows="5" placeholder="Please describe the issue in detail..."
											required></textarea>
									</div>

									<div class="mb-3">
										<label class="form-label fw-bold">Attach Evidence (Optional)</label>
										<input type="file" class="form-control form-control-lg rounded-3"
											name="evidence[]" multiple accept="image/*,video/*">
										<small class="text-muted">Upload photos or videos of the issue</small>
									</div>

									<div class="d-grid">
										<button type="submit" class="btn btn-premium btn-lg rounded-3">
											<i class="bi bi-send me-2"></i>Submit Dispute
										</button>
									</div>
								</form>
							</div>
						</div>
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
	<!--    JavaScripts-->
	<!-- ===============================================-->
	<?php
	include('inc/footer-link.php')
		?>
	<script>
		$('#disputeForm').on('submit', function (e) {
			e.preventDefault();

			const formData = new FormData(this);

			$.ajax({
				url: '<?= base_url('Home/submit_dispute') ?>',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function (res) {
					if (res.status) {
						swal("Success", res.msg, "success").then(() => {
							window.location.href = '<?= base_url('Home/dispute_history') ?>';
						});
					} else {
						swal("Error", res.msg, "error");
					}
				},
				error: function () {
					swal("Error", "Something went wrong. Please try again.", "error");
				}
			});
		});
	</script>
</body>

</html>