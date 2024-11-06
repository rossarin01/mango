@extends('./layout/master')

@section('head')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>

    <style>
        .event-roster {
            /*background-color: #ffcccc; /* สีพื้นหลังสำหรับสถานะส่งรถ */
            background-color: #590ee2; /* สีพื้นหลังสำหรับสถานะส่งรถ */
            color: #ffffff !important; /* สีตัวอักษรสำหรับสถานะส่งรถ */
        }


    </style>
@endsection

@section('content')
<div class="full-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div id='calendar'></div>

            </div>
        </div>
    </div>
</div>

{{-- Modal รายละเอียด --}}
<div class="modal fade" id="showRoster" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleshowBooking">Roster</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-5 my-2" style="text-align: right;">Workdate : </dt>
                    <dd class="col-7 my-2" id="workdate"></dd>

                    <dt class="col-5 my-2" style="text-align: right;">Morning shift : </dt>
                    <dd class="col-7 my-2" id="morning_shift"></dd>

                    <dt class="col-5 my-2" style="text-align: right;">Morning end : </dt>
                    <dd class="col-7 my-2" id="morning_end"></dd>

                    <dt class="col-5 my-2" style="text-align: right;">Evening shift : </dt>
                    <dd class="col-7 my-2" id="evening_shift"></dd>

                    <dt class="col-5 my-2" style="text-align: right;">Evening end : </dt>
                    <dd class="col-7 my-2" id="evening_end"></dd>
                </dl>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        calendarShowRoster('emp/get-roster');
    });

    function calendarShowRoster(fectEvent = null){
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            initialView: 'dayGridMonth',
            events: function(fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: fectEvent,  // URL ที่จะเรียกเพื่อดึงข้อมูล event
                    type: 'GET',
                    success: function(response) {
                        successCallback(response);  // ส่งข้อมูลที่ได้รับให้ FullCalendar
                    },
                    error: function() {
                        failureCallback();
                    }
                });
            },
            eventClick: function(info) {
                // ดึงรายละเอียดของ event เมื่อคลิก
                var eventObj = info.event;
                $.ajax({
                    type: 'GET',
                    url: '{{ route("empprofile.roster.show") }}',
                    data:{
                        'roster_id': eventObj.id
                    },
                    success: function(response) {
                        let workdate = response.roster.workdate;
                        let morning_shift = formatTime(response.roster.morning_shift);
                        let morning_end = formatTime(response.roster.morning_end);
                        let evening_shift = formatTime(response.roster.evening_shift);
                        let evening_end = formatTime(response.roster.evening_end);

                        $('#workdate').html(workdate);
                        $('#morning_shift').html(morning_shift);
                        $('#morning_end').html(morning_end);
                        $('#evening_shift').html(evening_shift);
                        $('#evening_end').html(evening_end);
                        $('#showRoster').modal('show');
                    }
                });
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            }
        });
        calendar.render();
    }

    // ฟังก์ชันเพื่อแสดงผลเป็น H:i
    function formatTime(date=null) {
        if(date){
            let dateArray = date.split(':');
            let hours = dateArray[0];
            let minutes = dateArray[1]
            return `${hours}:${minutes}`;
        }else{
            return '-';
        }
    }

</script>
@endsection
