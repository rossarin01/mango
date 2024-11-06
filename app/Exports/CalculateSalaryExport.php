<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class CalculateSalaryExport implements FromView, WithColumnWidths
{
    protected $calculate_salary;
    protected $employees;
    protected $roster_workdates;
    protected $roster_template_details;
    protected $roster_tempalte_times;
    protected $checkin_checkouts;
    protected $calculate_salary_weeklies;

    public function __construct($data)
    {
        $this->calculate_salary = $data['calculate_salary'];
        $this->employees = $data['employees'];
        $this->roster_workdates = $data['roster_workdates'];
        $this->roster_template_details = $data['roster_template_details'];
        $this->roster_tempalte_times = $data['roster_tempalte_times'];
        $this->checkin_checkouts = $data['checkin_checkouts'];
        $this->calculate_salary_weeklies = $data['calculate_salary_weeklies'];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,

            'B' => 10,
            'C' => 10,
            'D' => 10,
            'E' => 10,
            'F' => 7,

            'G' => 10,
            'H' => 10,
            'I' => 10,
            'J' => 10,
            'K' => 7,

            'L' => 10,
            'M' => 10,
            'N' => 10,
            'O' => 10,
            'P' => 7,

            'Q' => 10,
            'R' => 10,
            'S' => 10,
            'T' => 10,
            'U' => 7,

            'V' => 10,
            'W' => 10,
            'X' => 10,
            'Y' => 10,
            'Z' => 7,

            'AA' => 10,
            'AB' => 10,
            'AC' => 10,
            'AD' => 10,
            'AE' => 7,

            'AF' => 10,
            'AG' => 10,
            'AH' => 10,
            'AI' => 10,
            'AJ' => 7,

            'AK' => 10,
            'AL' => 10,
            'AM' => 10,
            'AN' => 10,
            'AO' => 10,
            'AP' => 10,
            'AQ' => 10,
            'AR' => 10,
            'AS' => 10,
            'AT' => 10,
            'AU' => 10,
            'AV' => 10,
            'AW' => 10,
            'AX' => 10,
        ];
    }

    public function view(): View
    {
        return view('reports.excel.calculate_salary', [
            'calculate_salary' => $this->calculate_salary,
            'employees' => $this->employees,
            'roster_workdates' => $this->roster_workdates,
            'roster_template_details' => $this->roster_template_details,
            'roster_tempalte_times' => $this->roster_tempalte_times,
            'checkin_checkouts' => $this->checkin_checkouts,
            'calculate_salary_weeklies' => $this->calculate_salary_weeklies,
        ]);
    }
}
