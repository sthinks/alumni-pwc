@extends('alumni.layout.app')
@section('title', 'Alumni Topluluğu')
@section('bg', url('static/alumni/assets/media/background/1.png'))
@section('breadcrumb', Breadcrumbs::render('community'))
@section("abstract", "PwC Türkiye ailesi hep bir arada")
@section("abstract_detail")
    <p>Heyecanımıza ortak olun. PwC Türkiye Alumni Portal’ın her gün büyüyen ailemizini güçlü bir bağ kurmasına katkı sağlamasını ümit ediyoruz.</p>
    <p>PwC Türkiye Alumni Portal’da ailemizin üyeleri ile ilgili güncel bilgileri ve PwC Ailesi’ne özel ayrıcalıkları paylaşmaya devam edeceğiz. Bir araya geleceğimiz  etkinlikleri de buradan takip edebiliriz.</p>
    <p>Ailemizin üyelerine direkt ulaşmak için profilinizi paylaşmamıza izin verin. Bu sayfada profil bilgilerini paylaşan tüm alumnilere ulaşabilirsiniz.</p>
@endsection
@section('main')
    <div>
        <!--begin::Alert-->
        <div class="card directory_permission_switch_bg">
                <div class="card-body">
            <!--begin::Wrapper-->
                    <div class="d-flex">
                        <!--begin::Title-->
                        <p class="text-white">İletişim bilgisi bildiriminizi açarsanız profil bilgileriniz bildirimleri açık olan Alumnilerimizle
                            paylaşılacaktır. <br /> Bu bölümde izin verdiğiniz takdirde tekrar değişiklik gerçekleştiremeyeceksiniz.</p>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                    <form method="post" id="directory_permission_form">
                        @csrf
                        <div class="form-check mb-4 ps-0">
                            <div class="d-flex">
                                <label class="switch">
                                    <input value="1" name="value" type="hidden" />
                                    <input onchange="sendPermission()" class="form-check-input" type="checkbox"
                                        name="name" value="directory" id="directory_perm" />
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Wrapper-->
            </div>
            <!--end::button-->
        </div>
        <!--end::Alert-->
    </div>
    <div class="row" id="profile-update" style="display: none;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="form_pwc_info">
                        @csrf
                        <input type="hidden" id="hidden_email" name="email" value="{{ auth()->user()->email }}">
                        <input type="hidden" id="hidden_phone" name="phone" value="{{ auth()->user()->phone }}">
                        <input type="hidden" id="hidden_linkedin" name="linkedin" value="{{ auth()->user()->linkedin }}">
                        <div class="form-group mt-5">
                            <label class="profile_card_table" for="legacy">Şirket unvanı</label>
                            <input value="{{ optional(auth()->user()->pwcLegacy)->name }}" type="text" name="legacy"
                                   class="form-control" id="legacy" aria-describedby="legacy">
                        </div>
                        <div class="form-group mt-5">
                            <div class="d-flex">
                                <label class="profile_card_table" for="first-join-pwc">PwC’de çalışmaya başladığınız tarih</label>
                                <div class="position-relative table_info"
                                     data="İşe giriş tarihinizi staj döneminiz varsa dahil etmeyiniz.">
                                    <img width="15" height="15"
                                         src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ optional(auth()->user()->pwc_join_year)->format('d.m.Y') }}" name="pwc_join_year"
                                   class="form-control" id="first-join-pwc" aria-describedby="first-join-pwc"
                                   autocomplete="off" placeholder="gg.aa.yyyy">
                        </div>
                        <div class="form-group mt-5">
                            <div class="d-flex">
                                <label class="profile_card_table" for="leave-pwc">PwC'den ayrıldığınız tarih</label>
                                <div class="position-relative table_info"
                                     data="PwC'den en son ayrıldığınız tarihi belirtiniz.">
                                    <img width="15" height="15"
                                         src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ optional(auth()->user()->pwc_quit_year)->format('d.m.Y') }}" name="pwc_quit_year"
                                   class="form-control" id="leave-pwc" autocomplete="off" placeholder="gg.aa.yyyy">
                        </div>
                        <div class="form-group mt-5">
                            <div class="d-flex">
                                <label class="profile_card_table" for="department_pwc">PwC'de çalıştığınız ofis</label>
                                <div class="position-relative table_info" data="En son çalıştığınız ofisi seçiniz.">
                                    <img width="15" height="15"
                                         src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ optional(auth()->user()->pwcWorkedOffice)->name }}" type="text"
                                   name="pwc_worked_office" class="form-control" id="department_pwc">
                        </div>
                        <div class="form-group mt-5">
                            <div class="d-flex">
                                <label class="profile_card_table" for="working_team">PwC'de çalıştığınız (LoS)</label>
                                <div class="position-relative table_info" data="En son çalıştığınız ekibi seçiniz.">
                                    <img width="15" height="15"
                                        src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ optional(auth()->user()->pwcWorkedTeamLos)->name }}" type="text"
                                   name="pwc_worked_team_los" class="form-control" id="pwc_worked_team_los">
                        </div>
                        <div class="form-group mt-5">
                            <div class="d-flex">
                                <label class="profile_card_table" for="working_team">PwC'de çalıştığınız (SubLoS)</label>
                                <div class="position-relative table_info" data="En son çalıştığınız ekibi seçiniz.">
                                        <img width="15" height="15"
                                            src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ optional(auth()->user()->pwcWorkedTeamSubLos)->name }}" type="text"
                                   name="pwc_worked_team_sublos" class="form-control" id="pwc_worked_team_sublos">
                        </div>
                        <div class="form-group mt-5">
                            <div class="d-flex">
                                <label class="profile_card_table" for="company_works_pwc">Çalıştığınız şirketin adı</label>
                                <div class="position-relative table_info"
                                    data="Çalıştığınız şirketin adı aşağıdaki önerilenlerde yoksa eklememiz için aşağıdaki alana yazınız.">
                                    <img width="15" height="15"
                                        src="{{ url('static/alumni/assets/media/icons/info.png') }}" alt="Bilgi Görseli">
                                </div>
                            </div>
                            <input value="{{ auth()->user()->current_work_company }}" type="text" name="current_work_company"
                                   class="form-control" id="company_works_pwc" aria-describedby="first-join-pwc"
                                   placeholder="Çalıştığınız şirketin adı">
                        </div>
                        <div class="form-group mt-5">
                            <label class="profile_card_table" for="company_works_title">Çalıştığınız şirketteki göreviniz</label>
                            <input value="{{ auth()->user()->current_work_role }}" type="text" name="current_work_role"
                                   class="form-control" id="company_works_title"
                                   placeholder="Çalıştığınız şirketteki göreviniz">
                        </div>
                        <button type="submit" class="btn pwc-orange-button text-uppercase mt-5"
                                id="profile_pwc_info_change_save">Değişiklikleri Kaydet</button>
                        <span id="pwc_info_save_spinner"></span>
                        <div id="form_pwc_info_message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("js")
    <script src="{{ url('js/axios.min.js') }}"></script>
    <script src="{{ url('static/alumni/assets/plugins/custom/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('static/alumni/assets/plugins/custom/datepicker/bootstrap-datepicker-tr.min.js') }}"></script>
    <script>
        function sendPermission() {
            const query = $("#directory_permission_form").serialize();
            axios.post('{{ route('permission.update') }}', query)
                .then(function(response) {
                    let status = response.data.status;
                    if (status === "success") {
                        toastr.success("İzinler başarıyla güncellenmiştir.");
                        window.location.replace("community");
                    } else {
                        toastr.error(response.data[0]);
                        $("#directory_perm").prop("checked", false);
                        $("#profile-update").show();
                        document.getElementById("profile-update").scrollIntoView({
                            behavior: "smooth"
                        });
                    }
                });
            return false;
        }
        // tagify Legacy
        const legacy_tagify = new Tagify(document.querySelector("#legacy"), {
            whitelist: ['{{ optional(auth()->user()->pwcLegacy)->name }}'],
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
            whitelist: ['{{ optional(auth()->user()->pwcWorkedOffice)->name }}'],
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

        // tagify worked office
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
            console.log('here');
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
            whitelist: ['{!! optional(auth()->user()->pwcWorkedTeamSubLos)->name !!}'],
            maxTags: 1,
            enforceWhitelist: false,
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', '),
            dropdown: {
                maxItems: 100, // <- maximum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
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

        // tagify Çalıştığı Şirket
        const company_tagify = new Tagify(document.querySelector("#company_works_pwc"), {
            whitelist: ['{!! auth()->user()->current_work_company !!}'],
            maxTags: 1,
            enforceWhitelist: false,
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', '),
            dropdown: {
                maxItems: 5, // <- maximum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 5, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        });
        company_tagify.on('input', function(e) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const value = e.detail.value;
                company_tagify.settings.whitelist.length = 0
                company_tagify.loading(true);
                if(value.length > 2) {
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
        $("form#form_pwc_info").on("submit", function(e) {
            e.preventDefault();
            const query = $('#form_pwc_info').serialize();
            axios.post('{{ route('profile.update') }}', query)
                .then(function(response) {
                    const status = response.data.status;
                    $('#pwc_info_save_spinner').hide();
                    if (status === "success") {
                        toastr.success("Bilgileriniz başarı ile güncellenmiştir.");
                        $("#directory_perm").prop("checked", true);
                        toastr.info('İzniniz onaylanıyor...')
                        setTimeout(sendPermission, 2000);
                    } else {
                        toastr.error("Bilgileriniz güncellenirken hata oluştu.");
                    }
                });
            return false;
        });
    </script>
@endsection
