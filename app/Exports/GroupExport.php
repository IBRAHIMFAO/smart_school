<?php

namespace App\Exports;
use App\Models\Group;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Collection;


class GroupExport implements FromCollection, WithHeadings 
{
    protected $headerData;
    protected $groupsData;

    public function __construct($headerData, $groupsData)
    {
        $this->headerData = $headerData;
        $this->groupsData = $groupsData;
        
    }
    
    public function collection()
    {
        // Define the header row
        $headerRow = [
            'Année Scolaire:',
            'École:',
            'Département:',
            'Filière:',
            'Niveaux Scolaire' ,
            'Nom du groupe',
        ];

        // Create a collection with header data and groups data
        $data = collect([$headerRow])->concat($this->groupsData);

        return $data;
    }

    public function headings(): array
    {
        // Define the headings for the Excel file
        return $this->headerData;
    }
}



        









