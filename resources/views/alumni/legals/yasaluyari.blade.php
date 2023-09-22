@extends('alumni.layout.app')
@section('title', 'Yasal Uyarı')
@section('bg', url('static/alumni/assets/media/background/acik_riza_metni.jpg'))
@section('breadcrumb', Breadcrumbs::render('yasaluyari'))
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <!--begin::Card header-->
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">Yasal Uyarı</span>
                    </h3>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::content-->
                    <!--begin::Card title-->
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 style="color: #000">Sözleşmeler</h3>
                        <label class="d-none btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                        </label>
                    </div>
                    <!--end::Card title-->
                    <hr style="width: 100%; color:#000">
                    <div class="row">
                        <div class="col-md-12 profile_contact_permission">
                            <div>
                                <label for="">
                                    <a href="{{ route('legal.export', \App\Enums\TermConditionType::ClarificationText) }}" target="_blank">Aydınlatma Metnini görmek
                                        için
                                        tıklayınız.</a>
                                </label>
                            </div>
                            <div>
                                <label for="">
                                    <a href="{{ route('legal.export', \App\Enums\TermConditionType::UserAgreement) }}" target="_blank">Üyelik Sözleşmesini
                                        görmek için

                                        tıklayınız.</a>
                                </label>
                            </div>
                            <div>
                                <label for="">
                                    <a href="{{ route('legal.acikriza') }}" target="_blank">İletişim İzinlerini görmek
                                        için
                                        tıklayınız.</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--end::content-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
@endsection
