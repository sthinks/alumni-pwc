@extends('alumni.layout.app')
@section('title', 'Kariyer Fırsatları')
@section('bg', url('static/alumni/assets/media/background/5.png'))
@section('breadcrumb', Breadcrumbs::render('jobs'))
@section("abstract", "Yeni bir iş fırsatı arıyorsanız bu sayfayı takip edebilir, paylaşmak istediğiniz bir iş ilanı varsa bize iletebilirsiniz.")
@section('main')
    @include('alumni.job.permission', ['skills' => $skills, 'users_skills' => $user_skills])
    <div class="row jobs_index_card">
        <div class="card col-md-9 col-xs-12">
            <!--begin::Card header-->
            <div class="card-header arrangement-top-card">
                <!--begin::Controls-->
                <div class="d-flex flex-wrap my-1">
                    <!--begin::Tab nav-->
                    <p>Sıralama</p>
                    <!--end::Tab nav-->
                    <!--begin::Wrapper-->
                    <div class="my-0">
                        <!--begin::Select-->
                        <form action="{{ route('jobs.filter') }}" method="get">
                            <select name="order" onchange="this.form.submit()" data-control="select2"
                                data-hide-search="true" class="form-select form-select-sm w-150px">
                                <option value="1" @if (empty($posted['order']) || $posted['order'] == 1) selected @endif)>Önerilen</option>
                                <option value="2" @if (isset($posted['order']) && $posted['order'] == 2) selected @endif>Eskiden yeniye</option>
                                <option value="3" @if (isset($posted['order']) && $posted['order'] == 3) selected @endif>Yeniden eskiye</option>
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
                    @if ($jobs->count() == 0)
                        <h5 class="text-center">İçerik bulunamadı</h5>
                    @endif
                    @foreach ($jobs as $i => $job)
                        <div class="col-md-12 col-xs-12 mt-10">
                            <div class="card shadow job-card card_box_shadow noselect">
                                <div class="card-header">
                                    <h2 class="mt-5">{{ $job->job_title }}</h2>
                                </div>
                                <a href="{{ route('jobs.show', $job->job_seo_url) }}" class="job_index_image">
                                </a>
                                <div class="card-body p-2">
                                    <div class="row job-offers">
                                        <div class="col-md-3">
                                            <!--begin::Stats-->
                                            <div class="jobs-mobile-text">
                                                <div>Şirket adı</div>
                                                <p>{{ $job->job_company_visible ? $job->job_company : 'Gizli' }}</p>
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <div class="col-md-5">
                                            <!--begin::Stats-->
                                            <div class="jobs-mobile-text">
                                                <div>Pozisyon adı</div>
                                                <p>{{ $job->job_position }}</p>
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <div class="col-md-2">
                                            <!--begin::Stats-->
                                            <div class="jobs-mobile-text">
                                                <div>Deneyim</div>
                                                <p>{{ $job->job_experience }} yıl</p>
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <div class="col-md-2">
                                            <!--begin::Stats-->
                                            <div class="jobs-mobile-text">
                                                <div>Lokasyon</div>
                                                <p>{{ $job->location->city }}</p>
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                    </div>
                                    <div class="row border-top border-bottom mt-3 pt-3 pb-3 m-auto">
                                        <div class="col-6">İlan tarihi:
                                            {{ $job->created_at->translatedFormat('d F Y') }}</div>
                                        <div class="col-6">Geçerlilik tarihi:
                                            {{ $job->job_valid_till->translatedFormat('d F Y') }}</div>
                                    </div>
                                    <div class="row mt-5 mb-3">
                                        <div class="col-12 text-center view-job">
                                            <a href="{{ route('jobs.show', $job->job_seo_url) }}">İlan
                                                Detayını
                                                Görüntüle</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-15">
                    {{ $jobs->withQueryString()->links() }}
                </div>
                <!--end::content-->
            </div>
            <!--end::Card body-->
        </div>
        <div class=" col-md-3 col-xs-12">
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <img src="{{ url('static/alumni/assets/media/icons/filtrele-icon.png') }}" alt="Filtrele">
                        <h3 class="gray_text_header">Filtrele</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-2 mt-3">
                    <form id="jobs_filter_form" method="get">
                        <div class="mb-10">
                            <label for="company" class="form-label">Şirket adı</label>
                            <input id="company" placeholder="Şirket adı" value="{{ $posted['company'] ?? '' }}"
                                name="company" type="text" class="form-control" />
                        </div>
                        <div class="mb-10">
                            <label for="position" class="form-label">Pozisyon adı</label>
                            <input id="position" placeholder="Pozisyon adı" value="{{ $posted['position'] ?? '' }}"
                                name="position" type="text" class="form-control" />
                        </div>
                        <div class="mb-10">
                            <label for="level" class="form-label">Pozisyon seviyesi</label>
                            <input id="level" placeholder="Pozisyon seviyesi" value="{{ $posted['level'] ?? '' }}"
                                name="level" type="text" class="form-control" />
                        </div>
                        <div class="mb-10">
                            <label for="city" class="form-label">Lokasyon</label>
                            <select name="city" class="form-select" data-control="select2" data-placeholder="İl Seçiniz">
                                <option></option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if (isset($posted['city']) && $posted['city'] == $city->id) selected @endif>
                                        {{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="experience" class="form-label">Deneyim</label>
                            <input id="experience" placeholder="Deneyim" value="{{ $posted['experience'] ?? '' }}"
                                name="experience" type="text" class="form-control" />
                        </div>
                        <div class="mb-10">
                            <button type="submit" class="btn m-auto w-100 pwc-yellow-button ml-desktop-1">Uygula</button>
                        </div>
                        <div id="jobs_filter_form_message"></div>
                    </form>
                </div>
                <!--end::Card body-->
            </div>
            <!--begin::Card-->
            <div class="card mt-5 shadow jobs-post"
                style="height: 400px; background-size: cover !important; background: url({{ url('static/alumni/assets/media/background/jobs-post-bg.png') }});">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                    <h4>İş İlanı Paylaş</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#new_jobs_posted"
                        class="btn jobs-post-button line-height-normal">Paylaş</button>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--Begin::Modal(Jobs Posted)-->
            <div class="modal fade" tabindex="-1" id="new_jobs_posted">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="post" id="form_new_jobs_posted">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="fullname">Şirket adı</label>
                                            <input type="text" name="company" class="form-control" id="company"
                                                aria-describedby="company" placeholder="Şirket adı" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="personal-email">Pozisyon adı</label>
                                            <input type="text" name="position" class="form-control" id="position"
                                                aria-describedby="position" placeholder="Pozisyon adı" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="phone_number">Pozisyon seviyesi</label>
                                            <input type="text" name="level" class="form-control" id="level"
                                                placeholder="Pozisyon seviyesi" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="phone_number">Lokasyon</label>
                                            <select type="text" name="location" class="form-control" id="location"
                                                placeholder="Lokasyon" required>
                                                <option></option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        @if (isset($posted['city']) && $posted['city'] == $city->id) selected @endif>
                                                        {{ $city->city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="phone_number">Deneyim</label>
                                            <input type="number" name="experience" class="form-control" id="experience"
                                                placeholder="Deneyim" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="detail">Detay</label>
                                            <textarea name="detail" class="form-control" id="detail" rows="3" placeholder="Detay" required></textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="phone_number">İlan tarihi</label>
                                            <input type="date" name="date" class="form-control" id="date"
                                                placeholder="İlan tarihi" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="phone_number">Geçerlilik tarihi</label>
                                            <input type="date" name="valid_till" class="form-control" id="date"
                                                placeholder="Geçerlilik tarihi" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="phone_number">İrtibat (E-mail - Başvuru linki)</label>
                                            <input type="text" name="link" class="form-control" id="link"
                                                placeholder="İrtibat (E-mail - Başvuru linki)" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <label for="skills" class="form-label">Yetenekler</label>
                                        <select name="skills[]" required id="skills" class="form-select form-select-solid" data-control="select2" data-placeholder="Lütfen pozisyon için gereken yetenekleri seçiniz" data-allow-clear="true" multiple="multiple">
                                            <option></option>
                                            @foreach ($skills as $skill)
                                                <option value="{{ $skill->name }}">
                                                    {{ $skill->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button class="btn pwc-orange-button text-uppercase">Paylaş</button>
                                <hr>
                                <p>Paylaştığınız ilan kontrollerden sonra uygun görülmesi durumunda yayınlanacaktır.</p>
                                <div id="form_new_jobs_posted_message"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End::Modal(Jobs Posted)-->
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-sm-row flex-column">
                        <div><img src="{{ url('images/iskur.png') }}" alt="İşkur izni" /></div>
                        <div>
                            <p><b style="color: #000 !important;">İzin Belgesi Bildirimi</b></p>
                            <p style="color: #000 !important;">PwC Yönetim Danışmanlığı A.Ş., Türkiye İş Kurumunun 24/12/2021 tarihli ve 1035 numaralı izin belgesi ile Özel İstihdam Bürosu olarak faaliyet göstermektedir. İzin belgesi İstanbul Çalışma ve İş Kurumu İl Müdürlüğü tarafından düzenlenmiştir. 4904 sayılı Türkiye İş Kurumu Kanunu uyarınca iş arayandan ücret alınması yasaktır.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('js/axios.min.js') }}"></script>
    <script src="{{ url('js/helper.js') }}"></script>
    <script>
        const form = document.getElementById('form_new_jobs_posted');
        form.addEventListener('submit', event => {
            event.preventDefault();
            postForm('{{ route('jobs.share') }}', 'form_new_jobs_posted', "#form_new_jobs_posted_message");
        });
        function sendPermission() {
            const query = $("#permission_form").serialize();
            axios.post('{{ route('permission.update') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    if (status === "success") {
                        toastr.success("İzinler başarıyla güncellenmiştir.");
                        window.location.hash = '#skills_form';
                        window.location.reload(true);
                    } else {
                        toastr.error("İzinler güncellenirken bir hata oluştu.");
                    }
                });
            return false;
        }
        $("form#skills_form").on("submit", function(e) {
            document.getElementById('save_skills_spinner').innerHTML = `<div class="spinner-border spinner-border-sm" id="spinner_verify_mail" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>`;
            $('#save_skills').css("visibility", "hidden");
            e.preventDefault();
            const query = $("#skills_form").serialize();
            axios.post('{{ route('profile.skills') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    if (status === "success") {
                        toastr.success("Yetenekler başarı ile güncellenmiştir.");
                    } else {
                        toastr.error("Yetenekler güncellenirken bir hata oluştu.");
                    }
                    $('#save_skills_spinner').hide();
                    $('#save_skills').css("visibility", "visible");
                });
            return false;
        });
    </script>
@endsection
