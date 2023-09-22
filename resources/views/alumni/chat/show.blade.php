@extends('alumni.layout.detailapp')
@section('title', sprintf('%s ile sohbet et', $friend->name))
@section('bg', url('static/alumni/assets/media/background/knowledge.png'))
@section('breadcrumb', Breadcrumbs::render('chat-detail', $friend))
@section('main')
    <div class="card col-12">
        <div class="card" id="kt_chat_messenger">
            <!--begin::Card header-->
            <div class="card-header" id="kt_chat_messenger_header">
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::User-->
                    <div class="d-flex justify-content-center flex-column me-3" id="message_user">
                        {{ $friend->name }}
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <div class="me-n3">
                        <button class="btn btn-sm btn-icon btn-active-light-primary" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                            <i class="bi bi-three-dots fs-2"></i>
                        </button>
                        <!--begin::Menu 3-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                            data-kt-menu="true">
                            <!--begin::Heading-->
                            <div class="menu-item px-3">
                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">İşlemler</div>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                @if (auth()->user()->checkIfUserBlocked($friend))
                                    <a href="{{ route('chat.unblock', $friend_id) }}" class="menu-link px-3">Engeli
                                        Kaldır</a>
                                @else
                                    <a href="{{ route('chat.block', $friend_id) }}" class="menu-link px-3">Engelle</a>
                                @endif
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 3-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body chat-messages-body" id="kt_chat_messenger_body">
                <!--begin::Messages-->
                <div id="scroll_chat_area" class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages"
                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                    data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                    data-kt-scroll-wrappers="#kt_content, #kt_chat_messenger_body" data-kt-scroll-offset="-2px"
                    style="max-height: 55px;">
                    @foreach ($messages as $message)
                        @if ($message->from == auth()->id())
                            <!--begin::Message(out)-->
                            <div class="d-flex justify-content-end mb-10 text-end">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column align-items-end">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Details-->
                                        <div class="me-3">
                                            <span
                                                class="text-muted fs-7 mb-1">{{ $message->created_at->diffForHumans() }}</span>
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">Sen</a>
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            @if (isset(auth()->user()->avatar))
                                                <img alt="{{ auth()->user()->name }}"
                                                    src="{{ auth()->user()->avatar }}">
                                            @endif
                                        </div>
                                        <!--end::Avatar-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Text-->
                                    <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px"
                                        data-kt-element="message-text">{!! $message->message !!}</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Message(out)-->
                        @else
                            <!--begin::Message(in)-->
                            <div class="d-flex justify-content-start mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column align-items-start">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            @if (isset($friend->avatar))
                                                <img alt="{{ $friend->name }}"
                                                    src="{{ $friend->avatar }}">
                                            @endif
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Details-->
                                        <div class="ms-3">
                                            <a href="#"
                                                class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{ $friend->name }}</a>
                                            <span
                                                class="text-muted fs-7 mb-1">{{ $message->created_at->diffForHumans() }}</span>
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Text-->
                                    <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start"
                                        data-kt-element="message-text">{!! $message->message !!}</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Message(in)-->
                        @endif
                    @endforeach
                </div>
                <!--end::Messages-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <form action="{{ route('chat.store', $friend_id) }}" method="post">
                @csrf
                <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                    <!--begin::Input-->
                    <textarea id="chat_message" name="message" class="form-control form-control-flush mb-3" rows="1" data-kt-element="input"
                        placeholder="Mesaj yazınız"></textarea>
                    <!--end::Input-->
                    <!--begin:Toolbar-->
                    <div class="d-flex flex-stack">
                        <!--begin::Send-->
                        <button class="btn directory_message_button" type="submit" data-kt-element="send">Gönder</button>
                        <!--end::Send-->
                    </div>
                    <!--end::Toolbar-->
                </div>
            </form>
            <!--end::Card footer-->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('static/alumni/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script>
        tinymce.init({
            selector: "textarea#chat_message",
            menubar: false,
            toolbar_location: "bottom",
            branding: false,
            elementpath: false,
            plugins: 'emoticons',
            language: 'tr_TR',
            inline_boundaries: false,
            toolbar: 'undo redo | bold italic | ' +
                '| emoticons',

        });
    </script>
    <script>
        $('html,body').animate({
            scrollTop: $("#message_user").offset().top
        }, 1000);
        $('#scroll_chat_area').animate({
            scrollTop: $(".text-end:last-child").offset().top
        }, 1000);
    </script>
@endsection
