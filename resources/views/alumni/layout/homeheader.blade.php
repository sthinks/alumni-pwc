<!--begin::Aside-->
<div id="kt_aside"
    class="aside aside-dark aside-hoverable drawer drawer-start d-block d-md-none"
    data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid aside_menu_background alumni_brand_background">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link @if (request()->is('home*')) active @endif" href="{{ route('home') }}">
                        <span class="menu-icon yan-ikonlar">
                            <!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
                            <img src="{{ url('static/alumni/assets/media/pwc_index/sol_1.svg') }}">
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Anasayfa</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->is('community*')) active @endif"
                        href="{{ route('community.index') }}">
                        <span class="menu-icon yan-ikonlar">
                            <!--begin::Svg Icon | path: icons/duotone/Design/Sketch.svg-->
                            <img src="{{ url('static/alumni/assets/media/pwc_index/sol_2.svg') }}">
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Alumni Topluluğu</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->is('campaign*')) active @endif"
                        href="{{ route('campaign.index') }}">
                        <span class="menu-icon yan-ikonlar">
                            <!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
                            <img src="{{ url('static/alumni/assets/media/pwc_index/sol_3.svg') }}">
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Ayrıcalıklar</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->is('announcement*')) active @endif"
                        href="{{ route('announcement.index') }}">
                        <span class="menu-icon yan-ikonlar">
                            <!--begin::Svg Icon | path: icons/duotone/Design/Sketch.svg-->
                            <img src="{{ url('static/alumni/assets/media/pwc_index/sol_4.svg') }}">
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Duyurular</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->is('media*')) active @endif"
                        href="{{ route('media.index') }}">
                        <span class="menu-icon yan-ikonlar">
                            <!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
                            <img src="{{ url('static/alumni/assets/media/pwc_index/sol_5.svg') }}">
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Alumni Sohbetleri</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->is('jobs*')) active @endif"
                        href="{{ route('jobs.index') }}">
                        <span class="menu-icon yan-ikonlar">
                            <!--begin::Svg Icon | path: icons/duotone/Design/Sketch.svg-->
                            <img src="{{ url('static/alumni/assets/media/pwc_index/sol_6.svg') }}">
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Kariyer Fırsatları</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->is('events*')) active @endif"
                        href="{{ route('events.index') }}">
                        <span class="menu-icon yan-ikonlar">
                            <!--begin::Svg Icon | path: icons/duotone/Design/Sketch.svg-->
                            <img src="{{ url('static/alumni/assets/media/pwc_index/sol_8.svg') }}">
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Etkinlik</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->is('hobby-clubs*')) active @endif"
                        href="{{ route('hobbies.index') }}">
                        <span class="menu-icon yan-ikonlar">
                            <!--begin::Svg Icon | path: icons/duotone/Design/Sketch.svg-->
                            <img src="{{ url('static/alumni/assets/media/pwc_index/sol_10.svg') }}">
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Hobiler</span>
                    </a>
                </div>
                <div class="menu-item">
                    <div class="menu-content">
                        <div class="separator mx-1"></div>
                    </div>
                </div>
                <div class="menu-item">
                    <form method="post" id="aside_logout" class="d-none" action="{{ route('logout') }}">
                        @csrf
                    </form>
                    <a class="menu-link"
                        onclick="event.preventDefault(); document.getElementById('aside_logout').submit();">
                        <span class="menu-icon yan-ikonlar">
                            <!--begin::Svg Icon | path: icons/duotone/Files/File.svg-->
                            <img src="{{ url('static/alumni/assets/media/pwc_index/sol_9.svg') }}">
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Oturumu kapat</span>
                    </a>
                </div>
            </div>
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->
<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper" style="padding-top: 65px;">
    <!--begin::Header-->
    <div id="kt_header" class="header align-items-stretch"
        style="position: absolute !important; left: 0px; right: 0px; top: 0px; background: #24262b;">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Aside mobile toggle-->
            <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                <div class="btn btn-icon w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                    <!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
                    <span class="svg-icon svg-icon-2x mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                                <path
                                    d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
            </div>
            <!--end::Aside mobile toggle-->
            <!--begin::Mobile logo-->
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                <a href="{{ route('home') }}" class="d-lg-none">
                    <img width="90" height="auto"
                        src="{{ url('static/alumni/assets/media/logos/alumni_site_logo.svg') }}" alt="PwC Alumni">
                </a>
            </div>
            <!--end::Mobile logo-->
            <!--begin::Wrapper-->
            <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1 web_header_app_post">
                <!--begin::Navbar-->
                <div class="d-flex align-items-stretch" id="kt_header_nav">
                    <!--begin::Menu wrapper-->
                    <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                        data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end"
                        data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                        data-kt-swapper-mode="prepend"
                        data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                        <!--begin::Menu-->
                        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                            id="#kt_header_menu" data-kt-menu="true">
                            <a href="{{ route('home') }}" class="d-none d-md-block m-auto flex-row">
                                <img width="200" height="auto"
                                    src="{{ url('static/alumni/assets/media/logos/alumni_site_logo.svg') }}"
                                    alt="PwC Alumni">
                            </a>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Navbar-->
                <!--begin::Topbar-->
                <div class="d-flex align-items-stretch flex-shrink-0">
                    <!--begin::Toolbar wrapper-->
                    <div class="d-flex align-items-stretch flex-shrink-0">

                        <!--begin::Chat-->
                        <a href="{{ route('chat.index') }}" class="d-flex align-items-center ms-1 ms-lg-3 pr-4">
                            <!--begin::Menu wrapper-->
                            <div class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px"
                                data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                <!--begin::Svg Icon | path: icons/duotone/Communication/Group-chat.svg-->
                                <img width="24" height="24"
                                    src="{{ url('static/alumni/assets/media/pwc_index/mesaj.svg') }}"
                                    alt="Mesajlaşma">
                                <!--end::Svg Icon-->
                                <span
                                    class="bullet bullet-dot position-absolute translate-middle top-0 start-50 bildirim-sayi">{{ $unread_messages }}</span>
                            </div>
                            <!--end::Menu wrapper-->
                        </a>
                        <!--end::Chat-->
                        <!--begin::Notifications-->
                        <div class="d-flex align-items-center ms-1 ms-lg-3 pr-4">
                            <!--begin::Menu- wrapper-->
                            <div class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px"
                                data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                <!--begin::Svg Icon | path: icons/duotone/Code/Compiling.svg-->
                                <img width="24" height="24"
                                    src="{{ url('static/alumni/assets/media/pwc_index/bildirim.svg') }}"
                                    alt="Bildirimler">
                                <span
                                    class="bullet bullet-dot position-absolute translate-middle top-0 start-50 bildirim-sayi">{{ $number_of_notification }}</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px"
                                data-kt-menu="true">
                                <!--begin::Heading-->
                                <div class="d-flex flex-column bgi-no-repeat rounded-top"
                                    style="background-image:url('{{ url('static/alumni/assets/media/misc/pattern-1.jpg') }}')">
                                    <!--begin::Title-->
                                    <h3 class="text-white fw-bold px-9 mt-10 mb-6 text-center">Bildirimler</h3>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Tab content-->
                                <div class="tab-content">
                                    <!--begin::Tab panel-->
                                    <div class="tab-pane fade show active" id="kt_topbar_notifications_3"
                                        role="tabpanel">
                                        <!--begin::Items-->
                                        <div class="scroll-y mh-325px my-5 px-8">
                                            @foreach ($notifications as $notification)
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack py-4">
                                                    <!--begin::Section-->
                                                    <div class="d-flex align-items-center me-2">
                                                        <!--begin::Code-->
                                                        @if (!$notification->is_read)
                                                            <div class="w-20px notification-dot me-4"></div>
                                                        @endif
                                                        <!--end::Code-->
                                                        <!--begin::Title-->
                                                        <a href="{{ route('notification.handle', $notification->link) }}"
                                                            class="text-gray-800 text-hover-primary fw-bold @if (!$notification->is_read) font-weight-bolder @endif">{{ $notification->message }}</a>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Section-->
                                                    <!--begin::Label-->
                                                    <span
                                                        class="badge badge-light fs-8">{{ $notification->when }}</span>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Item-->
                                            @endforeach
                                        </div>
                                        <!--end::Items-->
                                        <!--begin::View more-->
                                        <div class="py-3 text-center border-top d-none">
                                            <a href="pages/profile/activity.html"
                                                class="btn btn-color-gray-600 btn-active-color-primary">Hepsini Gör
                                                <!--begin::Svg Icon | path: icons/duotone/Navigation/Right-2.svg-->
                                                <span class="svg-icon svg-icon-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <rect fill="#000000" opacity="0.5"
                                                                transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)"
                                                                x="7.5" y="7.5" width="2" height="9" rx="1" />
                                                            <path
                                                                d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </div>
                                        <!--end::View more-->
                                    </div>
                                    <!--end::Tab panel-->
                                </div>
                                <!--end::Tab content-->
                            </div>
                            <!--end::Menu-->



                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::Notifications-->
                        <!--begin::User-->
                        <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                            <!--begin::Menu wrapper-->
                            <div class="d-flex cursor-pointer symbol symbol-circle symbol-30px symbol-md-40px header_fullname"
                                data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                <img style="object-fit: cover;" src="{{ $shared_alumni_user->avatar }}"
                                    alt="{{ $shared_alumni_user->name }}" />
                                <h3 class="text-white ms-lg-3 mt-3 user-name">{{ $shared_alumni_user->name }}</h3>
                            </div>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold py-4 fs-6 w-275px"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px me-5">
                                            <img alt="{{ $shared_alumni_user->name }}"
                                                src="{{ $shared_alumni_user->avatar }}" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Username-->
                                        <div class="d-flex flex-column">
                                            <div class="fw-bolder d-flex align-items-center fs-5">
                                                {{ $shared_alumni_user->name }}</div>
                                            <a href="#"
                                                class="fw-bold text-muted text-hover-primary fs-7">{{ $shared_alumni_user->email }}</a>
                                        </div>
                                        <!--end::Username-->
                                    </div>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="{{ route('profile.index') }}"
                                        class="menu-link header_menu_link px-5">Profil Bilgilerim</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <form id="log_out_form" class="d-none" action="{{ url('/logout') }}"
                                        method="POST">
                                        @csrf
                                    </form>
                                    <a onclick="event.preventDefault(); document.getElementById('log_out_form').submit();"
                                        class="menu-link header_menu_link px-5">Çıkış Yap</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::User -->
                    </div>
                    <!--end::Toolbar wrapper-->
                </div>
                <!--end::Topbar-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
