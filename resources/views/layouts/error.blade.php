<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Attely - Qlick by Nermin Elkasovic">
    <meta name="author" content="Qlick by Nermin Elkasovic">
    <meta name="robots" content="noindex, nofollow">

    <!-- Icons -->
    <!--
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">
    -->

    <!-- Fonts and Styles -->
    @yield('css_before')
    <link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" href="{{ mix('css/dashmix.css') }}">

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="/js/plugins/sweetalert2/sweetalert2.min.css">

    <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" href="{{ mix('css/themes/xwork.css') }}"> -->
    @yield('css_after')

    <!-- Scripts -->
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>
    <!-- Page Container -->
    <!--
        Available classes for #page-container:

    GENERIC

        'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

    SIDEBAR & SIDE OVERLAY

        'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
        'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
        'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
        'sidebar-dark'                              Dark themed sidebar

        'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
        'side-overlay-o'                            Visible Side Overlay by default

        'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

        'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

    HEADER

        ''                                          Static Header if no class is added
        'page-header-fixed'                         Fixed Header


    Footer

        ''                                          Static Footer if no class is added
        'page-footer-fixed'                         Fixed Footer (please have in mind that the footer has a specific height when is fixed)

    HEADER STYLE

        ''                                          Classic Header style if no class is added
        'page-header-dark'                          Dark themed Header
        'page-header-glass'                         Light themed Header with transparency by default
                                                    (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
        'page-header-glass page-header-dark'         Dark themed Header with transparency by default
                                                    (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

    MAIN CONTENT LAYOUT

        ''                                          Full width Main Content if no class is added
        'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
        'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
    -->

        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('/media/photos/photo18@2x.jpg');">
                    <div class="hero bg-gd-fruit-op align-items-sm-start">
                        <div class="hero-inner">
                            <div class="content content-full">
                                <div class="px-3 py-5 text-center text-sm-left">
                                    <div class="display-1 text-warning font-w700 invisible" data-toggle="appear">403</div>
                                    <h1 class="h2 font-w700 text-white mt-5 mb-3 invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="300">
                                        Oops.. You just found an error page..
                                    </h1>
                                    <h2 class="h3 font-w400 text-white-75 mb-5 invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="450">
                                        We are sorry but you do not have permission to access this page..
                                        @yield('title')
                                        @yield('code')
                                        @yield('message')
                                    </h2>
                                    <div class="invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="600">
                                        <a class="btn btn-hero-light" href="javascript:history.back();">
                                            <i class="fa fa-arrow-left mr-1"></i> Back to reality
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
            </div>
            <!-- END Page Container -->


    <!-- Dashmix Core JS -->
    <script src="{{ mix('js/dashmix.app.js') }}"></script>

    <!-- Laravel Scaffolding JS -->
    <script src="{{ mix('js/laravel.app.js') }}"></script>
    
    @yield('js_after')
    
    <!-- Page JS Plugins -->
    <script src="/js/main.app.js"></script>
    <script src="/js/plugins/es6-promise/es6-promise.auto.min.js"></script>
    <script src="/js/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- Page JS Code -->
    <script src="/js/plugins/be_comp_dialogs.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Page JS Helpers (Table Tools helpers) -->
    <script>jQuery(function(){ Dashmix.helpers(['table-tools-checkable', 'table-tools-sections', 'magnific-popup']); });</script>
</body>
</html>


