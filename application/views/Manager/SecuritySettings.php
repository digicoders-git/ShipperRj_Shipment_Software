<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php include("inc/header-link.php") ?>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
    <script>
        NProgress.configure({ showSpinner: false });
        NProgress.start();
    </script>
    <div id="toaster"></div>

    <div class="wrapper">
        <?php include("inc/sidebar.php") ?>

        <div class="page-wrapper">
            <?php include("inc/header.php") ?>

            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h2>Security Settings</h2>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('Manager/UpdatePassword') ?>" method="POST">
                                        <div class="form-group mb-4">
                                            <label class="form-label fw-bold">Login Email</label>
                                            <input type="email" class="form-control" value="<?= $manager->email ?>"
                                                readonly disabled>
                                            <small class="text-muted">Email cannot be changed by managers. Please
                                                contact admin for changes.</small>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label fw-bold">Current Password</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    value="<?= $manager->password ?>" readonly disabled
                                                    id="currentPass">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" onclick="togglePass('currentPass')">
                                                        <i class="mdi mdi-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label fw-bold" for="new_password">New Password</label>
                                            <input type="password" name="password" id="new_password"
                                                class="form-control" placeholder="Enter new password" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label fw-bold" for="confirm_password">Confirm
                                                Password</label>
                                            <input type="password" id="confirm_password" class="form-control"
                                                placeholder="Confirm new password" required>
                                            <div id="pass-msg"></div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary" id="submit-btn"
                                                disabled>Update Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include("inc/footer.php") ?>
        </div>
    </div>

    <?php include("inc/footer-link.php") ?>
    <script>
        function togglePass(id) {
            var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        $(document).ready(function () {
            $('#new_password, #confirm_password').on('keyup', function () {
                if ($('#new_password').val() == $('#confirm_password').val()) {
                    $('#pass-msg').html('<span class="text-success">Passwords match</span>');
                    $('#submit-btn').prop('disabled', false);
                } else {
                    $('#pass-msg').html('<span class="text-danger">Passwords do not match</span>');
                    $('#submit-btn').prop('disabled', true);
                }
            });
        });
    </script>
</body>

</html>