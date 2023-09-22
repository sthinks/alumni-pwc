@extends('alumni.layout.detailapp')
@section('title', $media->media_title)
@section('bg', $media->poster)
@section('breadcrumb', Breadcrumbs::render('media-detail', $media))
@section('abstract', $media->media_abstract)
@section('main')
    <div>
        <div class="card shadow-sm">
            <div class="col-md-12 col-xs-12">
                <div class="card-body p-0">
                    <div class="card-p mb-10" id="ck_list">
                        <div class="row">
                            <div class="col-md-6">
                                <div style="font-size: 16px">
                                    {!! $media->media_description !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                @foreach ($media->videos as $video)
                                    <!--begin::HTML5-->
                                    {!! $video !!}
                                    <!--end::HTML5-->
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <ul class="knowledge_file_list">
                                @foreach ($media->documents as $document)
                                    <li>
                                        <img class="knowledge_file_img" height="50" width="40"
                                            src="{{ url('static/alumni/assets/media/svg/files/' . \App\Helpers\StrHelper::getFileExtension($document) . '.svg') }}"
                                            alt="Ekli Dosyayı İndir">
                                        <a target="_blank" href="{{ $document }}"
                                            class="text-gray-800 text-hover-primary d-flex flex-column p-5">
                                            <!--begin::Title-->
                                            <div class="fs-5 fw-bolder mb-2">
                                                {{ \App\Helpers\FileHelper::extractFileName($document) }}</div>
                                            <!--end::Title-->
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Body-->
            <div class="card-body p-0">
                <div class="card-p">
                    <div class="row">
                        @foreach ($media->images as $image)
                            <!--begin::İmage-Content-->
                            <div class="col-md-3 col-xs-12 mt-5">
                                <!--begin::Overlay-->
                                <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{ $image }}">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('{{ $image }}')">
                                    </div>
                                    <!--end::Image-->

                                    <!--begin::Action-->
                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                    </div>
                                    <!--end::Action-->
                                </a>
                                <!--end::Overlay-->
                            </div>
                        @endforeach
                        <!--end::İmage-Content-->
                    </div>
                </div>
            </div>
            <!--end::body-->
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('static/alumni/assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

@endsection
@section('css')

@endsection
