@extends('alumni.layout.detailapp')
@section('title', $event->event_title)
@section('bg', route('storage.images', $event->event_poster))
@section('breadcrumb', Breadcrumbs::render('event-detail', $event))
@section('abstract', $event->event_abstract)
@section('main')

    <div>
        <!--begin::Post card-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body pb-lg-20">
                <!--begin::Container-->
                <div class="row events-detail-info">
                    <div class="col-md-3 col-xs-12"><span>Tarih:</span> {{ $event->event_start_date->format('d.m.Y') }}
                    </div>
                    <div class="col-md-3 col-xs-12"><span>Saat:</span> {{ $event->event_start_date->format('H:i') }}</div>
                    <div class="col-md-3 col-xs-12"><span>Lokasyon:</span> {{ $event->event_venue }}</div>
                    <div class="col-md-3 col-xs-12"><span>Son başvuru tarihi:</span>
                        {{ $event->event_last_apply_date->format('d.m.Y H:i') }}</div>
                </div>
                <div class="mt-5" id="ck_list">
                    {!! $event->event_description !!}
                </div>
                <!--begin::Action-->
                @if ($event->already_joined)
                    <form action="{{ route('events.disjoin', $event->event_seo_url) }}" method="post">
                        @csrf
                        <button type="submit"
                            class="btn btn-secondary d-flex line-height-normal px-20 mt-5">Etkinlik kaydınızı iptal etmek için tıklayınız</button>
                    </form>
                @elseif ($event->last_apply_date_due)
                    <button type="button" class="btn btn-danger d-flex line-height-normal px-20 mt-5">Son Başvuru Tarihi
                        Geçmiştir</button>

                        <p class="mt-3 text-muted"><a href="mailto:pwctr.alumni@pwc.com">pwctr.alumni@pwc.com</a> mail adresinden
                    bizimle iletişime
                    geçebilirsiniz</p>
                @else
                    <form action="{{ route('events.join', $event->event_seo_url) }}" method="post">
                        @csrf
                        <button
                            @if ($event->hobby_event && !$event->hobby_event_user_joined) onclick="return confirm('Bu etkinlik {{ $event->hobby_club }} kulübüne aittir. Katılmanız sonucunda otomatik olarak hobi kulübüne üye olacaksınız.')" @endif
                            type="submit"
                            class="btn d-flex line-height-normal pwc-orange-button px-20 mt-5">Etkinliğe katılmak için tıklayınız</button>
                    </form>
                @endif
                <!--end::Action-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Post card-->
    </div>
@endsection
