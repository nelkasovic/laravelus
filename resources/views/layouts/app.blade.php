<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token --> 
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - {{ __('common.AppTitle') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ config('app.name') }} - {{ __('common.AppTitle') }}">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="robots" content="noindex, nofollow">

    <!-- Icons -->
    <!--
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">
    -->

    <!-- Favicons and other Icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts and Styles -->
    @yield('css_before')
    <link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="/css/custom.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ mix('css/dashmix.css') }}">
    <link rel="stylesheet" href="/css/themes/xmodern.css">

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/js/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/js/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="/js/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="/js/plugins/dropzone/dist/min/dropzone.min.css">
    

    @if(request()->is('home'))
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/js/plugins/slick-carousel/slick.css">
    <link rel="stylesheet" href="/js/plugins/slick-carousel/slick-theme.css">
    @endif

    @yield('css_after')

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
    
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-narrow">



        <!-- Sidebar -->
        <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header -->
            <div class="bg-header-dark">
                <div class="content-header bg-white-10">
                    <!-- Logo -->
                    <a class="font-w600 font-size-lg text-white" href="{{ url('/') }}">
                        <span class="smini-visible">
                            <i class="nav-main-link-icon si si-rocket"></i>
                        </span>
                        <span class="smini-hidden">
                            <span class="text-white-75">
                                <i class="nav-main-link-icon si si-rocket mr-2"></i>
                            </span>
                            <span class="text-white font-w700">{{ config('app.name', 'Qlick') }}</span>
                        </span>
                    </a>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div>
                        <!-- Toggle Sidebar Style -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                        <a class="js-class-toggle text-white-75" data-target="#sidebar-style-toggler"
                            data-class="fa-toggle-off fa-toggle-on" data-toggle="layout"
                            data-action="sidebar_style_toggle" href="javascript:void(0)">
                            <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                        </a>
                        <!-- END Toggle Sidebar Style -->

                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close"
                            href="javascript:void(0)">
                            <i class="fa fa-times-circle"></i>
                        </a>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
            </div>
            <!-- END Side Header -->

            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">


                    @can('see home')
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                            <i class="nav-main-link-icon si si-home"></i>
                            <span class="nav-main-link-name">{{ __('common.Dashboard') }}</span>
                        </a>
                    </li>
                    @endcan

                    @hasrole('super|client')
                    <li class="nav-main-heading smini-hidden">{{ __('common.BaseData')}}</li>
                    @endhasrole

                  
                    @can('read roles')
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('roles') ? ' active' : '' }}" href="/roles">
                            <i class="nav-main-link-icon si si-lock"></i>
                            <span class="nav-main-link-name">{{ __('common.Roles') }}</span>
                        </a>
                    </li>
                    @endcan

                    @can('read tenants')
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('tenants*') ? ' active' : '' }}" href="/tenants">
                            <i class="nav-main-link-icon si si-fire"></i>
                            <span class="nav-main-link-name">{{ __('common.Clients') }}</span>
                        </a>
                    </li>
                    @endcan

                    @can('read users')
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('users*') ? ' active' : '' }}" href="/users">
                            <i class="nav-main-link-icon si si-users"></i>
                            <span class="nav-main-link-name">{{ __('common.Users') }}</span>
                        </a>
                    </li>
                    @endcan

                    @can('read persons')
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('persons') ? ' active' : '' }}" href="/persons">
                            <i class="nav-main-link-icon si si-user-female"></i>
                            <span class="nav-main-link-name">{{ __('common.Persons') }}</span>
                        </a>
                    </li>
                    @endcan
                    
                    @guest
                    <li class="nav-main-heading">{{ __('common.Auth') }}</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('login') }}">
                            <i class="nav-main-link-icon si si-users"></i>
                            <span class="nav-main-link-name">{{ __('Login') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-main-link" href="{{ route('register') }}">
                            <i class="nav-main-link-icon si si-users"></i>
                            <span class="nav-main-link-name">{{ __('Register') }}</span>
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>
            <!-- END Side Navigation -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div>
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                    <button type="button" class="btn btn-dual mr-1" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- END Toggle Sidebar -->

                    <!-- Open Search Section -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-dual" data-toggle="layout" data-action="header_search_on">
                        <i class="fa fa-fw fa-search"></i> <span
                            class="ml-1 d-none d-sm-inline-block">{{ __('common.Search') }} <span
                                class="text-warning">{{ isset($keyword) ? $keyword : '' }}</span></span>
                    </button>
                    <!-- END Open Search Section -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div>

                    <!-- LANG Dropdown -->
                    <div class="dropdown d-inline-block">

                        <button type="button" class="btn btn-dual" id="page-header-language-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-fw fa-bullhorn d-sm-none"></i>
                            <span class="d-none d-sm-inline-block">{{ __('common.Language') }}</span>
                            <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">

                            <div class="p-2">

                                @foreach (language()->allowed() as $code => $name)
                                <a class="dropdown-item" href="{{ language()->back($code) }}">
                                    <i class="far fa-fw fa-bookmark mr-1"></i>{{ $name }}
                                </a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- LANG Dropdown -->

                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block">@guest {{ __('common.User') }} @else
                                @hasrole('admin') <span class="icon si si-fire"></span> @endhasrole
                                {{ Auth::user()->name }} 
                                @endguest</span>
                            <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                            <!--
                            <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                            {{ __('common.UserOptions') }}
                            </div>
                            -->
                            <div class="p-2">


                                <a class="dropdown-item"
                                    href="#">
                                    <i class="far fa-fw fa-user mr-1"></i> {{ __('common.Profile') }}
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between"
                                    href="javascript:void(0)">
                                    <span><i class="far fa-fw fa-envelope mr-1"></i> {{ __('common.Inbox') }}</span>
                                    <span class="badge badge-primary">3</span>
                                </a>
                                @can('read files')
                                <a class="dropdown-item" href="/files">
                                    <i class="far fa-fw fa-file-alt mr-1"></i> {{ __('common.AssignmentSheets') }}
                                </a>
                                @endcan
                                @can('read grades')
                                <a class="dropdown-item" href="/grades">
                                    <i class="far fa-fw fa-file-alt mr-1"></i> {{ __('common.Grades') }}
                                </a>
                                @endcan
                                
                                <div role="separator" class="dropdown-divider"></div>
                                
                                <a class="dropdown-item" href="#" title="{{ __('common.Settings') }}">
                                    <i class="far fa-fw fa-building mr-1"></i> {{ __('common.Settings') }}
                                </a>
                                <!-- END Side Overlay -->

                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> {{ __('common.Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>
                
                            </div>
                        </div>
                    </div>
                    <!-- END User Dropdown -->

                    <!-- Notifications Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-dual" id="page-header-notifications-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-bell"></i>
                            <span class="badge badge-secondary badge-pill">

                         
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                                {{ __('common.UpcomingEvents') }}
                            </div>
                            <ul class="nav-items my-2">
                              
                            <div class="p-3">
                                <a class="btn btn-light btn-block text-center" href="javascript:void(0)">
                                    <i class="fa fa-fw fa-eye mr-1"></i> {{ __('common.Events') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END Notifications Dropdown -->

                    <!-- Toggle Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-dual" data-toggle="layout" data-action="side_overlay_toggle">
                        <i class="far fa-fw fa-list-alt"></i>
                    </button>
                    <!-- END Toggle Side Overlay -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header bg-primary">
                <div class="content-header">
                    <form class="w-100" action="{{ \Route::current()->getPrefix() }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="GET">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <button type="button" class="btn btn-primary" data-toggle="layout"
                                    data-action="header_search_off">
                                    <i class="fa fa-fw fa-times-circle"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control border-0" placeholder="{{ __('common.EnterOrEsc') }}"
                                id="keyword" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}">

                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->


            <!-- Header Loader -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary-darker">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">

            {{-- @include('flash::message') --}}

            <!-- Response ALERT -->
            @if (\Session::has('msg') || session('error'))
            <div class="content">
                <div class="block block-rounded block-bordered block-themed mb-0 block-fx-shadow">
                    <div class="block-header {{ (\Session::get('status')) == 1 ? "bg-success" : "bg-danger" }}">
                        <!-- bg-gd-sea bg-gd-aqua bg-gd-fruit -->
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-fire mr-2"></i>
                            {{ \Session::get('msg') }} {{ session('error') }}
                        </h3>
                        <!--
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                        -->
                    </div>
                </div>
            </div>
            @endif

            @if ($errors->any())
            <div class="content mb-0 pb-0">
                <div class="block block-rounded block-bordered block-themed mb-0">
                    <div class="block-header bg-primary-darker">
                        <div class="font-w600">
                            <i class="fa fa-fw fa-fire mr-2"></i>

                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach

                        </div>
                        <!--
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                        -->
                    </div>
                </div>
            </div>
            @endif

            <!-- Response ALERT END -->

            <!-- Laravel CONTENT -->
            @yield('content')
            <!-- Laravel CONTENT END -->

        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="bg-body-light">
            <div class="content py-0">
                <div class="row font-size-sm">
                    <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                        {{ __('common.Crafted') }} {{ __('common.with') }} <i class="fa fa-heart text-danger"></i>
                        {{ __('common.by') }} <a class="font-w600" href="#" target="_blank">{{ config('app.name') }}</a>
                    </div>
                    <div class="col-sm-6 order-sm-1 text-center text-sm-left">
                        <a class="font-w600" href="#" target="_blank">{{ config('app.name') }}</a>
                        &copy; <span data-toggle="year-copy">2019</span>

                        <span> | {{ Carbon::now()->formatLocalized('%A, %d. %B %Y') }}
                        
                    </div>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <!-- Dashmix Core JS -->
    <script src="{{ mix('js/dashmix.app.js') }}"></script>


    <!-- Laravel Scaffolding JS -->
    <script src="{{ mix('js/laravel.app.js') }}"></script>


    <!-- Page JS Plugins -->
    <script src="/js/plugins/es6-promise/es6-promise.auto.min.js"></script>
    <script src="/js/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script>
    <script src="/js/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="/js/plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="/js/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/js/pages/be_comp_dialogs.min.js"></script>
    <script src="/js/pages/be_comp_dialogs.min.js"></script>
    
    @if(request()->is('home'))
    <script src="/js/plugins/slick-carousel/slick.min.js"></script>
    <script src="/js/pages/be_comp_onboarding.min.js"></script>
    <script src="/js/pages/db_analytics.min.js"></script>
    @endif

    @if(request()->is('calendar'))
    <!-- Fullcalendar -->
    <script src="/js/plugins/moment/moment.min.js"></script>
    <script src="/js/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script src="/js/plugins/fullcalendar/locale/de.js"></script>
    <script src="/js/plugins/fullcalendar/locale/en.js"></script>
    <script src="/js/pages/be_comp_calendar.min.js"></script>
    {!! @$calendar->script() !!}
    @endif

    @if(request()->is('homeless'))
    <!-- Onboarding Modal -->
    @include('include.onboarding')
    <!-- Onboarding Modal END -->
    @endif

    @if(request()->is('home') || request()->is('/'))
    <!-- Page JS -->
    <script src="/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="/js/plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="/js/pages/be_pages_dashboard.js"></script>
    @endif

    @if(request()->is('files/create'))
    <script src="/js/plugins/dropzone/dropzone.min.js"></script>
    @endif

    <script src="/js/plugins/main.app.js"></script>

    <!-- Page JS Helpers (Table Tools helpers) -->
    <script>
        jQuery(function() {
            Dashmix.helpers(['datepicker', 'summernote', 'table-tools-checkable', 'table-tools-sections', 'colorpicker', 'magnific-popup', 'masked-inputs', 'easy-pie-chart', 'sparkline']);
        });

        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
    </script>

    @yield('js_after')

</body>

</html>