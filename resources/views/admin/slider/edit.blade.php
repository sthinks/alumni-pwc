@extends("admin.layouts.app")
@section("title", sprintf("%s - Düzenle", $slider->slider_title))
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ $slider->slider_title }} - Düzenle</h3>
                </div>
                <form class="form" method="post" action="{{ route('manager.sliders.update', $slider->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="mb-10">
                            <label for="slider_topic" class="required form-label">Slider Konu</label>
                            <input value="{{ $slider->slider_topic }}" id="slider_topic" name="slider_topic" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="slider_title" class="required form-label">Slider Başlığı</label>
                            <input value="{{ $slider->slider_title }}" id="slider_title" name="slider_title" type="text" class="form-control form-control-solid" required/>
                        </div>
                        <div class="mb-10">
                            <label for="slider_desc" class="required form-label">Slider Açıklaması</label>
                            <textarea id="slider_desc" name="slider_desc" class="form-control form-control-solid">{{ $slider->slider_desc }}</textarea>
                        </div>
                        <div class="mb-10">
                            <label for="slider_link" class="form-label">Slider Linki</label>
                            <input value="{{ $slider->slider_link }}" id="slider_link" name="slider_link" type="text" class="form-control form-control-solid" />
                        </div>
                        <div class="mb-10">
                            <label for="slider_order" class="form-label required">Slider Sırası</label>
                            <input value="{{ $slider->slider_order }}" id="slider_order" name="slider_order" type="number" class="form-control form-control-solid" required />
                        </div>
                        <div class="mb-10">
                            <label for="slider_image" class="form-label">Slider Görseli</label>
                            <input name="slider_image" id="slider_image" type="file" class="form-control form-control-solid" />
                            <small class="text-muted">Görsel {{ $config['image']['poster']['width'] }} px genişliğinde ve {{ $config['image']['poster']['height'] }} px yükseliğinde olmalıdır. Boyutu en fazla {{ $config['image']['poster']['max_size'] }} kb olmalıdır. </small>
                            <p>
                                <a href="{{ route('storage.images', $slider->slider_image) }}" target="_blank">Mevcut görseli görmek için tıklayın</a>
                            </p>
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">Slider Aktif Mi?</label>
                            <!--begin::Label-->
                            <!--begin::Label-->
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input name="slider_visible" class="form-check-input w-45px h-30px"
                                           type="checkbox" id="slider_visible" {{ $slider->slider_visible ? 'checked' : '' }} />
                                    <label class="form-check-label" for="slider_visible"></label>
                                </div>
                            </div>
                            <!--begin::Label-->
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">Slider Düzenle</button>
                                <button type="reset" class="btn btn-secondary">Formu Temizle</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
