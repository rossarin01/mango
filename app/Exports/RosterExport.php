<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class RosterExport implements FromView, WithColumnWidths
{

    protected $roster;
    protected $roster_details;
    protected $roster_template_details;
    protected $employees;
    protected $roster_group_date;

    public function __construct($data)
    {
        $this->roster = $data['roster'];
        $this->roster_details = $data['roster_details'];
        $this->roster_template_details = $data['roster_template_details'];
        $this->employees = $data['employees'];
        $this->roster_group_date = $data['roster_group_date'];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,

            'B' => 8,
            'C' => 8,
            'D' => 8,
            'E' => 8,
            'F' => 5,

            'G' => 8,
            'H' => 8,
            'I' => 8,
            'J' => 8,
            'K' => 5,

            'L' => 8,
            'M' => 8,
            'N' => 8,
            'O' => 8,
            'P' => 5,

            'Q' => 8,
            'R' => 8,
            'S' => 8,
            'T' => 8,
            'U' => 5,

            'V' => 8,
            'W' => 8,
            'X' => 8,
            'Y' => 8,
            'Z' => 5,

            'AA' => 8,
            'AB' => 8,
            'AC' => 8,
            'AD' => 8,
            'AE' => 5,

            'AF' => 8,
            'AG' => 8,
            'AH' => 8,
            'AI' => 8,
            'AJ' => 5,

            'AK' => 8,
        ];
    }

    public function view(): View
    {
        return view('reports.excel.roster', [
            'roster' => $this->roster,
            'roster_details' => $this->roster_details,
            'roster_template_details' => $this->roster_template_details,
            'employees' => $this->employees,
            'roster_group_date' => $this->roster_group_date,
        ]);
    }
}
