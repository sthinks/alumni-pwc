@extends('alumni.layout.app')
@section('title', 'Alumni Sohbetleri')
@section('bg', url('static/alumni/assets/media/background/4.png'))
@section('breadcrumb', Breadcrumbs::render('media'))
@section("abstract", "Alumnilerimizle yaptığımız sohbetleri keyifle okumanız ve izlemeniz dileğiyle.")
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">

                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::content-->
                    <div class="row">
                        @if ($media->count() == 0)
                            <h5 class="text-center">İçerik bulunamadı</h5>
                        @endif
                        @foreach ($media as $item)
                            <div class="col-md-3 col-xs-12">
                                <a href="{{ $item->detail_link }}">
                                    <div class="media_index_card card shadow card-flush mt-4 event_card_bgimage"
                                        style="background-image: url('{{ $item->poster }}'); ">
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
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-15">
                        {{ $media->links() }}
                    </div>
                    <!--end::content-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
@endsection
