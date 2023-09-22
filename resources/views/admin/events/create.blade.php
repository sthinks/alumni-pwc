@extends("admin.layouts.app")
@section("title", "Etkinlik Oluştur")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Etkinlik Oluştur</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.events.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="event_title" class="required form-label">Etkinlik Başlığı</label>
                            <input id="event_title" value="{{ old("event_title") }}" name="event_title" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="event_abstract" class="form-label">Etkinlik Kısa Açıklaması</label>
                            <textarea id="event_abstract" name="event_abstract" class="form-control form-control-solid">{{ old("event_abstract") }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="event_description" class="required form-label">Etkinlik Metni</label>
                            <textarea id="event_description" name="event_description" class="form-control form-control-solid">{{ old("event_description") }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="event_poster" class="required form-label">Etkinlik Görseli</label>
                            <input id="event_poster" name="event_poster" type="file" class="form-control form-control-solid" required/>
                            <small class="text-muted">Görsel {{ $config['image']['poster']['width'] }} px genişliğinde ve {{ $config['image']['poster']['height'] }} px yükseliğinde olmalıdır. Boyutu en fazla {{ $config['image']['poster']['max_size'] }} kb olmalıdır. </small>
                        </div>
                        <div class="mb-10">
                            <label for="event_city" class="required form-label">Etkinlik Şehri</label>
                            <select id="event_city" name="event_city" class="form-select" data-control="select2" data-placeholder="Etkinlik şehrini seçiniz">
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" @if(old('event_city') === $city->id)) selected @endif>{{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="event_venue" class="required form-label">Etkinlik Adresi</label>
                            <input id="event_venue" value="{{ old("event_venue") }}" name="event_venue" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="event_capacity" class="required form-label">Etkinlik Kapasitesi</label>
                            <input id="event_capacity" value="{{ old("event_capacity") }}" name="event_capacity" type="number" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="event_last_apply_date" class="required form-label">Etkinlik Son Başvuru Tarihi</label>
                            <input id="event_last_apply_date" value="{{ old("event_last_apply_date") }}" name="event_last_apply_date" type="datetime-local" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="event_start_date" class="required form-label">Etkinlik Başlangıç Tarihi</label>
                            <input id="event_start_date" value="{{ old("event_start_date") }}" name="event_start_date" type="datetime-local" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="event_end_date" class="required form-label">Etkinlik Bitiş Tarihi</label>
                            <input id="event_end_date" value="{{ old("event_end_date") }}" name="event_end_date" type="datetime-local" class="form-control form-control-solid" required/>
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">Etkinlik Aktif Mi?</label>
                            <!--begin::Label-->
                            <!--begin::Label-->
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input name="event_is_visible" class="form-check-input w-45px h-30px"
                                           type="checkbox" id="event_is_visible" {{ old('event_is_visible') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="event_is_visible"></label>
                                </div>
                            </div>
                            <!--begin::Label-->
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">Etkinlik Private Mı?</label>
                            <!--begin::Label-->
                            <!--begin::Label-->
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input name="event_is_private" class="form-check-input w-45px h-30px"
                                           type="checkbox" id="event_is_private"/>
                                    <label class="form-check-label" for="event_is_private"></label>
                                </div>
                            </div>
                            <!--begin::Label-->
                        </div>
                        <div class="row mb-10" id="event_attendees" style="display: none;">
                            <label for="event_private_users" class="required form-label">Etkinlik Katılımcılarını Seçiniz</label>
                            <select class="form-control select2" id="event_private_users" name="event_private_users[]" multiple="multiple">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mb-10" id="hobby_club_select">
                            <label for="hobby_club" class="form-label">Hobi kulübü seçiniz.</label>
                            <select data-control="select2" class="form-select" id="hobby_club" name="hobby_club">
                                <option value="" selected="" disabled="" hidden="">Lütfen hobi kulübü seçiniz</option>
                                @foreach($hobbies as $hobby)
                                    <option value="{{ $hobby->id }}">{{ $hobby->hobby_title }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Etkinlik hobi kulübüne aitse lütfen hobi kulübünü seçiniz.</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">Etkinliği Oluştur</button>
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
                    .create(document.querySelector('#event_description'), conf);
            }
            return {
                // public functions
                init: function() {
                    ckeditor();
                }
            };
        }();
    </script>
    <script type="text/javascript">
        // Class definition
        let KTSelect2 = function() {
            // Private functions
            let users_select = function() {
                // multi select
                $('#event_private_users').select2({
                    placeholder: "Etkinlik katılımcılarını seçiniz",
                    tags: true,
                    allowClear: true,
                    createTag: function(params) {
                        return undefined;
                    }
                });
            }
            return {
                init: function() {
                    users_select();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTSelect2.init();
            wysiwygEditor.init();
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            if($("#event_is_private").is(":checked"))
            {
                $("#event_attendees").show();
            }
            else
            {
                $("#event_attendees").hide();
            }
        });
        $('#event_is_private:checkbox').click(function(){
            if($(this).is(':checked')){
                $("#event_attendees").show();
                $("#hobby_club_select").hide();
                $("#hobby_club").val('').trigger('change');
            } else {
                $("#event_attendees").hide();
                $("#hobby_club_select").show();
                $("#event_private_users").val('').trigger('change');
            }
        });
    </script>
@endsection
