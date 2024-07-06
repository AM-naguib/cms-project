<html lang="en" data-bs-theme="dark" data-layout="fluid" data-sidebar-theme="dark" data-sidebar-position="left"
    data-sidebar-behavior="sticky">
<!-- Mirrored from appstack.bootlab.io/auth-sign-in by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2024 17:49:32 GMT --><!-- Added by HTTrack -->

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"><!-- /Added by HTTrack -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <title>Sign In | AppStack - Bootstrap 5 Admin &amp; Dashboard Template</title>

    <link rel="canonical" href="auth-sign-in-2.html">
    <link rel="shortcut icon" href="{{ asset('dash') }}/img/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <link href="{{ asset('dash') }}/css/app.css" rel="stylesheet">

    <!-- BEGIN SETTINGS -->
    <!-- Remove this after purchasing -->
    <script src="{{ asset('dash') }}/js/settings.js"></script>
    <!-- END SETTINGS -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=G-Q3ZYEKLQ68"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-Q3ZYEKLQ68');
    </script>
</head>

<body>
    <div class="auth-full-page d-flex">
        <div class="auth-form p-3">

            <div class="text-center">
                <h1 class="h2">Welcome back!</h1>
                <p class="lead">
                    Sign in to your account to continue
                </p>
            </div>

            <div class="mb-3">

                <div class="row">
                    <div class="col">
                        <hr>
                    </div>
                    <div class="col-auto text-uppercase d-flex align-items-center">Or</div>
                    <div class="col">
                        <hr>
                    </div>
                </div>
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input class="form-control form-control-lg" type="text" name="username" value="admin"
                            placeholder="Enter your Username" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-lg" type="password" name="password" value="admin"
                            placeholder="Enter your password" >

                    </div>
                    <div>
                        <div class="form-check align-items-center">
                            <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me"
                                name="remember-me" checked="">
                            <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-lg btn-primary">Sign in</button>
                    </div>
                </form>
            </div>


        </div>
    </div>

    <script src="{{ asset('dash') }}/js/app.js"></script>
    <div class="notyf"></div>
    <div class="notyf-announcer" aria-atomic="true" aria-live="polite"
        style="border: 0px; clip: rect(0px, 0px, 0px, 0px); height: 1px; margin: -1px; overflow: hidden; padding: 0px; position: absolute; width: 1px; outline: 0px;">
    </div>





    <div class="settings js-settings">
        <div class="settings-toggle">
            <div class="settings-toggle-option settings-toggle-option-text js-settings-toggle" title="Theme Builder">
                <svg class="lucide align-middle mb-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <line x1="4" x2="4" y1="21" y2="14"></line>
                    <line x1="4" x2="4" y1="10" y2="3"></line>
                    <line x1="12" x2="12" y1="21" y2="12"></line>
                    <line x1="12" x2="12" y1="8" y2="3"></line>
                    <line x1="20" x2="20" y1="21" y2="16"></line>
                    <line x1="20" x2="20" y1="12" y2="3"></line>
                    <line x1="2" x2="6" y1="14" y2="14"></line>
                    <line x1="10" x2="14" y1="8" y2="8"></line>
                    <line x1="18" x2="22" y1="16" y2="16"></line>
                </svg>
                Builder
            </div>
            <a class="settings-toggle-option" title="Documentation" href="docs-introduction.html" target="_blank">
                <svg class="lucide align-middle" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                </svg>

            </a>
        </div>

        <div class="settings-panel">
            <div class="settings-content">
                <div class="settings-title d-flex align-items-center">
                    <button type="button" class="btn-close float-right js-settings-toggle"
                        aria-label="Close"></button>

                    <h4 class="mb-0 ms-2 d-inline-block">Theme Builder</h4>
                </div>

                <div class="settings-body">

                    <div class="alert alert-primary" role="alert">
                        <div class="alert-message">
                            <strong>Hey there!</strong> Set your own customized style below. Choose the ones that best
                            fits your needs.
                        </div>
                    </div>

                    <div class="mb-3">
                        <span class="d-block font-size-lg font-weight-bold">Color scheme</span>
                        <span class="d-block text-muted mb-2">The perfect color mode for your app.</span>

                        <div class="row g-0 text-center mx-n1 mb-2">
                            <div class="col">
                                <label class="mx-1 d-block mb-1">
                                    <input class="settings-scheme-label" type="radio" name="theme"
                                        value="default">
                                    <div class="settings-scheme">
                                        <div class="settings-scheme-theme settings-scheme-theme-default"></div>
                                    </div>
                                </label>
                                Default
                            </div>
                            <div class="col">
                                <label class="mx-1 d-block mb-1">
                                    <input class="settings-scheme-label" type="radio" name="theme"
                                        value="colored">
                                    <div class="settings-scheme">
                                        <div class="settings-scheme-theme settings-scheme-theme-colored"></div>
                                    </div>
                                </label>
                                Colored
                            </div>
                        </div>
                        <div class="row g-0 text-center mx-n1">
                            <div class="col">
                                <label class="mx-1 d-block mb-1">
                                    <input class="settings-scheme-label" type="radio" name="theme"
                                        value="dark">
                                    <div class="settings-scheme">
                                        <div class="settings-scheme-theme settings-scheme-theme-dark"></div>
                                    </div>
                                </label>
                                Dark
                            </div>
                            <div class="col">
                                <label class="mx-1 d-block mb-1">
                                    <input class="settings-scheme-label" type="radio" name="theme"
                                        value="light">
                                    <div class="settings-scheme">
                                        <div class="settings-scheme-theme settings-scheme-theme-light"></div>
                                    </div>
                                </label>
                                Light
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <span class="d-block font-size-lg font-weight-bold">Sidebar position</span>
                        <span class="d-block text-muted mb-2">Toggle the position of the sidebar.</span>

                        <div>
                            <label>
                                <input class="settings-button-label" type="radio" name="sidebarPosition"
                                    value="left">
                                <div class="settings-button">
                                    Left
                                </div>
                            </label>
                            <label>
                                <input class="settings-button-label" type="radio" name="sidebarPosition"
                                    value="right">
                                <div class="settings-button">
                                    Right
                                </div>
                            </label>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <span class="d-block font-size-lg font-weight-bold">Sidebar behavior</span>
                        <span class="d-block text-muted mb-2">Change the behavior of the sidebar.</span>

                        <div>
                            <label>
                                <input class="settings-button-label" type="radio" name="sidebarBehavior"
                                    value="sticky">
                                <div class="settings-button">
                                    Sticky
                                </div>
                            </label>
                            <label>
                                <input class="settings-button-label" type="radio" name="sidebarBehavior"
                                    value="fixed">
                                <div class="settings-button">
                                    Fixed
                                </div>
                            </label>
                            <label>
                                <input class="settings-button-label" type="radio" name="sidebarBehavior"
                                    value="compact">
                                <div class="settings-button">
                                    Compact
                                </div>
                            </label>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <span class="d-block font-size-lg font-weight-bold">Layout</span>
                        <span class="d-block text-muted mb-2">Toggle container layout system.</span>

                        <div>
                            <label>
                                <input class="settings-button-label" type="radio" name="layout" value="fluid">
                                <div class="settings-button">
                                    Fluid
                                </div>
                            </label>
                            <label>
                                <input class="settings-button-label" type="radio" name="layout" value="boxed">
                                <div class="settings-button">
                                    Boxed
                                </div>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="settings-footer">
                    <div class="d-grid">
                        <a class="btn btn-primary btn-lg btn-block"
                            href="https://themes.getbootstrap.com/product/appstack-responsive-admin-template/"
                            target="_blank">Purchase</a>
                    </div>
                </div>

            </div>
        </div>
    </div><svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1"
        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
        style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
        <defs id="SvgjsDefs1002"></defs>
        <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
        <path id="SvgjsPath1004" d="M0 0 "></path>
    </svg>
</body>
<!-- Mirrored from appstack.bootlab.io/auth-sign-in by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2024 17:49:33 GMT -->

</html>
