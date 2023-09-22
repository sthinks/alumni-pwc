@extends("auth.custom.layout")
@section("title", "Şifremi Unuttum")
@section("main")
    <div class="d-flex flex-column flex-root pwc-alumni_background-image">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/pwc-alumni-login-2-min.gif); background-size: cover;">
            <!--begin::Content-->
            <div class="d-flex justify-content-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 pwc-card_login">
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('password.email') }}" id="forget_pw_form">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-10">
                            <img src="/images/gsg-siyah-logo.png" alt="" srcset="">
                            <!--begin::Title-->
                            <div style="color:#d93954; font-size:24px; font-weight:700; margin-top:25px">Şifremi Unuttum</div>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div style="font-size:20px; font-weight:bold">Lütfen, e-mail adresinizi giriniz.</div>
                            <!--end::Link-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input placeholder="E-mail" style="border:2px solid #e2e2e2;"  value="{{ old('email') }}" class="form-control form-control-lg @error('email') is-invalid @enderror bg-transparent" type="text" name="email" autocomplete="off" required />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if(session()->has('status'))
                                <span class="valid-feedback" role="alert" style="display: block;">
                                    <strong>{{ session()->get('status') }}</strong>
                                </span>
                            @endif
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center d-flex">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5" style="margin-right: 1rem; background-color:#D93954; font-weight: 700; padding-bottom: 8px;">
                                <span style="font-size: 20px;">Şifremi sıfırla</span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
@endsection
