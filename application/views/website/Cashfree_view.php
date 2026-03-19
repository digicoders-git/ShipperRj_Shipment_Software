<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cashfree Checkout</title>
	<script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Notify CDN links -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
</head>

<body>
	<script>
		const cashfree = Cashfree({
			mode: "sandbox", // Change to "production" for live mode
		});

		// Function to initiate payment with session ID as parameter
		function initiatePayment(paymentSessionId) {
			let checkoutOptions = {
				paymentSessionId: paymentSessionId, // Use the session ID passed as parameter
				redirectTarget: "_modal", // Open the checkout in a modal
			};

			cashfree.checkout(checkoutOptions).then((result) => {
				//alert("Full response from Cashfree: " + JSON.stringify(result));
				$('.notifyjs-wrapper').remove();

				// Handle the payment response
				if (result.error) {
					$.notify("You closed the popup or there was a payment error.", "error");
					window.location.href = "<?= isset($redirect_to) ? $redirect_to : base_url('Home/book_now'); ?>";
				} else if (result.paymentDetails) {
					//$.notify(result.paymentDetails.paymentMessage, "success");

					// Send payment details to your server for processing
					$.ajax({
						url: "<?= isset($callback_url) ? $callback_url : base_url('Home/UpdateCashfreePaymentStatus') ?>",
						type: "POST",
						data: {
							payment_status: result.paymentDetails.paymentStatus, // Payment status
							payment_message: result.paymentDetails.paymentMessage, // Payment message
							paymentSessionId: paymentSessionId, // Cashfree Payment session ID
							cforder_id: "<?= $cforder_id ?>",
						},
						success: function (response) {
							$.notify("Payment Done successfully", "success");
							// Redirect to the checkout page after successful update
							window.setTimeout(function () {
								window.location.href = "<?= isset($redirect_to) ? $redirect_to : base_url('Home/book_now'); ?>";
							}, 1000);
						},
						error: function (xhr, status, error) {
							$.notify("Error updating payment status", "error");
						}
					});
				} else if (result.redirect) {
					$.notify("Payment will be redirected", "success");
				}
			});
		}

		// Automatically initiate payment when the page loads
		window.onload = function () {
			const sessionId = "<?= $paymentSessionId ?>"; // Get the session ID from PHP
			if (sessionId) {
				initiatePayment(sessionId); // Call the function with the session ID
			} else {
				$.notify("Payment session ID is missing.", "error");
			}
		};
	</script>
</body>

</html>