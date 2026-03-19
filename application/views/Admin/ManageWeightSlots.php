<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <?php
    include("inc/header-link.php")
        ?>
    <title>Manage Weight Slots - ShipperRJ</title>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
    <script>
        NProgress.configure({ showSpinner: false });
        NProgress.start();
    </script>
    <div id="toaster"></div>

    <div class="wrapper">
        <?php
        include("inc/sidebar.php")
            ?>

        <div class="page-wrapper">

            <!-- Header -->
            <?php
            include("inc/header.php")
                ?>

            <div class="content-wrapper">
                <div class="content">

                    <div class="card card-default">
                        <div class="card-header">
                            <h2>Manage Weight Range Slots</h2>

                            <a class="btn mdi mdi-plus mdi-24px" data-toggle="modal" data-target="#add-slot">Add new
                            </a>

                        </div>
                        <div class="card-body">
                            <table id="weightTable" class="table table-hover table-product table-responsive-lg"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Slot Name</th>
                                        <th>Min Weight (kg)</th>
                                        <th>Max Weight (kg)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sr = 1;
                                    if (!empty($list)) {
                                        foreach ($list as $item) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $sr ?>
                                                </td>
                                                <td><span class="badge badge-info">
                                                        <?= $item->slot_name ?>
                                                    </span></td>
                                                <td>
                                                    <?= $item->min_weight ?> kg
                                                </td>
                                                <td>
                                                    <?= $item->max_weight ?> kg
                                                </td>
                                                <td class="d-flex" style="gap:10px">
                                                    <button class="btn btn-sm btn-info btn-pill mdi mdi-pencil"
                                                        onclick="EditWeightSlot('<?= $item->id; ?>')" title="Edit"></button>

                                                    <button class="btn btn-sm btn-danger btn-pill mdi mdi-delete"
                                                        onclick="return Delete('weight_slots','<?= $item->id; ?>')"
                                                        title="Delete"></button>
                                                </td>
                                            </tr>
                                            <?php
                                            $sr++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <?php
            include("inc/footer.php")
                ?>

        </div>
    </div>

    <!-- Add Slot Modal -->
    <div class="modal fade" id="add-slot" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <form action="<?= base_url('Admin/ManageWeightSlots/Add') ?>" method="POST">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add New Weight Slot</h5>
                    </div>
                    <div class="modal-body px-4">
                        <div class="form-group mb-3">
                            <label>Slot Name</label>
                            <input type="text" name="slot_name" class="form-control" placeholder="e.g. Small (0-2kg)"
                                required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label>Min Weight (kg)</label>
                                <input type="number" step="0.01" name="min_weight" placeholder="eg 0.500" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label>Max Weight (kg)</label>
                                <input type="number" step="0.01" name="max_weight" placeholder="eg 2" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-light btn-pill px-4" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-pill px-4">Create Slot</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include("inc/footer-link.php")
        ?>
    <script>
        $(document).ready(function () {
            $('#weightTable').DataTable({
                lengthMenu: [10, 25, 50, 75, 100],
                order: [[0, 'asc']]
            });
        });
    </script>


</body>

</html>