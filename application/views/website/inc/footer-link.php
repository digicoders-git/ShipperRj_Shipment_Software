<script src="<?= base_url('assets/web_assets/vendors/%40popperjs/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/web_assets/vendors/bootstrap/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/web_assets/vendors/is/is.min.js') ?>"></script>
<script src="<?= base_url('assets/web_assets/vendors/swiper/swiper-bundle.min.js') ?>"> </script>
<script src="../../v3/polyfill.min.js?features=window.scroll"></script>
<script src="<?= base_url('assets/web_assets/vendors/fontawesome/all.min.js') ?>"></script>
<script src="<?= base_url('assets/web_assets/js/theme.js') ?>"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- NOTIFY JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

<!-- SWEETALERT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
	function LogoutConfirm(url) {
		swal({
			title: "Are you sure?",
			text: "You want to logout from your account?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
			.then((willLogout) => {
				if (willLogout) {
					window.location.href = url;
				}
			});
	}
</script>


<?php
if ($this->session->flashdata('res') == 'success') {
	echo '<script>$.notify("' . $this->session->flashdata('msg') . '","success")</script>';
} else if ($this->session->flashdata('res') == 'error') {
	echo '<script>$.notify("' . $this->session->flashdata('msg') . '","error")</script>';
}
?>