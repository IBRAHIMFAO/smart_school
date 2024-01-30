<?php

namespace App\Exports;


use App\Models\Attendance;
use App\Models\Group;
use App\Models\Student;
use App\Models\Seance;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AttendanceExport implements FromArray , WithHeadingRow, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\array
    */
    public function array(): array
    {
        $list = [];
        $columnNames = [
            'nom group',
            'niveauxscolaire',
            'filiere',
        ];

        $list[] = $columnNames;

        $groups = Group::all();


        foreach($groups as $group){
        $list[] = [
                    'nom_group' =>        $group->nom_group,
                    'code_niveauxscolaire' =>        $group ->niveauxscolaire -> niveauxscolaire,
                    'code_filiere' =>        $group ->filiere -> nom_filiere,];
                }

        return $list;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style for column names (header)
            'A1:C1' => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'A9A9A9'],
                ],
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
        ];
    }


}
