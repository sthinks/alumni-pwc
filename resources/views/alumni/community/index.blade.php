@extends('alumni.layout.app')
@section('title', 'Alumni Topluluğu')
@section('bg', url('static/alumni/assets/media/background/1.png'))
@section('breadcrumb', Breadcrumbs::render('community'))
@section("abstract", "PwC Türkiye ailesi yeniden bir araya geliyor.")
@section("abstract_detail")
    Bu bölüme erişmek için gerekli izni <b>{{ auth()->user()->getConsent('directory')->created_at->format('d/m/Y') }}</b> tarihinde verdiniz.
@endsection
@section('main')
    <div class="row" id="community_index">
        <div class="col-md-9 col-xs-12">
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header arrangement-top-card">
                    <!--begin::Controls-->
                    <div class="d-flex flex-wrap">
                        <!--begin::Tab nav-->
                        <p>Sıralama</p>
                        <!--end::Tab nav-->
                        <!--begin::Wrapper-->
                        <div class="my-0">
                            <!--begin::Select-->
                            <form action="{{ route('community.filter') }}" method="get">
                                <select name="order" onchange="this.form.submit()" data-control="select2"
                                        data-hide-search="true" class="form-select form-select-sm w-150px">
                                    <option value="1" @if (empty($posted['order']) || $posted['order'] == 1) selected @endif)>Alfabetik</option>
                                    <option value="2" @if (isset($posted['order']) && $posted['order'] == 2) selected @endif>Eskiden yeniye
                                    </option>
                                    <option value="3" @if (isset($posted['order']) && $posted['order'] == 3) selected @endif>Yeniden eskiye
                                    </option>
                                </select>
                                <!--end::Select-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Controls-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::content-->
                    <div class="row">
                        @foreach ($users as $i => $user)
                            <div class="col-md-4 col-xs-12 content-margin-top">
                                <div class="card shadow">
                                    <div class="card-body p-2 text-center">
                                        <div class="community-avatar mt-2">
                                            <img src="{{ $user->avatar }}"
                                                style="object-fit: cover;" alt="{{ $user->name }}">
                                        </div>
                                        <h6 class="mt-3">{{ $user->name }}</h6>
                                        <p class="mt-5 h-40px">{{ $user->current_work_company ?? '???' }}</p>
                                        <p class="h-50px">{{ $user->current_work_role ?? '???' }}</p>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#user_{{ $user->id }}"
                                            class="btn btn-outline btn-outline-danger btn-active-light-danger pb-1 pt-1 mb-3 pwc-outline-red-button">Profili
                                            Görüntüle</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-15">
                        {{ $users->withQueryString()->links() }}
                    </div>
                    <!--end::content-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="card mt-4 mt-md-0">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <img src="{{ url('static/alumni/assets/media/icons/filtrele-icon.png') }}" alt="Filtrele">
                        <h3><span class="fw-bolder text-dark">Filtrele</span></h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-5 mt-3">
                    <form id="community_filter_form" method="get">
                        <div class="mb-10">
                            <label for="company" class="form-label">Ad</label>
                            <input id="company" placeholder="Ad" value="{{ $name ?? '' }}" name="first_name" type="text"
                                class="form-control" />
                        </div>
                        <div class="mb-10">
                            <label for="position" class="form-label">Soyad</label>
                            <input id="position" placeholder="Soyad" value="{{ $surname ?? '' }}" name="surname"
                                type="text" class="form-control" />
                        </div>
                        <div class="mb-10">
                            <label for="level" class="form-label">Çalıştığı ekip (LoS)</label>
                            <select name="pwc_worked_team_los" id="pwc_worked_team_los" class="form-select"
                                data-placeholder="Seçim Yapınız">
                                <option selected></option>
                                @foreach ($team_los as $item)
                                    <option value="{{ $item->id }}" @if (isset($posted['pwc_worked_team_los']) && $posted['pwc_worked_team_los'] == $item->id) selected @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="level" class="form-label">Çalıştığı ekip (SubLoS)</label>
                            <select name="pwc_worked_team_sublos" id="pwc_worked_team_sublos" class="form-select"
                                data-placeholder="Seçim Yapınız">
                                <option selected></option>
                                @foreach ($team_sublos as $item)
                                    <option value="{{ $item->id }}" @if (isset($posted['pwc_worked_team_sublos']) && $posted['pwc_worked_team_sublos'] == $item->id) selected @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="pwc_worked_office" class="form-label">Çalıştığı ofis</label>
                            <select name="pwc_worked_office" id="pwc_worked_office" class="form-select"
                                data-placeholder="Ofis Seçiniz">
                                <option selected></option>
                                @foreach ($pwc_offices as $pwc_office)
                                    <option value="{{ $pwc_office->id }}"
                                        @if (isset($posted['pwc_worked_office']) && $posted['pwc_worked_office'] == $pwc_office->id) selected @endif>{{ $pwc_office->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="city" class="form-label">Giriş yılı</label>
                            <select name="pwc_join_year" class="form-select" data-placeholder="Yıl Seçiniz">
                                <option></option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" @if (isset($posted['pwc_join_year']) && $posted['pwc_join_year'] == $year) selected @endif>
                                        {{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="city" class="form-label">Çıkış yılı</label>
                            <select name="pwc_quit_year" class="form-select" data-placeholder="Yıl Seçiniz">
                                <option></option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" @if (isset($posted['pwc_quit_year']) && $posted['pwc_quit_year'] == $year) selected @endif>
                                        {{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn pwc-yellow-button w-100 line-height-normal"
                                onclick="communitySubmit();">Uygula</button>
                        </div>
                        <div class="mt-4">
                            <button type="reset" class="btn btn-secondary fw-bolder w-100 line-height-normal"
                                id="reset_filter_form_button" onclick="communityReset();">Temizle</button>
                        </div>
                    </form>
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
    <!-- begin::user modals -->
    @foreach ($users as $i => $user)
        <div class="modal fade" tabindex="-1" id="user_{{ $user->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body"
                        style="background: url('{{ url('static/alumni/assets/media/background/directory_modal_bg.png') }}'); background-size:cover;">
                        <div class="community-avatar mt-2 mb-2 text-center">
                            <img src="{{ $user->avatar }}"
                                style="object-fit: cover;" alt="{{ $user->name }}">
                            <h6 class="mt-3">{{ $user->name }}</h6>
                            @if($user->linkedin) <a class="linkedin-color" href="{{ $user->linkedin }}" target="_blank">
                                <!--begin::Linkedin SVG-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34"
                                     class="global-nav__logo">
                                    <title>
                                        LinkedIn
                                    </title>

                                    <g>
                                        <!---->
                                        <path
                                            d="M34,2.5v29A2.5,2.5,0,0,1,31.5,34H2.5A2.5,2.5,0,0,1,0,31.5V2.5A2.5,2.5,0,0,1,2.5,0h29A2.5,2.5,0,0,1,34,2.5ZM10,13H5V29h5Zm.45-5.5A2.88,2.88,0,0,0,7.59,4.6H7.5a2.9,2.9,0,0,0,0,5.8h0a2.88,2.88,0,0,0,2.95-2.81ZM29,19.28c0-4.81-3.06-6.68-6.1-6.68a5.7,5.7,0,0,0-5.06,2.58H17.7V13H13V29h5V20.49a3.32,3.32,0,0,1,3-3.58h.19c1.59,0,2.77,1,2.77,3.52V29h5Z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                                <!--end::Linkedin SVG-->
                            </a> @endif
                        </div>
                        <div class="full-width-title mb-2">
                            <h1>Güncel Bilgiler</h1>
                        </div>
                        <h6 class="mt-5">Çalıştığı şirketin adı</h6>
                        <p>{{ $user->current_work_company ?? '???' }}</p>
                        <h6>Çalıştığı şirketteki görevi</h6>
                        <p>{{ $user->current_work_role ?? '???' }}</p>
                        <div class="full-width-title mb-2">
                            <h1>PwC Bilgileri</h1>
                        </div>
                        <h6 class="mt-5">Şirket unvanı</h6>
                        <p>{{ optional($user->pwcLegacy)->name ?? '???' }}</p>
                        <h6>Çalıştığı ekip (Los)</h6>
                        <p>{{ optional($user->pwcWorkedTeamLos)->name ?? '???' }}</p>
                        <h6>Çalıştığı ekip (SubLos)</h6>
                        <p>{{ optional($user->pwcWorkedTeamSubLos)->name ?? '???' }}</p>
                        <h6>Çalıştığı yıl aralığı</h6>
                        <p>{{ optional($user->pwc_join_year)->format('Y') ?? '???' }} -
                            {{ optional($user->pwc_quit_year)->format('Y') ?? '???' }}</p>
                        <h6>Çalıştığı ofis</h6>
                        <p>{{ optional($user->pwcWorkedOffice)->name ?? '???' }}</p>
                    </div>

                    <div class="px-8 pb-8 d-grid">
                        <a href="{{ route('chat.show', $user->uid) }}" type="button"
                            class="btn pwc-orange-button font-weight-bold">Mesaj Gönder</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- end::user modals -->
@endsection

@section('js')
    <script>
        $("#pwc_worked_office").select2({
            allowClear: true
        });
        $("[name='pwc_join_year']").select2({
            allowClear: true
        });
        $("[name='pwc_quit_year']").select2({
            allowClear: true
        });
        $("[name='pwc_worked_team_los']").select2({
            allowClear: true
        });
        $("[name='pwc_worked_team_sublos']").select2({
            allowClear: true
        });

        function communityReset() {
            $("[name='first_name']").removeAttr('value');
            $("[name='surname']").removeAttr('value');

            $("#pwc_worked_office > option").removeAttr("selected");
            $("#pwc_worked_office").trigger("change");
            $("[name='pwc_join_year'] > option").removeAttr("selected");
            $("[name='pwc_join_year']").trigger("change");
            $("[name='pwc_quit_year'] > option").removeAttr("selected");
            $("[name='pwc_quit_year']").trigger("change");
            $("[name='pwc_worked_team_los'] > option").removeAttr("selected");
            $("[name='pwc_worked_team_los']").trigger("change");
            $("[name='pwc_worked_team_sublos'] > option").removeAttr("selected");
            $("[name='pwc_worked_team_sublos']").trigger("change");
        }
    </script>
@endsection
