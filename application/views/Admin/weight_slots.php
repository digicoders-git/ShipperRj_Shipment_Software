<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('inc/header-link.php'); ?>
    <title>Manage Weight Slots - ShipperRJ Admin</title>
</head>

<body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
    <div class="mobile-sticky-body-overlay"></div>
    <div class="wrapper">
        <?php include('inc/sidebar.php'); ?>
        <div class="page-wrapper">
            <?php include('inc/header.php'); ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="breadcrumb-wrapper">
                        <h1>Manage Weight Slots</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('Admin/index') ?>">
                                        <span class="mdi mdi-home"></span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">Pincode Pricing</li>
                                <li class="breadcrumb-item">Weight Slots</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-default">
                                <div
                                    class="card-header card-header-border-bottom d-flex justify-content-between text-right">
                                    <h2>All Weight Slots</h2>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#addSlotModal">
                                        <span class="mdi mdi-plus"></span> Add New Slot
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="slotTable" class="table table-hover table-product"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Slot Name</th>
                                                    <th>Min Weight (kg)</th>
                                                    <th>Max Weight (kg)</th>
                                                    <th>Created On</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($slots)): ?>
                                                    <?php $sr = 1;
                                                    foreach ($slots as $row): ?>
                                                        <tr>
                                                            <td>
                                                                <?= $sr++ ?>
                                                            </td>
                                                            <td><strong>
                                                                    <?= $row->slot_name ?>
                                                                </strong></td>
                                                            <td>
                                                                <?= $row->min_weight ?> kg
                                                            </td>
                                                            <td>
                                                                <?= $row->max_weight ?> kg
                                                            </td>
                                                            <td>
                                                                <?= date('d-m-Y', strtotime($row->created_at)) ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex" style="gap:10px">
                                                                    <button class="btn btn-info btn-sm btn-pill mdi mdi-pencil"
                                                                        onclick='editSlot(<?= json_encode($row) ?>)'
                                                                        title="Edit"></button>
                                                                    <button
                                                                        class="btn btn-danger btn-sm btn-pill mdi mdi-delete"
                                                                        onclick="return Delete('weight_slots', '<?= $row->id ?>')"
                                                                        title="Delete"></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Slot Modal -->
            <div class="modal fade" id="addSlotModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Weight Slot</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/ManageWeightSlots/Add') ?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Slot Name (e.g., 0-500g, 1kg-5kg)</label>
                                    <input type="text" name="slot_name" class="form-control"
                                        placeholder="Enter slot name" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Min Weight (kg)</label>
                                            <input type="number" step="0.001" name="min_weight" class="form-control"
                                                placeholder="0.000" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Max Weight (kg)</label>
                                            <input type="number" step="0.001" name="max_weight" class="form-control"
                                                placeholder="0.000" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-pill"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-pill">Add Slot</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Slot Modal -->
            <div class="modal fade" id="editSlotModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Weight Slot</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/ManageWeightSlots/Update') ?>" method="POST">
                            <input type="hidden" name="id" id="edit_id">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Slot Name</label>
                                    <input type="text" name="slot_name" id="edit_slot_name" class="form-control"
                                        required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Min Weight (kg)</label>
                                            <input type="number" step="0.001" name="min_weight" id="edit_min_weight"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Max Weight (kg)</label>
                                            <input type="number" step="0.001" name="max_weight" id="edit_max_weight"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-pill"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-pill">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php include('inc/footer.php'); ?>
        </div>
    </div>
    <?php include('inc/footer-link.php'); ?>

    <script>
        $(document).ready(function () {
            $('#slotTable').DataTable();
        });

        function editSlot(data) {
            $('#edit_id').val(data.id);
            $('#edit_slot_name').val(data.slot_name);
            $('#edit_min_weight').val(data.min_weight);
            $('#edit_max_weight').val(data.max_weight);
            $('#editSlotModal').modal('show');
        }
    </script>
</body>

</html>