</div>
<!--begin::menubar-->
<nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-white"
    style="box-shadow: 0 0 10px rgb(0 0 0 / 19%);">
    <div class="container-fluid" style=" flex-direction: column;">
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav py-1 home_header_padding">
                <li class="nav-item"><a class="mt-2 text-black-50 fw-bolder nav-link pe-8 community_navbar_1"
                        href="{{ route('home') }}"> <span class="border_header">Ana
                            Sayfa</span></a></li>
                <li class="nav-item"><a class="mt-2 text-black-50 fw-bolder nav-link pe-8 community_navbar_1"
                        href="{{ route('community.index') }}"> <span class="border_header">Alumni
                            Topluluğu</span></a></li>
                <li class="nav-item"><a class="mt-2 text-black-50 fw-bolder nav-link pe-8 community_navbar_2"
                        href="{{ route('campaign.index') }}"> <span class="border_header">Ayrıcalıklar</span></a>
                </li>
                <li class="nav-item"><a class="mt-2 text-black-50 fw-bolder nav-link pe-8 community_navbar_3"
                        href="{{ route('announcement.index') }}"> <span class="border_header">Duyurular</span></a>
                </li>
                <li class="nav-item"><a class="mt-2 text-black-50 fw-bolder nav-link pe-8 community_navbar_4"
                        href="{{ route('media.index') }}"> <span class="border_header">Alumni Sohbetleri</span></a>
                </li>
                <li class="nav-item"><a class="mt-2 text-black-50 fw-bolder nav-link pe-8 community_navbar_5"
                        href="{{ route('jobs.index') }}"> <span class="border_header">Kariyer Fırsatları</span></a></li>
                <li class="nav-item"><a class="mt-2 text-black-50 fw-bolder nav-link pe-8 community_navbar_7"
                        href="{{ route('events.index') }}"> <span class="border_header">Etkinlikler</span></a></li>
                <li class="nav-item"><a class="mt-2 text-black-50 fw-bolder nav-link pe-8 community_navbar_8"
                        href="{{ route('hobbies.index') }}"> <span class="border_header">Hobi Kulüpleri</span></a>
                </li>
            </ul>
        </div> <!-- navbar-collapse.// -->
    </div> <!-- container-fluid.// -->
</nav>
<!--end::menubar-->
