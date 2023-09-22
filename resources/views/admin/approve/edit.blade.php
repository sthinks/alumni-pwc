@extends("admin.layouts.app")
@section("title", "$user->name Düzenle")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }} Düzenle</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.approval.update', $user->id) }}"
                     enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Adı ve Soyadı</label>
                            <input value="{{ $user->name }}" name="name" type="text"
                                   class="form-control form-control-solid" disabled required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Telefon Numarası</label>
                            <input value="{{ $user->phone }}" name="phone" type="text"
                                   class="form-control form-control-solid" disabled required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Email Adresi</label>
                            <input value="{{ $user->email }}" name="email" type="text"
                                   class="form-control form-control-solid" disabled required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">PwC'ye İlk Katılma Tarihi</label>
                            <input value="{{ $user->pwc_join_year ? $user->pwc_join_year->format("d/m/Y H:i:s") : "" }}" name="pwc_join_year" type="text"
                                   class="form-control form-control-solid" disabled required/>
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">Telefon Onay Durumu</label>
                            <!--begin::Label-->
                            <!--begin::Label-->
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input name="phone_verified" class="form-check-input w-45px h-30px"
                                           type="checkbox" id="phone_verified_id"
                                           {{ $user->hasVerifiedPhone() ? "checked" : "" }} disabled/>
                                    <label class="form-check-label" for="phone_verified_id"></label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="form-label">Linkedin Hesabı</label>
                            <input value="{{ $user->linkedin ?? "" }}" name="linkedin" type="text"
                                   class="form-control form-control-solid" disabled required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Üyelik Tarihi</label>
                            <input value="{{ $user->created_at ? $user->created_at->format("d/m/Y H:i:s") : "" }}" name="created_at" type="text"
                                   class="form-control form-control-solid" disabled required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Doğum Tarihi</label>
                            <input value="{{ $user->birthdate ? $user->birthdate->format("d/m/Y H:i:s") : "" }}" name="birth_date" type="text"
                                   class="form-control form-control-solid" disabled required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Staff ID (<b>{{ $last_staff_id ?? "-" }}</b>(Son kullanıcının staff id))</label>
                            <input value="{{ old('staff_id') ?? $user->staff_id }}" name="staff_id" type="text"
                                   class="form-control form-control-solid" required/>
                        </div>
                    </div>
                    <!--begin::Label-->
                    <div class="card-footer">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <button onclick="return confirm('Onaylama işlemini yapmak istediğinize emin misiniz?');" type="submit" class="btn btn-success mr-2">Onayla</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row p-5">
            <form style="display: contents"
                  action="{{ route("manager.approval.destroy", $user->id) }}" method="post">
                @method("delete")
                @csrf
                <button onclick="return confirm('Başvuruyu reddetmek istediğinize emin misiniz?');" type="submit" class="btn btn-danger mr-2">Başvuruyu Reddet!</button>
            </form>
        </div>
@endsection

