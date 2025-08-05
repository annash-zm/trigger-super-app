<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <title>Login | Trigger Super App</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column pb-0 pb-lg-5 p-10 w-100">
                    <div class="d-flex flex-row gap-5 mb-5">
                        <img class="" style="max-width: 25%" src="https://dlh.banyuwangikab.go.id/images/bwh.webp"
                            alt="" />

                        <img class="" style="width: 12%;"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/archive/a/a5/20240916131339%21Banyuwangi_Regency_coat_of_arms.svg/120px-Banyuwangi_Regency_coat_of_arms.svg.png"
                            alt="" />
                    </div>
                    <!--begin::Image-->
                    <img class="theme-light-show mx-auto mw-150 w-200px w-lg-300px mb-8 mb-lg-10"
                        src="assets/media/auth/agency.png" alt="" />
                    <!--end::Image-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div
                class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-10 bg-white">
                <!--begin::Wrapper-->
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-0">
                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-0">
                            <!--begin::Form-->
                            <form id="loginForm" class="form w-100">
                                @csrf
                                <!--begin::Heading-->
                                <div class="text-start mb-11">
                                    <!--begin::Title-->
                                    <h1 class="text-success fw-bolder fs-3x mb-3">Hallo !</h1>
                                    <!--end::Title-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold fs-6">Selamat Datang di Aplikasi Trigger Super
                                        App</div>
                                    <!--end::Subtitle=-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input type="text" placeholder="Email" name="email" autocomplete="off"
                                        class="form-control bg-transparent" />
                                    <!--end::Email-->
									<span class="text-danger fs-8 email"></span>
                                </div>
                                <!--end::Input group=-->
                                <div class="fv-row mb-3">
                                    <!--begin::Password-->
                                    <input type="password" placeholder="Password" name="password" autocomplete="off"
                                        class="form-control bg-transparent" />
                                    <!--end::Password-->
									<span class="text-danger fs-8 password"></span>
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <!--begin::Link-->
                                    <a href="#"
                                        class="link-primary">Forgot Password ?</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Submit button-->
                                <div class="d-grid mb-10">
                                    <button type="submit" id="loginButton" class="btn btn-success">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Sign In</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Submit button-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Footer-->
                        <div class="d-flex flex-stack">

                            <!--begin::Links-->
                            <div class="d-flex fw-semibold text-primary fs-base gap-5">
                                <a href="#" target="_blank">Terms</a>
                                <a href="#" target="_blank">Plans</a>
                                <a href="#" target="_blank">Contact Us</a>
                            </div>
                            <!--end::Links-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <script src="{{ asset('js/login.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
