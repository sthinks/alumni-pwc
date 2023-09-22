@extends("admin.layouts.app")
@section("title", "Hoşgeldiniz")
@section("content")
    <!--begin::Üye İstatistiği-->
    <div class="row">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">
                        12 Aylık Alumni İstatistiği
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <canvas id="alumni_user_stats" class="mh-400px"></canvas>
            </div>
        </div>
    </div>
    <!--end::Üye İstatistiği-->
    <!--begin::Etkinlik takvimi-->
    <div class="row mt-5">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">
                        Etkinlik Takvimi
                    </h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route("manager.events.create") }}" class="btn btn-light-primary font-weight-bold">
                        <i class="ki ki-plus "></i> Etkinlik Ekle
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div id="kt_calendar_app"></div>
            </div>
        </div>
    </div>
    <!--end::Etkinlik takvimi-->
@endsection
@section("css")
    <link href="{{ url("static/admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css") }}" rel="stylesheet"
          type="text/css"/>
@endsection
@section("js")
    <script src="{{ url("static/admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js") }}"></script>
    <script type="text/javascript">
        function eventCalendar()
        {
            var initialLocaleCode = "tr";
            var calendarEl = document.getElementById("kt_calendar_app");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay"
                },
                locale: initialLocaleCode,
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: [
                    @foreach(App\Event::all() as $event)
                    {
                        title: "{{ $event->event_title }}",
                        start: "{{ $event->event_start_date }}",
                        end: "{{ $event->event_end_date }}",
                        url: "{{ route("manager.events.edit", $event->id) }}",
                    },
                   @endforeach
                ]
            });

            calendar.render();
        }
        jQuery(document).ready(function() {
            eventCalendar();
        });
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById('alumni_user_stats');

        // Chart labels
        const labels = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];

        // Chart data
        const data = {
            labels: labels,
            datasets: [
                {
                    'type': 'line',
                    'label': 'Bu ay toplam kayıt sayısı',
                    'data': [{{ $alumni_stats }}],
                    'fill': false,
                    'borderColor': 'rgb(75, 192, 192)',
                    'tension': 0.1
                }
            ]
        };

        // Chart config
        const config = {
            data: data,
            options: {
                plugins: {
                    title: {
                        display: false,
                    },
                    legend: {
                        display: false
                    },
                },
                responsive: true,
            },
        };
        // Init ChartJS -- for more info, please visit: https://www.chartjs.org/docs/latest/
        var myChart = new Chart(ctx, config);
    </script>
@endsection
