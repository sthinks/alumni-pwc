@extends('alumni.layout.app')
@section('title', 'Knowledge & Development')
@section('bg', url('static/alumni/assets/media/background/6.png'))
@section('breadcrumb', Breadcrumbs::render('knowledge'))
@section('main')
    <div class="row">
        <div class="col-md-9">
            <div class="card shadow">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::content-->
                    <div class="row">
                        @if ($knowledge->count() == 0)
                            <h5 class="text-center">İçerik bulunamadı</h5>
                        @endif
                        @foreach ($knowledge as $i => $item)
                            <div class="feature_content_container col-md-4 col-xs-12 mt-4">
                                <a href="{{ route('knowledge.show', $item->knowledge_seo_url) }}"
                                    class="feature_content_panel"
                                    style="background-image: url('{{ route('storage.images', $item->knowledge_poster) }}');">
                                    <div class="feature_content_text">
                                        <div class="alumni_dark_card_new_subject">
                                            <span>{{ $item->created_at->translatedFormat('d F Y') }}</span>
                                        </div>
                                        <h2 class="feature_content_heading">
                                            <span>{{ $item->knowledge_title }}</span>
                                        </h2>
                                        <div class="feature_content_wrapper">
                                            <p>{{ $item->mini_description }}</p>
                                            <div class="pwc-fe-button mt-3 d-none">Detaylar</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-15">
                        {{ $knowledge->links() }}
                    </div>
                    <!--end::content-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="col-md-3">
            @foreach ($knowledge_featured as $i => $item)
                <a href="{{ route('knowledge.show', $item->knowledge_seo_url) }}">
                    <div class="card mt-5 shadow jobs-post"
                        style="height: 400px; background-size: cover !important; background-image: url('{{ route('storage.images', $item->knowledge_poster) }}');">
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column pt-12 p-9" style="background: linear-gradient(to top, rgba(0, 0, 0, 0.85), transparent);
                                                            justify-content: flex-end;">
                            <h4>{{ $item->knowledge_title }}</h4>
                            <h6 class="text-white">{{ $item->mini_description }}</h6>
                            <div style="display: flex; justify-content: center">
                                <div class="pwc-fe-button mt-3">Detaylar</div>
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
