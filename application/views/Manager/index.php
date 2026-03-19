<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <?php
    include("inc/header-link.php")
        ?>
    <style>
        .stat-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .icon-bg {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 24px;
        }
    </style>
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
                <div class="content">
                    <div class="row">
                        <!-- Row 1: Core Stats -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-default stat-card">
                                <div class="card-body">
                                    <div class="media align-items-center">
                                        <div class="icon-bg bg-primary-light text-primary mr-3">
                                            <i class="mdi mdi-package-variant"></i>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="text-dark mb-1"><?= $total_bookings ?></h2>
                                            <p>Total Bookings</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-default stat-card">
                                <div class="card-body">
                                    <div class="media align-items-center">
                                        <div class="icon-bg bg-info-light text-info mr-3">
                                            <i class="mdi mdi-truck-delivery"></i>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="text-dark mb-1"><?= $total_delivery_boys ?></h2>
                                            <p>Delivery Boys</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-default stat-card">
                                <div class="card-body">
                                    <div class="media align-items-center">
                                        <div class="icon-bg bg-warning-light text-warning mr-3">
                                            <i class="mdi mdi-clock-outline"></i>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="text-dark mb-1"><?= $pending_bookings ?></h2>
                                            <p>Pending</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-default stat-card">
                                <div class="card-body">
                                    <div class="media align-items-center">
                                        <div class="icon-bg bg-success-light text-success mr-3">
                                            <i class="mdi mdi-check-decagram"></i>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="text-dark mb-1"><?= $delivered_bookings ?></h2>
                                            <p>Delivered</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Row 2: Status Breakdown -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-default stat-card">
                                <div class="card-body">
                                    <div class="media align-items-center">
                                        <div class="icon-bg bg-secondary-light text-secondary mr-3">
                                            <i class="mdi mdi-map-marker-plus"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="text-dark mb-1"><?= $placed_bookings ?></h4>
                                            <p>New Placed</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-default stat-card">
                                <div class="card-body">
                                    <div class="media align-items-center">
                                        <div class="icon-bg bg-primary-light text-primary mr-3">
                                            <i class="mdi mdi-account-check"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="text-dark mb-1"><?= $assigned_bookings ?></h4>
                                            <p>Confirmed/Assigned</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-default stat-card">
                                <div class="card-body">
                                    <div class="media align-items-center">
                                        <div class="icon-bg bg-warning-light text-warning mr-3">
                                            <i class="mdi mdi-truck-fast"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="text-dark mb-1"><?= $in_transit_bookings ?></h4>
                                            <p>In-Transit</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-default stat-card">
                                <div class="card-body">
                                    <div class="media align-items-center">
                                        <div class="icon-bg bg-info-light text-info mr-3">
                                            <i class="mdi mdi-send-check"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="text-dark mb-1"><?= $dispatched_bookings ?></h4>
                                            <p>Dispatched</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-xl-8 col-md-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h2>Booking Trends (Sample)</h2>
                                </div>
                                <div class="card-body">
                                    <canvas id="bookingTrendChart" style="height: 300px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h2>Status Distribution</h2>
                                </div>
                                <div class="card-body">
                                    <canvas id="statusPieChart" style="height: 300px;"></canvas>
                                </div>
                            </div>
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

    <?php
    include("inc/footer-link.php")
        ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function () {
            // Trend Chart
            const trendCtx = document.getElementById('bookingTrendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: <?= json_encode($trend_labels) ?>,
                    datasets: [{
                        label: 'Bookings',
                        data: <?= json_encode($trend_data) ?>,
                        borderColor: '#F57C20',
                        tension: 0.4,
                        fill: true,
                        backgroundColor: 'rgba(245, 124, 32, 0.1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Pie Chart
            const pieCtx = document.getElementById('statusPieChart').getContext('2d');
            new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Placed', 'Confirmed', 'Dispatched', 'In-Transit', 'Out for Delivery', 'Delivered'],
                    datasets: [{
                        data: [
                            <?= $placed_bookings ?>, 
                            <?= $assigned_bookings ?>, 
                            <?= $dispatched_bookings ?>, 
                            <?= $in_transit_bookings ?>, 
                            <?= $out_for_delivery_bookings ?>,
                            <?= $delivered_bookings ?>
                        ],
                        backgroundColor: ['#6c757d', '#4c84ff', '#17a2b8', '#ffc107', '#f53e10ff','#29cc97']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>

</body>

</html>