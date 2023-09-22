@extends("auth.custom.layout")
@section('title', 'Kayıt Ol')
@section('main')
    <div class="d-flex flex-column flex-root pwc-alumni_background-image">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <!--begin::Content-->
            <div class="d-flex p-10 pb-lg-20 row">
                <!--begin::Wrapper-->
                <div class="card w-lg-500px rounded shadow-sm p-10 p-lg-10 col-md-6 col-xs-12 mt-4 mt-md-0 pwc-card_login">
                    <!--begin::Form-->
                    <form class="form w-100" method="post" id="sign_up_form" action="{{ route('register') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-10" style="position: relative; bottom:20px;">
                            <img src="/images/gsg-siyah-logo.png" class="mt-5" alt="" srcset="">
                            <!--begin::Title-->
                            <h4 class="mt-8" style="font-weight: 700; color:#d93954;">Kayıt Ol</h4>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <h4 class="mt-8" style="font-weight: 700; color:#d93954;">Lütfen kayıt olmak için aşağıdaki bilgileri doldurunuz.</h4>
                            <!--end::Link-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label style="font-size:20px; font-weight:bold" class="form-label required">Adınız Soyadınız</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input style="border:2px solid #e2e2e2;" id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label style="font-size:20px; font-weight:bold" class="form-label required">E-mail adresiniz</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input style="border:2px solid #e2e2e2;" id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" placeholder="Lüften kişisel e-mail adresinizi girin"
                                value="{{ old('email') }}" required autocomplete="false">

                            @error('email')
                                <span class="invalid-feedback " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <div class="d-flex">
                                <label style="font-size:20px; font-weight:bold" class="form-label required">Şifre</label>
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
                                <input style="border:2px solid #e2e2e2;" id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    aria-describedby="password-addon" aria-label="şifre" name="password" required
                                    autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="password-addon">
                                        <a onclick="showPassword()">
                                            <i id="passwordx" class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label style="font-size:20px; font-weight:bold;" class="form-label required">Şifre tekrar</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="input-group">
                                <input style="border:2px solid #e2e2e2;" id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
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
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label style="font-size:20px; font-weight:bold" class="form-label required">Cep telefonu numaranız (Onay kodu gönderilecektir)</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input style="border:2px solid #e2e2e2;" id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('phone') }}" required autocomplete="Telefon numaranız">
                            @error('phone')
                                <span class="invalid-feedback " role="alert">
                                    <strosng>{{ $message }}</strosng>
                                </span>
                            @enderror
                            <div class="mt-5">
                                <span class="fs-6 fw-bolder" style="display: none; color:#D93954;" id="invalid-phone-number">Lütfen telefon numaranızı doğru formatta giriniz.</span>
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <div class="row">
                            <!--begin::Input group-->
                            <div class="col-6 mb-10">
                                <!--begin::Label-->
                                <label style="font-size:20px; font-weight:bold" class="form-label required">Doğum tarihiniz</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input style="border:2px solid #e2e2e2;" id="birthdate" type="text"
                                    class="form-control @error('birthdate') is-invalid @enderror" name="birthdate"
                                    value="{{ old('birthdate') }}" required autocomplete="off" placeholder="gg.aa.yyyy">

                                @error('birthdate')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="col-6 mb-10">
                                <!--begin::Label-->
                                <label style="font-size:20px; font-weight:bold" class="form-label required">PwC'ye ilk katılma yılınız</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input style="border:2px solid #e2e2e2;" id="pwc_join_year" class="form-control @error('pwc_join_year') is-invalid @enderror"
                                    name="pwc_join_year" value="{{ old('pwc_join_year') }}" required autocomplete="off"
                                    placeholder="gg.aa.yyyy">

                                @error('pwc_join_year')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label style="font-size:20px; font-weight:bold" class="form-label">LinkedIn hesabınız</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input style="border:2px solid #e2e2e2;" id="linkedin" placeholder="http://www.linkedin.com/" type="url" class="form-control @error('linkedin') is-invalid @enderror"
                                name="linkedin" value="{{ old('linkedin') }}" autocomplete="e-Mail adresiniz">

                            @error('linkedin')
                                <span class="invalid-feedback " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <span class=""><span style="color:#d93954">*</span> Doldurulması zorunlu alanlardır.</span>
                        <!--begin::Input group-->
                        <div class="fv-row mb-10 alumni_agreement">
                            <div class="form-check mt-5">
                                <input name="user_agreement" required class="form-check-input" type="checkbox" value="1" id="check-login">
                                <label class="form-check-label " for="check-login">
                                    * <a href="{{ route('legal.aydinlatma') }}" class="register_legal "
                                        data-bs-toggle="modal" data-bs-target="#aydinlatma" target="_blank">Aydınlatma
                                        Metni'ni</a> okudum, anladım.
                                </label>
                            </div>
                            <div class="form-check mt-5">
                                <input name="clarification_text" required class="form-check-input" type="checkbox" value="1" id="check-login2">
                                <label class="form-check-label " for="check-login2">
                                    * <a href="{{ route('legal.uyeliksozlesmesi') }}" class="register_legal "
                                        data-bs-toggle="modal" data-bs-target="#uyeliksozlesmesi" target="_blank">Üyelik
                                        Sözleşmesi'ni</a> okudum onaylıyorum.
                                </label>
                            </div>
                            <div class="form-check mt-5">
                                <input name="acik-riza-metni" class="form-check-input" type="checkbox" value=""
                                    id="check-login3">
                                <label class="form-check-label " for="check-login3">
                                    <a href="{{ route('legal.uyeliksozlesmesi') }}" class="register_legal "
                                        data-bs-toggle="modal" data-bs-target="#acikrizasözlesmesi"
                                        target="_blank">Ayrıcalık, Etkinlik ve Bülten Paylaşımına</a> izin veriyorum.
                                </label>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center d-flex">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5"
                                style="margin-right: 1rem;background-color:#D93954;font-weight: 700; padding-bottom: 8px;">
                                <span style="font-size:20px">Kayıt Ol</span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                        <!--Begin::Aydınlatma Modal -->
                        <div class="modal fade" id="aydinlatma" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Aydınlatma Metni</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @include('alumni.contract.aydinlatma_metni')
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kapat</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::Aydınlatma Modal -->
                        <!--Begin::Üyelik Sözleşmesi Modal -->
                        <div class="modal fade" id="uyeliksozlesmesi" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Üyelik Sözleşmesi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @include(
                                            'alumni.contract.uyelik_sozlesmesi'
                                        )
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kapat</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::Üyelik Sözleşmesi Modal -->
                        <!--Begin::Açık rıza Sözleşmesi Modal -->
                        <div class="modal fade" id="acikrizasözlesmesi" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Açık Rıza Sözleşmesi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @include('alumni.contract.acikriza_metni')
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kapat</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::Üyelik Sözleşmesi Modal -->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
                <div class="card w-lg-500px p-8 p-lg-10 mx-auto col-md-6 col-xs-12" style="height: fit-content; display:block;" id="pwc-card_description">
                    <div id="close-icon">
                        <h3>X</h3>
                    </div>
                    <div class="card-header">
                        <div class="mb-3 d-table">
                            <img class="register-avatar" src="/images/ozlem-guc-alioglu-pp.png" alt="Özlem Güç Alioğlu">
                            <div class="register-responsible">
                                <span class="font-weight-bold mt-3 ">Özlem Güç Alioğlu</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <p style="color:#2d2d2d; font-size:20px" class="card-title mb-5">Herkese merhaba,</p>
                    <p style="color:#2d2d2d; font-size:20px" class="card-title mb-5">
                        Çok heyecanlıyız. PwC Ailesinin tüm üyelerini bir araya getirmek amacıyla PwC Türkiye Alumni Topluluğunu yeniliklerle ve farklı buluşma platformları ile yeniden hayata geçirmekten büyük mutluluk duyuyoruz. PwC Türkiye Ailesine kattıklarınız çok kıymetli. Yeniliklerle dolu projelerimizle birlikte aramıza tekrar hoş geldiniz diyerek sizlere yeni web sitemizi tanıtmak istiyoruz.
                    </p>
                    <p style="color:#2d2d2d; font-size:20px" class="card-title mb-5">
                        PwC Türkiye Alumni web sitesi 10bin kişiye yaklaşan PwC Ailemizin ana iletişim platformumuz olacak. Bu platform aracılığı ile birbirinizle iletişim kurabilir, PwC ailesinden yeni gelişmeler ve kariyer fırsatları hakkında haberdar olabilir, sizlere özel ayrıcalıklardan faydalanabilir, benzer ilgi alanlarına sahip arkadaşlarınızla biraraya gelebileceğiniz hobi kulüplerimize üye olabilirsiniz
                    </p>
                    <p style="color:#2d2d2d; font-size:20px" class="card-title mb-5">
                        Geçtiğimiz aylarda yaptığımız toplantılarımız ve etkinliklerimiz ile sizlerle bir araya gelme, hasret giderme fırsatı yakaladık, birbirimize anlatacak ne çok şey birikmiş!
                    </p>
                    <p style="color:#2d2d2d; font-size:20px" class="card-title mb-5">
                        Önümüzdeki günlerde gerek online gerek yüz yüze düzenleyeceğimiz etkinliklerimizde görüşmek dileğiyle.
                    </p>
                    </div>
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - Sign-in-->
        <div id="descButton" style="font-weight-bold">
            <div class="descButton-alert">
                <span id="descButtonAlertText">0</span>
            </div>
            <img class="button-avatar" src="/images/ozlem-guc-alioglu-pp.png" alt="Özlem Güç Alioğlu">
            <span style="margin-left:15px">Özlem Güç Alioğlu</span>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
            const phoneInputField = document.querySelector("#phone");
            const phoneInput = window.intlTelInput(phoneInputField, {
                initialCountry: "TR",
                utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
        $('#sign_up_form').on('submit', function () {
            if(!phoneInput.isValidNumber()){
                const invalidPhoneNumber = document.getElementById('invalid-phone-number');
                invalidPhoneNumber.style.display = '';
                invalidPhoneNumber.scrollIntoView()
                return false;
            } else {
                document.getElementById('phone').value = phoneInput.getNumber();
                document.getElementById("sign_up_form").submit();
            }
        });
    </script>
    <script>
        const button = document.getElementById('descButton');
        const card = document.getElementById('pwc-card_description');
        const descButtonAlertText = document.getElementById('descButtonAlertText');
        const close = document.getElementById('close-icon');
        let viewportWidth = window.innerWidth;


        window.onload = function () {
            if(viewportWidth > 800){
                setTimeout(() => {
                document.getElementById("pwc-card_description").style.display = "none";
                descButtonAlertText.innerHTML = '1';
                button.style.display = 'block';
            }, 4000);
        }};

        button.addEventListener('click',function(){
            if(card.style.display == 'block'){
                card.style.display = 'none';
                descButtonAlertText.innerHTML = '1';
                button.style.display = 'block';
            }else{
                card.style.display = 'block';
                descButtonAlertText.innerHTML = '0';
                button.style.display = 'none';

            }
        })

        close.addEventListener('click',function(){
            if(card.style.display == 'block'){
                card.style.display = 'none';
                descButtonAlertText.innerHTML = '1';
                button.style.display = 'block';

            }else{
                card.style.display = 'block';
                descButtonAlertText.innerHTML = '0';
                button.style.display = 'none';

            }
        })

    </script>
    <script src="{{ url('static/alumni/assets/plugins/custom/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('static/alumni/assets/plugins/custom/datepicker/bootstrap-datepicker-tr.min.js') }}"></script>
    <script type="text/javascript">
        const showPassword = () => {
            const pw = document.getElementById("password");
            if (pw.getAttribute('type') == 'password') {
                pw.setAttribute('type', 'text');
                $("#passwordx").removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                pw.setAttribute('type', 'password');
                $("#passwordx").removeClass("fa-eye-slash").addClass("fa-eye");
            }
        }
        const showPasswordConfirm = () => {
            const pw = document.getElementById("password-confirm");
            if (pw.getAttribute('type') == 'password') {
                pw.setAttribute('type', 'text');
                $("#passwordx_again").removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                pw.setAttribute('type', 'password');
                $("#passwordx_again").removeClass("fa-eye-slash").addClass("fa-eye");
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#birthdate').datepicker({
                format: 'dd.mm.yyyy',
                altFormat: "yyyy.mm.dd",
                autoclose: true,
                language: 'tr',
            });
            $('#pwc_join_year').datepicker({
                format: 'dd.mm.yyyy',
                altFormat: "yyyy.mm.dd",
                autoclose: true,
                language: 'tr',
            });
        });
    </script>
@endsection
