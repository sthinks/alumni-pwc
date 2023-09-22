<div class="row mb-4" id="job_permissions">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(!auth()->user()->consent('is-ilanlari'))
                <div id="job_permission_area">
                    <p class="font-weight-bold" style="color:#000;">Kariyer fırsatlarını e-mail olarak da almak istiyorsanız iletişim izni vermenizi rica ederiz.</p>
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <form id="permission_form">
                            @csrf
                            <div class="form-check mb-4 ps-0">
                                <div class="d-flex">
                                    <p style="font-weight:500;">Kariyer fırsatları ile ilgili bildirimleri almak istiyorum.</p>
                                    <label class="switch mt-0">
                                        <input name="value" value="1" type="hidden" />
                                        <input onchange="sendPermission()" class="form-check-input" type="checkbox"
                                               name="name" value="is-ilanlari" id="flexSwitchDefault" />
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <form id="skills_form">
                            <div class="form-group mb-4">
                                <label for="user_skills" class="form-label">
                                    <p>Yeteneklerinizi güncel tutun size uygun iş fırsatlarından önce siz haberdar olun!</p>
                                </label>
                                <select name="skills[]" required id="user_skills" class="form-select form-select-solid" data-control="select2" data-placeholder="Lütfen pozisyon için gereken yetenekleri seçiniz" data-allow-clear="true" multiple="multiple">
                                    <option></option>
                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill->id }}" @if(in_array($skill->id, $user_skills)) selected @endif>
                                            {{ $skill->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button id="save_skills" class="btn pwc-orange-button text-uppercase">Kaydet</button>
                            <div id="save_skills_spinner"></div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
