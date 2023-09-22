@extends('alumni.layout.detailapp')
@section('title', $job->job_title)
@section('bg', url('static/alumni/assets/media/background/5.png'))
@section('breadcrumb', Breadcrumbs::render('jobs-detail', $job))
@section('abstract', $job->job_abstract)
@section('main')
    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <div class="card shadow job-card">
                <div class="card-header">
                    <h2 class="mt-5">{{ $job->job_title }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 d-flex">
                            <!--begin::Stats-->
                            <div class="jobs-mobile-text">
                                <div>Şirket adı</div>
                                <p>{{ $job->job_company_visible ? $job->job_company : 'Gizli' }}</p>
                            </div>
                            <span class="jobs-vertical-line"></span>
                            <!--end::Stats-->
                        </div>
                        <div class="col-md-3 d-flex">
                            <!--begin::Stats-->
                            <div class="jobs-mobile-text">
                                <div>Pozisyon adı</div>
                                <p>{{ $job->job_position }}</p>
                            </div>
                            <span class="jobs-vertical-line"></span>
                            <!--end::Stats-->
                        </div>
                        <div class="col-md-3">
                            <!--begin::Stats-->
                            <div class="jobs-mobile-text">
                                <div>Deneyim</div>
                                <p>{{ $job->job_experience }} yıl</p>
                            </div>
                            <span class="jobs-vertical-line"></span>
                            <!--end::Stats-->
                        </div>
                        <div class="col-md-3 d-flex">
                            <!--begin::Stats-->
                            <div class="jobs-mobile-text">
                                <div>Lokasyon</div>
                                <p>{{ $job->location->city }}</p>
                            </div>
                            <!--end::Stats-->
                        </div>
                    </div>
                    <div class="row border-top border-bottom mt-3 pt-3 pb-3">
                        <div class="col-6">İlan Tarihi: {{ $job->created_at->translatedFormat('d F Y') }}</div>
                        <div class="col-6">Geçerlilik
                            Tarihi: {{ $job->job_valid_till->translatedFormat('d F Y') }}</div>
                    </div>
                    <div class="row mt-5 mb-3">
                        <div class="col-12" id="ck_list">
                            <p>
                                {!! $job->job_description !!}
                            </p>
                            <p class="text-center">
                                <!-- Eğer daha önce iş ilanına başvurduysa direk başvuru linkini göster -->
                                @if ($applied)
                                    <div class="btn pwc-yellow-button btn-block col-md-6 offset-md-3">
                                        <a class="text-dark" href="{{ $job->job_apply_link }}"
                                            target="_blank">Başvuru Adresine Git</a>
                                    </div>
                                    <!-- eğer ilanın geçerlilik süresi dolduysa -->
                                @elseif ($expired)
                                    iş ilanınızın geçerlilik süresi doldu.
                                    <!-- eğer daha önce iş ilanına başvurmadıysa, başvurması için linki ver -->
                                @else
                                    <a href="{{ route('jobs.join', $job->job_seo_url) }}" id="jobs-join-button"
                                        class="btn line-height-normal pwc-orange-button btn-block px-20 text-uppercase">
                                        Başvur
                                    </a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <!--begin::Card-->
            <div class="card mt-5 shadow jobs-post"
                style="height: 400px; background: url({{ url('static/alumni/assets/media/background/jobs-post-bg.png') }}); background-size:cover;">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                    <h4>İş İlanı Paylaş</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#new_jobs_posted"
                        class="btn btn-light jobs-post-button line-height-normal">Paylaş
                    </button>
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
        </script>
    @endsection
