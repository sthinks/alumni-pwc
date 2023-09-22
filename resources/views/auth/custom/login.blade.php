@extends("auth.custom.layout")
@section('title', 'Giriş Yap')
@section('main')
    <div class="d-flex flex-column flex-root pwc-alumni_background-image">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url(assets/media/pwc-alumni-login-2-min.gif);background-size: cover;">
            <!--begin::Content-->
            <div class="d-flex justify-content-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 pwc-card_login">
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('login') }}" id="sign_in_form">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-10">
                            <!--begin::Title-->
                            <img src="/images/pwc-renkli-logo.png"/>
                            <!--begin::Link-->
                            <div style="color:#d93954; font-size:24px; font-weight:700; margin-top:25px">Alumni Portal'a hoş geldiniz.</div>
                            <div style="font-size:20px; font-weight:bold">Kullanıcı Girişi</div>
                            @if (session()->has('status'))
                                <span class="valid-feedback" role="alert" style="display: block;">
                                    <strong>{{ session()->get('status') }}</strong>
                                </span>
                            @endif
                            @if (Cookie::has('password_reset'))
                                <span class="valid-feedback" role="alert" style="display: block;">
                                    <strong>Şifreniz başarıyla güncellenmiştir</strong>
                                </span>
                            @endif
                            <!--end::Link-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input style="border:2px solid #e2e2e2;" placeholder="E-mail" value="{{ old('email') }}"
                                class="form-control form-control-lg alumni-form-control @error('email') is-invalid @enderror bg-transparent" type="text"
                                name="email" autocomplete="off" required />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Input-->
                            <div class="input-group">
                                <input style="border:2px solid #e2e2e2;" placeholder="Şifre" id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror alumni-form-control bg-transparent"
                                    aria-describedby="password-addon" aria-label="şifre" name="password" required
                                    autocomplete="new-password">
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Input-->
                            <div class="d-flex align-items-center justify-content-between mt-6 mb-6">
                                <div class="form-check d-flex align-items-center justify-content-between alumni_agreement">
                                        <input style="width: 20px; height: 20px; border-radius:5px; border:2px solid #e2e2e2;" class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="check-login" style="margin-left:8px;font-size:15px;padding-top:5px">
                                            Beni Hatırla
                                        </label>
                                </div>
                                    <!--begin::Link-->
                                    <a href="{{ route('password.request') }}"
                                        class="link-primary fs-6 fw-bolder bgi-no-repeat" style="color:#000">
                                        Şifremi Unuttum
                                    </a>
                                    <!--end::Link-->
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn btn-lg btn-primary w-100 text-dark mb-5"
                                style="background-color: #D93954;font-weight: 700; padding-bottom: 8px;">
                                <span class="text-white" style="font-size:20px">Giriş Yap</span>
                            </button>
                            <a href="{{ route('register') }}"
                                class="btn btn-lg btn-primary w-100 mb-5 font-weight-bold"
                                style="font-weight: 700; border: 1px solid white; padding-bottom: 8px; background:#e2e2e2;">
                                <span style="color:#000; font-size:20px">Kayıt Ol</span>
                            </a>
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
@section('js')
    <script type="text/javascript">
        const showPassword = () => {
            const pw = document.getElementById("password");
            if (pw.getAttribute('type') == 'password') {
                pw.setAttribute('type', 'text');
                $("#login_passwordx").removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                pw.setAttribute('type', 'password');
                $("#login_passwordx").removeClass("fa-eye-slash").addClass("fa-eye");
            }
        }
        const showPasswordConfirm = () => {
            const pw = document.getElementById("password-confirm");
            if (pw.getAttribute('type') == 'password') {
                pw.setAttribute('type', 'text');
            } else {
                pw.setAttribute('type', 'password');
            }
        }
    </script>
@endsection
