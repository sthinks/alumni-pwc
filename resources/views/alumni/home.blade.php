<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
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
    <link href="{{ url('static/alumni/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" />
    <link href="{{ url('css/pwc.min.css') }}?v={{ md5_file(public_path('css/pwc.min.css')) }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>

<body id="kt_body" data-kt-aside-minimize="on"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed"
    style="background-color: #f2f2f2;">

    <div class="contact_me_fixed" id="homepage_contact_form" style="z-index: +9999;">
        <i class="icon" style="padding: 10px;">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 2000 2000"
                style="enable-background:new 0 0 2000 2000;" xml:space="preserve">
                <style type="text/css">
                    .st0 {
                        clip-path: url(#SVGID_00000069390216275071183090000001042262223189111430_);
                        fill: #FFFFFF;
                    }

                </style>
                <g>
                    <defs>
                        <path id="SVGID_1_" d="M1248.79,647.38c-14.32,0-28.06,2.99-40.61,8.38c-12.55,5.38-23.91,13.16-33.48,22.72
   c-9.57,9.57-17.35,20.92-22.74,33.46s-8.38,26.28-8.38,40.59c0,14.32,3,28.05,8.38,40.59c5.39,12.54,13.17,23.9,22.74,33.47
   c9.57,9.57,20.93,17.34,33.48,22.73c12.55,5.38,26.29,8.38,40.61,8.37c14.31,0,28.04-3,40.59-8.39
   c12.54-5.39,23.9-13.17,33.46-22.73c9.57-9.57,17.34-20.92,22.73-33.46c5.39-12.54,8.38-26.27,8.38-40.57
   c0-14.3-2.99-28.03-8.38-40.57c-5.39-12.54-13.16-23.9-22.73-33.47c-9.57-9.57-20.92-17.35-33.46-22.74
   C1276.82,650.37,1263.1,647.38,1248.79,647.38z M855.95,647.38c-14.32,0-28.06,2.99-40.6,8.38c-12.54,5.39-23.9,13.16-33.46,22.73
   c-9.56,9.57-17.34,20.92-22.72,33.46c-5.38,12.54-8.37,26.27-8.37,40.59c0,14.32,2.99,28.05,8.37,40.59
   c5.38,12.54,13.16,23.9,22.72,33.46c9.56,9.57,20.92,17.34,33.46,22.73c12.54,5.39,26.28,8.38,40.6,8.38
   c14.33,0,28.06-2.99,40.61-8.38c12.54-5.38,23.9-13.16,33.46-22.73c9.56-9.57,17.34-20.92,22.72-33.46
   c5.38-12.54,8.37-26.27,8.37-40.59c0-14.31-2.99-28.04-8.37-40.59c-5.38-12.54-13.16-23.9-22.72-33.46
   c-9.56-9.57-20.92-17.34-33.46-22.73C884,650.37,870.27,647.38,855.95,647.38z M463.17,647.38c-14.32,0-28.06,2.99-40.6,8.38
   c-12.54,5.39-23.9,13.16-33.46,22.73c-9.56,9.57-17.34,20.92-22.72,33.46c-5.38,12.54-8.37,26.27-8.37,40.59
   c0,14.31,2.99,28.04,8.37,40.59c5.38,12.54,13.16,23.9,22.72,33.47c9.56,9.57,20.92,17.34,33.46,22.73
   c12.54,5.39,26.28,8.38,40.6,8.38c14.32,0,28.05-3,40.6-8.38c12.54-5.39,23.9-13.16,33.46-22.73
   c9.56-9.57,17.34-20.92,22.72-33.46c5.38-12.54,8.38-26.27,8.38-40.58c0-14.31-2.99-28.04-8.38-40.58
   c-5.38-12.54-13.16-23.9-22.73-33.47c-9.57-9.57-20.92-17.35-33.46-22.73S477.48,647.38,463.17,647.38z M1449.67,262.14
   c24.82,0,49.49,5.27,72.54,14.75c23.05,9.48,44.49,23.18,62.86,40.04c18.36,16.86,33.65,36.88,44.39,59.01
   c10.74,22.13,16.95,46.38,17.15,71.68c0.1,13.12,0.16,26.24,0.18,39.37c0.02,13.12,0.01,26.25-0.02,39.37
   c-0.03,13.12-0.06,26.25-0.1,39.37c-0.03,13.12-0.06,26.24-0.06,39.37c0,40.01,0,80.01,0,120.02s0,80.01,0,120.02
   s0,80.01,0,120.02c0,40.01,0,80.01,0,120.02c0,13.25,0.28,26.35,0.08,39.21c-0.19,12.86-0.86,25.49-2.75,37.79
   c-1.89,12.31-5,24.3-10.09,35.89c-5.09,11.59-12.15,22.78-21.93,33.49c-12.35,13.52-26.11,24.32-40.87,32.9
   c-14.76,8.58-30.53,14.96-46.93,19.65c-16.39,4.69-33.4,7.68-50.64,9.5c-17.24,1.82-34.7,2.48-52,2.48c-36.03,0-72.07,0-108.1,0
   c-36.03,0-72.07,0-108.1,0c-36.03,0-72.07,0-108.1,0c-36.03,0-72.07,0-108.1,0c-32.58,0-65.17,0-97.75,0s-65.17,0-97.75,0
   s-65.17,0-97.75,0s-65.17,0-97.75,0l-99.87,58.74l-99.87,58.74l-99.87,58.74l-99.87,58.74l15.59-59.16l15.59-59.16l15.59-59.16
   l15.59-59.16c-16.89-1.58-34.76-4.69-52.58-9.47s-35.59-11.23-52.29-19.49c-16.7-8.26-32.31-18.32-45.82-30.32
   c-13.51-12-24.91-25.94-33.17-41.96c-2.96-5.74-5.18-11.47-6.84-17.23c-1.66-5.76-2.76-11.54-3.5-17.37
   c-0.73-5.83-1.1-11.72-1.28-17.69c-0.18-5.97-0.18-12.03-0.18-18.19c0-19.52,0-39.03,0-58.55s0-39.03,0-58.55
   c0-19.52,0-39.03,0-58.55s0-39.03,0-58.55c0-25.05,0-50.1,0-75.15c0-25.05,0-50.1,0-75.15c0-25.05,0-50.1,0-75.15
   c0-25.05,0-50.1,0-75.15c0-12.47-0.17-24.99-0.38-37.54c-0.21-12.55-0.46-25.12-0.63-37.7c-0.16-12.57-0.24-25.14-0.09-37.69
   s0.51-25.05,1.22-37.51c1.53-26.8,10.68-51.13,25.04-72.56c14.36-21.43,33.94-39.96,56.31-55.15s47.53-27.04,73.07-35.12
   c25.54-8.08,51.46-12.39,75.33-12.49c12.58-0.05,25.16-0.08,37.74-0.09c12.58-0.01,25.16,0,37.75,0.01
   c12.58,0.01,25.16,0.03,37.75,0.05c12.58,0.02,25.16,0.03,37.74,0.03c48.55,0,97.1,0,145.64,0c48.55,0,97.1,0,145.64,0
   c48.55,0,97.1,0,145.64,0c48.55,0,97.1,0,145.64,0c34.51,0,69.02,0,103.53,0c34.51,0,69.02,0,103.53,0s69.02,0,103.53,0
   c34.51,0,69.02,0,103.53,0c0.57,0,1.14,0,1.72,0c0.57,0,1.14,0,1.72,0c0.57,0,1.14,0,1.72,0S1449.1,262.14,1449.67,262.14z
   M1803.83,653.22c22.36,0,41.73,3.88,58.21,11c16.48,7.12,30.07,17.47,40.87,30.42c10.8,12.95,18.82,28.5,24.14,46
   c5.33,17.5,7.97,36.96,8.02,57.73c0.04,13.95,0.05,27.91,0.06,41.86c0.01,13.95,0,27.91-0.01,41.86s-0.02,27.91-0.03,41.86
   c-0.01,13.95-0.02,27.91-0.02,41.86c0,35.57,0,71.13,0,106.7c0,35.56,0,71.13,0,106.69c0,35.57,0,71.13,0,106.7
   c0,35.57,0,71.13,0,106.7c0,22.89-2.48,45.21-7.8,65.81c-5.32,20.59-13.49,39.46-24.87,55.42
   c-11.38,15.97-25.98,29.04-44.16,38.04c-18.18,9.01-39.95,13.95-65.66,13.66l10.64,43.09l10.64,43.09l10.64,43.09l10.64,43.09
   l-73.29-43.09l-73.29-43.09l-73.29-43.09l-73.29-43.09c-62.95,0-125.9,0.07-188.84,0.17c-62.95,0.09-125.9,0.21-188.85,0.28
   c-62.95,0.07-125.9,0.11-188.85,0.06c-62.95-0.06-125.9-0.2-188.84-0.5c-9.86-0.05-19.56-0.63-29.09-1.81
   c-9.53-1.18-18.89-2.97-28.06-5.42s-18.18-5.58-26.99-9.45c-8.81-3.87-17.44-8.47-25.87-13.89c-14.09-9.05-26.1-19.02-36.2-29.9
   c-10.1-10.88-18.29-22.66-24.71-35.34c-6.42-12.68-11.09-26.25-14.15-40.7c-3.06-14.45-4.51-29.77-4.51-45.96
   c61.58,0,123.16,0,184.74,0s123.16,0,184.74,0s123.16,0,184.74,0s123.16,0,184.74,0c21.92,0,43.85,0.11,65.79,0.26
   c21.94,0.14,43.89,0.31,65.83,0.43c21.95,0.11,43.89,0.17,65.83,0.09c21.94-0.09,43.87-0.31,65.79-0.77
   c24.43-0.51,46.15-5.6,65.02-14.4c18.87-8.8,34.88-21.31,47.87-36.66c12.99-15.35,22.97-33.53,29.77-53.68
   c6.8-20.15,10.42-42.27,10.72-65.48c0.15-12.24,0.23-24.49,0.26-36.74s0.01-24.5-0.03-36.75c-0.04-12.25-0.1-24.5-0.14-36.75
   c-0.05-12.25-0.09-24.5-0.09-36.74c0-34.39,0-68.78,0-103.16c0-34.39,0-68.77,0-103.16s0-68.77,0-103.16s0-68.77,0-103.16h12.8
   h12.8h12.8H1803.83z" />
                    </defs>
                    <use xlink:href="#SVGID_1_" style="overflow:visible;fill:#FFFFFF;" />
                    <clipPath id="SVGID_00000034768326341021516260000009296850147604681662_">
                        <use xlink:href="#SVGID_1_" style="overflow:visible;" />
                    </clipPath>
                    <polygon
                        style="clip-path:url(#SVGID_00000034768326341021516260000009296850147604681662_);fill:#FFFFFF;"
                        points="
  -238.82,-41.96 380.68,-41.96 1000.18,-41.96 1619.68,-41.96 2239.18,-41.96 2239.18,479.03 2239.18,1000.02 2239.18,1521
  2239.18,2041.99 1619.68,2041.99 1000.18,2041.99 380.68,2041.99 -238.82,2041.99 -238.82,1521 -238.82,1000.02 -238.82,479.03
  " />
                </g>
            </svg>
        </i>
        Bize Ulaşın
    </div>
    <div class="contact_me_fixed_mobile justify-content-center" id="homepage_contact_form_mobile">
        Bize Ulaşın
    </div>
    <div class="card shadow-none d-none" id="home_contact_card"
        style="position: fixed; bottom: 11%; right: 1%; z-index: +999999; border: solid .5px #ffb600;">
        <!--begin::Header-->
        <div class="card-header" id="kt_activities_header">
            <h3 class="card-title fw-bolder text-dark">Bize Ulaşın</h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body position-relative" id="kt_activities_body">
            <form method="post" id="form_contact_side">
                <div class="mb-3">
                    <label class="form-label">Konu</label>
                    <input name="contact_title" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mesaj</label>
                    <textarea name="contact_message" class="form-control" rows="4" cols="40"></textarea>
                </div>
                <button type="submit" class="btn pwc-orange-button" id="contact_index_form">Gönder</button>
                <div id="contact_form_spinner"></div>
            </form>
        </div>
        <!--end::Body-->
    </div>


    @include('alumni.layout.homeheader')
    <!--begin::Content-->
    <div class="d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid-home">
            <div id="kt_subheader" class="mt-5 subheader py-2 py-lg-6 subheader-solid"
                style="display: flex; align-items: flex-start; font-size: 30px;">
                <h1 class="home_last_news">Gündemdekiler</h1>
            </div>
            <!--begin::Card-->
        </div>
        <!--begin::Card-->
        <div class="card mt-5 shadow" id="home_profile_update_card" style="border-radius: 0!important;">
            <!--begin::Card body-->
            <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                <!--begin::Avatar-->
                <div class="symbol symbol-65px symbol-circle mb-5">
                    <img style="object-fit: cover;" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                </div>
                <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">{{ $user->name }}</a>
                <!--end::Name-->
                <!--begin::Position-->
                <div class="fw-bold text-gray-400 mb-2">{{ $user->email }}</div>
                <div class="fw-bold text-gray-400 mb-2">{{ $user->pwc_worked_between }}</div>
                <div class="fw-bold text-gray-400 mb-2">{{ optional($user->pwcWorkedTeamLos)->name ?? '?' }} -
                    {{ optional($user->pwcWorkedTeamSubLos)->name ?? '?' }}</div>
                <!--end::Position-->
                <!--begin::Info-->
                <div class="flex-center flex-wrap" style="display: contents;">
                    <!--begin::Stats-->
                    <div class="d-flex text-gray-400">
                        <span class="gradient_profile_done_home">
                            <img style="margin-left: {{ $user->getFillingRate() - 3 }}%;" width="30" height="30"
                                src="{{ url('static/alumni/assets/media/pwc_index/ProfilDurumu_ilk.svg') }}"
                                alt="Profil tamamlama">
                            <img width="30" height="30"
                                src="{{ url('static/alumni/assets/media/pwc_index/ProfilDurumu_iki.svg') }}"
                                alt="Profil tamamlandı">
                        </span>
                    </div>
                    <!--end::Stats-->
                    <!--begin::Stats-->
                    <a href="{{ route('profile.index') }}" class="btn rounded min-w-80px py-3 px-4 mx-2 mb-3"
                        style="background-color: #D04A02">
                        <div class="fs-6 fw-bolder text-white">Profil Güncelle</div>
                    </a>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
        @include('alumni.layout.passwordexpired')
        <div class="row container-fluid-home grid mb-11">
            <div id="kt_carousel_1_carousel_ust"
                class="grid-item carousel carousel-custom slide col-xl-9 col-md-9 col-sm-12" data-bs-ride="carousel"
                data-bs-interval="8000">
                <!--begin::Carousel-->
                <div class="carousel-inner" id="carousel-inner-slider">
                    @foreach ($sliders as $i => $slider)
                        <!--begin::Item-->
                        <div class="carousel-item @if ($i == 0) active @endif">
                            @if (isset($slider->slider_link))
                                <a href='{{ $slider->slider_link }}' target="_blank">
                                    <img class="d-block w-100"
                                        src="{{ route('storage.images', $slider->slider_image) }}"
                                        alt="{{ $slider->slider_title }}">
                                </a>
                            @else
                                <img class="d-block w-100"
                                    src="{{ route('storage.images', $slider->slider_image) }}"
                                    alt="{{ $slider->slider_title }}">
                            @endif
                            <!--end::Item-->
                            <div class="card-overlay home_old_news_overlay_slider">
                                <span
                                    class="home_old_news_overlay_span_slider fw-bold">{{ $slider->slider_topic }}</span>
                                    <span class="old_news_title_slider">{{ $slider->slider_desc }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--end::Carousel-->
                <!--begin::Heading-->
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <!--begin::Carousel Indicators-->
                    <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                        @for ($i = 0; $i < $sliders->count(); $i++)
                            <li data-bs-target="#kt_carousel_1_carousel_ust" data-bs-slide-to="{{ $i }}"
                                class="ms-1 @if ($i == 0) active @endif"></li>
                        @endfor
                    </ol>
                    <!--end::Carousel Indicators-->
                </div>
                <!--end::Heading-->
            </div>
            <!--begin::Old-News-Card-->
            @foreach ($news as $new)
                @if ($new->category->slug === 'pwc-duyurulari')
                    <div class="grid-item col-xl-3 col-md-4 col-sm-6 col-xs-12" id="home_isotope_size">
                        <div class="card home_old_news">
                            <a href="{{ $new->link }}" style="color: inherit;">
                                <div class="home_img_wrap">
                                    <img src="{{ $new->cover_photo }}" alt="image" class="home_card_image"
                                        style="width: 100%">
                                </div>
                                <div class="card-overlay home_old_news_overlay">
                                    <h2>
                                        <span class="old_news_title text-white">{{ $new->announcement_title }}</span>
                                    </h2>
                                    <div class="card-overlay-inner home_old_news_overlay_inner text-white fs-3">
                                        {{ $new->mini_description }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @elseif($new->category->slug === 'ayricalik-indirim')
                    <div class="grid-item col-xl-3 col-md-4 col-sm-6 col-xs-12" id="home_isotope_size">
                        <div class="card home_old_news_campaign">
                            <a href="{{ $new->link }}" style="color: inherit;">
                                <div class="home_img_wrap">
                                    <img src="{{ $new->cover_photo }}" alt="image" class="home_card_image card-image"
                                        style="width: 100%">
                                </div>
                                <div class="card-overlay home_old_news_overlay_campaign">
                                    <span
                                        class="home_old_news_overlay_span_campaign ">{{ $new->category_name }}</span>
                                    <h2>
                                        <span class="old_news_title text-white">{{ $new->announcement_title }}</span>
                                    </h2>
                                    <div
                                        class="card-overlay-inner home_old_news_overlay_inner_campaign text-white fs-6">
                                        <span>
                                            {{ $new->mini_description }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @elseif($new->category->slug === 'is-ilanlari')
                    <div class="grid-item col-xl-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="card home_job_posting_card">
                            <div class="card-body home_imageless_card">
                                <img class="home_imageless_card_is mt-4"
                                    src="{{ url('static/alumni/assets/media/icons/is.svg') }}" alt="İleri İcon">
                                <h2 class="card-title home_imageless_title two-lines">{{ $new->category_name }}
                                </h2>
                                <p class="card-text home_imageless_text mt-4 three-lines">
                                    {{ $new->announcement_title }}</p>
                                <a href="{{ $new->link }}" style="color: inherit;">
                                    <img class="home_imageless_icon mt-4" width="40" height="auto"
                                        src="{{ url('static/alumni/assets/media/icons/home_next_page.svg') }}"
                                        alt="İleri İcon">
                                </a>
                            </div>
                        </div>
                    </div>
                @elseif($new->category->slug === 'vefat')
                    <div class="grid-item col-xl-3 col-md-4 col-sm-6 col-xs-12 d-none">
                        <div class="card home_death_card">
                            <div class="card-body home_imageless_card">
                                <img class="home_imageless_card_is mt-4" width="40" height="auto"
                                    src="{{ url('static/alumni/assets/media/icons/vefat_ikon.svg') }}"
                                    alt="Vefat İcon">
                                <h2 class="card-title home_imageless_title two-lines">{{ $new->category_name }}
                                </h2>
                                <p class="card-text home_imageless_text mt-4 three-lines">
                                    {{ $new->first_sentence }}
                                </p>
                                <a href="{{ $new->link }}" style="color: inherit;">
                                    <img class="home_imageless_icon mt-4" width="40" height="auto"
                                        src="{{ url('static/alumni/assets/media/icons/home_next_page.svg') }}"
                                        alt="İleri İcon">
                                </a>
                            </div>
                        </div>
                    </div>
                @elseif($new->category->slug === 'etkinlik')
                    <div class="grid-item col-xl-3 col-md-4 col-sm-6 col-xs-12" id="home_isotope_size">
                        <div class="card home_old_news_campaign">
                            <a href="{{ $new->link }}" style="color: inherit;">
                                <div class="home_img_wrap">
                                    <img src="{{ $new->cover_photo }}" alt="image" class="card-image home_card_image"
                                        style="width: 100%">
                                </div>
                                <div class="card-overlay home_old_news_overlay_campaign">
                                    <span
                                        class="home_old_news_overlay_span_campaign">{{ $new->category_name }}</span>
                                    <h2>
                                        <span class="old_news_title text-white">{{ $new->announcement_title }}</span>
                                    </h2>
                                    <div
                                        class="card-overlay-inner home_old_news_overlay_inner_campaign text-white fs-6">
                                        {{ $new->mini_description }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach

            <!--end::Old-News-Card-->
        </div>
    </div>
    <!--end::Content-->
    @include('alumni.layout.footer')
    <!--end::Main-->
</body>
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ url('static/alumni/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ url('static/alumni/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ url('static/alumni/assets/plugins/custom/isotope/isotope.pkgd.js') }}"></script>
<script src="{{ url('static/alumni/assets/plugins/custom/isotope/packery-mode.pkgd.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ url('static/alumni/assets/js/custom/widgets.js') }}"></script>
<script src="{{ url('static/alumni/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ url('static/admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ url('static/alumni/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ url('js/axios.min.js') }}"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
<script>
    $("form#form_contact_side").on("submit", function(e) {
        e.preventDefault();
        document.getElementById('contact_form_spinner').innerHTML = `<div class="spinner-border" id="spinner_submit_contact" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>`;
        $('#contact_index_form').hide();
        const query = $('#form_contact_side').serialize();
        axios.post('{{ route('contactform.store') }}', query)
            .then(function(response) {
                let status = response.data.status;

                if (status === "success") {
                    $('#form_contact_side').find('input').val('');
                    $('#form_contact_side').find('textarea').val('');
                    toastr.success("Formunuz bize ulaşmıştır.");
                    $('#spinner_submit_contact').hide();
                    $('#contact_index_form').show();
                } else {
                    toastr.error("Bir hata oluştu.");
                    $('#spinner_submit_contact').hide();
                    $('#contact_index_form').show();
                }
            });
        return false;
    });

    // DOMContentLoaded  end
    $(document).ready(function() {
        $("#homepage_contact_form").click(function() {
            $("#home_contact_card").removeClass("d-none").toggle();
        });
        $("#homepage_contact_form_mobile").click(function() {
            $("#home_contact_card").removeClass("d-none").toggle();
        });
        $("#homepage_birthday").click(function() {
            $("#home_birthday_card").removeClass("d-none").toggle();
        });
        $("#homepage_birthday_mobile").click(function() {
            $("#home_birthday_card").removeClass("d-none").toggle();
        });

        //Profil Güncelle kartı, Doğum Günü ve Bize Ulaşın kartları açıkken scroll edilirse kapanıyor.
        $(function() {
            $(window).scroll(function() {
                $("#home_contact_card").addClass("d-none");
                $("#home_birthday_card").addClass("d-none");
                $("#home_profile_update_card").css("transform", "translateX(100%)");
            });
        });
        //Profil Güncelle kartına tıklanınca kart görünür oluyor, başka bir yere tıklayınca kart önceki yerine gidiyor.
        $("#home_profile_update_card").click(function() {
            $("#home_profile_update_card").css("transform", "translateX(0%)");
        });

        document.addEventListener('click', function(event) {
            var isClickInside = document.getElementById("home_profile_update_card").contains(event
                .target);

            if (!isClickInside) {
                $("#home_profile_update_card").css("transform", "translateX(100%)");
            }
        });
    });
    //ISOTOPE kullanarak asimetrik layoutun oluşturulmasını sağlıyor
    jQuery(document).ready(function($) {
        setTimeout(function() {
            $('.grid').isotope({
                layoutMode: 'packery',
                itemSelector: '.grid-item',
            });
        }, 800);
    });
</script>

</body>
<!--end::Body-->

</html>
