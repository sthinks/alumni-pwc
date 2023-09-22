@extends("admin.layouts.app")
@section("title", "SubLos Ekle")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">SubLos Ekle</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.sublos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="pwc_los_id" class="required form-label">PwC Los</label>
                            <select id="pwc_los_id" name="pwc_los_id" class="form-select" data-control="select2" data-placeholder="Select an option">
                                @foreach($options as $option)
                                    <option value="{{ $option->id }}" @if(old("pwc_los_id") === $option->id)) selected @endif>{{ $option->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="name" class="required form-label">Sublos Başlık</label>
                            <input value="{{ old("name") }}" id="name" name="name" type="text" class="form-control form-control-solid" required/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">SubLos Ekle</button>
                                <button type="reset" class="btn btn-secondary">Formu Temizle</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
