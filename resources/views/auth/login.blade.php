<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/js/head.js') }}"></script>


</head>

<body>
    <!-- Begin page -->
    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center g-0 px-3 py-3 vh-100">

                <div class="col-md-6 col-lg-4 col-xxl-3 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-0 p-0 p-lg-3">
                                <div class="mb-0 border-0 p-md-4 p-lg-0 texc">
                                    <div class="mb-4 p-0  text-center">
                                        <div class="auth-brand">
                                            <h3 class="logo-text mt-3">TMS</h3>
                                            {{-- <a class='logo logo-light' href='index.html'>
                                                <span class="logo-lg">
                                                    <img src="{{ asset('assets/images/logo-light-3.png') }}"
                                                        alt="" height="24">
                                                </span>
                                            </a>
                                            <a class='logo logo-dark' href='index.html'>
                                                <span class="logo-lg">
                                                    <img src="{{ asset('assets/images/logo-dark-3.png') }}"
                                                        alt="" height="24">
                                                </span>
                                            </a> --}}
                                        </div>
                                    </div>

                                    <div class="auth-title-section mb-4 text-lg-start text-center">
                                        <h3 class="text-dark text-center fw-semibold mb-3">Welcome back! Please Sign
                                            in to
                                            continue.</h3>
                                    </div>

                                    <form id="login_form">
                                        @csrf
                                        <div class="pt-0">
                                            <form action="https://zoyothemes.com/hando/html/index.html" class="my-4">
                                                <div class="form-group mb-3">
                                                    <label for="emailaddress" class="form-label">Email
                                                        address</label>
                                                    <input class="form-control" type="email" id="email"
                                                        name="email" required="" placeholder="Enter your email">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input class="form-control" name="password" type="password"
                                                        required="" id="password" placeholder="Enter your password">
                                                </div>

                                                {{-- <div class="form-group d-flex mb-3">
                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="checkbox-signin" checked>
                                                        <label class="form-check-label" for="checkbox-signin">Remember
                                                            me</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 text-end">
                                                    <a class='text-muted fs-14' href='auth-recoverpw.html'>Forgot
                                                        password?</a>
                                                </div>
                                            </div> --}}

                                                <div class="form-group mb-0 row pt-3">
                                                    <div class="col-12">
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary fw-semibold" type="submit">
                                                                Log
                                                                In </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>



                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('assets/js/app.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#login_form').on('submit', function(e) {
                e.preventDefault();

                var $form = $(this);
                var $btn = $form.find("button[type=submit]");
                $btn.prop("disabled", true);

                // Remove previous errors
                $form.find('.text-danger').remove();

                $.ajax({
                    url: "{{ route('login-post') }}",
                    type: "POST",
                    data: $form.serialize(),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.success) {
                            // Redirect to the URL based on user permissions
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            } else {
                                // Fallback to dashboard if no redirect URL provided
                                window.location.href = "{{ route('dashboard') }}";
                            }
                        } else {
                            showError(response.message || "Login failed.");
                            $btn.prop("disabled", false);
                        }
                    },
                    error: function(xhr) {
                        $btn.prop("disabled", false);
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            var errors = xhr.responseJSON.error;
                            // Display field errors
                            Object.keys(errors).forEach(function(key) {
                                var input = $form.find('[id="' + key + '"]');
                                if (input.length) {
                                    input.after(
                                        '<div class="text-danger" style="font-size: 13px;">' +
                                        errors[key][0] + '</div>');
                                }
                            });
                        }
                        showError(xhr.responseJSON && xhr.responseJSON.message ? xhr
                            .responseJSON.message : "Login failed.");
                    }
                });

                function showError(msg) {
                    // Show error somewhere at the top of the form
                    if ($form.find('.form-error').length === 0) {
                        $form.prepend('<div class="form-error text-danger mb-3" style="font-size: 14px;">' +
                            msg + '</div>');
                    } else {
                        $form.find('.form-error').html(msg);
                    }
                }
            });
        });
    </script>

</body>


</html>
