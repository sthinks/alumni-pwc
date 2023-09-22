@extends("admin.layouts.app")
@section("title", sprintf("%s - Düzenle", $hobby->hobby_title))
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ $hobby->hobby_title }} - Düzenle</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.hobby.update', $hobby->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="hobby_title" class="required form-label">Hobi Kulübü Başlığı</label>
                            <input id="hobby_title" value="{{ $hobby->hobby_title }}" name="hobby_title" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="hobby_abstract" class="form-label">Hobi Kulübü Açıklaması</label>
                            <textarea id="hobby_abstract" name="hobby_abstract" class="form-control form-control-solid">{{ $hobby->hobby_abstract }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="hobby_description_id" class="required form-label">Hobi Kulübü Açıklaması</label>
                            <textarea id="hobby_description_id" name="hobby_description" class="form-control form-control-solid">{{ $hobby->hobby_description }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="hobby_poster" class="required form-label">Hobi Kulübü Görseli</label>
                            <input id="hobby_poster" name="hobby_poster" type="file" class="form-control form-control-solid" />
                            <a href="{{ route('storage.images', $hobby->hobby_poster) }}" target="_blank">Mevcut görseli görmek için tıklayın</a>
                            <small class="text-muted">Görsel {{ $config['image']['poster']['width'] }} px genişliğinde ve {{ $config['image']['poster']['height'] }} px yükseliğinde olmalıdır. Boyutu en fazla {{ $config['image']['poster']['max_size'] }} kb olmalıdır. </small>
                        </div>
                        <div class="mb-10">
                            <label for="hobby_responsible" class="required form-label">Hobi Kulübü Sorumlusu</label>
                            <input id="hobby_responsible" value="{{ $hobby->hobby_responsible }}" name="hobby_responsible" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="hobby_responsible_role" class="required form-label">Hobi Kulübü Sorumlusu Görevi</label>
                            <input id="hobby_responsible_role" value="{{ $hobby->hobby_responsible_role }}" name="hobby_responsible_role" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="hobby_responsible_avatar" class="required form-label">Hobi Kulübü Sorumlusu Fotoğrafı</label>
                            <input id="hobby_responsible_avatar" name="hobby_responsible_avatar" type="file" class="form-control form-control-solid" />
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">Kulüp Aktif Mi?</label>
                            <!--begin::Label-->
                            <!--begin::Label-->
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input name="hobby_visible" class="form-check-input w-45px h-30px"
                                           type="checkbox" id="hobby_visible_id" @if($hobby->hobby_visible) checked @endif />
                                    <label class="form-check-label" for="hobby_visible_id"></label>
                                </div>
                            </div>
                            <!--begin::Label-->
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">Düzenle</button>
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
                    .create(document.querySelector('#hobby_description_id'), conf);
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
