@extends("admin.layouts.app")
@section("title", "Üye Listesi")
@section("content")
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title fs-3 fw-bolder">Üye Filtreleme</div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Form-->
        <form class="form" method="post" action="{{ route("manager.users.search") }}">
            @csrf
            <div class="row p-5">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="alumni_name">Ad, Soyad:</label>
                        <input id="alumni_name" value="{{ $posted["alumni_name"] ?? "" }}" type="text"
                               class="form-control form-control-solid" name="alumni_name"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="alumni_created_at_from">Üyelik Tarihi:</label>
                        <input id="alumni_created_at_from" value="{{ $posted["alumni_created_at_from"] ?? "" }}"
                               type="date" class="form-control form-control-solid" name="alumni_created_at_from"/>
                        <span class="form-text text-muted">Başlangıç Tarihi</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="alumni_created_at_to"></label>
                        <input id="alumni_created_at_to" value="{{ $posted["alumni_created_at_to"] ?? "" }}" type="date"
                               class="form-control form-control-solid" name="alumni_created_at_to"/>
                        <span class="form-text text-muted">Bitiş Tarihi</span>
                    </div>
                </div>
            </div>
            <div class="row p-5">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="alumni_phone">Telefon Numarası:</label>
                        <input id="alumni_phone" value="{{ $posted["alumni_phone"] ?? "" }}" type="text"
                               class="form-control form-control-solid" name="alumni_phone"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="alumni_staff_id">Staff ID:</label>
                        <input id="alumni_staff_id" value="{{ $posted["alumni_staff_id"] ?? "" }}"
                               type="text" class="form-control form-control-solid" name="alumni_staff_id"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="alumni_email">Email Adresi</label>
                        <input id="alumni_email" value="{{ $posted["alumni_email"] ?? "" }}" type="email"
                               class="form-control form-control-solid" name="alumni_email"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success mt-5">Filtrele</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end:Form-->
    </div>
    <!--end::Card-->
    <div class="card mb-5 mb-xl-8 mt-5">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Üye Listesi</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4" id="alumni_table">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-125px rounded-start">Ad ve Soyad</th>
                        <th class="min-w-125px">Staff ID</th>
                        <th class="min-w-125px">Telefon</th>
                        <th class="min-w-125px">Email</th>
                        <th class="min-w-125px d-none">İkinci Soyad</th>
                        <th class="min-w-125px d-none">Linkedin</th>
                        <th class="min-w-125px d-none">Doğum Günü</th>
                        <th class="min-w-125px d-none">Ev Adresi</th>
                        <th class="min-w-125px d-none">Üniversite</th>
                        <th class="min-w-125px d-none">Legacy</th>
                        <th class="min-w-125px d-none">PwC Ayrılma Yılı</th>
                        <th class="min-w-125px d-none">PwC Çalıştığı Ofis</th>
                        <th class="min-w-125px d-none">PwC Los</th>
                        <th class="min-w-125px d-none">PwC SubLos</th>
                        <th class="min-w-125px d-none">Şu an çalıştığı şirket</th>
                        <th class="min-w-125px d-none">Şu an rolü</th>
                        <th class="min-w-200px">Üyelik Tarihi</th>
                        <th class="min-w-150px">Güncellenme Tarihi</th>
                        <th class="min-w-200px text-center rounded-end">İşlemler</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $user->name }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $user->staff_id }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $user->phone }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $user->email }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ $user->second_surname }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ $user->linkedin }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ optional($user->birthdate)->format('d/m/Y') ?? "-" }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ $user->home_address }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ $user->university }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ optional($user->pwcLegacy)->name }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ optional($user->pwc_quit_year)->format('d/m/Y') }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ optional($user->pwcWorkedOffice)->name }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ optional($user->pwcWorkedTeamLos)->name }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ optional($user->pwcWorkedTeamSubLos)->name }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ $user->current_work_company }}</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ $user->current_work_role }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ optional($user->created_at)->format('d/m/Y H:i:s') ?? "-" }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ optional($user->updated_at)->format('d/m/Y H:i:s') ?? "-" }}</span>
                            </td>
                            <td class="text-end">

                                <a title="{{ $user->name }} profilini incele" href="{{ route('manager.users.show', $user->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Text/Dots.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1">
        <rect x="14" y="9" width="6" height="6" rx="3" fill="black"/>
  <rect x="3" y="9" width="6" height="6" rx="3" fill="black" fill-opacity="0.7"/>
 </g>
</svg><!--end::Svg Icon--></span>
                                    <!--end::Svg Icon-->
                                </a>
                                <form style="display: contents"
                                      action="{{ route("manager.users.destroy", $user->id) }}" method="post">
                                    @method("delete")
                                    @csrf
                                    <button onclick="return confirm('{{ $user->name }} üyesini silmek istediğinize emin misiniz?')" type="submit"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <!--begin::Svg Icon | path: icons/duotone/General/Trash.svg-->
                                        <span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         width="24px" height="24px" viewBox="0 0 24 24"
                                                                         version="1.1">
																		<g stroke="none" stroke-width="1" fill="none"
                                                                           fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24"/>
																			<path
                                                                                d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                                fill="#000000" fill-rule="nonzero"/>
																			<path
                                                                                d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                                fill="#000000" opacity="0.3"/>
																		</g>
																	</svg>
																</span>
                                        <!--end::Svg Icon-->
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
@endsection
@section("js")
    <script>
        $("#alumni_table").DataTable({
            "columnDefs": [{
                "visible": false,
            }],
            // Pagination settings
            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
			<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            responsive: true,
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    titleAttr: 'Export to Excel',
                    title: 'Alumni Kullanıcıları Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i> CSV',
                    titleAttr: 'CSV',
                    title: 'Alumni Kullanıcıları Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Alumni Kullanıcıları Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    },
                },
            ],
        });
    </script>
@endsection
