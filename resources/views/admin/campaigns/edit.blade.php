@extends("admin.layouts.app")
@section('title', sprintf('%s - Düzenle', $campaign->campaign_title))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ $campaign->campaign_title }} - Düzenle</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.campaigns.update', $campaign->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="campaign_company" class="required form-label">Ayrıcalık Firma</label>
                            <input id="campaign_company" value="{{ $campaign->campaign_company }}" name="campaign_company"
                                type="text" class="form-control form-control-solid" required />
                        </div>
                        <div class="mb-10">
                            <label for="campaign_title" class="required form-label">Ayrıcalık Başlığı</label>
                            <input id="campaign_title" value="{{ $campaign->campaign_title }}" name="campaign_title"
                                type="text" class="form-control form-control-solid" required />
                        </div>
                        <div class="mb-10">
                            <label for="campaign_category" class="required form-label">Kategori</label>
                            <select id="campaign_category" name="campaign_category" class="form-control selectpicker">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($campaign->campaign_category === $category->id) ) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="campaign_abstract" class="form-label">Ayrıcalık Kısa Açıklama</label>
                            <textarea name="campaign_abstract" class="form-control form-control-solid"
                                id="campaign_abstract">{{ $campaign->campaign_abstract }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="campaign_text" class="required form-label">Ayrıcalık Metni</label>
                            <textarea name="campaign_text" class="form-control form-control-solid"
                                id="campaign_text">{{ $campaign->campaign_text }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="campaign_poster" class="form-label">Ayrıcalık Görseli</label>
                            <input id="campaign_poster" name="campaign_poster" type="file"
                                class="form-control form-control-solid" />
                            <p><a href="{{ route('storage.images', $campaign->campaign_poster) }}" target="_blank">Mevcut
                                    Görseli Görmek İçin Tıklayın</a></p>
                            <small class="text-muted">Görsel {{ $config['image']['poster']['width'] }} px genişliğinde
                                ve {{ $config['image']['poster']['height'] }} px yükseliğinde olmalıdır. Boyutu en fazla
                                {{ $config['image']['poster']['max_size'] }} kb olmalıdır. </small>
                        </div>
                        <div class="mb-10">
                            <label for="campaign_code" class="required form-label">Ayrıcalık Kodu</label>
                            <input id="campaign_code" value="{{ $campaign->campaign_code }}" name="campaign_code"
                                type="text" class="form-control form-control-solid" required />
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">Ayrıcalık Aktif Mi?</label>
                            <!--begin::Label-->
                            <!--begin::Label-->
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input name="campaign_visible" class="form-check-input w-45px h-30px" type="checkbox"
                                        @if ($campaign->campaign_visible) checked @endif id="campaign_visible_id" />
                                    <label class="form-check-label" for="campaign_visible_id"></label>
                                </div>
                            </div>
                            <!--begin::Label-->
                        </div>
                        <div class="mb-10">
                            <label for="campaign_end_date" class="required form-label">Ayrıcalık Bitiş Tarihi</label>
                            <input id="campaign_end_date"
                                value="{{ $campaign->campaign_end_date->format('Y-m-d\TH:i') }}" name="campaign_end_date"
                                type="datetime-local" class="form-control form-control-solid" required />
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

@section('js')
    <script src="{{ url('static/admin/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    <script type="text/javascript">
        let wysiwygEditor = function() {
            // Private functions
            let conf = {
                ckfinder: {
                    uploadUrl: '{{ route('manager.uploader', ['_token' => csrf_token()]) }}',
                    uploadMethod: 'form'
                }
            };
            let ckeditor = function() {
                ClassicEditor
                    .create(document.querySelector('#campaign_text'), conf);
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
            wysiwygEditor.init();
        });
    </script>
@endsection
