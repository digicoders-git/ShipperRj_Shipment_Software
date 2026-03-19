<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <?php
    include('inc/header-link.php')
        ?>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar">
    <main class="main" id="top">
        <?php
        include('inc/header.php')
            ?>
        <section class="py-7 position-relative">
            <div class="bg-holder bg-size"
                style="background-image:url(<?= base_url('assets/web_assets/img/gallery/hero-header-bg.png') ?>);background-position:top center;background-size:cover;">
            </div>

            <div class="container mt-5">
                <div class="text-start mb-5">
                    <h2 class="fw-bold text-primary mb-2">My Disputes</h2>
                    <p class="text-muted">Track the status of your reported issues.</p>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4">Booking ID</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th class="pe-4 text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($disputes)): ?>
                                                <?php foreach ($disputes as $row): ?>
                                                    <tr>
                                                        <td class="ps-4 fw-bold">#
                                                            <?= $row->booking_id ?>
                                                        </td>
                                                        <td>
                                                            <?= $row->dispute_type ?>
                                                        </td>
                                                        <td>
                                                            <div class="text-truncate" style="max-width: 200px;"
                                                                title="<?= $row->description ?>">
                                                                <?= $row->description ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php if ($row->status == 'Pending'): ?>
                                                                <span
                                                                    class="badge bg-warning text-dark rounded-pill px-3">Pending</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-success rounded-pill px-3">Resolved</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?= date('d M, Y h:i A', strtotime($row->created_at)) ?>
                                                        </td>
                                                        <td class="pe-4 text-end">
                                                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                                                onclick="viewDetails(<?= htmlspecialchars(json_encode($row)) ?>)">
                                                                View Details
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center py-5">
                                                        <i class="bi bi-info-circle fs-1 text-muted d-block mb-3"></i>
                                                        <p class="text-muted">No disputes raised yet.</p>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Details Modal -->
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4">
                    <div class="modal-header border-bottom py-3">
                        <h5 class="modal-title fw-bold text-primary">Dispute Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold d-block mb-1">Issue Description</label>
                            <div id="dispDescription" class="p-3 bg-light rounded-3 text-dark"></div>
                        </div>
                        <div class="mb-3" id="adminRemarkSection" style="display:none;">
                            <label class="small text-success fw-bold d-block mb-1">Admin Remark</label>
                            <div id="dispRemark"
                                class="p-3 bg-success bg-opacity-10 border border-success border-opacity-20 rounded-3 text-dark">
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="small text-muted fw-bold d-block mb-2">Evidence Attached</label>
                            <div id="dispEvidence" class="d-flex flex-wrap gap-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include('inc/footer.php')
            ?>
    </main>

    <?php
    include('inc/footer-link.php')
        ?>

    <script>
        function viewDetails(data) {
            $('#dispDescription').text(data.description);

            if (data.admin_remark) {
                $('#dispRemark').text(data.admin_remark);
                $('#adminRemarkSection').show();
            } else {
                $('#adminRemarkSection').hide();
            }

            let evidenceHtml = '';
            if (data.evidence) {
                const files = JSON.parse(data.evidence);
                if (files.length > 0) {
                    files.forEach(file => {
                        const ext = file.split('.').pop().toLowerCase();
                        if (['mp4', 'webm'].includes(ext)) {
                            evidenceHtml += `<a href="<?= base_url('assets/admin_assets/images/dispute/') ?>${file}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill px-3 py-1"><i class="bi bi-play-circle me-1"></i> Video</a>`;
                        } else {
                            evidenceHtml += `<a href="<?= base_url('assets/admin_assets/images/dispute/') ?>${file}" target="_blank"><img src="<?= base_url('assets/admin_assets/images/dispute/') ?>${file}" class="rounded shadow-sm" style="width: 80px; height: 80px; object-fit: cover;"></a>`;
                        }
                    });
                } else {
                    evidenceHtml = '<span class="text-muted small">No evidence attached.</span>';
                }
            } else {
                evidenceHtml = '<span class="text-muted small">No evidence attached.</span>';
            }
            $('#dispEvidence').html(evidenceHtml);

            $('#detailsModal').modal('show');
        }
    </script>
</body>

</html>