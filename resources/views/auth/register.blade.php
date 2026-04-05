<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Register</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('auth/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('auth/css/feather.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('auth/css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('auth/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('auth/css/app-dark.css') }}" id="darkTheme" disabled>
</head>

<body class="light ">
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <form class="col-lg-6 col-md-8 col-10 mx-auto" action="{{ route('register-user') }}" method="POST">
                @csrf
                <div class="mx-auto text-center my-4">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/">
                        <div class="d-flex flex-column align-items-center mb-4">
                            <h1 style="font-size: 2.5rem; font-weight: 700; background: linear-gradient(45deg, #0dcaf0, #0d6efd); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 0.5rem;">
                                Medicare
                            </h1>
                            <span class="fs-6" style="color: #0dcaf0; margin-top: -0.5rem;">Apotek Online Terpercaya</span>
                        </div>
                    </a>
                    <h2 class="my-3">Register</h2>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="Username">Username</label>
                    <input type="text" id="Username" class="form-control" name="name" placeholder="Username"
                        value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email"
                        value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Phone Number</label>
                    <input type="no_hp" class="form-control" id="no_hp" name="no_hp" placeholder="Phone Number"
                        value="{{ old('no_hp') }}" required>
                </div>
                <div class="form-group">
                    <label for="inputrole">Role</label>
                    <select class="form-control" id="jabatan" name="jabatan" placeholder="Role" required>
                        <option selected>Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="karyawan">Karyawan</option>
                        <option value="apoteker">Apoteker</option>
                        <option value="pemilik">Pemilik</option>
                        <option value="kasir">Kasir</option>
                        <option value="kurir">Kurir</option>
                    </select>
                </div>
                <hr class="my-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPassword5">New Password</label>
                            <input type="password" class="form-control" id="inputPassword5" name="password"
                                placeholder="Password" value="{{ old('password') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPassword5">Password Confirm</label>
                            <input type="password" class="form-control" id="password_confirmed"
                                name="password_confirmation" placeholder="Password Confirm" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2">Password requirements</p>
                        <p class="small text-muted mb-2"> To create a new password, you have to meet all of the
                            following requirements: </p>
                        <ul class="small text-muted pl-4 mb-0">
                            <li> Minimum 8 character </li>
                            <li>At least one special character</li>
                            <li>At least one number</li>
                            <li>Can’t be the same as a previous password </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                <div class="text-center mt-4 fw-light"> Already have an account?
                    <a href="{{ url('login') }}" class="text-primary">Login</a>
                </div>
                <p class="mt-5 mb-3 text-muted text-center">© 2020</p>
            </form>
        </div>
    </div>
    <script src="{{ asset('auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/js/popper.min.js') }}"></script>
    <script src="{{ asset('auth/js/moment.min.js') }}"></script>
    <script src="{{ asset('auth/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auth/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('auth/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('auth/js/jquery.stickOnScroll.js') }}"></script>
    <script src="{{ asset('auth/js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('auth/js/config.js') }}"></script>
    <script src="{{ asset('auth/js/apps.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');
    </script>
</body>

</html>
