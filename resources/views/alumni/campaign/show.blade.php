@extends('alumni.layout.detailapp')
@section('title', $campaign->campaign_title)
@section('bg', route('storage.images', $campaign->campaign_poster))
@section('breadcrumb', Breadcrumbs::render('campaign-detail', $campaign))
@section('abstract', $campaign->campaign_abstract)
@section('main')
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="card-p mb-10 row" id="scroll_down_campaign_show">
                        <div class="col-md-6" id="ck_list">

                            @if ($campaign->already_joined)
                                <div class="text-gray-400 mt-5 mb-5" style="color: #d04a02 !important; font-size:16px;"><b>Bu
                                        ayrıcalığa
                                        {{ $campaign->campaign_join_at }} tarihinde katıldınız.</b></div>
                            @else
                                <div class="text-gray-400 mt-5 mb-5" style="color: #d04a02 !important; font-size:16px;">
                                    <b>Ayrıcalık Son
                                        Kullanım Tarihi: {{ $campaign->campaign_last_apply_date }} </b>
                                </div>
                            @endif
                        </div>
                        <hr style="color: rgba(125,125,125,0.5)">
                        <div class="col-md-12" id="ck_list">
                            <div style="font-size: 16px;">{!! $campaign->campaign_text !!}</div>
                            <div class="text-center mt-20">
                                <!-- if user already joined, show the coupon code -->
                                @if ($already_joined)
                                    <p class="text-uppercase" style="font-size: 16px; font-weight: bold;">
                                        Ayrıcalıktan yararlanın</p>
                                    <p><button title="Ayrıcalık kodunu kopyala!"
                                            data-clipboard-text="{{ $campaign->campaign_code }}" id="campaign_coupon_code"
                                            class="btn pwc-orange-button campaign-join-button">{{ $campaign->campaign_code }}</button>
                                    </p>
                                    <p id="campaign_code_copied" style="display: none">Ayrıcalık Kodu Kopyalanmıştır.</p>
                                    <!-- check if expired -->
                                @elseif ($expired)
                                    <span class="btn btn-danger"> Bu ayrıcalığın geçerlilik süresi dolmuş...</span>
                                    <!-- show user apply link if not expired and not joined before -->
                                @else
                                    <a href="{{ route('campaign.join', $campaign->campaign_seo_url) }}"
                                        class="text-uppercase btn pwc-orange-button campaign-join-button campaign_used_button">Ayrıcalıktan yararlanın</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            @foreach ($others as $i => $other)
                <div class="feature_content_container mt-3 mt-md-0 col-12 {{ $i > 0 ? 'mt-3' : '' }}">
                    <a href="{{ route('campaign.show', $other->campaign_seo_url) }}" class="feature_content_panel"
                        style="background-image: url('{{ route('storage.images', $other->campaign_poster) }}');">
                        <div class="feature_content_text">
                            <div class="alumni_dark_card_new_subject">
                                @if ($other->already_joined)
                                    <span>
                                        <div>Bu ayrıcalığa
                                            {{ $other->campaign_join_at }} tarihinde
                                            katıldınız.</div>
                                    </span>
                                @else
                                    <span><small>Ayrıcalık Son Kullanım Tarihi:</small></span>
                                    <span> <small>{{ $other->campaign_last_apply_date }}</small></span>
                                @endif
                            </div>
                            <h2 class="feature_content_heading">
                                <span>{{ $other->campaign_title }}</span>
                            </h2>
                            <div class="feature_content_wrapper" style="font-size: 16px;">
                                {!! Illuminate\Support\Str::words($other->campaign_text, 10) !!}
                                <div class="pwc-fe-button mt-3 d-none">Detaylar</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


@endsection

@section('js')
    <script src="{{ url('static/alumni/assets/js/custom/clipboard.min.js') }}"></script>
    <script>
        let clipboard = new ClipboardJS('#campaign_coupon_code');
        $("#campaign_coupon_code").click(function() {
            toastr.success("Ayrıcalık kodu kopyalanmıştır!");
        });


        if ($('.campaign_used_button:visible').length == 0) {
            console.log('campaign_used_button:visible');
            $('html,body').animate({
                scrollTop: $("#scroll_down_campaign_show").offset().top - 50 + 'px'
            }, 1000);
        }
    </script>
@endsection
