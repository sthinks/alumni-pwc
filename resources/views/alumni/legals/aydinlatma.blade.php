@extends('alumni.layout.app')
@section('title', 'Aydınlatma Metni')
@section('bg', url('static/alumni/assets/media/background/aydinlatma.png'))
@section('breadcrumb', Breadcrumbs::render('aydinlatma'))
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <!--begin::Card header-->
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">Aydınlatma Metni</span>
                    </h3>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::content-->
                    @include('alumni.contract.aydinlatma_metni')
                    <!--end::content-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
@endsection
