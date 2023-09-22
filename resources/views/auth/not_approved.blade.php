@extends("auth.custom.layout")
@section("title", "Üyeliğiniz onay bekliyor")
@section("main")
<div class="d-flex flex-column flex-root pwc-alumni_background-image">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
        <!--begin::Content-->
        <div class="d-flex align-items-start justify-content-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 bg-black pwc-card_login">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
                    <!--begin::Heading-->
                    <div class="mb-10 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3 text-white">Telefon numaranız doğrulandı.</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <img src="{{ url("static/alumni/assets/media/icons/success-tick.png") }}" alt="Success">
                        <div class="fw-bold fs-5 mb-1 mt-5 text-white">{{ auth()->user()->maskedPhone() }}</div>
                        <div class="fs-6 text-white">Telefon Numarası Onaylandı!</div>
                        <hr class="mt-10" style="color: #FFF;"/>
                        <div class="text-white" style="font-weight: bold;">Kayıt talebiniz alınmıştır. Alumni ilişkileri sorumlumuz tarafından gerekli kontroller gerçekleştirildikten sonra tarafınıza dönüş sağlanacaktır.</div>
                        <p class="mt-5 font-weight-bold text-white">Yönlendiriliyorsunuz...</p>
                        <div id="countdown"></div>
                        <!--end::Link-->
                    </div>
                    <!--begin::Heading-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Main-->
@endsection
@section("js")
<script>

    setTimeout(function() {
        window.location.href = "https://www.pwc.com.tr/alumni"
    }, 61000); // 60 seconds
    let timeleft = 60;
    let downloadTimer = setInterval(function(){
        if(timeleft <= 0){
            clearInterval(downloadTimer);
            document.getElementById("countdown").innerHTML = "0";
        } else {
            document.getElementById("countdown").innerHTML = timeleft;
        }
        timeleft -= 1;
    }, 1000);
 </script>
@endsection
