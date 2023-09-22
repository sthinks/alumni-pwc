@extends("admin.layouts.app")
@section("title", $user->name)
@section("content")
    <div class="card ">
        <div class="card-header card-header-stretch">
            <h3 class="card-title">{{ $user->name }} ({{ $user->staff_id }})</h3>
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#info">Kullanıcı Bilgileri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#campaigns">Katıldığı Ayrıcalıklar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#jobs">İş Başvuruları</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#events">Katıldığı Etkinlikler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#hobby">Katıldığı Hobi Kulüpleri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#preferences">İletişim İzinleri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#failed_logins">Başarısız Girişler</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel">
                    <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-4" id="user_info">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded" colspan="2">İletişim Bilgileri</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">Adı, Soyadı</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $user->name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">Telefon Numarası</span>
                                    </td>
                                    <td class="d-block">
                                        <span class="fw-bold fs-7">{{ $user->phone }}</span> {!! $user->hasVerifiedPhone() ? '<span class="badge badge-success">Onaylı</span>' : '<span class="badge badge-danger">Onaysız</span>'  !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">Email Adresi</span>
                                    </td>
                                    <td class="d-block">
                                        <span class="fw-bold fs-7">{{ $user->email }}</span> {!! $user->hasVerifiedEmail() ? '<span class="badge badge-success">Onaylı</span>' : '<span class="badge badge-danger">Onaysız</span>'  !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">İkinci Email Adresi</span>
                                    </td>
                                    <td class="d-block">
                                        <span class="fw-bold fs-7">{{ $user->second_mail }}</span> {!! $user->hasVerifiedSecondMail() ? '<span class="badge badge-success">Onaylı</span>' : '<span class="badge badge-danger">Onaysız</span>'  !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">Ev Adresi</span>
                                    </td>
                                    <td class="d-block">
                                        <span class="fw-bold fs-7">{{ $user->home_address ?? "-" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">Linkedin Adresi</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-7"><a href="{{ $user->linkedin }}" target="_blank">{{ $user->linkedin }}</a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">Kayıt Tarihi</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-7">{{ optional($user->created_at)->format("d/m/Y H:i:s") ?? "-" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">Profil Güncelleme Tarihi</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-7">{{ optional($user->updated_at)->format("d/m/Y H:i:s") ?? "-" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">Onaylanma Tarihi</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-7">{{ optional($user->approved_at)->format("d/m/Y H:i:s") ?? "-" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">Onaylayan Kullanıcı</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-7">{{ !is_null(\App\User::find($user->approved_by)) ? \App\User::find($user->approved_by)->name : "-" }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <table class="table align-middle gs-0 gy-4" id="user_pwc_info">
                        <!--begin::Table head-->
                        <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 min-w-125px rounded" colspan="2">PwC Bilgileri</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Legacy</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ optional($user->pwcLegacy)->name ?? "-" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">PwC'ye İlk Katılma Yılı</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ optional($user->pwc_join_year)->format("d/m/Y H:i:s") ?? "-" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">PwC'den Ayrılma Tarihi</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ optional($user->pwc_quit_year)->format("d/m/Y H:i:s") ?? "-" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">PwC'de Çalıştığı Ofis</span>
                            </td>
                            <td class="d-block">
                                <span class="fw-bold fs-7">{{ optional($user->pwcWorkedOffice)->name ?? "-" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">PwC'de Çalıştığı Ekip Los</span>
                            </td>
                            <td class="d-block">
                                <span class="fw-bold fs-7">{{ optional($user->pwcWorkedTeamLos)->name ?? "-" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">PwC'de Çalıştığı Ekip SubLos</span>
                            </td>
                            <td class="d-block">
                                <span class="fw-bold fs-7">{{ optional($user->pwcWorkedTeamSubLos)->name ?? "-" }}</span>
                            </td>
                        </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                        <table class="table align-middle gs-0 gy-4" id="user_professional_info">
                        <!--begin::Table head-->
                        <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 min-w-125px rounded" colspan="2">Profesyonel Tecrübe</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Çalıştığı Şirket</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $user->current_work_company ?? "-" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Çalıştığı Şirketteki Rolü (Ünvanı)</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $user->current_work_role ?? "-" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Yetenekler</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $user_skills ?? "-" }}</span>
                            </td>
                        </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                        <table class="table align-middle gs-0 gy-4" id="user_educational_info">
                        <!--begin::Table head-->
                        <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 min-w-125px rounded" colspan="2">Eğitim</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Üniversite</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $user->university ?? "-" }}</span>
                            </td>
                        </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>


                </div>

                <div class="tab-pane fade" id="campaigns" role="tabpanel">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-4" id="alumni_user_campaigns">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">Ayrıcalık Adı</th>
                                <th class="min-w-150px rounded-end">Ayrıcalık Katılım Tarihi</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach($user->campaigns()->get() as $campaign)
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $campaign->campaign_title }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $campaign->pivot->created_at->format('d/m/Y H:i:s') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>

                <div class="tab-pane fade" id="jobs" role="tabpanel">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-4" id="alumni_user_campaigns">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">İş İlanı</th>
                                <th class="min-w-150px rounded-end">Başvuru Tarihi</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach($user->jobOffers()->get() as $job)
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $job->job_title }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $job->pivot->created_at->format('d/m/Y H:i:s') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>

                <div class="tab-pane fade" id="events" role="tabpanel">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-4" id="alumni_user_campaigns">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">Etkinlik Adı</th>
                                <th class="min-w-150px rounded-end">Katılım Tarihi</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach($user->events()->get() as $event)
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $event->event_title }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $event->pivot->created_at->format('d/m/Y H:i:s') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>

                <div class="tab-pane fade" id="hobby" role="tabpanel">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-4" id="alumni_user_campaigns">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">Kulüp Adı</th>
                                <th class="min-w-150px rounded-end">Katılım Tarihi</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach($user->hobbies()->get() as $hobby)
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $hobby->hobby_title }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $hobby->pivot->created_at->format('d/m/Y H:i:s') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>

                <div class="tab-pane fade" id="preferences" role="tabpanel">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-4" id="alumni_user_campaigns">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">İletişim Tipi</th>
                                <th class="min-w-150px rounded-end">Durum</th>
                                <th class="min-w-150px rounded-end">İzin Tarihi</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach(\App\Permission::all() as $permission)
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $permission->name }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{!! $permission->users->contains($user) ? '<span class="badge badge-success">İzin Verildi</span>' : '<span class="badge badge-danger">İzin Verilmedi</span>' !!}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ !is_null($permission->users()->find($user)) ? $permission->users()->find($user)->pivot->created_at : "-" }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <div class="tab-pane fade" id="failed_logins" role="tabpanel">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-4" id="alumni_user_campaigns">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">İp Adresi</th>
                                <th class="min-w-150px rounded-end">Cihaz</th>
                                <th class="min-w-150px rounded-end">Eylem Tarihi</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach($failed_logins as $failed_login)
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $failed_login->properties['ip'] }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $failed_login->properties['user_agent'] }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block fs-7">{{ $failed_login->created_at->translatedFormat("d F Y H:i:s") }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
