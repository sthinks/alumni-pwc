<!DOCTYPE html>
<html lang="tr">
<!--begin::Head-->

<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NB99XSD');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} - @yield("title")</title>
    <meta name="description" content="PwC Alumni" />
    <meta name="keywords" content="PwC, Alumni, Hatırlı Sohbetler, Kariyer Fırsatları" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ url('static/alumni/assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ url('static/alumni/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('static/alumni/assets/css/style.bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('static/admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('css/pwc.min.css') }}?v={{ md5_file(public_path('css/pwc.min.css')) }}">
    <link rel="stylesheet"
        href="{{ url('static/alumni/assets/plugins/custom/datepicker/bootstrap-datepicker.min.css') }}">
    @yield("css")
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" data-kt-aside-minimize="on"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper" style="padding-left: 0;">
                @include('alumni.layout.homeheader')
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding: 0;">
                    <!--begin::Hero-->
                    <div class="position-relative mb-17">
                        <!--begin::Overlay-->
                        <div class="overlay overlay-show">
                            <!--begin::Image-->
                            <div class="bgi-no-repeat bgi-position-center bgi-size-cover min-h-350px"
                                style="background-image:url('@yield('bg')')"></div>
                            <!--end::Image-->
                            <!--begin::layer-->
                            <div class="overlay-layer">
                                <!--begin::Heading-->
                                <div class="position-relative text-white web_app_post_text d-grid">
                                    <!--begin::Title-->
                                    <h1 class="alumni_app_abstract_title text-capitalize">
                                        <span>@yield("title")</span>
                                    </h1>
                                    <h5 class="alumni_app_abstract_text">
                                        <span>
                                           @yield("abstract")
                                        </span>
                                    </h5>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::layer-->
                        </div>
                        <!--end::Overlay-->

                        <!--begin::Breadcrumb-->
                        <div class="web_app_post mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            @yield("breadcrumb")
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Breadcrumb-->
                        <!--begin::Abstract-->
                        @hasSection("abstract_detail")
                        <div class="web_app_post mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>@yield("abstract_detail")
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--end::Abstract-->
                        <!--end::Heading-->
                    </div>
                    <!--end::-->

                    <!--Alumni Topluluğu Card-->
                    <!--begin::Post-->
                    <div class="web_app_post" id="kt_post" style="position: relative; bottom: 3rem; padding: 0 2rem;">
                        <!--begin::Container-->
                        <div id="kt_content_container">
                            @include('alumni.form-validation.errors')
                            @include('alumni.form-validation.success')
                            <!--begin::Layout-->
                            <div>
                                @yield("main")
                            </div>
                            <!--end::Layout-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                    <!--Alumni Topluluğu Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>

    <!--begin::Footer-->
    @include('alumni.layout.footer')
    <!--end::Footer-->
    <!--end::Root-->

    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ url('static/alumni/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ url('static/alumni/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ url('static/alumni/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ url('static/alumni/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ url('static/admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <!--end::Page Custom Javascript-->
    @yield("js")
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
