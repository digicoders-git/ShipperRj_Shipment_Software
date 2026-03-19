<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <?php include('inc/header-link.php') ?>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        .shipment-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            background: #fff;
            margin-bottom: 24px;
        }

        .status-badge-lg {
            padding: 8px 20px;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .tracking-timeline {
            position: relative;
            padding-left: 45px;
        }

        .tracking-timeline::before {
            content: '';
            position: absolute;
            left: 19px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }

        .tracking-item {
            position: relative;
            padding-bottom: 30px;
        }

        .tracking-icon {
            position: absolute;
            left: -35px;
            width: 20px;
            height: 20px;
            background: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 50%;
            z-index: 1;
        }

        .tracking-item.completed .tracking-icon {
            background: #10b981;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .tracking-item.latest .tracking-icon {
            background: #3b82f6;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }

        .tracking-content {
            background: #f8fafc;
            padding: 16px;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .tracking-item.latest .tracking-content {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
        }

        .detail-label {
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .detail-value {
            font-weight: 600;
            color: #1e293b;
        }

        .delivery-boy-info {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: #fff;
            padding: 24px;
            border-radius: 20px;
        }

        .btn-back {
            background: #fff;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .glass-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <main class="main">
        <?php include('inc/header.php') ?>

        <section class="py-7 mt-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="<?= base_url('Home/book_histroy') ?>" class="btn-back text-decoration-none">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                    <h3 class="fw-bold m-0">Shipment Details</h3>
                </div>

                <div class="row">
                    <!-- Left Side: Order Info & Tracking -->
                    <div class="col-lg-8">
                        <div class="shipment-card p-4">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h5 class="fw-bold mb-1 text-primary">Shipment #
                                        <?= str_pad($booking->id, 6, '0', STR_PAD_LEFT) ?>
                                    </h5>
                                    <p class="text-muted small mb-0"><i class="bi bi-calendar-event me-1"></i>Placed on
                                        <?= $booking->date ?> at
                                        <?= $booking->time ?>
                                    </p>
                                </div>
                                <?php
                                $status_class = 'bg-primary text-white';
                                if ($booking->order_status == 'Delivered')
                                    $status_class = 'bg-success text-white';
                                if ($booking->order_status == 'Cancelled')
                                    $status_class = 'bg-danger text-white';
                                ?>
                                <span class="status-badge-lg <?= $status_class ?>">
                                    <?= $booking->order_status ?>
                                </span>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-4">
                                        <div class="detail-label">Sender Details</div>
                                        <div class="detail-value">
                                            <?= $booking->sender ?>
                                        </div>
                                        <div class="small text-muted mb-2">
                                            <?= $booking->sender_mobile ?>
                                        </div>
                                        <div class="small"><i class="bi bi-geo-alt me-1 text-danger"></i>
                                            <?= $booking->sender_address ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-4">
                                        <div class="detail-label">Receiver Details</div>
                                        <div class="detail-value">
                                            <?= $booking->receiver ?>
                                        </div>
                                        <div class="small text-muted mb-2">
                                            <?= $booking->receiver_mobile ?>
                                        </div>
                                        <div class="small"><i class="bi bi-geo-alt-fill me-1 text-success"></i>
                                            <?= $booking->receiver_address ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 bg-light rounded-4 mb-4">
                                <div class="row text-center">
                                    <div class="col-4 border-end">
                                        <div class="detail-label">Weight</div>
                                        <div class="detail-value">
                                            <?= $booking->weight ?> KG
                                        </div>
                                    </div>
                                    <div class="col-4 border-end">
                                        <div class="detail-label">Content</div>
                                        <div class="detail-value text-truncate px-2">
                                            <?= $booking->package_contents ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="detail-label">Amount</div>
                                        <div class="detail-value text-success">₹
                                            <?= number_format($booking->amount, 2) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if ($booking->order_status == 'Delivered' && !empty($booking->delivery_proof)): ?>
                                <div class="mt-5 mb-4 animate-fade-in">
                                    <h6 class="fw-bold mb-3"><i class="bi bi-patch-check-fill me-2 text-success"></i>Delivery Proof</h6>
                                    <div class="p-2 border rounded-4 bg-white shadow-sm d-inline-block cursor-pointer" onclick="viewImage('<?= base_url('assets/admin_assets/images/proof/') . $booking->delivery_proof ?>')" style="cursor: pointer;">
                                        <img src="<?= base_url('assets/admin_assets/images/proof/') . $booking->delivery_proof ?>" 
                                             class="img-fluid rounded-3" style="max-height: 300px; border: 1px solid #eee;" alt="Delivery Proof">
                                        <div class="mt-2 text-center">
                                            <small class="text-muted"><i class="bi bi-zoom-in me-1"></i>Click to expand</small>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <h6 class="fw-bold mb-4 mt-5"><i class="bi bi-map me-2"></i>Live Tracking Timeline</h6>
                            <div class="tracking-timeline">
                                <?php if (!empty($tracking)):
                                    // Ensure Chronological Order (Oldest at Top, Newest at Bottom)
                                    $first_log = reset($tracking);
                                    $last_log = end($tracking);
                                    $display_tracking = $tracking;

                                    // If timestamps suggest newest is at top, reverse it for "Chronological"
                                    if (strtotime($first_log->date . ' ' . $first_log->time) > strtotime($last_log->date . ' ' . $last_log->time)) {
                                        $display_tracking = array_reverse($tracking);
                                    }

                                    $last_index = count($display_tracking) - 1;
                                    foreach ($display_tracking as $index => $log):
                                        $item_class = ' completed';
                                        if ($index == $last_index)
                                            $item_class .= ' latest';
                                        ?>
                                        <div class="tracking-item <?= $item_class ?>">
                                            <div class="tracking-icon"></div>
                                            <div class="tracking-content">
                                                <div class="d-flex justify-content-between">
                                                    <div
                                                        class="fw-bold <?= $index == $last_index ? 'text-primary' : 'text-success' ?>">
                                                        <?= $log->order_status ?>
                                                        <i class="bi bi-check-circle-fill ms-1"></i>
                                                    </div>
                                                    <div class="small text-muted">
                                                        <?= $log->date ?> |
                                                        <?= $log->time ?>
                                                    </div>
                                                </div>
                                                <div class="small text-secondary mt-1">
                                                    <?= $log->msg ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-4 text-muted">
                                        <i class="bi bi-info-circle me-1"></i> No tracking history available yet.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Delivery Boy & Summary -->
                    <div class="col-lg-4">
                        <?php if ($delivery_boy): ?>
                            <div class="delivery-boy-info mb-4 shadow-lg">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="glass-icon me-3">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                    <div>
                                        <div class="small text-white-50 text-uppercase fw-bold">Assigned Agent</div>
                                        <h5 class="mb-0 fw-bold text-white">
                                            <?= $delivery_boy->name ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-telephone-fill me-2"></i>Contact Number</span>
                                    <span class="fw-bold">
                                        <?= $delivery_boy->mobile ?>
                                    </span>
                                </div>
                                <a href="tel:<?= $delivery_boy->mobile ?>"
                                    class="btn btn-light w-100 rounded-pill fw-bold py-2 mt-2">
                                    <i class="bi bi-phone me-2"></i>Call Now
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="shipment-card p-4 bg-light border-dashed text-center">
                                <div class="glass-icon bg-secondary text-white mx-auto mb-3">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                                <h6 class="fw-bold">Agent Assignment Pending</h6>
                                <p class="small text-muted mb-0">We are currently assigning the best delivery agent for your
                                    shipment.</p>
                            </div>
                        <?php endif; ?>

                        <div class="shipment-card p-4">
                            <h6 class="fw-bold mb-3">Order Specs</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Route</span>
                                <span class="small fw-bold">
                                    <?= $booking->sender_pincode ?> <i class="bi bi-arrow-right"></i>
                                    <?= $booking->receiver_pincode ?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Dimensions</span>
                                <span class="small fw-bold">
                                    <?= $booking->length ?>x
                                    <?= $booking->width ?>x
                                    <?= $booking->height ?> (cm)
                                </span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">Payment Status</span>
                                <span class="small fw-bold text-success text-uppercase">
                                    <?= $booking->payment_status ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include('inc/footer.php') ?>
    </main>

    <?php include('inc/footer-link.php') ?>
    <!-- Premium Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-hidden="true" style="backdrop-filter: blur(5px);">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0" style="background: transparent;">
                <div class="modal-body p-0 text-center">
                    <div class="position-relative d-inline-block shadow-lg rounded-4 overflow-hidden bg-dark">
                        <!-- Close button pinned to image top-right -->
                        <button type="button" class="btn btn-light rounded-circle position-absolute d-flex align-items-center justify-content-center" 
                                data-bs-dismiss="modal" data-dismiss="modal" 
                                style="top: 15px; right: 15px; width: 35px; height: 35px; z-index: 10; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                            <i class="bi bi-x-lg text-dark"></i>
                        </button>
                        <!-- Label pinned to image top-left -->
                        <div class="position-absolute px-3 py-2 text-white fw-bold d-flex align-items-center" 
                             style="top: 0; left: 0; background: rgba(0,0,0,0.6); border-bottom-right-radius: 15px; z-index: 5; backdrop-filter: blur(4px);">
                            <i class="bi bi-image me-2"></i>Proof Preview
                        </div>
                        <!-- The Image -->
                        <img src="" id="fullPreviewImage" class="img-fluid" style="max-height: 80vh; min-width: 300px; display: block;">
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold shadow-lg" data-bs-dismiss="modal" data-dismiss="modal">
                            CLOSE PREVIEW
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function viewImage(src) {
            $('#fullPreviewImage').attr('src', src);
            $('#imagePreviewModal').modal('show');
        }
    </script>
</body>

</html>