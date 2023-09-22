@extends('alumni.layout.detailapp')
@section('title', $hobby->hobby_title)
@section('bg', route('storage.images', $hobby->hobby_poster))
@section('breadcrumb', Breadcrumbs::render('hobby-detail', $hobby))
@section('abstract', $hobby->hobby_abstract)
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="card-p mb-10" id="ck_list">
                        @if ($hobby->already_joined)
                            <form action="{{ route('hobbies.disjoin', $hobby->hobby_seo_url) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-secondary float-md-end">{{ $hobby->hobby_title }}
                                    kulübünden ayrıl</button>
                            </form>
                        @else
                            <form action="{{ route('hobbies.join', $hobby->hobby_seo_url) }}" method="post">
                                @csrf
                                <button type="submit" class="btn pwc-yellow-button float-md-end">{{ $hobby->hobby_title }}
                                    kulübüne katıl</button>
                            </form>
                        @endif
                        <div class="mb-3 d-table">
                            <img class="hobby-avatar"
                                src="{{ route('storage.images', $hobby->hobby_responsible_avatar) }}"
                                alt="{{ $hobby->hobby_responsible }}">
                            <div class="hobby-responsible">
                                <span>{{ $hobby->hobby_responsible }}</span>
                                <span class="text-muted">{{ $hobby->hobby_responsible_role }}</span>
                            </div>
                        </div>
                        {!! $hobby->hobby_description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($hobby_events->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card col-md-12">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-dark" style="font-size: 1.35rem;">Etkinlikler</span>
                        </h3>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::content-->
                        <div class="row">
                            <div class="table-responsive table_events">
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <thead>
                                        <tr class="fw-bolder text-muted">
                                            <th class="min-w-50px"></th>
                                            <th class="min-w-100px">Etkinlik Yeri/Tarihi</th>
                                            <th class="min-w-100px">Etkinlik Adı/Açıklama</th>
                                            <th class="min-w-100px">Son Başvuru Tarihi</th>
                                            <th style="min-width: 210px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hobby_events as $i => $item)
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
    @endif
    @if ($hobby_medias->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card col-md-12">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-dark" style="font-size: 1.35rem;">Medyalar</span>
                        </h3>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::content-->
                        <div class="row">
                            @foreach ($hobby_medias as $i => $item)
                                <div class="col-md-3 card_space">
                                    <!--begin::Hot sales post-->
                                    <a href="{{ $item->detail_link }}">
                                        <div class="media_index_card card shadow card-flush mt-4 event_card_bgimage"
                                            style="background-image: url({{ $item->poster }})">
                                            <img class="visually-hidden-focusable" src="{{ $item->poster }}"
                                                alt="{{ $item->knowledge_title }}">
                                            <!--begin::Overlay-->
                                            <!--end::Overlay-->
                                            <div class="card-body position-relative">
                                                <!--begin::Body-->
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
                                                                    <!--end::Number-->
                                                                    <div class="pwc-fe-button mt-3 d-none">Detaylar</div>
                                                                </div>
                                                                <!--end::Stats-->
                                                            </div>
                                                            <!--end::Items-->
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                        </div>
                                    </a>
                                    <!--end::Hot sales post-->
                                </div>
                            @endforeach
                            <!--end::content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
