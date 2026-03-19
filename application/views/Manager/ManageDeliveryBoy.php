<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <?php
    include("inc/header-link.php")
        ?>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
    <script>
        NProgress.configure({ showSpinner: false });
        NProgress.start();
    </script>
    <div id="toaster"></div>


    <!-- ====================================
            ——— WRAPPER
        ===================================== -->
    <div class="wrapper">

        <!-- ====================================
                ——— LEFT SIDEBAR WITH OUT FOOTER
            ===================================== -->
        <?php
        include("inc/sidebar.php")
            ?>

        <!-- ====================================
                ——— PAGE WRAPPER
            ===================================== -->
        <div class="page-wrapper">

            <!-- Header -->
            <?php
            include("inc/header.php")
                ?>

            <!-- ====================================
                    ——— CONTENT WRAPPER
                ===================================== -->

            <div class="content-wrapper">
                <div class="content"><!-- For Components documentaion -->


                    <!-- Category Inventory -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2>Manage Delivery Boys</h2>

                            <a class="btn mdi mdi-plus mdi-24px" data-toggle="modal" data-target="#add-boy">Add new</a>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="deliveryBoyTable" class="table table-hover table-product table-responsive-lg"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S no</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Address</th>
                                        <th>Aadhar Number</th>
                                        <th>Status</th>
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
                                                <td>
                                                    <?= $item->name ?>
                                                </td>
                                                <td>
                                                    <?= $item->mobile ?>
                                                </td>
                                                <td>
                                                    <?= $item->email ?>
                                                </td>
                                                <td>
                                                    <?= $item->password ?>
                                                </td>
                                                <td>
                                                    <?= $item->address ?>
                                                </td>
                                                <td>
                                                    <?= $item->aadharno ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column align-items-center" style="gap: 2px;">
                                                        <label class="switch switch-primary mb-0">
                                                            <input type="checkbox" class="switch-input"
                                                                onchange="Status(this, 'delivery_boy', 'id', '<?= $item->id ?>', 'status', 'true')"
                                                                <?= ($item->status == 'true') ? 'checked' : '' ?>>
                                                            <span class="switch-label text-white"></span>
                                                            <span class="switch-handle"></span>
                                                        </label>
                                                        <span class="badge badge-<?= ($item->status == 'true') ? 'success' : 'danger' ?>"
                                                                    style=" font-size: 9px; padding: 2px 6px;">
                                                                <?= ($item->status == 'true') ? 'ACTIVE' : 'BLOCKED' ?>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="d-flex" style="gap:7px">
                                                    <button class="btn btn-sm btn-info btn-pill mdi mdi-pencil"
                                                        onclick="EditDeliveryBoy('<?= $item->id; ?>')" title="Edit"></button>
                                                    <button class="btn btn-sm btn-danger btn-pill mdi mdi-delete"
                                                        onclick="return Delete('delivery_boy','<?= $item->id; ?>')"
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
    <!-- Add Delivery Boy Modal -->
    <div class="modal fade" id="add-boy" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <form action="<?= base_url('Manager/ManageDeliveryBoy/Add') ?>" method="POST">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Delivery Boy</h5>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" class="form-control" id="Name" placeholder="Enter Name"
                                        name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" id="email" placeholder="Enter Email"
                                        name="email" required>
                                </div>
                                <div class="form-group pb-2">
                                    <label>Mobile Number</label>
                                    <input class="form-control" type="tel" placeholder="Enter Mobile" name="mobile"
                                        minlength="10" maxlength="10" pattern="[6-9]{1}[0-9]{9}"
                                        title="Please enter 10 digits starting with 6, 7, 8 or 9" required
                                        oninput="validateMobile(this)">
                                    <span class="mobile-msg small"></span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" placeholder="Enter Password"
                                        name="password" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" placeholder="Enter Address" name="address"
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Aadhar Number</label>
                                    <input class="form-control" type="text" placeholder="Enter Aadhar Number"
                                        name="aadhar" minlength="12" maxlength="12" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-pill">Save</button>
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
            $('#deliveryBoyTable').DataTable();
        });
    </script>

</body>

</html>