@extends("admin.layouts.app")
@section("title", sprintf("%s İlanını Düzenle", $job->job_title))
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ $job->job_title }} İlanını Düzenle</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.jobs.update', $job->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Şirket Adı</label>
                            <input value="{{ $job->job_company }}" name="job_company" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">Şirket adı gözüksün mü?</label>
                            <!--begin::Label-->
                            <!--begin::Label-->
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input name="job_company_visible" class="form-check-input w-45px h-30px"
                                           type="checkbox" id="job_company_visible_id" @if($job->job_company_visible) checked @endif />
                                    <label class="form-check-label" for="job_company_visible_id"></label>
                                </div>
                            </div>
                            <!--begin::Label-->
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">İlan Başlığı</label>
                            <input value="{{ $job->job_title }}" name="job_title" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Pozisyon Adı</label>
                            <input value="{{ $job->job_position }}" name="job_position" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Pozisyon Seviyesi</label>
                            <input value="{{ $job->job_position_level }}" name="job_position_level" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">İlan Lokasyonu</label>
                            <select id="job_location" name="job_location" class="form-select" data-control="select2" data-placeholder="Select an option">
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" @if($job->job_location === $city->id)) selected @endif>{{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="job_owner_id" class="form-label">İlan Sahibi</label>
                            <select id="job_owner_id" name="job_owner_id" class="form-select" data-control="select2" data-placeholder="Select an option">
                                <option value="" selected disabled hidden>Seçim yapınız</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if($job->job_owner_id === $user->id)) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Deneyim (yıl)</label>
                            <input value="{{ $job->job_experience }}" name="job_experience" type="number" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">İlan Başvuru Linki</label>
                            <input value="{{ $job->job_apply_link }}" name="job_apply_link" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="job_abstract" class="form-label">İlan Kısa Açıklaması</label>
                            <textarea id="job_abstract" name="job_abstract" class="form-control form-control-solid wysiwyg">{{ $job->job_abstract }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">İlan Açıklaması</label>
                            <textarea id="job_description" name="job_description" class="form-control form-control-solid wysiwyg">{{ $job->job_description }}</textarea>
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">İlan Aktif Mi?</label>
                            <!--begin::Label-->
                            <!--begin::Label-->
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input name="job_visible" class="form-check-input w-45px h-30px"
                                           type="checkbox" id="job_visible_id" @if($job->job_visible) checked @endif />
                                    <label class="form-check-label" for="job_visible_id"></label>
                                </div>
                            </div>
                            <!--begin::Label-->
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">İlan Bitiş Tarihi</label>
                            <input value="{{ $job->job_valid_till->format('Y-m-d\TH:i') }}" name="job_valid_till" type="datetime-local" class="form-control form-control-solid" required/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">Düzenle</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script src="{{ url("static/admin/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js") }}"></script>
    <script type="text/javascript">
        let wysiwygEditorforDescription = function () {
            // Private functions
            let conf = {ckfinder: {
            uploadUrl: '{{ route('manager.uploader', ['_token' => csrf_token() ]) }}',
            uploadMethod: 'form'
            }};
            let ckeditor = function () {
                ClassicEditor
                    .create(document.querySelector('#job_description'), conf);
            }
            return {
                // public functions
                init: function() {
                    ckeditor();
                }
            };
        }();
        // Initialization of wysiwyg editor
        jQuery(document).ready(function() {
            wysiwygEditorforDescription.init();
        });
    </script>
@endsection
