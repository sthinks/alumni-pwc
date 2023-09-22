@extends('alumni.layout.detailapp')
@section('title', $knowledge->knowledge_title)
@section('bg', route('storage.images', $knowledge->knowledge_poster))
@section('breadcrumb', Breadcrumbs::render('knowledge-detail', $knowledge))
@section('abstract', $knowledge->knowledge_abstract)
@section('main')
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="card-p mb-10" id="ck_list">
                        <div class="content-image">
                            <img class="mw-100 mh-300px card-rounded-bottom" alt="{{ $knowledge->knowledge_title }}"
                                src="{{ route('storage.images', $knowledge->knowledge_poster) }}" />
                        </div>
                        <h2 class="p-5">{{ $knowledge->knowledge_title }}</h2>
                        {!! $knowledge->knowledge_text !!}
                        <div class="row">
                            <ul class="knowledge_file_list">
                                @foreach ($knowledge->documents as $document)
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

                        <div class="card-body p-0">
                            <div class="card-p">
                                @if (count($knowledge->videos) > 0)
                                    <h3 class="knowledge_video_title">Videolar</h3>
                                @endif
                                <div class="row">
                                    @foreach ($knowledge->videos as $video)
                                        <div class="col-md-6 col-xs-12" id="knowledge_video_size">
                                            <!--begin::HTML5-->
                                            {!! $video !!}
                                            <!--end::HTML5-->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <div class="card-body p-0">
                            <div class="card-p">
                                @if (count($knowledge->images) > 0)
                                    <h3 class="knowledge_photo_title">Görseller</h3>
                                @endif
                                <div class="row">
                                    @foreach ($knowledge->images as $image)
                                        <!--begin::İmage-Content-->
                                        <div class="col-md-4 col-xs-12 mt-5">
                                            <!--begin::Overlay-->
                                            <a class="d-block overlay" data-fslightbox="lightbox-basic"
                                                href="{{ $image }}">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            @foreach ($others as $i => $other)
                <div class="card shadow {{ $i > 0 ? 'mt-3' : '' }}">
                    <img src="{{ route('storage.images', $other->knowledge_poster) }}" class="card-img-top"
                        alt="{{ $other->knowledge_title }}">
                    <div class="card-body">
                        <h2 class="card-title">{{ $other->knowledge_title }}</h2>
                        <p class="card-text p-3">{{ $other->mini_description }}</p>
                        <a href="{{ route('knowledge.show', $other->knowledge_seo_url) }}"
                            class="btn pwc-orange-button line-height-normal">Detaylı Bilgi</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('static/alumni/assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

@endsection
