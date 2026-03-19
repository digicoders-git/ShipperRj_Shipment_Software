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

        <section class="py-7 mt-5" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center mb-5">
                        <h5 class="text-danger fw-bold">FIND US</h5>
                        <h2 class="fw-bold">Contact Our Logistics Experts</h2>
                        <p class="text-muted">Have questions? We're here to help you with your shipping needs 24/7.</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="card card-premium h-100 p-4 border-0">
                            <h5 class="fw-bold mb-4">Contact Information</h5>
                            <div class="d-flex mb-4">
                                <div class="icon-box me-3"><i class="bi bi-geo-alt-fill text-primary fs-4"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Our Location</h6>
                                    <p class="small text-muted mb-0">Sector 12, Janakipuram Extension, Lucknow, UP
                                        226021</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="icon-box me-3"><i class="bi bi-telephone-fill text-primary fs-4"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Phone Number</h6>
                                    <p class="small text-muted mb-0">+91 9140967607</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="icon-box me-3"><i class="bi bi-envelope-fill text-primary fs-4"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Email Address</h6>
                                    <p class="small text-muted mb-0">info@shipperrj.com</p>
                                </div>
                            </div>

                            <hr class="my-4 opacity-10">

                            <h6 class="fw-bold mb-3">Our Socials</h6>
                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-light btn-sm rounded-circle"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="#" class="btn btn-light btn-sm rounded-circle"><i
                                        class="bi bi-twitter"></i></a>
                                <a href="#" class="btn btn-light btn-sm rounded-circle"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="#" class="btn btn-light btn-sm rounded-circle"><i
                                        class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card card-premium p-4 border-0">
                            <h5 class="fw-bold mb-4">Get In Touch</h5>
                            <form action="<?= base_url('Home/AddContactInquiry') ?>" method="POST" id="contactForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small fw-bold text-muted">Your Name</label>
                                            <input type="text" name="name" class="form-control form-quriar-control"
                                                placeholder="John Doe" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small fw-bold text-muted">Email Address</label>
                                            <input type="email" name="email" class="form-control form-quriar-control"
                                                placeholder="john@example.com" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small fw-bold text-muted">Mobile Number</label>
                                            <input type="text" name="mobile" id="mobile"
                                                class="form-control form-quriar-control" placeholder="9876543210"
                                                required maxlength="10">
                                            <div id="mobileError" class="text-danger small mt-1" style="display: none;">
                                                Please enter a valid 10-digit number starting with 6, 7, 8, or 9.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label small fw-bold text-muted">Subject</label>
                                            <input type="text" name="subject" class="form-control form-quriar-control"
                                                placeholder="Shipping Inquiry" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label small fw-bold text-muted">Message</label>
                                            <textarea name="message" class="form-control form-quriar-control" rows="4"
                                                placeholder="How can we help you?" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-premium px-5 py-3" id="submitBtn">Send
                                            Message <i class="bi bi-send ms-2"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const mobileInput = document.getElementById('mobile');
                                const mobileError = document.getElementById('mobileError');
                                const contactForm = document.getElementById('contactForm');
                                const submitBtn = document.getElementById('submitBtn');

                                function validateMobile(value) {
                                    // Exactly 10 digits
                                    // Starts with 6, 7, 8, or 9
                                    const regex = /^[6-9]\d{9}$/;
                                    return regex.test(value);
                                }

                                mobileInput.addEventListener('input', function () {
                                    // Allow only numbers
                                    this.value = this.value.replace(/[^0-9]/g, '');

                                    if (this.value.length > 0) {
                                        if (!validateMobile(this.value)) {
                                            mobileError.style.display = 'block';
                                            this.classList.add('is-invalid');
                                        } else {
                                            mobileError.style.display = 'none';
                                            this.classList.remove('is-invalid');
                                        }
                                    } else {
                                        mobileError.style.display = 'none';
                                        this.classList.remove('is-invalid');
                                    }
                                });

                                contactForm.addEventListener('submit', function (e) {
                                    if (!validateMobile(mobileInput.value)) {
                                        e.preventDefault();
                                        mobileError.style.display = 'block';
                                        mobileInput.classList.add('is-invalid');
                                        mobileInput.focus();
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="rounded-4 overflow-hidden shadow-lg" style="height: 400px;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14234.35794717142!2d80.94821!3d26.88514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfd991f32b16b%3A0x93ccba8909978be7!2sLucknow%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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