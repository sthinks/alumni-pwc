@extends("auth.custom.layout")
@section("title", "İki Aşamalı Doğrulama")
@section("main")
    <div class="d-flex flex-column flex-root pwc-alumni_background-image">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <!--begin::Content-->
            <div class="d-flex flex-column justify-content-center flex-column-fluid p-10 pb-lg-20">
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-black rounded shadow-sm p-10 p-lg-15 pwc-card_login">
                    <!--begin::Form-->
                    <form method="POST" id="phone_verify">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-10">
                            <!--begin::Title-->
                            <h1 class="text-white mb-3">Telefon Numaranızı Doğrulayın</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-white fw-bold fs-5 mb-1">{{ $phone }}</div>
                            <div class="text-white fs-6">Yukarıdaki telefon numarasına gönderdiğimiz kodu girin.</div>
                            <!--end::Link-->
                            <!--start::six digit code-->
                            <div class="d-flex justify-content-center mt-5 number-group" id="number_mask_twofa">
                                <input type="text" name="code[]" class="twofacode" min="0" max="9" maxlength="1" required />
                                <input type="text" name="code[]" class="twofacode" min="0" max="9" maxlength="1" required />
                                <input type="text" name="code[]" class="twofacode" min="0" max="9" maxlength="1" required />
                                <input type="text" name="code[]" class="twofacode" min="0" max="9" maxlength="1" required />
                                <input type="text" name="code[]" class="twofacode" min="0" max="9" maxlength="1" required />
                                <input type="text" name="code[]" class="twofacode" min="0" max="9" maxlength="1" required />
                            </div>
                            <!--end::six digit code-->
                            <!--start::notification-->
                            <div id="notification" class="mt-5"></div>
                            <!--end::notification-->

                            <!--start::time left-->
                            <div class="text-center mt-5 p-2 pt-2">
                                <h3 class="text-white" id="countdown_timer"></h3>
                            </div>
                            <!--end::time left-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Actions-->
                        <div class="text-center d-flex">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5 text-dark" style="margin-right: 1rem;background-color: #D93954;font-weight: 700;">
                                <span class="text-white">Kodu Doğrula</span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                        <!--begin::resend-->
                        <div class="text-center">
                            <a href="#" id="resend_code" class="link-primary fs-6 fw-bolder justify-content-center bgi-no-repeat mt-5" style="color: #fff;">Kodu Yeniden Gönder</a>
                        </div>
                        <!--end::resend-->
                        <!--start::problem-->
                        <hr class="mt-10">
                        <a href="mailto:pwctr.alumni@pwc.com?subject=Alumni Portal'a kayıt olurken telefon numaramı doğrularken sorun yaşıyorum.">
                            <p class="text-white mt-5">Telefon numaranızı doğrularken bir sorun mu yaşıyorsunuz?</p>
                        </a>
                        <!--end::problem-->
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
        const codes = document.querySelectorAll('.twofacode');
        codes[0].focus();
        codes.forEach((code, idx) => {
            code.addEventListener('keydown', (e) => {
                let kCd = e.keyCode || e.which;
                if (kCd == 0 || kCd == 229) { //for android chrome keycode fix
                    kCd = getKeyCode(this.value);
                }
                kCd = Number(kCd);
                if(kCd >= 48 && kCd <= 57) {
                    setTimeout(() => {
                        codes[idx+1].focus();
                    }, 10);
                }else if(kCd >= 97 && kCd <= 105){
                    setTimeout(() => {
                        codes[idx+1].focus();
                    }, 10);
                }else if (kCd == 8) {
                    setTimeout(() => {
                        codes[idx-1].focus();
                    }, 10);
                }
            });
        });
    </script>
    <script>
        let upgradeTime = 120; // seconds
        let seconds = upgradeTime;

        function pad(n) {
            return (n < 10 ? "0" + n : n);
        }
        function timer() {
            let days = Math.floor(seconds / 24 / 60 / 60);
            let hoursLeft = Math.floor((seconds) - (days * 86400));
            let hours = Math.floor(hoursLeft / 3600);
            let minutesLeft = Math.floor((hoursLeft) - (hours * 3600));
            let minutes = Math.floor(minutesLeft / 60);
            let remainingSeconds = seconds % 60;
            document.getElementById('countdown_timer').innerHTML = "Kalan süre " + pad(minutes) + ":" + pad(remainingSeconds) + " dakika";
            if (seconds == 0) {
                clearInterval(countdownTimer);
                document.getElementById('countdown_timer').innerHTML = "Size verilen süre doldu.";
            } else {
                seconds--;
            }
        }
        let countdownTimer = setInterval('timer()', 1000);
    </script>
    <script src="{{ url("js/axios.min.js") }}"></script>
    <script type="text/javascript">
    $("#resend_code").on('click', function(){
        let status = "";
        let msg = "";
        axios.get('{{ route('verification.phone.resend') }}')
        .then(function (response) {
            status = response.data.status;
            msg = response.data.msg;
            if(status == "error"){
                status = "danger";
            } else if(status == "success") {
                seconds = upgradeTime;
                countdownTimer = setInterval('timer()', 1000);
            }
            $("#notification").html("<strong class='text-"+ "white" + "'>" + msg + "</strong>")
        })
    });
    $("#phone_verify").on('submit', function(e){
        e.preventDefault();
        let status = "";
        let msg = "";
        const query = $('#phone_verify').serialize();
        axios.post('{{ route('verification.phone.verify') }}', query)
        .then(function (response){
            status = response.data.status;
            msg = response.data.msg;
            redirectTo = response.data.redirectTo;
            if(status == "error"){
                status = "danger";
            } else if(status == "success") {
                window.location.href = redirectTo;
            }
            $("#notification").html("<strong class='text-"+ status + "'>" + msg + "</strong>")
        })
    });
    </script>
    <script src="{{url('static/alumni/assets/plugins/custom/mask/inputmask.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#number_mask_twofa > input').inputmask({
                "mask": "9",
                "repeat": 1,
            });

        });

    </script>
@endsection
