@extends('alumni.layout.app')
@section('title', 'Etkinlikler')
@section('bg', url('static/alumni/assets/media/background/7.png'))
@section('breadcrumb', Breadcrumbs::render('event'))
@section("abstract", "PwC ailesi olarak Alumnilerimizle bir araya gelerek gerçekleştireceğimiz etkinlikleri bu sayfadan takip edebilirsiniz.")
@section("abstract_detail", "Sektör toplantıları, hobi kulüpleri ve sosyal aktivitelerde bir araya gelerek keyifle vakit geçirip özlem gidereceğiz.")
@section('main')
    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="card shadow vh-100">
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="fw-bolder" style="font-size: 1.35rem;">Etkinlik Medya İçeriği</span>
                    </h3>
                </div>
                <div class="card-body event_media_card_body">
                    @foreach ($event_medias as $i => $item)
                        <div class="col-md-12">
                            <a href="{{ $item->detail_link }}">
                                <div class="media_index_card card shadow card-flush mt-4 event_card_bgimage"
                                    style="background-image: url('{{ $item->poster }}');">
                                    <img class="visually-hidden-focusable" src="{{ $item->poster }}"
                                        alt="{{ $item->knowledge_title }}">
                                    <div class="card-body position-relative">
                                        <div class="date event_card_layer_media">
                                            <span class="day">{{ $item->creation_date }}</span>
                                        </div>
                                        <div class="position-absolute" style="bottom: 0;width: 100%;left: 0;">
                                            <div class="row g-3 g-lg-6">
                                                <div class="col-md-12">
                                                    <!--begin::Items-->
                                                    <div
                                                        class="bg-gray-100 bg-opacity-70 px-6 py-5 event_card_layer_bgimage">
                                                        <!--begin::Stats-->
                                                        <div class="m-0">
                                                            <!--begin::Number-->
                                                            <span
                                                                class="event_media_title_item">{{ $item->media_title }}</span>
                                                            <div class="pwc-fe-button mt-3 d-none">Detaylar</div>
                                                            <!--end::Number-->
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Items-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-9 col-xs-12">
            <div class="card shadow vh-100">
                <!--begin::Card header-->
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="fw-bolder" style="font-size: 1.35rem;">Etkinlikler</span>
                    </h3>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body overflow-scroll">
                    <!--begin::content-->
                    <div class="row">
                        @if ($events->count() == 0)
                            <h5 class="text-center">Yakın tarihte planlanan bir etkinliğimiz bulunmamaktadır.</h5>
                        @endif

                        <div class="table-responsive table_events">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th class="min-w-50px"></th>
                                        <th class="min-w-100px">Etkinlik yeri/tarihi</th>
                                        <th class="min-w-100px">Etkinlik adı/detayı</th>
                                        <th class="min-w-100px">Son kayıt tarihi</th>
                                        <th style="min-width: 210px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $i => $item)
                                        <tr>
                                            <td>
                                                <a class="events_link_table"
                                                    href="{{ route('events.show', $item->event_seo_url) }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-5 d-grid">
                                                            <img class="lazyload @if ($item->last_apply_date_due) grayscale_events_image @endif"
                                                                src="{{ route('storage.images', $item->event_poster) }}"
                                                                style="max-height: 57px;">
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="events_link_table"
                                                    href="{{ route('events.show', $item->event_seo_url) }}">
                                                    <div class="text-dark fw-bolder text-hover-primary d-block fs-6">
                                                        {{ $item->location }}</div>
                                                    <span
                                                        class="text-muted fw-bold text-muted d-block fs-7">{{ $item->event_start_date->format('d.m.Y') }}</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="events_link_table"
                                                    href="{{ route('events.show', $item->event_seo_url) }}">
                                                    <h3 class="d-flex justify-content-start flex-shrink-0">
                                                        {{ $item->event_title }}
                                                    </h3>
                                                    <span class="text-muted fw-bold text-muted d-block"
                                                        style="font-size: 16px;">{{ $item->mini_description }}</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="events_link_table"
                                                    href="{{ route('events.show', $item->event_seo_url) }}">
                                                    <div class="d-flex justify-content-start flex-shrink-0 text-muted">
                                                        {{ $item->event_last_apply_date->format('d.m.Y') }}
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                @if ($item->event_is_private)
                                                    <a class="btn w-100"
                                                        style="background-color: #E669A2; opacity:1;border-radius: 50px;"
                                                        href="{{ route('events.show', $item->event_seo_url) }}">
                                                        <img width="30" height="auto"
                                                            src="{{ url('static/alumni/assets/media/icons/davet_edildigi_etkinlik.svg') }}"
                                                            alt="Yaklaşan Etkinlik"><span
                                                            style="color: #fff;padding-left: 0.3rem; font-size: 16px;">Size
                                                            Özel</span>
                                                    </a>
                                                @else
                                                    <a class="btn w-100"
                                                        style="background-color: #F3BE26; opacity:1;border-radius: 50px;"
                                                        href="{{ route('events.show', $item->event_seo_url) }}">
                                                        <img width="30" height="auto"
                                                            src="{{ url('static/alumni/assets/media/icons/genel_etkinlik.svg') }}"
                                                            alt="Yaklaşan Etkinlik"><span
                                                            style="color: #fff;padding-left: 0.3rem; font-size: 16px;">Yaklaşan
                                                            Etkinlik</span>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end::content-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
        </div>
    </div>
@endsection
