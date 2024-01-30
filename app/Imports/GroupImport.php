<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\Niveauxscolaire;
use App\Models\Filiere;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class GroupImport implements ToModel, WithHeadingRow
// class GroupImport implements ToCollection, WithHeadingRow
{

    private $niveauxscolaire;
    private $filiere;

    public function __construct()
    {

        $this->niveauxscolaire = Niveauxscolaire ::select('id','niveauxscolaire','label')->get();
        $this->filiere = Filiere ::select('id','nom_filiere','label')->get();
    }

    /**
    * @param array $row
    */
    public function model(array $row)
    {
      // Dump the row to inspect its structure
              // dd($row);

        $niveauxscolaire =$this->niveauxscolaire-> where('id', $row['code_niveauxscolaire'])->first() ;
        $filiere =$this->filiere ->where('id', $row['code_filiere'])->first();

        // if (!$niveauxscolaire || !$filiere) {
        //     // Handle the case where the related records are not found
        //     return null;
         //}
        return new Group([
            'label' => $row['label'],
            'nom_group' => $row['nom_group'],
            'description' => $row['description'],
            'code_niveauxscolaire' => $niveauxscolaire->id ?? null,
            'code_filiere' => $filiere->id ?? null,
        ]);
    }
    // public function model(array $row)
    // {

    //       return  new Filiere ([
    //             'nom_filiere' => $row['nom_filiere'],
    //             'label' => $row['label'],
    //         ]);

    //         dd($row);

    // }
}
