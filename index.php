<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css?v=1">
    <style>
        .nav-link {
            position: relative;
            text-decoration: none;
            color: black;
            font-size: 16px;
            margin: 0 15px;
            transition: color 0.3s ease-in-out;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 1px;
            background-color: black;
            transform: scaleX(0);
            transition: transform 0.3s ease-in-out;
        }

        .nav-link:hover {
            color: rgb(53, 53, 53);
        }

        .nav-link:hover::after {
            transform: scaleX(1);
        }
    </style>

</head>

<body>
    <header class="py-2 px-5 border-bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- Brand Logo (Optional) -->
                <a class="navbar-brand" href="#">
                    <img src="./assets/images/jumpa-logo.png" alt="Jumpa Logo" width="32">
                </a>

                <!-- Hamburger Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Links -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="php/login.php" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="php/signup.php" class="nav-link">Sign Up</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Main Banner -->
        <div class="main-banner">
            <p class="main-banner-header-p">The best gig platform for all, a quick way to hire helpers and perform tasks
            </p>
            <img src="./assets/images/jumpa-logo-with-word.png" alt="jumpa-xxl-logo" class="jumpa-xxl-logo" />
            <p class="simple-quick-secure">Simple . Quick . Secure.</p>
        </div>

        <!-- Hire Section -->
        <section class="hire-skilled-worker">
            <div class="hire-skilled-worker-text">
                <h2 class="hire-h2">Hire a skilled worker</h2>
                <p>Whatever task you need!</p>
                <p>Our gig platform is designed to help connecting people together to get a task done. We make hiring
                    the right person for your needs quick, easy, and safe.</p>
                <button class="hire-button">Learn more</button>
            </div>

            <div class="hire-skilled-worker-images">
                <img src="assets/images/undraw_hire_re_gn5j.svg" alt="image-1">
                <!-- <img src="assets/images/icons8-clock-50.png" alt="image-2"> -->
            </div>
        </section>

        <!-- 'Do Work, Get Paid' Section-->
        <section class="do-work-get-paid">
            <div class="do-work-get-paid-images">
                <img src="assets/images/undraw_at_work_re_qotl.svg" alt="image-1">
                <!-- <img src="" alt="image-2"> -->
            </div>

            <div class="do-work-get-paid-text">
                <h2 class="work-get-paid-h2">Do work, get paid</h2>
                <p>Earn up to Rm500 per day</p>
                <p>Choose between a variety of gigs available and earn cash per job</p>
                <button class="work-pay-button">Learn more</button>
            </div>
        </section>

        <!-- Safety Section -->
        <section class="security">
            <div class="security-text">
                <h2 class="safety-h2">Stay safe</h2>
                <p>Secure Payment Processing</p>
                <p>Earn as you want, confidently, with secure transactions every time.</p>
            </div>

            <div class="security-images">
                <img src="assets/images/undraw_two_factor_authentication_namy.svg" alt="image-1">
            </div>
        </section>

        <!-- Verification Section -->
        <section class="verification">
            <div class="verification-images">
                <img src="assets/images/undraw_security_on_re_e491.svg" alt="image-1">
            </div>

            <div class="verification-text">
                <h2 class="verify-h2">Verification</h2>
                <p>Get verified gig workers</p>
                <p>Trust that highly rated workers have been evaluated for their skills and are highly recommended to
                    employers.</p>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="text-light py-4">
        <div class="container">
            <div class="row">
                <!-- Logo and Company Info -->
                <div class="col-md-4 text-center text-md-start">
                    <img src="./assets/images/jumpa-logo-with-word.png" alt="Jumpa Logo" class="img-fluid mb-2"
                        width="150">
                    <p class="small">JUMPA &reg; is a registered Trademark of Jumpa NAE Sdn Bhd - 201901000005
                        (1312525-A)</p>
                    <p class="small">Copyright &#169; 2025 Jumpa NAE Sdn Bhd (ACN 142 189 759). All rights reserved.</p>
                </div>

                <!-- Quick Links for Navigation (SEO Optimization) -->
                <div class="col-md-4 mt-5 text-center">
                    <h5 class="text-light">Quick Links</h5>
                    <ul class="list-unstyled mt-4">
                        <li><a href="about-us.html" class="text-light text-decoration-none mb-2">About Us</a></li>
                        <li><a href="services.html" class="text-light text-decoration-none mb-2">Our Services</a></li>
                        <li><a href="contact.html" class="text-light text-decoration-none mb-2">Contact Us</a></li>
                        <li><a href="privacy-policy.html" class="text-light text-decoration-none mb-2">Privacy
                                Policy</a>
                        </li>
                        <li><a href="terms-of-service.html" class="text-light text-decoration-none">Terms of Service</a>
                        </li>
                    </ul>
                </div>

                <!-- Social Media Links -->
                <div class="col-md-4 text-center text-md-end my-5">
                    <h5 class="text-light">Follow Us</h5>
                    <div class="d-flex justify-content-center justify-content-md-end">
                        <a href="https://www.linkedin.com/company/jumpa" target="_blank" class="me-3">
                            <img src="./assets/images/icons8-linkedin-48.png" alt="LinkedIn" width="30">
                        </a>
                        <a href="https://www.facebook.com/jumpa" target="_blank">
                            <img src="./assets/images/5296499_fb_facebook_facebook logo_icon.svg" alt="Facebook"
                                width="30">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>