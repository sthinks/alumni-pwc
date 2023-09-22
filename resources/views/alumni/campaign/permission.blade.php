@if(!auth()->user()->consent('ayricalik-indirim'))
    <div class="row mb-4" id="campaign_permission_area">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <p>Ayrıcalıklarla ile ilgili bildirimleri almak istiyorum.</p>
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <form id="permission_form">
                                @csrf
                                <div class="form-check mb-4 ps-0">
                                    <div class="d-flex">
                                        <label class="switch mt-0">
                                            <input name="value" value="1" type="hidden" />
                                            <input onchange="sendPermission()" class="form-check-input" type="checkbox"
                                                   name="name" value="ayricalik-indirim" id="flexSwitchDefault" />
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
