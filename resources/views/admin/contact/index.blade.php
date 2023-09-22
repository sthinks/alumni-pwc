@extends("admin.layouts.app")
@section("title", "İletişim Formları")
@section("content")
    <div class="card mb-5 mb-xl-8 mt-5">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">İletişim Formları</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4" id="contact_table">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-125px rounded-start">Adı</th>
                        <th class="min-w-125px">Email</th>
                        <th class="min-w-125px">Mesaj</th>
                        <th class="min-w-150px">Eklenme Tarihi</th>
                        <th class="min-w-200px text-center rounded-end">İşlemler</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $contact->contact_name }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $contact->contact_email }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $contact->mini_description }}</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $contact->created_at->format("d/m/Y H:i:s") }}</span>
                            </td>
                            <td class="text-end">
                                <form style="display: contents" action="{{ route("manager.contact.destroy", $contact->id) }}" method="post">
                                    @method("delete")
                                    @csrf
                                    <button onclick="return confirm('Bu iletişim formunu silmek istediğinize emin misiniz?')" type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
        $("#contact_table").DataTable({
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
                    title: 'İletişim Formları - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i> CSV',
                    titleAttr: 'CSV',
                    title: 'İletişim Formları - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'İletişim Formları - {{ now()->format('d-m-Y H.i.s') }}',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    },
                },
            ],
        });
    </script>
@endsection
