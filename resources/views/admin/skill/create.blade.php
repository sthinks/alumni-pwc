@extends("admin.layouts.app")
@section("title", "Yetenek Ekle")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Yetenek Ekle</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.skills.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="name" class="required form-label">Yetenek Başlık</label>
                            <input value="{{ old("name") }}" id="name" name="name" type="text" class="form-control form-control-solid" required/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">Yetenek Ekle</button>
                                <button type="reset" class="btn btn-secondary">Formu Temizle</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
