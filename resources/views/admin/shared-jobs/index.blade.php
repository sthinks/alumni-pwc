@extends("admin.layouts.app")
@section("title", "Paylaşılan İş İlanları")
@section("content")
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title fs-3 fw-bolder">Paylaşılan İş İlanı Filtreleme</div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Form-->
        <form class="form" method="post" action="{{ route("manager.shared.search") }}">
            @csrf
            <div class="row p-5">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="position">Pozisyon Adı:</label>
                        <input id="position" value="{{ $posted["position"] ?? "" }}" type="text" class="form-control form-control-solid" name="position" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="company">Şirket:</label>
                        <input id="company" value="{{ $posted["company"] ?? "" }}" type="text" class="form-control form-control-solid" name="company" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="job_location">Lokasyon:</label>
                        <select id="job_location" name="job_location" class="form-select" data-control="select2" data-placeholder="Select an option">
                            <option value="-1">Tümü</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" @if(isset($posted['job_location']) && (int) $posted['job_location'] === $city->id)) selected @endif>{{ $city->city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row p-5">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="start">İlan Tarihi Aralığı:</label>
                        <input id="start" value="{{ $posted["start"] ?? "" }}" type="date" class="form-control form-control-solid" name="start" />
                        <span class="form-text text-muted">Başlangıç Tarihi</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="end"></label>
                        <input id="end" value="{{ $posted["job_deadline_end"] ?? "" }}" type="date" class="form-control form-control-solid" name="end" />
                        <span class="form-text text-muted">Bitiş Tarihi</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="owner">Öneren Kullanıcı</label>
                        <select id="owner" name="owner" class="form-select" data-control="select2" data-placeholder="Select an option">
                            <option value="-1">Tümü</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if(isset($posted['owner']) && (int) $posted['owner'] === $user->id)) selected @endif>{{ $user->name }}</option>
                            @endforeach
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
                <span class="card-label fw-bolder fs-3 mb-1">Paylaşılan İş İlanları</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('manager.jobs.create') }}" class="btn btn-sm btn-light-primary">
                    <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                    <span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                     viewBox="0 0 24 24" version="1.1">
													<path
                                                        d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
													<path
                                                        d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                        fill="#000000" fill-rule="nonzero"/>
												</svg>
											</span>
                    <!--end::Svg Icon-->İş İlanı Ekle</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4" id="shared_jobs_table">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-125px rounded-start">Öneren</th>
                        <th class="ps-4 min-w-125px">Şirket Adı</th>
                        <th class="min-w-125px">Pozisyon Adı</th>
                        <th class="min-w-125px">Deneyim</th>
                        <th class="min-w-325px d-none">İlan Metni</th>
                        <th class="min-w-125px">Lokasyon</th>
                        <th class="min-w-125px">Başvuru Linki</th>
                        <th class="min-w-200px">İlan Geçerlilik Tarihi</th>
                        <th class="min-w-150px">Eklenme Tarihi</th>
                        <th class="min-w-150px">Düzenlenme Tarihi</th>
                        <th class="min-w-200px text-center rounded-end">İşlemler</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $job->user()->first()->name }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $job->company }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $job->position }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $job->experience }} yıl</span>
                            </td>
                            <td class="d-none">
                                <span class="fw-bold d-block fs-7">{{ strip_tags($job->detail) }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ optional($job->location()->first())->city }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $job->link }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ optional($job->valid_till)->format("d/m/Y H:i:s") ?? "-" }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $job->created_at->format("d/m/Y H:i:s") }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $job->updated_at->format("d/m/Y H:i:s") }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('manager.shared.show', $job->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
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
                                <form style="display: contents" action="{{ route("manager.shared.destroy", $job->id) }}" method="post">
                                    @method("delete")
                                    @csrf
                                    <button onclick="return confirm('{{ $job->job_title }} ilanını silmek istediğinize emin misiniz?')" type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
        $("#shared_jobs_table").DataTable({
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
                    title: 'Paylaşılan İş İlanları Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i> CSV',
                    titleAttr: 'CSV',
                    title: 'Paylaşılan İş İlanları Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Paylaşılan İş İlanları Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    },
                },
            ],
        });
    </script>
@endsection
