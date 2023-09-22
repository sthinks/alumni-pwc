@extends('alumni.layout.app')
@section('title', 'Ayrıcalıklar')
@section('bg', url('static/alumni/assets/media/background/2.png'))
@section('breadcrumb', Breadcrumbs::render('campaign'))
@section("abstract", "PwC Ailesine özel ayrıcalıklarımıza bu sayfadan ulaşabilirsiniz.")
@section('main')
    @include('alumni.campaign.permission')
    <div class="row">
        <div class="col-12">
            <div class="card card-xxl-stretch" id="scroll_filter_down">
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
                    <form action="{{ route('campaign.filter') }}" method="get" id="campaign_filter_checkbox">
                        @foreach ($categories as $category)
                            <div id="campaign-category-button">
                                <label class="cursor-pointer  ">
                                    <input @if (isset($posted['category']) && in_array($category->id, $posted['category'])) checked @endif
                                        class="d-none checked_campaign_true" name="category[]" type="checkbox"
                                        value="{{ $category->id }}">
                                    <span style="font-size: 14px;">{{ $category->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </form>
                    <!--end::Categories-->
                </div>
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
                        @foreach ($campaigns as $campaign)
                            <div class="feature_content_container col-md-3 col-xs-12 mt-4">
                                <a href="{{ route('campaign.show', $campaign->campaign_seo_url) }}"
                                    class="feature_content_panel"
                                    style="background-image: url('{{ route('storage.images', $campaign->campaign_poster) }}');">
                                    <div class="feature_content_text">
                                        <div class="alumni_dark_card_new_subject">
                                            @if ($campaign->already_joined)
                                                <span>
                                                    Bu ayrıcalığa
                                                    {{ $campaign->campaign_join_at }} tarihinde
                                                    katıldınız.
                                                </span>
                                            @else
                                                <span>
                                                    Ayrıcalık Son Kullanım Tarihi:
                                                </span>
                                                <span>
                                                    {{ $campaign->campaign_last_apply_date }}
                                                </span>
                                            @endif
                                        </div>
                                        <h2 class="feature_content_heading">
                                            <span>{{ $campaign->campaign_title }}</span>
                                        </h2>
                                        <div class="feature_content_wrapper" style="font-size: 16px;">
                                            <span>{!! $campaign->campaign_abstract !!}</span>
                                            <div class="pwc-fe-button mt-3 d-none">Detaylar</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $campaigns->withQueryString()->links() }}
@endsection
@section('js')
    <script src="{{ url('js/axios.min.js') }}"></script>
    <script>
        function sendPermission() {
            const query = $("#permission_form").serialize();
            axios.post('{{ route('permission.update') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    if (status === "success") {
                        toastr.success("İzinler başarıyla güncellenmiştir.");
                        $("#campaign_permission_area").hide();
                    } else {
                        toastr.error("İzinler güncellenirken bir hata oluştu.");
                    }
                });
            return false;
        }
        $('input[name="category[]"]').on("click", function(e) {
            e.preventDefault();
            $('#campaign_filter_checkbox').submit();
            return false;
        });
    </script>
@endsection
