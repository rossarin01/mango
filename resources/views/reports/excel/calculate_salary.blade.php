<style>
    .thead{
        background-color: #FFa;
        font-weight: bold;
    }
</style>
<div style="page-break-after: always;">
    <table>
        <tr>
            <td colspan="37" style="text-align: center"><h1 style="font-size: 35px;"><strong>Salary Report</strong></h1></td>
        </tr>
        <tr>
            <td colspan="37" style="text-align: center"><h3 style="font-size: 25px;"><strong>
                {{ $calculate_salary->branch->branch_name}} {{ $calculate_salary->department->department_name }}
            </strong></h3></td>
        </tr>
        <tr>
            <td colspan="2">อัพเดท {{ date('Y-m-d') }}</td>
        </tr>
        <tr>
            <td style="height: 20px;"></td>
        </tr>
    </table>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th rowspan="3" style="vertical-align: middle; background-color:#049d20; color:#FFF;">รายชื่อ</th>
                @foreach ($roster_workdates as $workdate )
                    <th colspan="5" style="text-align: center">
                        {{ date('D, j M Y', strtotime($workdate)) }}
                    </th>
                @endforeach
                <th rowspan="3" style="background-color:#fa8336; color:#FFF; vertical-align: middle; text-align:center">Total Hours</th>
                <th rowspan="2" colspan="14" style="vertical-align: middle; text-align:center">Weekly Summary</th>
            </tr>
            <tr>
                @foreach ($roster_workdates as $workdate )
                    <th colspan="2" style="text-align: center; background-color:#049d20; color:#FFF;">เช้า</th>
                    <th colspan="2" style="text-align: center; background-color:#049d20; color:#FFF;">บ่าย</th>
                    <th style="background-color:#049d20; color:#FFF;"></th>
                @endforeach
            </tr>
            <tr style="text-align: center">
                @foreach ($roster_template_details as $roster_template )
                    <th style="background-color:#049d20; color:#FFF; text-align: center">เข้า {{ date('H:i', strtoTime($roster_template->morning_shift)) }}</th>
                    <th style="background-color:#049d20; color:#FFF; text-align: center">ออก {{ date('H:i', strtoTime($roster_template->morning_end)) }}</th>
                    <th style="background-color:#049d20; color:#FFF; text-align: center">เข้า {{ date('H:i', strtoTime($roster_template->evening_shift)) }}</th>
                    <th style="background-color:#049d20; color:#FFF; text-align: center">ออก {{ date('H:i', strtoTime($roster_template->evening_end)) }}</th>
                    <th style="background-color:#049d20; color:#FFF; text-align: center">HR</th>
                @endforeach
                <th style="background-color:#049d20; color:#FFF;">Weekday Hours</th>
                <th style="background-color:#049d20; color:#FFF;">Weekend Hours</th>
                <th style="background-color:#049d20; color:#FFF;">Weekday Rate</th>
                <th style="background-color:#049d20; color:#FFF;">Weekend Rate</th>
                <th style="background-color:#fa8336; color:#FFF;">Pay</th>
                <th style="background-color:#049d20; color:#FFF;">Diff</th>
                <th style="background-color:#049d20; color:#FFF;">Surcharge</th>
                <th style="background-color:#fa8336; color:#FFF;">Total</th>
                <th style="background-color:#f9d347; color:#000;">Cash Pay</th>
                <th style="background-color:#049d20; color:#FFF;">Transfer Pay</th>
                <th style="background-color:#049d20; color:#FFF;">Payroll transfer</th>
                <th style="background-color:#049d20; color:#FFF;">TAX</th>
                <th style="background-color:#049d20; color:#FFF;">SUPPER</th>
            </tr>
        </thead>
        <tbody>
            @php
                use App\Helpers\TransferBioTime;
            @endphp
            @foreach ($employees as $employee )
            <tr>
                @php
                    $weekly_total_hours = 0;
                    $weekday_total_hours = 0;
                    $weekend_total_hours = 0;
                @endphp
                <td>
                    {{ $employee->name }}
                </td>
                @foreach ($roster_workdates as $key => $workdate )
                    @php
                        if(isset($roster_tempalte_times[$employee->id][$workdate]['morning_shift'])){
                            $workdate_morning_shift = date('H:i', strtotime($roster_tempalte_times[$employee->id][$workdate]['morning_shift']));
                        }else{
                            $workdate_morning_shift = '-';
                        }

                        if(isset($checkin_checkouts[$employee->id][$workdate]['morning_shift'])){
                            $checkin_morning_shift = date('H:i', strtotime($checkin_checkouts[$employee->id][$workdate]['morning_shift']));
                        }else{
                            $checkin_morning_shift = '';
                        }

                        $class_compare = (new TransferBioTime)->compareTime($workdate_morning_shift, $checkin_morning_shift, 'checkin');
                    @endphp
                    <td style="background-color: {{ $class_compare['class_bg'] }}; color:{{ $class_compare['class_font_color'] }}">
                        {{ $checkin_morning_shift }}
                    </td>

                    @php
                        if(isset($roster_tempalte_times[$employee->id][$workdate]['morning_end'])){
                            $workdate_morning_end = date('H:i', strtotime($roster_tempalte_times[$employee->id][$workdate]['morning_end']));
                        }else{
                            $workdate_morning_end = '-';
                        }

                        if(isset($checkin_checkouts[$employee->id][$workdate]['morning_end'])){
                            $checkin_morning_end = date('H:i', strtotime($checkin_checkouts[$employee->id][$workdate]['morning_end']));
                        }else{
                            $checkin_morning_end = '';
                        }

                        $class_compare = (new TransferBioTime)->compareTime($workdate_morning_end, $checkin_morning_end, 'checkout');
                    @endphp
                    <td style="background-color: {{ $class_compare['class_bg'] }}; color:{{ $class_compare['class_font_color'] }}">
                        {{ $checkin_morning_end }}
                    </td>

                    @php
                        if(isset($roster_tempalte_times[$employee->id][$workdate]['evening_shift'])){
                            $workdate_evening_shift = date('H:i', strtotime($roster_tempalte_times[$employee->id][$workdate]['evening_shift']));
                        }else{
                            $workdate_evening_shift = '-';
                        }

                        if(isset($checkin_checkouts[$employee->id][$workdate]['evening_shift'])){
                            $checkin_evening_shift = date('H:i', strtotime($checkin_checkouts[$employee->id][$workdate]['evening_shift']));
                        }else{
                            $checkin_evening_shift = '';
                        }

                        $class_compare = (new TransferBioTime)->compareTime($workdate_evening_shift, $checkin_evening_shift, 'checkin');
                    @endphp
                    <td style="background-color: {{ $class_compare['class_bg'] }}; color:{{ $class_compare['class_font_color'] }}">
                        {{ $checkin_evening_shift }}
                    </td>

                    @php
                        if(isset($roster_tempalte_times[$employee->id][$workdate]['evening_end'])){
                            $workdate_evening_end = date('H:i', strtotime($roster_tempalte_times[$employee->id][$workdate]['evening_end']));
                        }else{
                            $workdate_evening_end = '-';
                        }

                        if(isset($checkin_checkouts[$employee->id][$workdate]['evening_end'])){
                            $checkin_evening_end = date('H:i', strtotime($checkin_checkouts[$employee->id][$workdate]['evening_end']));
                        }else{
                            $checkin_evening_end = '';
                        }

                        $class_compare = (new TransferBioTime)->compareTime($workdate_evening_end, $checkin_evening_end, 'checkout');
                    @endphp
                    <td style="background-color: {{ $class_compare['class_bg'] }}; color:{{ $class_compare['class_font_color'] }}">
                        {{ $checkin_evening_end }}
                    </td>
                    <td>
                        @php
                            $morning_shift = strtotime($checkin_morning_shift);
                            $morning_end = strtotime($checkin_morning_end);
                            $hr_morning = round( abs($morning_shift - $morning_end) / 3600, 2 );

                            $evening_shift = strtotime($checkin_evening_shift);
                            $evening_end = strtotime($checkin_evening_end);
                            $hr_evening = round( abs($evening_shift - $evening_end) / 3600, 2 );

                            $hr = round($hr_morning + $hr_evening , 2);
                            $hours = floor($hr); // ชั่วโมงเต็ม
                            $minutes = round(($hr - $hours) * 60); // เศษชั่วโมงแปลงเป็นนาที

                            if($hours == 0 && $minutes == 0){
                                $total_day_hours = 0;
                            }else{
                                $total_day_hours = $hours.".".$minutes;
                            }
                        @endphp

                        {{ $total_day_hours }}

                    </td>

                    @php
                        $dayname = date('D', strtotime($workdate));
                        $dayname = strtoupper($dayname);
                        if($dayname == 'SAT' || $dayname == 'SUN'){
                            $weekend_total_hours += $total_day_hours;
                        }else{
                            $weekday_total_hours += $total_day_hours;
                        }

                        $weekly_total_hours += $total_day_hours;
                    @endphp
                @endforeach

                <td style="background-color:#fa8336; color:#FFF;">
                    @php
                        if(isset($calculate_salary_weeklies[$employee->id]['total_hours']) && !is_null($calculate_salary_weeklies[$employee->id]['total_hours'])){
                            $weekly_total_hours = $calculate_salary_weeklies[$employee->id]['total_hours'];
                        }
                    @endphp
                    {{ $weekly_total_hours }}
                </td>
                <td>
                    @php
                        if(isset($calculate_salary_weeklies[$employee->id]['weekday_hours']) && !is_null($calculate_salary_weeklies[$employee->id]['weekday_hours'])){
                            $weekday_total_hours = $calculate_salary_weeklies[$employee->id]['weekday_hours'];
                        }
                    @endphp

                    {{ $weekday_total_hours }}
                </td>
                <td>
                    @php
                        if(isset($calculate_salary_weeklies[$employee->id]['weekend_hours']) && !is_null($calculate_salary_weeklies[$employee->id]['weekend_hours'])){
                            $weekend_total_hours = $calculate_salary_weeklies[$employee->id]['weekend_hours'];
                        }
                    @endphp

                    {{ $weekend_total_hours }}
                </td>
                <td>
                    {{ $calculate_salary_weeklies[$employee->id]['weekday_rate'] ?? '' }}
                </td>
                <td>
                    {{ $calculate_salary_weeklies[$employee->id]['weekend_rate'] ?? '' }}
                </td>
                <td style="background-color:#fa8336; color:#FFF;">
                    {{ $calculate_salary_weeklies[$employee->id]['payment'] ?? '' }}
                </td>
                <td>
                    {{ $calculate_salary_weeklies[$employee->id]['diff'] ?? '' }}
                </td>
                <td>
                    {{ $calculate_salary_weeklies[$employee->id]['surcharge'] ?? '' }}
                </td>
                <td style="background-color:#fa8336; color:#FFF;">
                    {{ $calculate_salary_weeklies[$employee->id]['total'] ?? '' }}
                </td>
                <td style="background-color:#f9d347; color:#000;">
                    {{ $calculate_salary_weeklies[$employee->id]['cash_payment'] ?? '' }}
                </td>
                <td>
                    {{ $calculate_salary_weeklies[$employee->id]['transfer_payment'] ?? '' }}
                </td>
                <td>
                    {{ $calculate_salary_weeklies[$employee->id]['payroll_transfer'] ?? '' }}
                </td>
                <td>
                    {{ $calculate_salary_weeklies[$employee->id]['tax'] ?? '' }}
                </td>
                <td>
                    {{ $calculate_salary_weeklies[$employee->id]['super'] ?? '' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
