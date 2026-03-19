<script src="<?= base_url('assets/user_assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/user_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/user_assets/plugins/simplebar/simplebar.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/hotkeys-js@3.13.7/dist/hotkeys.min.js"></script>
<script src="<?= base_url('assets/user_assets/plugins/apexcharts/apexcharts.js') ?>"></script>
<script
	src="<?= base_url('assets/user_assets/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') ?>"></script>

<!-- DATATABLE -->
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<!-- JS -->
<script src="<?= base_url('assets/user_assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') ?>"></script>
<script src="<?= base_url('assets/user_assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') ?>"></script>
<script src="<?= base_url('assets/user_assets/plugins/jvectormap/jquery-jvectormap-us-aea.js') ?>"></script>
<script src="<?= base_url('assets/user_assets/plugins/daterangepicker/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/user_assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>

<!-- NOTIFY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

<!-- SWEETALERT 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script>
	jQuery(document).ready(function () {
		jQuery('input[name="dateRange"]').daterangepicker({
			autoUpdateInput: false,
			singleDatePicker: true,
			locale: {
				cancelLabel: 'Clear'
			}
		});
		jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
			jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
		});
		jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
			jQuery(this).val('');
		});
	});
</script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script defer async src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="<?= base_url('assets/user_assets/js/mono.js?v=1.1') ?>"></script>
<script src="<?= base_url('assets/user_assets/js/chart.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url('assets/user_assets/js/map.js') ?>"></script>
<script src="<?= base_url('assets/user_assets/js/custom.js?v=1.1') ?>"></script>

<script>
	var currentUrl = window.location.href;
	var sidebarLinks = document.querySelectorAll('.nav.sidebar-inner li a');
	sidebarLinks.forEach(function (link) {
		if (link.href === currentUrl) {
			link.parentElement.classList.add('active');
		}
	});



	function order_status(id, value) {
		// alert('Are You Sur Want To Change Status !');

		var status = true;
		swal({
			title: "Are you sure?",
			text: "You want to " + value + " this Order !",
			icon: "warning",
			buttons: true,
			dangerMode: true
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "<?php echo base_url("User/ChangeOrderStatus"); ?>",
					type: "post",
					data: {
						'id': id,
						'value': value
					},
					success: function (response) {
						swal("Order Status Changed successfully !", {
							icon: "success",
						});
						location.reload();
					}
				});
			}
		});
		return status;
	}
	function LogoutConfirm(url) {
		swal({
			title: "Are you sure?",
			text: "You want to logout?",
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