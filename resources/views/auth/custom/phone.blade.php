@extends("auth.custom.layout")
@section("title", "İki Aşamalı Doğrulama")
@section("main")
    <div class="d-flex flex-column flex-root pwc-alumni_background-image">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <!--begin::Content-->
            <div class="d-flex flex-column justify-content-center flex-column-fluid p-10 pb-lg-20">
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 pwc-card_login">
                    <!--begin::Form-->
                    <form method="POST" id="phone_verify">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-10">
                            <!--begin::Title--> 
                            <div class="custom-bold" style="color:#d93954; font-size:20px; font-weight:700; margin-top:25px">Telefon Numaranızı Doğrulayın</div>
                            <div class="custom-html" style="font-size:16px; font-weight:bold; margin-top: 6px;">{{ $phone }}</div>
                            <div class="custom-html" style="font-size:16px; font-weight:bold; margin-top: 6px;">Yukarıdaki telefon numarasına gönderdiğimiz kodu girin.</div>
                           
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
                                <h3 class="" id="countdown_timer"></h3>
                            </div>
                            <!--end::time left-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Actions-->
                        <div class="text-center d-flex">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn btn-lg btn-primary w-100 text-dark mb-5"
                                style="background-color: #D93954; padding-bottom: 8px;">
                                <span class="text-white custom-html" style="font-size:17px">Kodu Doğrula</span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                        <!--begin::resend--> <a href="#" id="resend_code"
                                class="btn btn-lg btn-primary w-100 mb-5"
                                style="border: 1px solid white; padding-bottom: 8px; background:#e2e2e2;">
                                <span class="custom-html" style="color:#000; font-size:17px">Kodu Yeniden Gönder</span>
                        </a>
                        <!--end::resend-->
                        <!--start::problem-->
                        <hr class="mt-10">
                        <a href="mailto:pwctr.alumni@pwc.com?subject=Alumni sitesine girerken iki aşamalı doğrulamada sorun yaşıyorum.">
                            <div class="custom-html" style="font-size:16px; font-weight:bold; margin-top: 6px;">Telefon numaranızı doğrularken bir sorun mu yaşıyorsunuz?</div>
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
