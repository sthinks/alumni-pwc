<!DOCTYPE html>
<html lang="en">
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
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="canonical" href="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ url('static/admin/assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ url('static/alumni/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('static/alumni/assets/css/style.bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('static/admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('css/pwc.min.css') }}?v={{ md5_file(public_path('css/pwc.min.css')) }}">
    <link rel="preload" as="image"
        href="{{ url('static/alumni/assets/media/background/pwc-alumni-login-video.png') }}" />
    <link rel="stylesheet"
        href="{{ url('static/alumni/assets/plugins/custom/datepicker/bootstrap-datepicker.min.css') }}">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="alumni_body" class="bg-white" style="overflow-x:hidden">
    <!--begin::Main-->
    @yield("main")
    <!--begin::Header-->
    <div class="alumni-login_header d-flex align-items-center pt-5 pb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center; align-items:center footer-text-and-logo">
                        <div style="flex:8; display:flex; align-items:center;">
                            <p class="text-white" style="margin:0px; font-size:10px">© 2015-2023 PwC. All rights reserved. PwC refers to the PwC network and/or one or more of its member firms, each of which is a separate legal entity. Please see www.pwc.com/structure for further details.</p>
                        </div>
                        <div style="flex:2; display:flex; justify-content:center; align-items:center; gap: 30px;">
                            <img src="/images/pwc-beyaz-logo.png" alt="" srcset="" style="width:55px;height:41px">
                            <img src="/images/strategy-beyaz-logo.png" alt="" srcset="" style="width:79px;height:22px">
                            <img src="/images/gsgbeyaz.png" style="width:90px;" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Header-->
</body>
<!--end::Main-->
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ url('static/alumni/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ url('static/alumni/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ url('static/alumni/assets/js/custom/authentication/sign-in/general.js') }}"></script>
<script type="text/javascript">
    jQuery.fn.preventDoubleSubmission = function() {
        $(this).on('submit', function(e) {
            var $form = $(this);

            if ($form.data('submitted') === true) {
                // Previously submitted - don't submit again
                e.preventDefault();
            } else {
                // Mark it so that the next submit can be ignored
                $form.data('submitted', true);
            }
        });

        // Keep chainability
        return this;
    };
    $('form').preventDoubleSubmission();
</script>
<!--end::Page Custom Javascript-->
@yield("js")
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>
