@extends("admin.layouts.app")
@section("title", "Ayrıcalıklar")
@section("content")
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title fs-3 fw-bolder">Ayrıcalık Filtreleme</div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Form-->
        <form class="form" method="post" action="{{ route("manager.campaigns.search") }}">
            @csrf
            <div class="row p-5">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Ayrıcalık Firma:</label>
                        <input value="{{ isset($posted["campaign_company"]) ? $posted["campaign_company"] : "" }}" type="text" class="form-control form-control-solid" name="campaign_company" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Ayrıcalık Kodu:</label>
                        <input value="{{ isset($posted["campaign_code"]) ? $posted["campaign_code"] : "" }}" type="text" class="form-control form-control-solid" name="campaign_code" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Ayrıcalık Katılımcı Sayısı:</label>
                        <input value="{{ isset($posted["campaign_attendees"]) ? $posted["campaign_attendees"] : "" }}" type="text" class="form-control form-control-solid" name="campaign_attendees" />
                        <span class="form-text text-muted">min-max (0-15 ya da 15-20) olarak giriş yapınız.</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Kategori:</label>
                        <select id="campaign_category" name="campaign_category" class="form-control selectpicker">
                            <option value="-1">Tümü</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(isset($posted['campaign_category']) && (int) $posted['campaign_category'] === $category->id)) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row p-5">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Ayrıcalık Bitiş Tarihi Aralığı:</label>
                        <input value="{{ isset($posted["campaign_deadline_start"]) ? $posted["campaign_deadline_start"] : "" }}" type="date" class="form-control form-control-solid" name="campaign_deadline_start" />
                        <span class="form-text text-muted">Başlangıç Tarihi</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label></label>
                        <input value="{{ isset($posted["campaign_deadline_end"]) ? $posted["campaign_deadline_end"] : "" }}" type="date" class="form-control form-control-solid" name="campaign_deadline_end" />
                        <span class="form-text text-muted">Bitiş Tarihi</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Ayrıcalık Durumu</label>
                        <select id="campaign_visible_id" name="campaign_visible" class="form-control selectpicker">
                            <option value="-1" @if(empty($posted["campaign_visible"])) selected @endif>Tümü</option>
                            <option value="1" @if(isset($posted["campaign_visible"]) && $posted["campaign_visible"] === "1") selected @endif>Aktif</option>
                            <option value="0" @if(isset($posted["campaign_visible"]) && $posted["campaign_visible"] === "0") selected @endif>Pasif</option>
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
                <span class="card-label fw-bolder fs-3 mb-1">Ayrıcalıklar</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('manager.campaigns.create') }}" class="btn btn-sm btn-light-primary">
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
                    <!--end::Svg Icon-->Ayrıcalık Ekle</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4" id="campaigns_table">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-125px rounded-start">Ayrıcalık Başlığı</th>
                        <th class="ps-4 min-w-125px">Ayrıcalık Firma</th>
                        <th class="ps-4 min-w-125px">Ayrıcalık Kategorisi</th>
                        <th class="ps-4 min-w-325px d-none">Ayrıcalık Metni</th>
                        <th class="ps-4 min-w-125px">Ayrıcalık Kodu</th>
                        <th class="ps-4 min-w-125px">Toplam Katılımcı Sayısı</th>
                        <th class="min-w-125px">Ayrıcalık Durumu</th>
                        <th class="min-w-125px">Ayrıcalık Bitiş Tarihi</th>
                        <th class="min-w-200px">Eklenme Tarihi</th>
                        <th class="min-w-150px">Güncellenme Tarihi</th>
                        <th class="min-w-200px text-center rounded-end">İşlemler</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @foreach($campaigns as $campaign)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-5">
                                    <img src="{{ route('storage.images', $campaign->campaign_poster) }}" class="" alt="{{ $campaign->campaign_title }}"/>
                                </div>
                                <div class="d-flex justify-content-start flex-column">
                                    <span class="fw-bold d-block fs-7">{{ $campaign->campaign_title }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold d-block fs-7">{{ $campaign->campaign_company }}</span>
                        </td>
                        <td>
                            <span class="fw-bold d-block fs-7">{{ $campaign->category()->first()->name }}</span>
                        </td>
                        <td class="d-none">
                            <span class="fw-bold d-block fs-7">{{ strip_tags($campaign->campaign_text) }}</span>
                        </td>
                        <td>
                            <span class="fw-bold d-block fs-7">{{ $campaign->campaign_code }}</span>
                        </td>
                        <td>
                            <span class="fw-bold d-block fs-7">{{ $campaign->users()->count() }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $campaign->campaign_visible ? "badge-light-success" : "badge-light-danger" }} fs-7 fw-bold">{{ $campaign->campaign_visible ? "Aktif" : "Pasif" }}</span>
                        </td>
                        <td>
                            <span class="fw-bold d-block fs-7">{{ $campaign->campaign_end_date->format('d/m/Y H:i:s') }}</span>
                        </td>
                        <td>
                            <span class="fw-bold d-block fs-7">{{ $campaign->created_at->format('d/m/Y H:i:s') }}</span>
                        </td>
                        <td>
                            <span class="fw-bold d-block fs-7">{{ $campaign->updated_at->format('d/m/Y H:i:s') }}</span>
                        </td>
                        <td class="text-end">
                            <a title="Ayrıcalık katılımcılarını görüntüle" href="{{ route('manager.campaigns.show', $campaign->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
                                <span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24"></rect>
																			<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
																			<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
																		</g>
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </a>
                            <a title="Ayrıcalığı düzenle" href="{{ route('manager.campaigns.edit', $campaign->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
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
                            <form style="display: contents" action="{{ route("manager.campaigns.destroy", $campaign->id) }}" method="post">
                                @method("delete")
                                @csrf
                                <button onclick="return confirm('{{ $campaign->campaign_title }} ayrıcalığını silmek istediğinize emin misiniz?')" type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
        $("#campaigns_table").DataTable({
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
                    title: 'Ayrıcalıklar Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i> CSV',
                    titleAttr: 'CSV',
                    title: 'Ayrıcalıklar Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Ayrıcalıklar Raporu - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    },
                },
            ],
        });
    </script>
@endsection
