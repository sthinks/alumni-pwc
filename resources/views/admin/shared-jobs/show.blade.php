@extends("admin.layouts.app")
@section("title", sprintf("%s tarafından önerilen iş ilanı", $owner->name))
@section("content")
    <div class="card">
    <div class="card-body">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table align-middle gs-0 gy-4" id="job_owner_info">
                        <!--begin::Table head-->
                        <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 min-w-125px rounded" colspan="2">İlanı Öneren Kişinin Bilgileri</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Öneren</span>
                            </td>
                            <td>
                                <span class="fw-bold d-block fs-7">{{ $owner->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Öneren Telefon Numarası</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $owner->phone }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Öneren Mail Adresi</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $owner->email }}</span>
                            </td>
                        </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
                <!--end::Table-->
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table align-middle gs-0 gy-4" id="job_info">
                        <!--begin::Table head-->
                        <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 min-w-125px rounded" colspan="2">İlan Detayları</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Şirket Adı</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $job->company }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Pozisyon Adı</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $job->position }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Pozisyon Seviyesi</span>
                            </td>
                            <td class="d-block">
                                <span class="fw-bold fs-7">{{ $job->level }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Adres / Lokasyon</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $location }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Deneyim</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $job->experience }} yıl</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Detay</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $job->detail }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">İlan Tarihi</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ optional($job->date)->format("d/m/Y H:i:s") ?? "-" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Geçerlilik Tarihi</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ optional($job->valid_till)->format("d/m/Y H:i:s") ?? "-" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">Başvuru Linki</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $job->link }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold d-block fs-7">İstenen Yetenekler</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-7">{{ $job->skills }}</span>
                            </td>
                        </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
                <!--end::Table-->
        <form style="display: contents" action="{{ route("manager.shared.destroy", $job->id) }}" method="post">
            @method("delete")
            @csrf
            <button onclick="return confirm('Bu ilanını silmek istediğinize emin misiniz?')" type="submit" class="btn btn-danger">
                İlanı Sil
            </button>
        </form>

            </div>

        </div>
@endsection
