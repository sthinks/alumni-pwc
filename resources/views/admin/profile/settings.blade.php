@extends("admin.layouts.app")
@section("title", "Profil Güncelleme")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Profil Güncelleme</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.settings.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="name" class="required form-label">Ad, Soyad</label>
                            <input id="name" value="{{ $user->name }}" name="name" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="email" class="required form-label">Email</label>
                            <input id="email" value="{{ $user->email }}" name="email" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="phone" class="required form-label">Telefon Numarası</label>
                            <input id="phone" value="{{ $user->phone }}" name="phone" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input id="avatar" name="avatar" type="file" class="form-control form-control-solid" />
                            <small class="text-muted">Görsel boyutu en fazla {{ $config['max_size'] }} kb olmalıdır. </small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">Profilimi Güncelle</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

