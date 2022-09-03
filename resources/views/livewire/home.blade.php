<?php

use App\Models\Book;
use App\Models\Order;
?>
<x-layout>
<link href="assets/css/style.css" rel="stylesheet">

<body>

    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:moayadabukhadra54@gmail.com">contact Us</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+962 786317708</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">

                <a href="https://web.facebook.com/riwaya.jo/" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/riwaya.jo/" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://www.linkedin.com/in/moayad-abukhadra-8b5b10232/" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">

        <div class="container d-flex align-items-center justify-content-between">


            <h1 class="logo"><a href="index.html"><img src="{{ asset('images/riwaya.jpg') }}" width="50" class="rounded-full ">Riwaya<span>.</span></a></h1>



            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="/dashboard">Shop Now</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto " href="#portfolio">Products</a></li>
                    @guest
                    <li><a class="nav-link" href="/login-register">Login/Register</a></li>
                    @endguest
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1>Welcome to <span>Riwaya</span></h1>
            <h2>Riwaya book store</h2>
            <div class="d-flex">
                <a href="#about" class="btn-get-started scrollto">Get Started</a>
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">




        <!-- ======= About Section ======= -->
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>About</h2>
                    <h3>Find Out More <span>About Us</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
                </div>

                <div class="row">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                        <img src="assets/img/about.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="pt-4 col-lg-6 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li>
                                <i class="bx bx-store-alt"></i>
                                <div>
                                    <h5>Ullamco laboris nisi ut aliquip consequat</h5>
                                    <p>Magni facilis facilis repellendus cum excepturi quaerat praesentium libre trade</p>
                                </div>
                            </li>
                            <li>
                                <i class="bx bx-images"></i>
                                <div>
                                    <h5>Magnam soluta odio exercitationem reprehenderi</h5>
                                    <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna pasata redi</p>
                                </div>
                            </li>
                        </ul>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->


        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <div class="row">


                    <div class="mt-5 col-lg-3 col-md-6 mt-md-0">
                        <div class="count-box">
                            <i class="bi bi-journal-richtext"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{  Book::all()->count() }}" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Total Books</p>
                        </div>
                    </div>

                    <div class="mt-5 col-lg-3 col-md-6 mt-lg-0">
                        <div class="count-box">
                        <i class="bi bi-truck"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ Order::all()->count() }}" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Orders</p>
                        </div>
                    </div>

                    <div class="mt-5 col-lg-3 col-md-6 mt-lg-0">
                        <div class="count-box">
                            <i class="bi bi-people"></i>
                            <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Hard Workers</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->







        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Products</h2>
                    <h3>Check our <span>Products</span></h3>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">Reading Intervals</li>
                            <li data-filter=".filter-card">Books</li>
                            <li data-filter=".filter-web">Other</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ asset('images/reading-interval2.jpg')}}" class="img-fluid" alt="">

                    </div>



                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ asset('images/reading-interval.jpg')}}" class="img-fluid" alt="">

                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{ asset('images/ابق قويا.jpg')}}" class="img-fluid" alt="">

                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <img src="{{ asset('images/gift.jpg')}}" class="img-fluid" alt="">

                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ asset('images/reading-interval3.jpg')}}" class="img-fluid" alt="">

                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{ asset('images/انا قبل.jpg')}}" class="img-fluid" alt="">

                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{ asset('images/reading-interval')}}" class="img-fluid" alt="">

                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <img src="{{ asset('images/gift')}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>






        <!-- ======= Contact Section ======= -->
        <section id="contact" class="justify-center contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <h3><span>Contact Us</span></h3>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">


                    <div class="">
                        <div class="mb-4 info-box">
                            <i class="bx bx-envelope"></i>
                            <h3>Email Us</h3>
                            <p>riwayajo@gmail.com</p>
                        </div>
                    </div>

                    <div class="">
                        <div class="mb-4 info-box">
                            <i class="bx bx-phone-call"></i>
                            <h3>Call Us</h3>
                            <p>+962 786317708</p>
                        </div>
                    </div>

                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">



                    <div class="justify-center ">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                </div>
                                <div class="col form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>
</x-layout>
