@extends('alumni.layout.app')
@section('title', 'Duyurular')
@section('bg', url('static/alumni/assets/media/background/3.png'))
@section('breadcrumb', Breadcrumbs::render('announcement'))
@section("abstract", "PwC’den haberleri, Alumni ayrıcalıklarını, kariyer fırsatlarını ve etkinlik duyurularını buradan takip edebilirsiniz.")
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card shadow" id="anouncement_scroll_down">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <img src="{{ url('static/alumni/assets/media/icons/filtrele-icon.png') }}" alt="Filtrele">
                        <h3><span class="fw-bolder text-dark">Filtrele</span></h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Categories-->
                    <form action="{{ route('announcement.filter') }}" method="get" id="announcement_filter_checkbox">
                        @foreach ($categories as $category)
                            <div id="campaign-category-button">
                                <label class="cursor-pointer">
                                    <input @if (isset($posted['category']) && in_array($category->id, $posted['category'])) checked @endif class="d-none"
                                        name="category[]" type="checkbox" value="{{ $category->id }}">
                                    <span class="font-weight-bold line-height-normal px-8"
                                        style="font-size: 14px;">{{ $category->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </form>
                    <!--end::Categories-->
                </div>
                <!--end::Card body-->
                <!--end::Card body-->
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::content-->
                    <div class="row">
                        @foreach ($announcement as $i => $item)
                            <div class="feature_content_container col-md-3 col-xs-12 mt-4">
                                <a href="{{ route('announcement.show', $item->announcement_seo_url) }}"
                                    class="feature_content_panel"
                                    style="background-image: url('{{ route('storage.images', $item->announcement_poster) }}');">
                                    <div class="feature_content_text">
                                        <div class="alumni_dark_card_new_subject">
                                            <span style="font-size: 16px;">{{ $item->category->name }}</span>
                                            <span class="vertical_meta_sep"> | </span>
                                            <span style="font-size: 16px;"
                                                class="">{{ $item->created_at->translatedFormat('d F Y') }}</span>
                                        </div>
                                        <h2 class="feature_content_heading">
                                            <span>{{ $item->announcement_title }}</span>
                                        </h2>
                                        <div class="feature_content_wrapper" style="font-size: 16px;">
                                            <span>{{ $item->mini_description }}</span>
                                            <div class="pwc-fe-button mt-3 d-none">Detaylar</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        @if ($announcement->count() == 0)
                            <h5 class="text-center">İçerik bulunamadı</h5>
                        @endif
                    </div>
                    <div class="mt-15">
                        {{ $announcement->withQueryString()->links() }}
                    </div>
                    <!--end::content-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('input[name="category[]"]').on("click", function(e) {
            e.preventDefault();
            $('#announcement_filter_checkbox').submit();
            return false;
        });
    </script>
@endsection
