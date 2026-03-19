<script src="<?= base_url('assets/admin_assets/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/simplebar/simplebar.min.js')?>"></script>
<script src="../hotkeys-js%403.13.7/dist/hotkeys.min.js"></script>
<script src="<?= base_url('assets/admin_assets/plugins/apexcharts/apexcharts.js')?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js')?>"></script>

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script src="<?= base_url('assets/admin_assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/jvectormap/jquery-jvectormap-world-mill.js')?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/jvectormap/jquery-jvectormap-us-aea.js')?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/daterangepicker/moment.min.js')?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
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
<script src="../1.3.6/quill.js"></script>
<script src="<?= base_url('assets/admin_assets/plugins/toaster/toastr.min.js')?>"></script>
<script defer async src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="<?= base_url('assets/admin_assets/js/mono.js')?>"></script>
<script src="<?= base_url('assets/admin_assets/js/chart.js')?>"></script>
<script src="<?= base_url('assets/admin_assets/js/map.js')?>"></script>
<script src="<?= base_url('assets/admin_assets/js/custom.js')?>"></script>

<!----------------notify JS link --------------------->
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

<script>
	var currentUrl = window.location.href;
	var sidebarLinks = document.querySelectorAll('.nav.sidebar-inner li a');
	sidebarLinks.forEach(function (link) {
		if (link.href === currentUrl) {
			link.parentElement.classList.add('active');
		}
	});
</script>

<?php
	if ($this->session->flashdata('res') == 'success')
	{
		echo '<script>$.notify("' . $this->session->flashdata('msg') . '","success")</script>';
	}
	else if ($this->session->flashdata('res') == 'error')
	{
		echo '<script>$.notify("' . $this->session->flashdata('msg') . '","error")</script>';
	}
?>