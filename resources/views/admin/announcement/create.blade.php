@extends("admin.layouts.app")
@section("title", "Yeni Duyuru Ekle")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Yeni Duyuru Ekle</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.announcement.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="announcement_title" class="required form-label">Duyuru Başlığı</label>
                            <input id="announcement_title" value="{{ old("announcement_title") }}" name="announcement_title" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="announcement_link" class="form-label">Duyuru Linki</label>
                            <input id="announcement_link" value="{{ old("announcement_link") }}" name="announcement_link" type="text" class="form-control form-control-solid" />
                        </div>
                        <div class="mb-10">
                            <label for="announcement_category_id" class="required form-label">Duyuru Kategorisi</label>
                            <select id="announcement_category_id" name="announcement_category_id" class="form-control selectpicker">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(old("announcement_category_id") === $category->id)) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="announcement_abstract" class="form-label">Duyuru Kısa Açıklaması</label>
                            <textarea id="announcement_abstract" name="announcement_abstract" class="form-control form-control-solid">{{ old("announcement_abstract") }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="announcement_text" class="form-label">Duyuru Metni</label>
                            <textarea id="announcement_text" name="announcement_text" class="form-control form-control-solid">{{ old("announcement_text") }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="announcement_poster" class="form-label required">Duyuru Görseli</label>
                            <input id="announcement_poster" name="announcement_poster" type="file" class="form-control form-control-solid" required />
                            <small class="text-muted">Görsel {{ $config['image']['poster']['width'] }} px genişliğinde ve {{ $config['image']['poster']['height'] }} px yükseliğinde olmalıdır. Boyutu en fazla {{ $config['image']['poster']['max_size'] }} kb olmalıdır. </small>
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">Duyuru Aktif Mi?</label>
                            <!--begin::Label-->
                            <!--begin::Label-->
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input name="announcement_is_visible" class="form-check-input w-45px h-30px"
                                           type="checkbox" id="announcement_is_visible" {{ old("announcement_text") ? "checked" : "" }} />
                                    <label class="form-check-label" for=announcement_is_visible"></label>
                                </div>
                            </div>
                            <!--begin::Label-->
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">Ekle</button>
                                <button type="reset" class="btn btn-secondary">Formu Temizle</button>
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
        let wysiwygEditor = function () {
            // Private functions
            let conf = {ckfinder: {
            uploadUrl: '{{ route('manager.uploader', ['_token' => csrf_token() ]) }}',
            uploadMethod: 'form'
            }};
            let ckeditor = function () {
                ClassicEditor
                    .create(document.querySelector('#announcement_text'), conf);
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
