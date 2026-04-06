<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Medicare</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!-- Icon Font Stylesheet -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('fe/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fe/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('fe/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('fe/css/style.css') }}" rel="stylesheet">
    
</head>


<body>
    @php 
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\Storage; 
    @endphp
    <style>
        .nav-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(145deg, #ffffff, #f3f3f3);
            /* box-shadow: 3px 3px 6px #d9d9d9, -3px -3px 6px #ffffff; */
            transition: all 0.3s ease;
        }

        .nav-icon i {
            color: #0dcaf0;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .nav-icon:hover {
            background: linear-gradient(145deg, #0dcaf0, #0bb5d7);
            transform: translateY(-2px);
        }

        .nav-icon:hover i {
            color: white;
        }

        .badge {
            font-size: 0.6rem;
            transform: translate(25%, -25%);
        }

        .profile-img {
            width: 32px;
            height: 32px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #0dcaf0;
        }
        .dropdown-menu-profile {
            min-width: 200px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            background: linear-gradient(135deg, #f8fafc 80%, #e0f7fa 100%);
            border: none;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        .dropdown-menu-profile .profile-header {
            padding: 1rem 1rem 0.5rem 1rem;
            border-bottom: 1px solid #e3e3e3;
            background: transparent;
        }
        .dropdown-menu-profile .profile-img {
            width: 56px;
            height: 56px;
            margin-bottom: 0.5rem;
            border: 3px solid #0dcaf0;
            box-shadow: 0 2px 8px rgba(13,202,240,0.08);
        }
        .dropdown-menu-profile .profile-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: #222;
        }
        .dropdown-menu-profile .profile-email {
            font-size: 0.95rem;
            color: #6c757d;
        }
        .dropdown-menu-profile .dropdown-item {
            border-radius: 8px;
            margin: 0 0.5rem;
            transition: background 0.2s, color 0.2s;
        }
        .dropdown-menu-profile .dropdown-item:hover {
            background: #0dcaf0;
            color: #fff;
        }
        .dropdown-menu-profile .dropdown-divider {
            margin: 0.5rem 0;
        }
        .navbar-nav .dropdown-menu {
            min-width: 180px;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(13,202,240,0.10);
            border: none;
            background: #f8fafc;
            padding: 0.5rem 0;
        }
        .navbar-nav .dropdown-menu .dropdown-item {
            color: #0dcaf0;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background 0.2s, color 0.2s;
        }
        .navbar-nav .dropdown-menu .dropdown-item:hover,
        .navbar-nav .dropdown-menu .dropdown-item:focus {
            background: #0dcaf0;
            color: #fff;
        }
        .navbar-nav .dropdown-toggle::after {
            margin-left: 0.4em;
        }
        .navbar-nav .dropdown-menu {
            margin-top: 0.5rem;
        }
    </style>

    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    @stack('scripts')

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-info" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    @yield('navbar')
    <!-- Navbar End -->
    @yield('contact')

    @yield('profile')

    @yield('keranjang')

    @yield('checkout')

    @yield('nav-product')

    {{-- <div>
        @yield('checkout')

    {{-- <div>
        @yield('keranjang')
    </div> --}}


    <!-- Carousel Start -->
    @yield('carousel')
    <!-- Carousel End -->


    <!-- About Start -->
    <div>
        @yield('about')
    </div>
    <!-- About End -->


    <!-- Feature Start -->
    @yield('feature')
    <!-- Feature End -->

    <div>
        @yield('akun')
    </div>

    <!-- Product Start -->
    @yield('product')
    <!-- Product End -->


    <!-- Firm Visit Start -->
    @yield('visit')
    <!-- Firm Visit End -->


    <!-- Testimonial Start -->
    @yield('testimonial')
    <!-- Testimonial End -->


    <!-- Blog Start -->
    {{-- <div class="container-xxl py-5">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Latest Blog</h1>
                <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid" src="{{ asset ('fe/img/blog-1.jpg')}}" alt="">
                    <div class="bg-light p-4">
                        <a class="d-block h5 lh-base mb-4" href="">How to cultivate organic fruits and vegetables in own firm</a>
                        <div class="text-muted border-top pt-4">
                            <small class="me-3"><i class="fa fa-user text-primary me-2"></i>Admin</small>
                            <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>01 Jan, 2045</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <img class="img-fluid" src="{{ asset ('fe/img/blog-2.jpg')}}" alt="">
                    <div class="bg-light p-4">
                        <a class="d-block h5 lh-base mb-4" href="">How to cultivate organic fruits and vegetables in own firm</a>
                        <div class="text-muted border-top pt-4">
                            <small class="me-3"><i class="fa fa-user text-primary me-2"></i>Admin</small>
                            <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>01 Jan, 2045</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="img-fluid" src="{{ asset ('fe/img/blog-3.jpg')}}" alt="">
                    <div class="bg-light p-4">
                        <a class="d-block h5 lh-base mb-4" href="">How to cultivate organic fruits and vegetables in own firm</a>
                        <div class="text-muted border-top pt-4">
                            <small class="me-3"><i class="fa fa-user text-primary me-2"></i>Admin</small>
                            <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>01 Jan, 2045</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Blog End -->


    <!-- Footer Start -->
    @yield('footer')
    <!-- Footer End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-info btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('fe/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('fe/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('fe/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('fe/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('fe/js/main.js') }}"></script>

    {{-- @stack('scripts') --}}

</body>

</html>
