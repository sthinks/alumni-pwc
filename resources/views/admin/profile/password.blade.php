@extends("admin.layouts.app")
@section("title", "Şifre Güncelleme")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Şifre Güncelleme</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.password.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="old_password" class="required form-label">Eski Şifre</label>
                            <input id="old_password" name="old_password" type="password" class="form-control form-control-solid" required/>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="new_password" class="required form-label">Yeni Şifre</label>
                            <input id="new_password" name="new_password" type="password" class="form-control form-control-solid" required/>
                            <ul class="mt-4 text-muted">
                                <li>Yeni şifreniz son 10 şifrenizden farklı olmalıdır,</li>
                                <li>En az 20 karakter,</li>
                                <li>En az 1 büyük harf,</li>
                                <li>En az 1 küçük harf,</li>
                                <li>En az 1 özel karakter,</li>
                                <li>En az 1 rakam içermelidir.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="new_password_confirmation" class="required form-label">Yeni Şifre Tekrar</label>
                            <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="form-control form-control-solid" required/>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">Şifremi Güncelle</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

