<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <?php
    include("inc/header-link.php")
        ?>
    <title>Manage Disputes - ShipperRJ</title>
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
                            <h2>Manage All Disputes</h2>
                        </div>
                        <div class="card-body">
                            <table id="disputeTable" class="table table-hover table-product table-responsive-lg" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Details</th>
                                        <th>Booking ID</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Raised On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($disputes)): ?>
                                            <?php foreach ($disputes as $row): ?>
                                                    <tr>
                                                        <td>#<?= $row->id ?></td>
                                                        <td>
                                                            <strong><?= $row->user_name ?></strong><br>
                                                            <small class="text-muted"><?= $row->user_email ?></small>
                                                        </td>
                                                        <td>#<?= $row->booking_id ?></td>
                                                        <td><?= $row->dispute_type ?></td>
                                                        <td>
                                                            <?php if ($row->status == 'Pending'): ?>
                                                                    <span class="badge badge-warning">Pending</span>
                                                            <?php else: ?>
                                                                    <span class="badge badge-success">Resolved</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= date('d-m-Y h:i A', strtotime($row->created_at)) ?></td>
                                                        <td>
                                                            <button class="btn btn-primary btn-sm btn-pill"
                                                                onclick="showDisputeModal(<?= htmlspecialchars(json_encode($row)) ?>)">
                                                                <span class="mdi mdi-eye"></span> View & Action
                                                            </button>
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

            <!-- Footer -->
            <?php
            include("inc/footer.php")
                ?>

        </div>
    </div>

    <!-- Dispute Action Modal -->
    <div class="modal fade" id="disputeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title">Dispute Action - #<span id="modalDisputeId"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Admin/UpdateDisputeStatus') ?>" method="POST">
                    <input type="hidden" name="id" id="formDisputeId">
                    <div class="modal-body px-4">
                        <div class="row mb-4">
                            <div class="col-md-6 text-left">
                                <label class="form-label fw-bold text-muted">User Description</label>
                                <p id="dispDescription" class="p-3 bg-light rounded" style="min-height: 100px;"></p>
                            </div>
                            <div class="col-md-6 text-left">
                                <label class="form-label fw-bold text-muted">Evidence</label>
                                <div id="dispEvidence" class="d-flex flex-wrap gap-2"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 text-left">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="formDisputeStatus" required>
                                        <option value="Pending">Pending</option>
                                        <option value="Resolved">Resolved</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-left">
                            <label>Admin Remark / Resolution Details</label>
                            <textarea name="admin_remark" id="formAdminRemark" class="form-control" rows="4"
                                placeholder="Enter resolution details or remarks for the user..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-light btn-pill px-4" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-pill px-4">Save Changes</button>
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
            $('#disputeTable').DataTable({
                order: [[0, 'desc']],
                lengthMenu: [10, 25, 50, 75, 100]
            });
        });

        function showDisputeModal(data) {
            $('#modalDisputeId').text(data.id);
            $('#formDisputeId').val(data.id);
            $('#dispDescription').text(data.description);
            $('#formDisputeStatus').val(data.status);
            $('#formAdminRemark').val(data.admin_remark);

            let evidenceHtml = '';
            if (data.evidence) {
                const files = JSON.parse(data.evidence);
                if (files.length > 0) {
                    files.forEach(file => {
                        const ext = file.split('.').pop().toLowerCase();
                        if (['mp4', 'webm'].includes(ext)) {
                            evidenceHtml += `<a href="<?= base_url('assets/admin_assets/images/dispute/') ?>${file}" target="_blank" class="btn btn-outline-info mr-2 mb-2">Video</a>`;
                        } else {
                            evidenceHtml += `<a href="<?= base_url('assets/admin_assets/images/dispute/') ?>${file}" target="_blank" class="mr-2 mb-2"><img src="<?= base_url('assets/admin_assets/images/dispute/') ?>${file}" class="img-thumbnail" style="width: 100px;"></a>`;
                        }
                    });
                } else {
                    evidenceHtml = '<p class="text-muted">No evidence attached.</p>';
                }
            } else {
                evidenceHtml = '<p class="text-muted">No evidence attached.</p>';
            }
            $('#dispEvidence').html(evidenceHtml);

            $('#disputeModal').modal('show');
        }
    </script>
</body>

</html>
