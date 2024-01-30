<?php

namespace App\Exports;

use App\Models\Seance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmploiDuTempsProfExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Get the seances data based on your logic
        $seances = Seance::with(['prof', 'matiere', 'salle', 'group'])
            // Apply any filters or conditions here
            ->get();

        // Transform the data as needed
        $data = [];
        foreach ($seances as $seance) {
            $data[] = [
                $seance->id,
                $seance->prof->firstName . ' ' . $seance->prof->lastName,
                $seance->matiere->nom_matiere,
                $seance->salle->label,
                $seance->heure_debut,
                $seance->heure_fin,
                $seance->group->nom_group,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Professor',
            'Matiere',
            'Salle',
            'Heure de debut',
            'Heure de fin',
            'Groupe',
        ];
    }





}
