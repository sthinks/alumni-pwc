@extends('alumni.layout.app')
@section('title', 'Hobi Kulüpleri')
@section('bg', url('static/alumni/assets/media/background/8.png'))
@section('breadcrumb', Breadcrumbs::render('hobbies'))
@section("abstract", "Hobi kulüplerimize ilgi duyuyorsanız sizi de kulüp etkinliklerimizde görmek isteriz.")
@section("abstract_detail", "Birlikte keyifli zaman geçirmek, boş zamanınızda farklı bir şey denemek, yeni insanlarla tanışmak, yeni bir hobi edinmek isterseniz hobi kulüplerimizde sizleri de aramızda görmeyi çok isteriz. Siz hangi kulübümüze katılmak istersiniz?")
@section('main')
    <div class="card shadow card-xxl-stretch col-12">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::content-->
            <div class="row">
                @foreach ($hobbies as $i => $hobby)
                    <div class="feature_content_container col-md-3 col-xs-12 mt-4 lazy">
                        <a href="{{ route('hobbies.show', $hobby->hobby_seo_url) }}" class="feature_content_panel"
                            style="background-image: url('{{ route('storage.images', $hobby->hobby_poster) }}');">
                            <div class="feature_content_text">
                                <h2 class="feature_content_heading">
                                    <span>{{ $hobby->hobby_title }}</span>
                                </h2>
                                <div class="feature_content_wrapper">
                                    <div class="pwc-fe-button mt-3 d-none">Detaylar</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-15">
                {{ $hobbies->links() }}
            </div>
            <!--end::content-->
        </div>
        <!--end::Card body-->
    </div>
@endsection
