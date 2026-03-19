<!-- UPDATE DATA MODAL -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h5 class="modal-title" id="exampleModalCenterTitle">Update Data</h5>
            </div>

            <div class="modal-body px-4">

            </div>
        </div>
    </div>
</div>



<script src="<?= base_url('assets/admin_assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/simplebar/simplebar.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/hotkeys-js@3.13.7/dist/hotkeys.min.js"></script>
<script src="<?= base_url('assets/admin_assets/plugins/apexcharts/apexcharts.js') ?>"></script>
<script
    src="<?= base_url('assets/admin_assets/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') ?>"></script>

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
<script src="<?= base_url('assets/admin_assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') ?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') ?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/jvectormap/jquery-jvectormap-us-aea.js') ?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/daterangepicker/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/admin_assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
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


<!-- JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script defer async src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="<?= base_url('assets/admin_assets/js/mono.js?v=1.1') ?>"></script>
<script src="<?= base_url('assets/admin_assets/js/chart.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url('assets/admin_assets/js/map.js') ?>"></script>
<script src="<?= base_url('assets/admin_assets/js/custom.js?v=1.1') ?>"></script>

<!-- NOTIFY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

<!-- SWEETALERT 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>



    function EditUser(id) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url('Admin/ManageUser/Edit/') ?>" + id);
    }

    function EditPrice(from_pin, to_pin) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url('Admin/ManagePricing/Edit/') ?>" + from_pin + "/" + to_pin);
    }

    function EditDistance(id) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url('Admin/ManageDistance/Edit/') ?>" + id);
    }

    function EditDeliveryBoy(id) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url('Admin/ManageDeliveryBoy/Edit/') ?>" + id);
    }

    function AssignDelvieryBoy(id) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url('Admin/ManageBooking/Edit/') ?>" + id);
    }

    function EditWeightSlot(id) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url('Admin/ManageWeightSlots/Edit/') ?>" + id);
    }

    function EditManager(id) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url('Admin/ManageManager/Edit/') ?>" + id);
    }





    var currentUrl = window.location.href;
    var sidebarLinks = document.querySelectorAll('.nav.sidebar-inner li a');
    sidebarLinks.forEach(function (link) {
        if (link.href === currentUrl) {
            link.parentElement.classList.add('active');
        }
    });


    function Delete(table, id) {
        var status = true;
        swal({
            title: "Are you sure?",
            text: "You want to delete this !",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "<?php echo base_url("Admin/Deletedata"); ?>",
                    type: "post",
                    data: {
                        'table': table,
                        'id': id
                    },
                    success: function (response) {
                        swal("Deleted successfully !", {
                            icon: "success",
                        });
                        location.reload();
                    }
                });
            }
        });
        return status;
    }

    function DeleteRoute(from_pin, to_pin) {
        swal({
            title: "Are you sure?",
            text: "You want to delete all prices for this route (" + from_pin + " -> " + to_pin + ")?",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "<?php echo base_url("Admin/DeleteRoutePricing"); ?>",
                    type: "post",
                    data: {
                        'from_pin': from_pin,
                        'to_pin': to_pin
                    },
                    success: function (response) {
                        $.notify("Route pricing deleted successfully !", "success");
                        location.reload();
                    }
                });
            }
        });
    }

    function topuprequest(id, value) {
        var status = true;
        swal({
            title: "Are you sure?",
            text: "You want to " + value + " this !",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "<?php echo base_url("Admin/Accepttopuprequest"); ?>",
                    type: "post",
                    data: {
                        'id': id,
                        'value': value
                    },
                    success: function (response) {
                        swal("Verified Successfully !", {
                            icon: "success",
                        });
                        location.reload();
                    }
                });
            }
        });
        return status;
    }



    function Status(e, table, where_column, where_value, column, value) {
        var status = true;
        var check = $(e).prop("checked");
        if (check) {
            swal({
                title: "Are you sure?",
                text: "You want to activate this !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?php echo base_url("Admin/UpdateStatus"); ?>",
                        type: "post",
                        data: {
                            'table': table,
                            'column': column,
                            'value': check,
                            'where_column': where_column,
                            'where_value': where_value
                        },
                        success: function (response) {
                            swal("Activated successfully !", {
                                icon: "success",
                            });
                            location.reload();
                        }
                    });
                }
            });
        } else {
            swal({
                title: "Are you sure?",
                text: "You want to deactivate this !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?php echo base_url("Admin/UpdateStatus"); ?>",
                        type: "post",
                        data: {
                            'table': table,
                            'column': column,
                            'value': 'false',
                            'where_column': where_column,
                            'where_value': where_value
                        },
                        success: function (response) {
                            swal("Deactivated successfully !", {
                                icon: "success",
                            });
                            location.reload();
                        }
                    });
                }
            });
        }
    }

    function LogoutConfirm(url) {
        swal({
            title: "Are you sure?",
            text: "You want to logout?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willLogout) => {
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