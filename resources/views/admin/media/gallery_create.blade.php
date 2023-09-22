@extends("admin.layouts.app")
@section("title", sprintf("%s - Medya Ekle", $media->media_title))
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ $media->media_title }} - Medya Ekle</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.medias.gallery.store', $media->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="media_gallery" class="form-label required">Medya Görselleri</label>
                            <input id="media_gallery" name="media_gallery[]" type="file" class="form-control form-control-solid" required multiple />
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">Oluştur</button>
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
            let ckeditor = function () {
                ClassicEditor
                    .create(document.querySelector('#media_description_id'));
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

