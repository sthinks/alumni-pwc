@extends("auth.custom.layout")
@section("title", "Şifremi Unuttum")
@section("main")
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url('assets/media/pwc-alumni-login-2-min.gif');background-size: cover;">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('password.update') }}" id="forget_pw_form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <!--begin::Heading-->
                        <div class="mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Şifre Belirleyiniz</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fs-6">Lütfen, yeni şifrenizi belirleyiniz.</div>
                            <!--end::Link-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">E-mail</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input  value="{{ $email ?? old('email') }}" class="form-control form-control-lg  @error('email') is-invalid @enderror" type="text" name="email" autocomplete="off" required />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <div class="d-flex">
                                <label class="form-label fs-6 fw-bolder text-dark required">Şifre</label>
                                <div class="position-relative table_info"
                                     data="Şifreniz en az 1 büyük, 1 küçük, 1 rakam ve 1
                                özel karakter içermelidir. Şifrenizin uzunluğu en az 10 karakter
                                olmalıdır.">
                                    <img width="15" height="15"
                                         src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="input-group">
                                <input id="password" class="form-control form-control-lg  @error('password') is-invalid @enderror" type="password" name="password" aria-describedby="password-addon" autocomplete="off" required />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="password-addon">
                                        <a onclick="showPassword()">
                                            <i id="passwordx" class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </span>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark required">Şifre Tekrar</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="input-group">
                                <input id="password-confirm" type="password" aria-describedby="password-addon" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="password-addon">
                                        <a onclick="showPasswordConfirm()">
                                            <i id="passwordx_again" class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center d-flex">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5 text-dark" style="margin-right: 1rem;background-color: #FFB600;font-weight: 700;">
                                <span>Şifreyi sıfırla</span>
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
@section("js")
<script type="text/javascript">
    const showPassword = () => {
        const pw = document.getElementById("password");
        if(pw.getAttribute('type') == 'password') {
            pw.setAttribute('type', 'text');
            $( "#passwordx" ).removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            pw.setAttribute('type', 'password');
            $( "#passwordx" ).removeClass("fa-eye-slash").addClass("fa-eye");
        }
    }
    const showPasswordConfirm = () => {
        const pw = document.getElementById("password-confirm");
        if(pw.getAttribute('type') == 'password') {
            pw.setAttribute('type', 'text');
            $( "#passwordx_again" ).removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            pw.setAttribute('type', 'password');
            $( "#passwordx_again" ).removeClass("fa-eye-slash").addClass("fa-eye");
        }
    }
</script>
@endsection
