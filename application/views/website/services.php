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

        <section class="py-7 mt-5" id="services">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-5 text-center mb-3">
                        <h5 class="text-danger fw-bold">OUR SERVICES</h5>
                        <h2 class="fw-bold">Premium Logistics Solutions</h2>
                        <p class="text-muted">We provide world-class shipping and global logistics services tailored to
                            your needs.</p>
                    </div>
                </div>
                <div class="row h-100 justify-content-center">
                    <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                        <div class="card h-100 px-lg-4 card-premium active"
                            style="border: 2px solid var(--primary-color);">
                            <div class="card-body d-flex flex-column justify-content-around">
                                <div class="text-center pt-5">
                                    <i class="bi bi-briefcase display-3 text-primary"></i>
                                    <h5 class="my-4 fw-bold">Business Shipping</h5>
                                </div>
                                <p class="text-muted text-center">Comprehensive logistics solutions for corporate
                                    clients and bulk shipments.</p>
                                <ul class="list-unstyled text-muted small">
                                    <li class="mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Bulk pricing
                                    </li>
                                    <li class="mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Dedicated
                                        account manager</li>
                                    <li class="mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>24/7 priority
                                        support</li>
                                </ul>
                                <div class="text-center my-4">
                                    <div class="d-grid">
                                        <button class="btn btn-premium">Learn more</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                        <div class="card h-100 px-lg-4 card-premium active"
                            style="border: 2px solid var(--primary-color);">
                            <div class="card-body d-flex flex-column justify-content-around">
                                <div class="text-center pt-5">
                                    <i class="bi bi-truck display-3 text-primary"></i>
                                    <h5 class="my-4 fw-bold">Express Delivery</h5>
                                </div>
                                <p class="text-muted text-center">Fast and reliable door-to-door delivery within the
                                    city and across states.</p>
                                <ul class="list-unstyled text-muted small">
                                    <li class="mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Same day
                                        delivery</li>
                                    <li class="mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Real-time
                                        tracking</li>
                                    <li class="mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Secure
                                        packaging</li>
                                </ul>
                                <div class="text-center my-4">
                                    <div class="d-grid">
                                        <button class="btn btn-premium">Learn more</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                        <div class="card h-100 px-lg-4 card-premium active"
                            style="border: 2px solid var(--primary-color);">
                            <div class="card-body d-flex flex-column justify-content-around">
                                <div class="text-center pt-5">
                                    <i class="bi bi-box-seam display-3 text-primary"></i>
                                    <h5 class="my-4 fw-bold">Personal Courier</h5>
                                </div>
                                <p class="text-muted text-center">Safe and secure delivery for your personal parcels and
                                    important documents.</p>
                                <ul class="list-unstyled text-muted small">
                                    <li class="mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Easy booking
                                    </li>
                                    <li class="mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Reliable
                                        handling</li>
                                    <li class="mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Affordable
                                        rates</li>
                                </ul>
                                <div class="text-center my-4">
                                    <div class="d-grid">
                                        <button class="btn btn-premium">Learn more</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Services Section -->
                <div class="row mt-7 align-items-center">
                    <div class="col-md-6 mb-4 text-center">
                        <img class="img-fluid rounded-4 shadow-lg"
                            src="<?= base_url('assets/web_assets/img/gallery/services-detailed.png') ?>"
                            alt="Global Logistics" style="max-height: 350px; width: auto; object-fit: contain;">
                    </div>
                    <div class="col-md-6 ps-md-5">
                        <h3 class="fw-bold mb-4">Global Network, Local Expertise</h3>
                        <p class="text-muted mb-4">With ShipperRJ, you gain access to a powerful global logistics
                            network combined with the personalized care of local experts. We understand the intricacies
                            of every route we traverse.</p>
                        <div class="d-flex mb-3">
                            <div class="me-3"><i class="bi bi-shield-check fs-2 text-primary"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Fully Insured</h6>
                                <p class="small text-muted">Your shipments are protected with comprehensive insurance
                                    coverage.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="me-3"><i class="bi bi-geo-alt fs-2 text-primary"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Worldwide Reach</h6>
                                <p class="small text-muted">Delivering to over 200 countries with reliable transit
                                    times.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        include('inc/footer.php')
            ?>
    </main>

    <?php
    include('inc/footer-link.php')
        ?>
</body>

</html>