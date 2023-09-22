@extends('alumni.layout.app')
@section('title', 'Mesaj Kutusu')
@section('bg', url('static/alumni/assets/media/background/knowledge.png'))
@section('breadcrumb', Breadcrumbs::render('chat'))
@section("abstract", "Eski çalışma arkadaşlarınızla yeniden bağlantı kurun.")
@section('main')
    <div class="card shadow col-12">
        <div class="p-6">
            <div class="w-100 position-relative mb-5" autocomplete="off">
                <!--begin::Hidden input(Added to disable form autocomplete)-->
                <input type="hidden">
                <!--end::Hidden input-->
                <!--begin::Icon-->
                <!--begin::Svg Icon | path: icons/duotone/General/Search.svg-->
                <span
                    class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path
                                d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                            <path
                                d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                fill="#000000" fill-rule="nonzero"></path>
                        </g>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <!--end::Icon-->
                <!--begin::Input-->
                <input id="chat_search" type="text" class="form-control form-control-lg form-control-solid px-15"
                    name="search" value="" placeholder="Arama" data-kt-search-element="input">
                <!--end::Input-->
                <!--begin::Spinner-->
                <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5"
                    data-kt-search-element="spinner">
                    <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                </span>
                <!--end::Spinner-->
                <!--begin::Reset-->
                <span
                    class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none"
                    data-kt-search-element="clear">
                    <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                    <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5"
                                    transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                    x="0" y="7" width="16" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </span>
                <!--end::Reset-->
            </div>
        </div>
        <div class="table-responsive">
            <table id="chat" class="table table-striped table-row-bordered gy-5 gs-7">
                <thead class="d-none">
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td><a class="text-dark font-weight-900"
                                    href="{{ route('chat.show', $contact->uid) }}"><b>{{ $contact->name }}</b>
                                    @if ($contact->unread > 0)
                                        ({{ $contact->unread }} okunmamış mesajınız var)
                                    @endif
                                </a></td>
                            <td>
                                @if ($contact->lastmessage->from == auth()->id())
                                    <b>Sen:</b>
                                @else
                                    <b>{{ $contact->name }}:</b>
                                @endif
                                {{ Illuminate\Support\Str::words(strip_tags($contact->lastmessage->message), 5) }}
                            </td>
                            <td>{{ $contact->lastmessage->created_at->format('d.m.Y | H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        let chatTable = $("#chat").DataTable({
            dom: `
			<'row'<'col-sm-12'tr>>
			<'row p-5'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7 dataTables_pager'p>>`,
            "order": [
                [2, "desc"]
            ],
            "oLanguage": {
                "sEmptyTable": "<b><u><a href='community'>Alumni Topluluğu</a></u></b> bölümünden kişi kartlarına tıklayarak yeni bir sohbet başlatabilirsiniz."
            }
        });
        $('#chat_search').keyup(function() {
            chatTable.search($(this).val()).draw();
        });
    </script>
@endsection
