@extends('alumni.layout.app')
@section('title', 'Profil Bilgilerim')
@section('bg', url('static/alumni/assets/media/background/knowledge.png'))
@section('breadcrumb', Breadcrumbs::render('profile'))
@section("abstract", "Profilinizi güncel tutarak eski çalışma arkadaşlarınız ve PwC ailesi ile iletişimde kalın.")
@section('main')
    <!--begin::Welcome Modal-->
    <div class="modal" tabindex="-1" id="prizePopup">
        <div class="modal-dialog info_modal_homepage">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Merhaba, {{ auth()->user()->name }}</h5>
                    <button type="button" class="btn-close homepage_modal_close_btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Çok heyecanlıyız. PwC Ailesinin tüm üyelerini bir araya getirmek amacıyla PwC Türkiye Alumni Topluluğunu yeniliklerle ve farklı buluşma platformları ile yeniden hayata geçirmekten büyük mutluluk duyuyoruz. PwC Türkiye Ailesine kattıklarınız çok kıymetli. Yeniliklerle dolu projelerimizle birlikte aramıza tekrar hoş geldiniz diyerek sizlere yeni web sitemizi tanıtmak istiyoruz.                    </p>
                    <p>
                        PwC Türkiye Alumni web sitesi 10bin kişiye yaklaşan PwC Ailemizin ana iletişim platformumuz olacak. Bu platform aracılığı ile birbirinizle iletişim kurabilir, PwC ailesinden yeni gelişmeler ve kariyer fırsatları hakkında haberdar olabilir, sizlere özel ayrıcalıklardan faydalanabilir, benzer ilgi alanlarına sahip arkadaşlarınızla biraraya gelebileceğiniz hobi kulüplerimize üye olabilirsiniz
                    </p>
                    <p>
                        Geçtiğimiz aylarda yaptığımız toplantılarımız ve etkinliklerimiz ile sizlerle bir araya gelme, hasret giderme fırsatı yakaladık, birbirimize anlatacak ne çok şey birikmiş!
                    </p>
                    <p>
                        Önümüzdeki günlerde gerek online gerek yüz yüze düzenleyeceğimiz etkinliklerimizde görüşmek dileğiyle.
                    </p>
                    <p>
                    Özlem Güç Alioğlu
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--end::Welcome Modal-->
    <div class="row mt-8">
        <div class="col-xl-4">
            <!--begin::Cards-->
            <div class="card shadow profile-info-card">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                    <!--begin::Avatar-->
                    <div type="button" data-bs-toggle="modal" data-bs-target="#profile_left_image_change"
                        class="symbol symbol-150px symbol-circle mb-5" style="margin-top: -8rem;">
                        <img style="object-fit: cover;" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Name-->
                    <a href="#" class="fs-4 text-dark text-hover-primary fw-bolder mb-0">{{ $user->name }}</a>
                    <!--end::Name-->
                    <!--begin::Position-->
                    <div class="fw-bold text-gray-400 mb-2">{{ $user->current_work_role ?? '-' }}</div>
                    <!--end::Position-->
                    <hr width="100%">
                    <!--begin::Info-->
                    <div class="d-flex flex-center flex-wrap w-100">
                        <!--begin::Stats-->
                        <div class="d-flex min-w-80px py-3 px-2 me-10 mb-3 flex-row w-100">
                            <div class="col-md-3">
                                <label type="button" data-bs-toggle="modal" data-bs-target="#profile_left_fullname_change"
                                    class="btn btn-xs btn-icon btn-hover-text-primary btn-shadow profile-icon_item"
                                    style="background-color: #EDF7FB" data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <img width="20" height="20"
                                        src="{{ url('static/alumni/assets/media/pwc_index/profil_1.svg') }}"
                                        alt="Ad Soyad İkinci Soyad">
                                </label>
                                <!--begin::Full Name Edit button-->
                                <label class="btn btn-icon btn-circle w-25px h-25px edit_pencil_button"
                                    data-bs-target="#profile_left_fullname_change" data-bs-toggle="modal">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                </label>
                                <!--end::Full Name Edit button-->
                            </div>
                            <div class="col-md-9">
                                <table class="table profile-table-line">
                                    <thead>
                                        <tr>
                                            <th scope="col">Adınız</th>
                                            <th scope="col">Soyadınız</th>
                                            <th class="text-break" scope="col">
                                            İkinci Soyadınız
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $user->getFirstName() }}</td>
                                            <td>{{ $user->getSurname() }}</td>
                                            <td class="text-break">{{ $user->second_surname ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--begin::Stats-->
                        <div class="d-flex min-w-80px py-3 px-2 me-10 mb-3 flex-row w-100">
                            <div class="col-md-3">
                                <label type="button" data-bs-toggle="modal" data-bs-target="#profile_left_birthday_change"
                                    class="btn btn-xs btn-icon btn-hover-text-primary btn-shadow profile-icon_item"
                                    style="background-color: #EDF7FB" data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <img width="20" height="20"
                                        src="{{ url('static/alumni/assets/media/pwc_index/profil_2.svg') }}"
                                        alt="Doğum tarihiniz">
                                </label>
                                <!--begin::Birthday Edit button-->
                                <label class="btn btn-icon btn-circle w-25px h-25px edit_pencil_button"
                                    data-bs-toggle="modal" data-bs-target="#profile_left_birthday_change">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                </label>
                                <!--end::Birthday Edit button-->
                            </div>
                            <div class="col-md-9">
                                <table class="table profile-table-line">
                                    <thead>
                                        <tr>
                                            <th scope="col">Doğum tarihiniz</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ optional($user->birthdate)->translatedFormat('d F Y') ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--begin::Stats-->
                        <div class="d-flex min-w-80px py-3 px-2 me-10 mb-3 flex-row w-100">
                            <div class="col-md-3">
                                <label class="btn btn-xs btn-icon btn-hover-text-primary btn-shadow profile-icon_item"
                                    style="background-color: #EDF7FB" data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <img width="20" height="20"
                                        src="{{ url('static/alumni/assets/media/pwc_index/profil_3.svg') }}"
                                        alt="Cep telefonu numaranız">
                                </label>
                            </div>
                            <div class="col-md-9">
                                <table class="table profile-table-line">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cep telefonu numaranız</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--begin::Stats-->
                        <div class="d-flex min-w-80px py-3 px-2 me-10 mb-3 flex-row w-100">
                            <div class="col-md-3">
                                <label class="btn btn-xs btn-icon btn-hover-text-primary btn-shadow profile-icon_item"
                                    style="background-color: #EDF7FB" data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <img width="20" height="20"
                                        src="{{ url('static/alumni/assets/media/pwc_index/profil_4.svg') }}"
                                        alt="Adresiniz">
                                </label>
                            </div>
                            <div class="col-md-9">
                                <table class="table profile-table-line">
                                    <thead>
                                        <tr>
                                            <th scope="col">Adresiniz</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-break">{{ $user->home_address ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--begin::Stats-->
                        <div class="d-flex min-w-80px py-3 px-2 me-10 mb-3 flex-row w-100">
                            <div class="col-md-3">
                                <label class="btn btn-xs btn-icon btn-hover-text-primary btn-shadow profile-icon_item"
                                    style="background-color: #EDF7FB" data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <img width="20" height="20"
                                        src="{{ url('static/alumni/assets/media/pwc_index/profil_5.svg') }}"
                                        alt="Doğum tarihiniz">
                                </label>
                            </div>
                            <div class="col-md-9">
                                <table class="table profile-table-line">
                                    <thead>
                                        <tr>
                                            <th scope="col">E-mail adresiniz</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-break">{{ $user->email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--begin::Stats-->
                        <div class="d-flex min-w-80px py-3 px-2 me-10 mb-3 flex-row w-100">
                            <div class="col-md-3">
                                <label class="btn btn-xs btn-icon btn-hover-text-primary btn-shadow profile-icon_item"
                                    style="background-color: #EDF7FB" data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <img width="20" height="20"
                                        src="{{ url('static/alumni/assets/media/pwc_index/profil_6.svg') }}"
                                        alt="Linkedin">
                                </label>
                            </div>
                            <div class="col-md-9">
                                <table class="table profile-table-line">
                                    <thead>
                                        <tr>
                                            <th scope="col">LinkedIn hesabınız</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-break">{{ $user->linkedin ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex min-w-80px py-3 px-2 me-10 mb-3 flex-row w-100">
                            <div class="col-md-3">
                                <label type="button" data-bs-toggle="modal" data-bs-target="#profile_left_password_change"
                                    class="btn btn-xs btn-icon btn-hover-text-primary btn-shadow profile-icon_item"
                                    style="background-color: #EDF7FB" data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <img width="20" height="20"
                                        src="{{ url('static/alumni/assets/media/pwc_index/kilitli.svg') }}"
                                        alt="Doğum tarihiniz">
                                </label>
                                <!--begin::Password Edit button-->
                                <label class="btn btn-icon btn-circle w-25px h-25px edit_pencil_button"
                                    data-bs-toggle="modal" data-bs-target="#profile_left_password_change">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                </label>
                                <!--end::Password Edit button-->
                            </div>
                            <div class="col-md-9">
                                <table class="table profile-table-line table-password-left">
                                    <tbody>
                                        <tr>
                                            <th scope="col">Şifremi Güncelle</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Cards-->
            <!--begin::Card Sosyal-->
            <div class="card shadow mt-5">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Card title-->
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 style="color: #000">Sosyal</h3>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow d-none"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                        </label>
                    </div>
                    <!--end::Card title-->
                    <hr style="width: 100%; color:#000;">
                    <div class="">
                        <b class="d-block profile_right_title">Katıldığım Hobi Kulüpleri</b>
                        <div class="d-inline mt-5">
                            @foreach ($hobbies as $hobby)
                                <span class="badge badge-pink mt-1">{{ $hobby->hobby_title }}</span>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card Sosyal-->
            <!--begin::Card Yetenekler-->
            <div class="card shadow mt-5" id="user-skills" style="display: none;">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Card title-->
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 style="color: #000">Yetenekler</h3>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow d-none"
                               data-action="change" data-toggle="tooltip" title="" data-original-title="Yetenekler">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                        </label>
                    </div>
                    <!--end::Card title-->
                    <hr style="width: 100%; color:#000;">
                    <div class="">
                        <b class="d-block profile_right_title">Bu alanı <a href="{{ route('jobs.index') }}">iş ilanları</a> kısmından güncelleyebilirsiniz.</b>
                        <div class="d-inline mt-5">
                            @foreach ($user->skills()->get(['name']) as $skill)
                                <span class="badge badge-pink mt-1">{{ $skill->name }}</span>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card Yetenekler-->
            <!--begin::Card Üyelikten Ayrıl-->
            <div class="card shadow mt-5">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Card title-->
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 style="color: #000">Üyelikten Ayrıl</h3>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow d-none"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                        </label>
                    </div>
                    <!--end::Card title-->
                    <hr style="width: 100%; color:#000;">
                    <form action="{{ route('delete-account') }}" method="post">
                        @method("delete")
                        @csrf
                        <button onclick="return confirm('Hesabınızı silmek istediğinizden emin misiniz?')" type="submit"
                            class="btn btn-link float-end text-danger"> Üyelikten ayrıl
                        </button>
                    </form>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card Üyelikten Ayrıl-->
        </div>
        <div class="col-xl-8 mt-md-0 mt-4">
            <div class="card shadow">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Card title-->
                    <h3 style="color: #000">Profil Durumu</h3>
                    <span>{{ $user->getFillingRate() }}%</span>
                    <!--end::Card title-->
                    <div class="d-flex text-gray-400">
                        <span class="gradient_profile_done">
                            <img style="margin-left: {{ $user->getFillingRate() - 2 }}%;" width="30" height="30"
                                src="{{ url('static/alumni/assets/media/pwc_index/ProfilDurumu_ilk.svg') }}"
                                alt="Profil tamamlandı">
                            <img width="30" height="30"
                                src="{{ url('static/alumni/assets/media/pwc_index/ProfilDurumu_iki.svg') }}"
                                alt="Profil tamamlandı">
                        </span>
                    </div>
                    <div class="mt-5">
                        @if (optional($user->updated_at)->diffInMonths() > 6)
                            <p class="font-weight-bold">Profiliniz en son <span
                                    style="color: rgba(208,74,2,1) !important;">{{ optional($user->updated_at)->translatedFormat('d F Y') }}</span>
                                tarihinde güncellediniz. İletişimimizin kesilmemesi için lütfen profilinizi güncel tutunuz.
                            </p>
                        @else
                            <p>İletişimimizin kesilmemesi için lütfen profilinizi güncel tutunuz.</p>
                        @endif
                    </div>

                </div>
                <!--end::Card body-->
            </div>
            <!--begin::Card İletişim Bilgilerim-->
            <div class="card shadow mt-5">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Card title-->
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 style="color: #000">İletişim Bilgilerim</h3>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#contact_info_form">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                        </a>
                    </div>
                    <!--end::Card title-->
                    <hr style="width: 100%; color:#000">
                    <div class="d-flex">
                        <table class="table align-middle gs-0 gy-4" id="user_info">
                            <!--begin::Table body-->
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="d-block profile_right_title">E-mail adresiniz (Kişisel)</span>
                                    </td>
                                    <td class="d-block" style="min-height: 61px;">
                                        <div>
                                            <span class="fw-bold profile_card_table">{{ $user->email }}</span>
                                            {!! $user->hasVerifiedEmail() ? '<span class="badge badge-yellow">Doğrulandı</span>' : '<span class="badge badge-orange">Doğrulanmadı</span> <button class="btn btn-sm pwc-pink-button ms-4" id="mail_verify">Doğrula!</button>' !!}
                                            <span class="profile_verification_spinner" id="email_spinner"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="d-block profile_right_title">E-mail adresiniz (İş)</span>
                                    </td>
                                    <td class="d-block" style="min-height: 61px;">
                                        <div>
                                            <span
                                                class="fw-bold profile_card_table">{{ $user->second_mail ?? '-' }}</span>
                                            {!! $user->hasVerifiedSecondMail() ? '<span class="badge badge-yellow">Doğrulandı</span>' : '<span class="badge badge-orange">Doğrulanmadı</span> <button class="btn btn-sm pwc-pink-button ms-4" id="business_mail_verify">Doğrula!</button>' !!}
                                            <span class="profile_verification_spinner" id="second_email_spinner"></span>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="d-block profile_right_title">Cep telefonu numaranız</span>
                                    </td>
                                    <td class="d-block">
                                        <span class="fw-bold profile_card_table">{{ $user->phone }}</span>
                                        {!! $user->hasVerifiedPhone() ? '<span class="badge badge-yellow">Doğrulandı</span>' : '<span class="badge badge-orange">Doğrulanmadı</span>' !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="d-block profile_right_title">Adresiniz</span>
                                    </td>
                                    <td class="d-block">
                                        <span class="fw-bold profile_card_table">{{ $user->home_address ?? '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="d-block profile_right_title">LinkedIn hesabınız</span>
                                    </td>
                                    <td class="text-break">
                                        <span class="fw-bold profile_card_table">{{ $user->linkedin ?? '-' }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card İletişim Bilgilerim-->
            <!--begin::Card PwC-->
            <div class="card shadow mt-5">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Card title-->
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 style="color: #000">PwC Bilgilerim</h3>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#pwc_info_form">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                        </a>
                    </div>
                    <!--end::Card title-->
                    <hr style="width: 100%; color:#000">
                    <div class="d-flex">
                        <table class="table align-middle gs-0 gy-4" id="user_pwc_info">
                            <!--begin::Table body-->
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-block profile_right_title">Şirket unvanı</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="fw-bold d-block profile_card_table">{{ optional($user->pwcLegacy)->name ?? '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="d-block profile_right_title">PwC’de çalışmaya başladığınız tarih</span>
                                    </td>
                                    <td>
                                        <span
                                            class="fw-bold d-block profile_card_table">{{ optional($user->pwc_join_year)->format('d.m.Y') ?? '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="d-block profile_right_title">PwC'den ayrıldığınız tarih</span>
                                    </td>
                                    <td>
                                        <span
                                            class="fw-bold d-block profile_card_table">{{ optional($user->pwc_quit_year)->format('d.m.Y') ?? '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="d-block profile_right_title">PwC'de çalıştığınız ofis</span>
                                    </td>
                                    <td class="d-block">
                                        <span
                                            class="fw-bold profile_card_table">{{ optional($user->pwcWorkedOffice)->name ?? '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-block profile_right_title">PwC'de çalıştığınız (LoS)</span>
                                        </div>
                                    </td>
                                    <td class="d-block">
                                        <span
                                            class="fw-bold profile_card_table">{{ optional($user->pwcWorkedTeamLos)->name ?? '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-block profile_right_title">PwC'de çalıştığınız (SubLoS)</span>
                                        </div>
                                    </td>
                                    <td class="d-block">
                                        <span
                                            class="fw-bold profile_card_table">{{ optional($user->pwcWorkedTeamSubLos)->name ?? '-' }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card PwC-->
            <!--begin::Card Güncel Şirket Bilgilerim-->
            <div class="card shadow mt-5">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Card title-->
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 style="color: #000">Güncel Şirket Bilgilerim</h3>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#professional_experience">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                        </a>
                    </div>
                    <!--end::Card title-->
                    <hr style="width: 100%; color:#000">
                    <div class="d-flex">
                        <table class="table align-middle gs-0 gy-4" id="user_professional_info">
                            <!--begin::Table body-->
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-block profile_right_title">Çalıştığınız şirketin adı</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="fw-bold profile_card_table">{{ $user->current_work_company ?? '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="d-block profile_right_title">Çalıştığınız şirketteki göreviniz</span>
                                    </td>
                                    <td>
                                        <span
                                            class="fw-bold profile_card_table">{{ $user->current_work_role ?? '-' }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card Güncel Şirket Bilgilerim-->
            <!--begin::Card Eğitim Bilgilerim-->
            <div class="card shadow mt-5">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Card title-->
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 style="color: #000">Eğitim Bilgilerim</h3>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#education_form">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                        </a>
                    </div>
                    <!--end::Card title-->
                    <hr style="width: 100%; color:#000">
                    <div class="d-flex">
                        <table class="table align-middle gs-0 gy-4" id="user_educational_info">
                            <!--begin::Table body-->
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="d-block profile_right_title">Mezun olduğunuz üniversite</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold profile_card_table">{{ $user->university ?? '-' }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card Eğitim Bilgilerim-->

            <!--begin::Card İletişim Tercihlerim-->
            <div class="card shadow mt-5">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Card title-->
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 style="color: #000">İletişim Tercihlerim</h3>
                        <label class="d-none btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                        </label>
                    </div>
                    <!--end::Card title-->
                    <hr style="width: 100%; color:#000">
                    <form id="permissions_form">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>PwC Türkiye</h3>
                                @foreach ($pwc_permissions as $pwc_permission)
                                    <div class="form-check mb-4 ps-0">
                                        <div class="d-flex">
                                            <label class="switch">
                                                <input value="{{ $pwc_permission->id }}"
                                                    class="permissions_form_switch consents" name="{{ $pwc_permission->slug }}"
                                                    type="checkbox" {{ $pwc_permission->allowed ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                            <p style="margin:.4rem 0 0 .5rem" class="switch-paragraph">{{ $pwc_permission->desc }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <h3>PwC Alumni</h3>
                                @foreach ($alumni_permissions as $alumni_permission)
                                    <div class="form-check mb-4 ps-0">
                                        <div class="d-flex">
                                            <label class="switch">
                                                <input value="{{ $alumni_permission->id }}"
                                                    class="permissions_form_switch consents" name="{{ $alumni_permission->slug }}"
                                                    type="checkbox" {{ $alumni_permission->allowed ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                            <p style="margin:.4rem 0 0 .5rem" class="switch-paragraph">{{ $alumni_permission->desc }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- marketing permission -->
                        </div>
                    </form>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card İletişim Tercihlerim-->
        </div>
    </div>

    <!--Begin::Modal(İletişim Bilgilerim)-->
    <div class="modal fade" tabindex="-1" id="contact_info_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">İletişim Bilgilerim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_contact_info">
                        @csrf
                        <div class="form-group">
                            <label class="profile_card_table" for="personal-email">E-mail adresiniz (Kişisel)</label>
                            <input value="{{ $user->email }}" type="email" name="email" class="form-control"
                                id="personal-email" aria-describedby="email" placeholder="E-mail adresiniz (Kişisel)">
                        </div>
                        <div class="form-group">
                            <label class="profile_card_table" for="job-email">E-mail adresiniz (İş)</label>
                            <input value="{{ $user->second_mail }}" type="email" name="second_mail"
                                class="form-control" id="job-email" aria-describedby="email" placeholder="E-mail adresiniz (İş)">
                        </div>
                        <div class="form-group">
                            <label class="profile_card_table" class="profile_card_table" for="phone_number">Cep telefonu numaranız</label>
                            <input value="{{ $user->phone }}" type="text" name="phone" class="form-control"
                                id="phone_number" placeholder="Cep telefonu numaranız">
                        </div>
                        <div class="form-group">
                            <label class="profile_card_table" for="adress">Adresiniz</label>
                            <input value="{{ $user->home_address }}" type="text" name="home_address"
                                class="form-control" id="adress" placeholder="Adresiniz">
                        </div>
                        <div class="form-group">
                            <label class="profile_card_table" for="linkedin">LinkedIn hesabınız</label>
                            <input value="{{ $user->linkedin }}" type="url" name="linkedin" class="form-control"
                                id="linkedin" placeholder="https://www.linkedin.com/">
                        </div>
                        <button class="btn pwc-orange-button text-uppercase"
                            id="profile_contact_information_change_save">Değişiklikleri Kaydet</button>
                        <span id="contact_save_spinner"></span>
                        <div id="form_contact_info_message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::Modal(İletişim Bilgilerim)-->
    <!--Begin::Modal(PwC)-->
    <div class="modal fade" tabindex="-1" id="pwc_info_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PwC Bilgilerim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_pwc_info">
                        @csrf
                        <input type="hidden" id="hidden_email" name="email" value="{{ $user->email }}">
                        <input type="hidden" id="hidden_phone" name="phone" value="{{ $user->phone }}">
                        <input type="hidden" id="hidden_linkedin" name="linkedin" value="{{ $user->linkedin }}">
                        <div class="form-group">
                            <label class="profile_card_table" for="legacy">Şirket unvanı</label>
                            <input value="{{ optional($user->pwcLegacy)->name }}" type="text" name="legacy"
                                class="form-control" id="legacy" aria-describedby="legacy">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <label class="profile_card_table" for="first-join-pwc">PwC’de çalışmaya başladığınız tarih</label>
                                <div class="position-relative table_info"
                                    data="İşe giriş tarihinizi staj döneminiz varsa dahil etmeyiniz.">
                                    <img width="15" height="15"
                                        src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ optional($user->pwc_join_year)->format('d.m.Y') }}" name="pwc_join_year"
                                class="form-control" id="first-join-pwc" aria-describedby="first-join-pwc"
                                autocomplete="off" placeholder="gg.aa.yyyy">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <label class="profile_card_table" for="leave-pwc">PwC'den ayrıldığınız tarih</label>
                                <div class="position-relative table_info"
                                     data="PwC'den en son ayrıldığınız tarihi belirtiniz.">
                                    <img width="15" height="15"
                                         src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ optional($user->pwc_quit_year)->format('d.m.Y') }}" name="pwc_quit_year"
                                class="form-control" id="leave-pwc" autocomplete="off" placeholder="gg.aa.yyyy">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <label class="profile_card_table" for="department_pwc">PwC'de çalıştığınız ofis</label>
                                <div class="position-relative table_info" data="En son çalıştığınız ekibi belirtiniz.">
                                    <img width="15" height="15"
                                         src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ optional($user->pwcWorkedOffice)->name }}" type="text"
                                name="pwc_worked_office" class="form-control" id="department_pwc">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <label class="profile_card_table" for="working_team">PwC'de çalıştığınız (LoS)</label>
                                <div class="position-relative table_info" data="En son çalıştığınız ekibi seçiniz.">
                                    <img width="15" height="15"
                                        src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ optional($user->pwcWorkedTeamLos)->name }}" type="text"
                                name="pwc_worked_team_los" class="form-control" id="pwc_worked_team_los">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <label class="profile_card_table" for="working_team">PwC'de çalıştığınız (SubLoS)</label>
                                <div class="position-relative table_info" data="En son çalıştığınız ekibi seçiniz.">
                                        <img width="15" height="15"
                                            src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ optional($user->pwcWorkedTeamSubLos)->name }}" type="text"
                                name="pwc_worked_team_sublos" class="form-control" id="pwc_worked_team_sublos">
                        </div>
                        <button type="submit" class="btn pwc-orange-button text-uppercase"
                            id="profile_pwc_info_change_save">Değişiklikleri Kaydet</button>
                        <span id="pwc_info_save_spinner"></span>
                        <div id="form_pwc_info_message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::Modal(PwC)-->
    <!--Begin::Modal(Güncel Şirket Bilgilerim)-->
    <div class="modal fade" tabindex="-1" id="professional_experience">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Güncel Şirket Bilgilerim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_professional_experience">
                        @csrf
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="phone" value="{{ $user->phone }}">
                        <input type="hidden" name="linkedin" value="{{ $user->linkedin }}">
                        <div class="form-group">
                            <div class="d-flex">
                                <label class="profile_card_table" for="company_works_pwc">Çalıştığınız şirketin adı</label>
                                <div class="position-relative table_info"
                                    data="Çalıştığınız şirketin adı aşağıdaki önerilenlerde yoksa eklememiz için aşağıdaki alana yazınız.">
                                    <img width="15" height="15"
                                        src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ $user->current_work_company }}" type="text" name="current_work_company"
                                class="form-control" id="company_works_pwc" aria-describedby="first-join-pwc"
                                placeholder="Çalıştığınız şirketin adı">
                        </div>
                        <div class="form-group">
                            <label class="profile_card_table" for="company_works_title">Çalıştığınız şirketteki göreviniz</label>
                            <input value="{{ $user->current_work_role }}" type="text" name="current_work_role"
                                class="form-control" id="company_works_title"
                                placeholder="Çalıştığınız şirketteki göreviniz">
                        </div>
                        <button type="submit" class="btn pwc-orange-button text-uppercase"
                            id="profile_professionel_experience_change_save">Değişiklikleri Kaydet</button>
                        <span id="professionel_experience_save_spinner"></span>
                        <div id="form_professional_experience_message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::Modal(Güncel Şirket Bilgilerim)-->
    <!--Begin::Modal(Eğitim Bilgilerim)-->
    <div class="modal fade" tabindex="-1" id="education_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eğitim Bilgilerim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_education">
                        @csrf
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="phone" value="{{ $user->phone }}">
                        <input type="hidden" name="linkedin" value="{{ $user->linkedin }}">
                        <div class="form-group">
                            <label class="profile_card_table" for="university">Mezun olduğunuz üniversite</label>
                            <input value="{{ $user->university }}" type="text" name="university" class="form-control"
                                id="university" aria-describedby="university">
                        </div>
                        <button type="submit" class="btn pwc-orange-button text-uppercase"
                            id="profile_education_change_save">Değişiklikleri Kaydet</button>
                        <span id="education_save_spinner"></span>
                        <div id="form_education_message"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::Modal(Eğitim Bilgilerim)-->

    <!--Begin::Modal(Profile Left İmage)-->
    <div class="modal fade" tabindex="-1" id="profile_left_image_change">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profil Fotoğrafı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_image_change" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="phone" value="{{ $user->phone }}">
                        <input type="hidden" name="linkedin" value="{{ $user->linkedin }}">
                        <div class="form-group">
                            <label for="formFile" class="form-label">Profil Fotoğrafı</label>
                            <input class="form-control" id="avatar" name="avatar" type="file">
                        </div>
                        <button type="submit" class="btn pwc-orange-button text-uppercase"
                            id="profile_image_change_save">Değişiklikleri Kaydet</button>
                        <span id="image_save_spinner"></span>
                        <div id="form_image_change_message"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::Modal(Profile Left İmage)-->
    <!--Begin::Modal(Profile Left Fullname)-->
    <div class="modal fade" tabindex="-1" id="profile_left_fullname_change">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adınız - Soyadınız</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_fullname_change">
                        @csrf
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="phone" value="{{ $user->phone }}">
                        <input type="hidden" name="linkedin" value="{{ $user->linkedin }}">
                        <div class="form-group">
                            <label class="profile_card_table" for="fullname">Adınız Soyadınız</label>
                            <input value="{{ $user->name }}" type="text" name="name" class="form-control"
                                id="fullname" aria-describedby="fullname" placeholder="Adınız Soyadınız">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <label class="profile_card_table" for="secondsurname">İkinci Soyadınız</label>
                                <div class="position-relative table_info" data="PwC'de çalışırkenki soyadınız farklı ise lütfen bu alanı doldurunuz.">
                                    <img width="15" height="15"
                                        src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ $user->second_surname }}" type="text" name="second_surname"
                                class="form-control" id="second_surname" aria-describedby="secondsurname"
                                placeholder="İkinci Soyad">
                        </div>
                        <button type="submit" class="btn pwc-orange-button text-uppercase"
                            id="profile_name_surname_change_save">Değişiklikleri Kaydet</button>
                        <span id="name_surname_save_spinner"></span>
                        <div id="form_fullname_change_message"></div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::Modal(Profile Left Fullname)-->
    <!--Begin::Modal(Profile Left Birthday)-->
    <div class="modal fade" tabindex="-1" id="profile_left_birthday_change">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Doğum tarihiniz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_birthday_change">
                        @csrf
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="phone" value="{{ $user->phone }}">
                        <input type="hidden" name="linkedin" value="{{ $user->linkedin }}">
                        <div class="form-group">
                            <label class="profile_card_table" for="birthday">Doğum tarihiniz</label>
                            <input type="text" value="{{ optional($user->birthdate)->format('d.m.Y') }}" name="birthdate"
                                class="form-control" id="birthday" aria-describedby="birthday" placeholder="Doğum tarihiniz"
                                autocomplete="off">
                            <date-picker format="MMMM DD (DDD), YYYY"
                                value="{{ optional($user->birthdate)->format('d.m.Y') }}" name="birthdate"></date-picker>
                        </div>
                        <button type="submit" class="btn pwc-orange-button text-uppercase"
                            id="profile_birthday_change_save">Değişiklikleri Kaydet</button>
                        <span id="birthday_save_spinner"></span>
                        <div id="form_birthday_change_message"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::Modal(Profile Left Birthday)-->
    <!--Begin::Modal(Profile Left Birthday)-->
    <div class="modal fade" tabindex="-1" id="profile_left_password_change">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Şifreyi Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_password_change">
                        @csrf
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="phone" value="{{ $user->phone }}">
                        <input type="hidden" name="linkedin" value="{{ $user->linkedin }}">
                        <div class="form-group">
                            <label class="profile_card_table" for="password">Şifre</label>
                            <input type="password" name="old_password" class="form-control" id="password"
                                aria-describedby="password" placeholder="Şifre" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="profile_card_table" for="password">Yeni Şifre</label>
                            <input type="password" name="new_password" class="form-control" id="new_password"
                                aria-describedby="password" placeholder="Şifre" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="profile_card_table" for="password">Yeni Şifre Tekrar</label>
                            <input type="password" name="new_password_confirmation" class="form-control"
                                id="new_password_confirmation" aria-describedby="password" autocomplete="off"
                                placeholder="Şifre">
                        </div>
                        <button type="submit" class="btn pwc-orange-button text-uppercase"
                            id="profile_password_update_change_save">Değişiklikleri Kaydet</button>
                        <span id="password_update_save_spinner"></span>
                        <div id="form_password_change_message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::Modal(Profile Left Birthday)-->
@endsection
@section('js')
    <script src="{{ url('js/axios.min.js') }}"></script>
    <script type="text/javascript">
        const loaderxl = `<div class="spinner-border" id="spinner_contact_information" role="status">
                                            <span class="visually-hidden ">Loading...</span>
                                        </div>`
        const loadersm = `<div class="spinner-border" id="spinner_contact_information" role="status">
                                            <span class="visually-hidden spinner-border-sm">Loading...</span>
                                        </div>`

        $("form#form_contact_info").on("submit", function(e) {
            e.preventDefault();
            const query = $('#form_contact_info').serialize();

            $("#profile_contact_information_change_save").hide();
            $('#contact_save_spinner').html(loaderxl);
            axios.post('{{ route('profile.update') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    $('#contact_save_spinner').hide();
                    if (status == "success") {
                        $("#form_contact_info_message").html(
                            "<div class='alert alert-success mt-5' role='alert'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Değişiklikleriniz başarıyla kaydedildi.</div>"
                        );
                        $("#form_contact_info_message").fadeIn(500).delay(3000).fadeOut(500);
                        window.location.reload();
                    } else {
                        $("#form_contact_info_message").html(
                            "<div class='alert alert-danger mt-5' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Hata oluştu. Lütfen daha sonra tekrar deneyin.</div>"
                        );
                        $("#form_contact_info_message").fadeIn(500).delay(3000).fadeOut(500);
                        $("#profile_contact_information_change_save").show();
                    }
                });
            return false;
        });

        $("form#form_pwc_info").on("submit", function(e) {
            e.preventDefault();
            const query = $('#form_pwc_info').serialize();

            $("#profile_pwc_info_change_save").hide();
            $('#pwc_info_save_spinner').html(loaderxl);
            axios.post('{{ route('profile.update') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    $('#pwc_info_save_spinner').hide();
                    if (status == "success") {
                        $("#form_pwc_info_message").html(
                            "<div class='alert alert-success mt-5' role='alert'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Değişiklikleriniz başarıyla kaydedildi.</div>"
                        );
                        $("#form_pwc_info_message").fadeIn(500).delay(3000).fadeOut(500);
                        window.location.reload();
                    } else {
                        $("#form_pwc_info_message").html(
                            "<div class='alert alert-danger mt-5' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Hata oluştu. Lütfen daha sonra tekrar deneyin.</div>"
                        );
                        $("#form_pwc_info_message").fadeIn(500).delay(3000).fadeOut(500);
                        $("#profile_pwc_info_change_save").show();
                    }
                });
            return false;
        });
        $("form#form_professional_experience").on("submit", function(e) {
            e.preventDefault();
            const query = $('#form_professional_experience').serialize();
            console.log(query);
            $("#profile_professionel_experience_change_save").hide();
            $('#professionel_experience_save_spinner').html(loaderxl);
            axios.post('{{ route('profile.update') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    $('#professionel_experience_save_spinner').hide();
                    if (status == "success") {
                        $("#form_professional_experience_message").html(
                            "<div class='alert alert-success mt-5' role='alert'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Değişiklikleriniz başarıyla kaydedildi.</div>"
                        );
                        $("#form_professional_experience_message").fadeIn(500).delay(3000).fadeOut(500);
                        window.location.reload();
                    } else {
                        $("#form_professional_experience_message").html(
                            "<div class='alert alert-danger mt-5' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Hata oluştu. Lütfen daha sonra tekrar deneyin.</div>"
                        );
                        $("#form_professional_experience_message").fadeIn(500).delay(3000).fadeOut(500);
                        $("#profile_professionel_experience_change_save").show();
                    }
                });
            return false;
        });
        $("form#form_education").on("submit", function(e) {
            e.preventDefault();
            const query = $('#form_education').serialize();

            $("#profile_education_change_save").hide();
            $('#education_save_spinner').html(loaderxl);
            axios.post('{{ route('profile.update') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    $('#education_save_spinner').hide();
                    if (status == "success") {
                        $("#form_education_message").html(
                            "<div class='alert alert-success mt-5' role='alert'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Değişiklikleriniz başarıyla kaydedildi.</div>"
                        );
                        $("#form_education_message").fadeIn(500).delay(3000).fadeOut(500);
                        window.location.reload();
                    } else {
                        $("#form_education_message").html(
                            "<div class='alert alert-danger mt-5' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Hata oluştu. Lütfen daha sonra tekrar deneyin.</div>"
                        );
                        $("#form_education_message").fadeIn(500).delay(3000).fadeOut(500);
                        $("#profile_education_change_save").show();
                    }
                });
            return false;
        });
        $("form#form_fullname_change").on("submit", function(e) {
            e.preventDefault();
            const query = $('#form_fullname_change').serialize();

            $("#profile_name_surname_change_save").hide();
            $('#name_surname_save_spinner').html(loaderxl);
            axios.post('{{ route('profile.update') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    $('#name_surname_save_spinner').hide();
                    if (status == "success") {
                        $("#form_fullname_change_message").html(
                            "<div class='alert alert-success mt-5' role='alert'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Değişiklikleriniz başarıyla kaydedildi.</div>"
                        );
                        $("#form_fullname_change_message").fadeIn(500).delay(3000).fadeOut(500);
                        window.location.reload();
                    } else {
                        $("#form_fullname_change_message").html(
                            "<div class='alert alert-danger mt-5' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Hata oluştu. Lütfen daha sonra tekrar deneyin.</div>"
                        );
                        $("#form_fullname_change_message").fadeIn(500).delay(3000).fadeOut(500);
                        $("#profile_name_surname_change_save").show();
                    }
                });
            return false;
        });
        $("form#form_image_change").on("submit", function(e) {
            e.preventDefault();
            const query = $('#form_image_change').serialize();

            $("#profile_image_change_save").hide();
            $('#image_save_spinner').html(loaderxl);
            let formData = new FormData()
            let avatar = document.querySelector('#avatar');
            formData.append('avatar', avatar.files[0]);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('phone', $("#hidden_phone").val());
            formData.append('email', $('#hidden_email').val());
            formData.append('linkedin', $('#hidden_linkedin').val());

            axios.post('{{ route('profile.update') }}', formData)
                .then(function(response) {
                    let status = response.data.status;
                    $('#image_save_spinner').hide();
                    if (status == "success") {
                        $("#form_image_change_message").html(
                            "<div class='alert alert-success mt-5' role='alert'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Değişiklikleriniz başarıyla kaydedildi.</div>"
                        );
                        $("#form_image_change_message").fadeIn(500).delay(3000).fadeOut(500);
                        window.location.reload();
                    } else {
                        $("#form_image_change_message").html(
                            "<div class='alert alert-danger mt-5' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Hata oluştu. Lütfen daha sonra tekrar deneyin.</div>"
                        );
                        $("#form_image_change_message").fadeIn(500).delay(3000).fadeOut(500);
                        $("#profile_image_change_save").show();
                    }
                });
            return false;
        });

        $("form#form_birthday_change").on("submit", function(e) {
            e.preventDefault();
            const query = $('#form_birthday_change').serialize();
            $("#profile_birthday_change_save").hide();
            $('#birthday_save_spinner').html(loaderxl);
            axios.post('{{ route('profile.update') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    $('#birthday_save_spinner').hide();
                    if (status == "success") {
                        $("#form_birthday_change_message").html(
                            "<div class='alert alert-success mt-5' role='alert'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Değişiklikleriniz başarıyla kaydedildi.</div>"
                        );
                        $("#form_birthday_change_message").fadeIn(500).delay(3000).fadeOut(500);
                        window.location.reload();
                    } else {
                        $("#form_birthday_change_message").html(
                            "<div class='alert alert-danger mt-5' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Hata oluştu. Lütfen daha sonra tekrar deneyin.</div>"
                        );
                        $("#form_birthday_change_message").fadeIn(500).delay(3000).fadeOut(500);
                        $("#profile_birthday_change_save").show();
                    }
                });
            return false;
        });


        $("form#form_password_change").on("submit", function(e) {
            e.preventDefault();
            const query = $('#form_password_change').serialize();

            $("#profile_password_update_change_save").hide();
            $('#password_update_save_spinner').html(loaderxl);
            axios.post('{{ route('profile.password') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    let data = response.data;
                    let validation_errors = Object.values(data.data).flat().join('<br />');

                    $('#password_update_save_spinner').hide();
                    if (status == "success") {
                        $("#form_password_change_message").html(
                            "<div class='alert alert-success mt-5' role='alert'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Değişiklikleriniz başarıyla kaydedildi.</div>"
                        );
                        $("#form_password_change_message").fadeIn(500).delay(3000).fadeOut(500);
                        window.location.reload();
                    } else {
                        $("#form_password_change_message").html(
                            "<div class='alert alert-danger mt-5' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>" +
                            validation_errors + "</div>");
                        $("#form_password_change_message").fadeIn(500).delay(10000);
                        $("#profile_password_update_change_save").show();
                    }
                });

            return false;
        });

        // verify second mail
        $("#business_mail_verify").on("click", function(e) {
            e.preventDefault();
            let loader = `<div class="spinner-border spinner-border-sm" id="spinner_verify_second_mail" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>`
            document.getElementById('second_email_spinner').innerHTML = loader;
            $('#business_mail_verify').css("visibility", "hidden");
            axios.post('{{ route('user.resend.second.mail') }}')
                .then(function(response) {
                    let status = response.data.status;
                    if (status == "success") {
                        toastr.success("Doğrulama kodu başarı ile yollanmıştır!");
                        $('#spinner_verify_second_mail').hide();
                        $('#business_mail_verify').css("visibility", "visible");
                    } else {
                        toastr.error("Lütfen iş e-mail adresinizi kontrol ediniz!");
                        $('#spinner_verify_second_mail').hide();
                        $('#business_mail_verify').css("visibility", "visible");
                    }
                });
            return false;
        });

        // verify mail
        $("#mail_verify").on("click", function(e) {
            e.preventDefault();
            let loader = `<div class="spinner-border spinner-border-sm" id="spinner_verify_mail" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>`
            document.getElementById('email_spinner').innerHTML = loader;
            $('#mail_verify').css("visibility", "hidden");
            axios.post('{{ route('verification.resend') }}')
                .then(function(response) {
                    let status = response.status
                    if (status < 300) {
                        toastr.success("Doğrulama kodu başarı ile yollanmıştır!");
                        $('#spinner_verify_mail').hide();
                        $('#mail_verify').css("visibility", "visible");
                    } else {
                        toastr.error("Lütfen email adresinizi kontrol ediniz!");
                        $('#spinner_verify_mail').hide();
                        $('#mail_verify').css("visibility", "visible");
                    }
                });
            return false;
        });

        // tagify university
        new Tagify(document.querySelector("#university"), {
            whitelist: ["Adana Bilim ve Teknoloji Üniversitesi", "Çukurova Üniversitesi", "Adıyaman Üniversitesi",
                "Afyon Kocatepe Üniversitesi", "Afyonkarahisar Sağlık Bilimleri Üniversitesi",
                "Ağrı İbrahim Çeçen Üniversitesi", "Aksaray Üniversitesi", "Amasya Üniversitesi",
                "Ankara Üniversitesi", "Ankara Müzik ve Güzel Sanatlar Üniversitesi",
                "Ankara Hacı Bayram Veli Üniversitesi", "Ankara Sosyal Bilimler Üniversitesi",
                "Gazi Üniversitesi", "Hacettepe Üniversitesi", "Orta Doğu Teknik Üniversitesi",
                "Ankara Yıldırım Beyazıt Üniversitesi", "Anka Teknoloji Üniversitesi",
                "Ankara Medipol Üniversitesi", "Atılım Üniversitesi", "Başkent Üniversitesi",
                "Çankaya Üniversitesi", "İhsan Doğramacı Bilkent Üniversitesi", "Lokman Hekim Üniversitesi",
                "Ostim Teknik Üniversitesi", "TED Üniversitesi", "TOBB Ekonomi ve Teknoloji Üniversitesi",
                "Ufuk Üniversitesi", "Türk Hava Kurumu Üniversitesi", "Yüksek İhtisas Üniversitesi",
                "Polis Akademisi", "Akdeniz Üniversitesi", "Alaaddin Keykubat Üniversitesi",
                "Hamdullah Emin Paşa Üniversitesi", "Antalya Akev Üniversitesi", "Antalya Bilim Üniversitesi",
                "Ardahan Üniversitesi", "Artvin Çoruh Üniversitesi", "Aydın Adnan Menderes Üniversitesi",
                "Balıkesir Üniversitesi", "Bandırma Onyedi Eylül Üniversitesi", "Bartın Üniversitesi",
                "Batman Üniversitesi", "Bayburt Üniversitesi", "Bilecik Şeyh Edebali Üniversitesi",
                "Bingöl Üniversitesi", "Bitlis Eren Üniversitesi", "Bolu Abant İzzet Baysal Üniversitesi",
                "Burdur Mehmet Akif Ersoy Üniversitesi", "Bursa Teknik Üniversitesi",
                "Bursa Uludağ Üniversitesi", "Çanakkale Onsekiz Mart Üniversitesi",
                "Çankırı Karatekin Üniversitesi", "Hitit Üniversitesi", "Pamukkale Üniversitesi",
                "Dicle Üniversitesi", "Düzce Üniversitesi", "Trakya Üniversitesi", "Fırat Üniversitesi",
                "Erzincan Binali Yıldırım Üniversitesi", "Atatürk Üniversitesi", "Erzurum Teknik Üniversitesi",
                "Anadolu Üniversitesi", "Eskişehir Osmangazi Üniversitesi", "Eskişehir Teknik Üniversitesi",
                "Gaziantep Üniversitesi", "Gaziantep İslam Bilim ve Teknoloji Üniversitesi",
                "Hasan Kalyoncu Üniversitesi", "Sanko Üniversitesi", "Giresun Üniversitesi",
                "Gümüşhane Üniversitesi", "Hakkari Üniversitesi", "İskenderun Teknik Üniversitesi",
                "Mustafa Kemal Üniversitesi", "Iğdır Üniversitesi", "Süleyman Demirel Üniversitesi",
                "Isparta Uygulamalı Bilimler Üniversitesi", "Boğaziçi Üniversitesi", "Galatasaray Üniversitesi",
                "İstanbul Medeniyet Üniversitesi", "İstanbul Teknik Üniversitesi", "İstanbul Üniversitesi",
                "İstanbul Üniversitesi", "Marmara Üniversitesi", "Millî Savunma Üniversitesi",
                "Mimar Sinan Güzel Sanatlar Üniversitesi",
                "Türkiye Uluslararası İslam, Bilim ve Teknoloji Üniversitesi", "Türk-Alman Üniversitesi",
                "Sağlık Bilimleri Üniversitesi", "Yıldız Teknik Üniversitesi", "Acıbadem Üniversitesi",
                "Bahçeşehir Üniversitesi", "Beykent Üniversitesi", "Bezmialem Vakıf Üniversitesi",
                "Biruni Üniversitesi", "Doğuş Üniversitesi", "Fatih Sultan Mehmet Üniversitesi",
                "Gedik Üniversitesi", "Haliç Üniversitesi", "Işık Üniversitesi", "İbn Haldun Üniversitesi",
                "İstanbul 29 Mayıs Üniversitesi", "İstanbul Altınbaş Üniversitesi",
                "İstanbul Arel Üniversitesi", "İstanbul Atlas Üniversitesi", "İstanbul Aydın Üniversitesi",
                "İstanbul Ayvansaray Üniversitesi", "İstanbul Beykoz Üniversitesi",
                "İstanbul Bilgi Üniversitesi", "İstanbul Bilim Üniversitesi", "İstanbul Ticaret Üniversitesi",
                "İstanbul Esenyurt Üniversitesi", "İstanbul Gedik Üniversitesi",
                "İstanbul Gelişim Üniversitesi", "İstanbul Kent Üniversitesi", "İstanbul Kültür Üniversitesi",
                "İstanbul Medipol Üniversitesi", "İstanbul Okan Üniversitesi", "İstanbul Rumeli Üniversitesi",
                "İstanbul Sabahattin Zaim Üniversitesi", "İstanbul Şehir Üniversitesi", "İstinye Üniversitesi",
                "Kadir Has Üniversitesi", "Koç Üniversitesi", "Maltepe Üniversitesi", "MEF Üniversitesi",
                "Nişantaşı Üniversitesi", "İstanbul Okan Üniversitesi", "Özyeğin Üniversitesi",
                "Piri Reis Üniversitesi", "Sabancı Üniversitesi", "Semerkand Bilim ve Medeniyet Üniversitesi",
                "Üsküdar Üniversitesi", "Yeditepe Üniversitesi", "İstanbul Yeni Yüzyıl Üniversitesi",
                "İzmir Dokuz Eylül Üniversitesi", "Ege Üniversitesi", "İzmir Yüksek Teknoloji Enstitüsü",
                "İzmir Kâtip Çelebi Üniversitesi", "İzmir Bakırçay Üniversitesi",
                "İzmir Demokrasi Üniversitesi", "İzmir Ekonomi Üniversitesi", "İzmir Tınaztepe Üniversitesi",
                "Yaşar Üniversitesi", "Kahramanmaraş Sütçü İmam Üniversitesi",
                "Kahramanmaraş İstiklal Üniversitesi", "Karabük Üniversitesi",
                "Karamanoğlu Mehmetbey Üniversitesi", "Kafkas Üniversitesi", "Kastamonu Üniversitesi",
                "Abdullah Gül Üniversitesi", "Erciyes Üniversitesi", "Kayseri Üniversitesi",
                "Nuh Naci Yazgan Üniversitesi", "Kırıkkale Üniversitesi", "Kırklareli Üniversitesi",
                "Kırşehir Ahi Evran Üniversitesi", "Kilis 7 Aralık Üniversitesi", "Gebze Teknik Üniversitesi",
                "Kocaeli Üniversitesi", "Konya Teknik Üniversitesi", "Necmettin Erbakan Üniversitesi",
                "Selçuk Üniversitesi", "Konya Gıda ve Tarım Üniversitesi", "KTO Karatay Üniversitesi",
                "Kütahya Dumlupınar Üniversitesi", "Kütahya Sağlık Bilimleri Üniversitesi",
                "İnönü Üniversitesi", "Malatya Turgut Özal Üniversitesi", "Manisa Celal Bayar Üniversitesi",
                "Mardin Artuklu Üniversitesi", "Mersin Üniversitesi", "Çağ Üniversitesi", "Tarsus Üniversitesi",
                "Toros Üniversitesi", "Muğla Sıtkı Koçman Üniversitesi", "Muş Alparslan Üniversitesi",
                "Nevşehir Hacı Bektaş Veli Üniversitesi", "Kapadokya Üniversitesi",
                "Niğde Ömer Halisdemir Üniversitesi", "Ordu Üniversitesi", "Osmaniye Korkut Ata Üniversitesi",
                "Recep Tayyip Erdoğan Üniversitesi", "Sakarya Üniversitesi", "Uygulamalı Bilimler Üniversitesi",
                "Ondokuz Mayıs Üniversitesi", "Samsun Üniversitesi", "Siirt Üniversitesi", "Sinop Üniversitesi",
                "Sivas Cumhuriyet Üniversitesi", "Sivas Bilim ve Teknoloji Üniversitesi", "Harran Üniversitesi",
                "Şırnak Üniversitesi", "Tekirdağ Namık Kemal Üniversitesi", "Tokat Gaziosmanpaşa Üniversitesi",
                "Karadeniz Teknik Üniversitesi", "Trabzon Üniversitesi", "Avrasya Üniversitesi",
                "Munzur Üniversitesi", "Uşak Üniversitesi", "Van Yüzüncü Yıl Üniversitesi",
                "Yalova Üniversitesi", "Yozgat Bozok Üniversitesi", "Zonguldak Bülent Ecevit Üniversitesi",
                "Faruk Saraç Tasarım Meslek Yüksekokulu", "Ataşehir Adıgüzel Meslek Yüksekokulu",
                "Avrupa Meslek Yüksekokulu", "Beykoz Lojistik Meslek Yüksekokulu",
                "İstanbul Kavram Meslek Yüksekokulu", "İstanbul Şişli Meslek Yüksekokulu",
                "Plato Meslek Yüksekokulu"
            ],
            maxTags: 1,
            enforceWhitelist: false,
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', '),
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        });

        // tagify Legacy
        const legacy_tagify = new Tagify(document.querySelector("#legacy"), {
            whitelist: ['{{ optional($user->pwcLegacy)->name }}'],
            maxTags: 1,
            enforceWhitelist: true,
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', '),
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        });
        legacy_tagify.on('focus', () => {
            legacy_tagify.settings.whitelist.length = 0
            legacy_tagify.loading(true);
            axios.get('api/pwc/legacy').then(response => {
                legacy_tagify.settings.whitelist = response.data.data;
                legacy_tagify.loading(false);
                legacy_tagify.dropdown.show.call(legacy_tagify)
            }).catch(error => {
                toastr.error('Bir hata oluştu');
            });
        })

        // tagify Ofis
        const department_pwc_tagify = new Tagify(document.querySelector("#department_pwc"), {
            whitelist: ['{{ optional($user->pwcWorkedOffice)->name }}'],
            enforceWhitelist: true,
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', '),
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        });
        department_pwc_tagify.on('focus', () => {
            department_pwc_tagify.settings.whitelist.length = 0
            department_pwc_tagify.loading(true);
            axios.get('api/pwc/office').then(response => {
                department_pwc_tagify.settings.whitelist = response.data.data;
                department_pwc_tagify.loading(false);
                department_pwc_tagify.dropdown.show.call(department_pwc_tagify)
            }).catch(error => {
                toastr.error('Bir hata oluştu');
            });
        })

        // tagify Los
        const pwc_worked_team_los_tagify = new Tagify(document.querySelector("#pwc_worked_team_los"), {
            whitelist: [],
            maxTags: 1,
            enforceWhitelist: false,
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', '),
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        });
        pwc_worked_team_los_tagify.on('focus', () => {
            pwc_worked_team_los_tagify.settings.whitelist.length = 0
            pwc_worked_team_los_tagify.loading(true);
            axios.get('api/pwc/los').then(response => {
                pwc_worked_team_los_tagify.settings.whitelist = response.data.data;
                pwc_worked_team_los_tagify.loading(false);
                pwc_worked_team_los_tagify.dropdown.show.call(pwc_worked_team_los_tagify)
            }).catch(error => {
                toastr.error('Bir hata oluştu');
            });
        })

        // tagify SubLos
        let timeout = setTimeout(function() {}, 0)
        const sublos_tagify = new Tagify(document.querySelector("#pwc_worked_team_sublos"), {
            whitelist: ['{!! optional($user->pwcWorkedTeamSubLos)->name !!}'],
            maxTags: 1,
            enforceWhitelist: false,
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', '),
            dropdown: {
                maxItems: 10, // <- maximum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 10, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        });
        sublos_tagify.on('focus', function(e) {
            const value = pwc_worked_team_los_tagify.value[0]?.value;
            if (!value) {
                toastr.error('Lütfen önce los seçimi yapınız.');
            } else {
                sublos_tagify.settings.whitelist.length = 0
                sublos_tagify.loading(true);
                axios.get('api/pwc/sublos?name=' + value).then(response => {
                    sublos_tagify.settings.whitelist = response.data.data;
                    sublos_tagify.loading(false);
                    sublos_tagify.dropdown.show.call(sublos_tagify)
                }).catch(error => {
                    toastr.error('Bir hata oluştu');
                });
            }
        })

        // tagify Çalıştığınız şirketin adı
        const company_tagify = new Tagify(document.querySelector("#company_works_pwc"), {
            whitelist: ['{!! $user->current_work_company !!}'],
            maxTags: 1,
            enforceWhitelist: false,
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', '),
            dropdown: {
                maxItems: 15, // <- maximum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 15, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        });
        company_tagify.on('input', function(e) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const value = e.detail.value;
                company_tagify.settings.whitelist.length = 0
                company_tagify.loading(true);
                if(value.length > 2){
                    axios.get('api/pwc/companies?query=' + value).then(response => {
                        company_tagify.settings.whitelist = response.data.data;
                        company_tagify.loading(false);
                        company_tagify.dropdown.show.call(company_tagify)
                    }).catch(error => {
                        toastr.error('Bir hata oluştu');
                    });
                }
            }, 1000)
        })

        // permissions form
        $('.permissions_form_switch').on('change', function(e) {
            const query = {
                name: e.currentTarget.name,
                value: e.currentTarget.checked ? 1 : 0
            };
            axios.post('{{ route('permission.update') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    if (status === "success") {
                        toastr.success("İzinler başarıyla güncellenmiştir.");
                    } else {
                        toastr.error("İzinler güncellenirken bir hata oluştu.");
                    }
                });
        });
        // dont show that user approving marketing if none is checked
        $(".consents").click(function() {
            if ($(".consents:checked").length === 0) {
                $(".marketing-permissions").hide();
            } else {
                $(".marketing-permissions").show();
            }
        });
        $(document).ready(function() {
            if ($(".consents:checked").length === 0) {
                $(".marketing-permissions").hide();
            } else {
                $(".marketing-permissions").show();
            }
        });
    </script>
    <script src="{{ url('static/alumni/assets/plugins/custom/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('static/alumni/assets/plugins/custom/datepicker/bootstrap-datepicker-tr.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('#birthday').datepicker({
                format: 'dd.mm.yyyy',
                autoclose: true,
                language: 'tr',
            });
            $('#first-join-pwc').datepicker({
                format: 'dd.mm.yyyy',
                autoclose: true,
                language: 'tr',
            });
            $('#leave-pwc').datepicker({
                format: 'dd.mm.yyyy',
                autoclose: true,
                language: 'tr',
            });

            //modal only appears on first entry
            if (localStorage.getItem("firstTime") == null) {
                setTimeout(function() {
                    $('#prizePopup').fadeIn(1000)
                });
                localStorage.setItem("firstTime", "done");
            }
            $('.homepage_modal_close_btn').on('click', function() {
                $('#prizePopup').fadeOut();
            });
        });
        if($('input[name="is-ilanlari"]').is(":checked")){
            $('#user-skills').show();
        }
        $('input[name="is-ilanlari"]').on('change', () => {
            if($('input[name="is-ilanlari"]').is(":checked")){
                $('#user-skills').show();
            } else {
                $('#user-skills').hide();
            }
        })
    </script>
@endsection
