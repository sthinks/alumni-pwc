@extends("admin.layouts.app")
@section("title", "Onay Bekleyen Kullanıcı Listesi")
@section("content")
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title fs-3 fw-bolder">Kullanıcı Filtreleme</div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Form-->
        <form class="form" method="post" action="{{ route("manager.approval.search") }}">
            @csrf
            <div class="row p-5">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Ad ve soyad:</label>
                        <input value="{{ isset($posted["name"]) ? $posted["name"] : "" }}" type="text" class="form-control form-control-solid" name="name" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Email Adresi:</label>
                        <input value="{{ isset($posted["email"]) ? $posted["email"] : "" }}" type="text" class="form-control form-control-solid" name="email" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Telefon Numarası:</label>
                        <input value="{{ isset($posted["phone"]) ? $posted["phone"] : "" }}" type="text" class="form-control form-control-solid" name="phone" />
                    </div>
                </div>
                <div class="col-md-3">

                </div>
            </div>
            <div class="row p-5">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Üyelik Tarihi:</label>
                        <input value="{{ isset($posted["start"]) ? $posted["start"] : "" }}" type="date" class="form-control form-control-solid" name="start" />
                        <span class="form-text text-muted">Başlangıç Tarihi</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label></label>
                        <input value="{{ isset($posted["end"]) ? $posted["end"] : "" }}" type="date" class="form-control form-control-solid" name="end" />
                        <span class="form-text text-muted">Bitiş Tarihi</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Telefon Onay Durumu</label>
                            <select id="phone_approval_id" name="phone_approval" class="form-control selectpicker">
                                <option value="-1" @if(empty($posted["phone_approval"])) selected @endif>Tümü</option>
                                <option value="1" @if(isset($posted["phone_approval"]) && $posted["phone_approval"] === "1") selected @endif>Onaylı</option>
                                <option value="0" @if(isset($posted["phone_approval"]) && $posted["phone_approval"] === "0") selected @endif>Onaysız</option>
                            </select>
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
                <span class="card-label fw-bolder fs-3 mb-1">Onay Bekleyen Kullanıcı Listesi</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4" id="approval_table">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-125px rounded-start">Ad ve soyad</th>
                        <th class="min-w-125px">Email adresi</th>
                        <th class="min-w-125px">Telefon Numarası</th>
                        <th class="min-w-125px">Telefon Onay Durumu</th>
                        <th class="min-w-125px">Linkedin Profili</th>
                        <th class="min-w-200px">Kayıt Tarihi</th>
                        <th class="min-w-200px text-center rounded-end">İşlemler</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7"> {{ $user->name }} </span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7"> {{ $user->email }} </span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7"> {{ $user->phone }} </span>
                            </td>
                            <td>
                                <span
                                    class="badge {{ $user->hasVerifiedPhone() ? "badge-light-success" : "badge-light-danger" }} fs-7 fw-bold">{{ $user->hasVerifiedPhone() ? "Onaylı" : "Onaysız" }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7"> <a
                                        href="{{ $user->linkedin }}" target="_blank">{{ $user->linkedin }}</a> </span>
                            </td>
                            <td>
                                <span
                                    class="fw-bold d-block fs-7"> {{ $user->created_at->format('d/m/Y H:i:s') }} </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('manager.approval.edit', $user->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
                                    <span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                         height="24px" viewBox="0 0 24 24"
                                                                         version="1.1">
																		<path
                                                                            d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                            fill="#000000" fill-rule="nonzero"
                                                                            transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"/>
																		<path
                                                                            d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                            fill="#000000" fill-rule="nonzero"
                                                                            opacity="0.3"/>
																	</svg>
																</span>
                                    <!--end::Svg Icon-->
                                </a>
                                <form style="display: contents"
                                      action="{{ route("manager.approval.destroy", $user->id) }}" method="post">
                                    @method("delete")
                                    @csrf
                                    <button onclick="return confirm('Kullanıcının silme işlemini onaylıyor musunuz?');"
                                            type="submit"
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
        $("#approval_table").DataTable({
            "columnDefs": [{
                "visible": false,
            }],
            "ordering": false,
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
                    title: 'Onay Bekleyen Kullanıcı Listesi Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i> CSV',
                    titleAttr: 'CSV',
                    title: 'Onay Bekleyen Kullanıcı Listesi Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Onay Bekleyen Kullanıcı Listesi Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    },
                },
            ],
        });
    </script>
@endsection
