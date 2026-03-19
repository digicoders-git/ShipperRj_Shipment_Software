<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php include("inc/header-link.php") ?>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
    <div class="wrapper">
        <?php include("inc/sidebar.php") ?>
        <div class="page-wrapper">
            <?php include("inc/header.php") ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="card card-default">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2>User Wallets Overview</h2>
                        </div>
                        <div class="card-body">
                            <table id="walletTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>User Details</th>
                                        <th>Mobile</th>
                                        <th>Wallet Balance</th>
                                        <th>Status</th>
                                        <th>Last Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sr = 1;
                                    if (!empty($users)):
                                        foreach ($users as $user): ?>
                                            <tr>
                                                <td>
                                                    <?= $sr++ ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                                            style="width: 35px; height: 35px;">
                                                            <?= strtoupper(substr($user->name, 0, 1)) ?>
                                                        </div>
                                                        <div>
                                                            <span class="d-block fw-bold text-dark">
                                                                <?= $user->name ?>
                                                            </span>
                                                            <small class="text-muted">
                                                                <?= $user->email ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?= $user->mobile ?>
                                                </td>
                                                <td>
                                                    <div class="d-inline-block p-2 rounded bg-light border">
                                                        <span class="fw-bold text-success fs-5">₹
                                                            <?= number_format($user->wallet, 2) ?>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-pill text-white <?= ($user->status == 'true') ? 'bg-success' : 'bg-danger' ?>">
                                                        <?= ($user->status == 'true') ? 'Active' : 'Blocked' ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?= $user->date ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("inc/footer.php") ?>
        </div>
    </div>
    <?php include("inc/footer-link.php") ?>
    <script>
        $(document).ready(function () {
            $('#walletTable').DataTable({
                "order": [[3, "desc"]]
            });
        });
    </script>
</body>

</html>