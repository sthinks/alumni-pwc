@extends("admin.layouts.app")
@section("title", sprintf("%s - Düzenle", $media->media_title))
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ $media->media_title }} - Düzenle</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.medias.update', $media->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="media_title" class="required form-label">Medya Başlığı</label>
                            <input id="media_title" value="{{ $media->media_title }}" name="media_title" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="media_category_id" class="form-label">Nerelerde Gözüksün?</label>
                            <div class="checkbox-inline">
                                @foreach($categories as $category)
                                    <label class="checkbox p-3">
                                        <input @if($media->categories->contains($category->id)) checked @endif type="checkbox" name="media_category[]" value="{{ $category->id }}" />
                                        <span></span>
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @if($hobbies->count() > 0)
                            <div class="row mb-10" id="hobby_clubs_select_section">
                                <label for="hobby_clubs_select" class="form-label">Medyanın gösterilmesini istediğiniz hobi kulüplerini seçiniz</label>
                                <select class="form-control select2" id="hobby_clubs_select" name="media_hobby_clubs[]" multiple="multiple">
                                    @foreach($hobbies as $hobby)
                                        <option value="{{ $hobby->id }}" @if($media->hobbies->contains($hobby->id)) selected @endif>{{ $hobby->hobby_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="mb-10">
                            <label for="media_abstract" class="form-label">Medya Kısa Açıklaması</label>
                            <textarea id="media_abstract" name="media_abstract" class="form-control form-control-solid">{{ $media->media_abstract }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="media_description_id" class="required form-label">Medya Açıklaması</label>
                            <textarea id="media_description_id" name="media_description" class="form-control form-control-solid">{{ $media->media_description }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="media_embed" class="form-label">Video linkleri</label>
                            <textarea id="media_embed" name="media_embed" class="form-control form-control-solid">{{ $media->media_embed }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="media_poster" class="form-label">Medya Kapak Görseli</label>
                            <input id="media_poster" name="media_poster" type="file" class="form-control form-control-solid" />
                            <p><a href="{{ route('storage.images', $media->media_poster) }}" target="_blank">Mevcut görseli görmek için tıklayın</a></p>
                            <small class="text-muted">Görsel {{ $config['image']['poster']['width'] }} px genişliğinde ve {{ $config['image']['poster']['height'] }} px yükseliğinde olmalıdır. Boyutu en fazla {{ $config['image']['poster']['max_size'] }} kb olmalıdır. </small>
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">Medya Aktif Mi?</label>
                            <!--begin::Label-->
                            <!--begin::Label-->
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input @if($media->media_is_visible) checked @endif name="media_is_visible" class="form-check-input w-45px h-30px"
                                           type="checkbox" id="media_is_visible"/>
                                    <label class="form-check-label" for="media_is_visible"></label>
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
            },
            };
            let ckeditor = function () {
                ClassicEditor
                    .create(document.querySelector('#media_description_id'), conf);
            }
            return {
                // public functions
                init: function() {
                    ckeditor();
                }
            };
        }();
        // Class definition
            let KTSelect2 = function() {
            // Private functions
            let hobby_clubs_select = function() {
                // multi select
                $('#hobby_clubs_select').select2({
                    placeholder: "Hobi kulüplerini seçiniz",
                    tags: true,
                    allowClear: true,
                    createTag: function(params) {
                        return undefined;
                    }
                });
            }
            return {
                init: function() {
                    hobby_clubs_select();
                }
            };
        }();
        jQuery(document).ready(function() {
            wysiwygEditor.init();
            KTSelect2.init();
        });
    </script>
@endsection

