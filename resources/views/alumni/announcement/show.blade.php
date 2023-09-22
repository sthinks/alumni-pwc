@extends('alumni.layout.detailapp')
@section('title', $announcement->announcement_title)
@section('bg', route('storage.images', $announcement->announcement_poster))
@section('breadcrumb', Breadcrumbs::render('announcement-detail', $announcement))
@section('abstract', $announcement->announcement_abstract)
@section('main')

    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="card-p mb-10" id="ck_list" style="font-size: 16px;">
                        {!! $announcement->announcement_text !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            @foreach ($suggestions as $i => $suggest)
                <div class="feature_content_container {{ $i > 0 ? 'mt-3' : '' }}">
                    <a href="{{ route('announcement.show', $suggest->announcement_seo_url) }}" target="_blank"
                        class="feature_content_panel"
                        style="background-image: url('{{ route('storage.images', $suggest->announcement_poster) }}');">
                        <div class="feature_content_text">
                            <h2 class="feature_content_heading">
                                <span>{{ $suggest->announcement_title }}</span>
                            </h2>
                            <div class="feature_content_wrapper" style="font-size: 16px;">
                                <p>{{ $suggest->mini_description }}</p>
                                <div class="pwc-fe-button mt-3 d-none">Detaylar</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>


@endsection
