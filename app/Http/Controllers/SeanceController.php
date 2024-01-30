<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seance;
use App\Models\Group;
use App\Models\Salle;
use carbon\Carbon;

class SeanceController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'heure_debut' => 'required|date_format:H:i:s',
            'heure_fin' => 'required|date_format:H:i:s',
            'code_salle' => 'required|exists:salles,id',
            'code_prof' => 'required|exists:profs,id',
            'code_matiere' => 'required|exists:matieres,id',
            'code_group' => 'required|exists:groups,id',
        ]);

        $seance = new Seance;
        $seance->date = $data['date'];
        $seance->heure_debut = $data['heure_debut'];
        $seance->heure_fin = $data['heure_fin'];
        $seance->code_salle = $data['code_salle'];
        $seance->code_prof = $data['code_prof'];
        $seance->code_matiere = $data['code_matiere'];
        $seance->code_group = $data['code_group'];

        // Vérifier les contraintes de disponibilité
        if ($this->checkConstraints($seance)) {
            $seance->save();
            return response()->json(['success' => 'Séance créée avec succès']);
        } else {
            return response()->json(['error' => 'Impossible de créer la séance. Contraintes non respectées.'], 400);
        }
    }

    private function checkConstraints($seance)
    {
        // Vérifier la disponibilité de la salle
        $salleOccupied = Seance::where('code_salle', $seance->code_salle)
            ->where(function ($query) use ($seance) {
                $query->where('date', $seance->date)
                    ->where(function ($q) use ($seance) {
                        $q->where('heure_debut', '>=', $seance->heure_debut)
                            ->where('heure_debut', '<', $seance->heure_fin);
                    })
                    ->orWhere(function ($q) use ($seance) {
                        $q->where('heure_fin', '>', $seance->heure_debut)
                            ->where('heure_fin', '<=', $seance->heure_fin);
                    })
                    ->orWhere(function ($q) use ($seance) {
                        $q->where('heure_debut', '<=', $seance->heure_debut)
                            ->where('heure_fin', '>=', $seance->heure_fin);
                    });
            })
            ->exists();

        if ($salleOccupied) {
            return false; // Salle occupée pendant la séance
        }

        // Vérifier la disponibilité du professeur
        $profOccupied = Seance::where('code_prof', $seance->code_prof)
            ->where(function ($query) use ($seance) {
                $query->where('date', $seance->date)
                    ->where(function ($q) use ($seance) {
                        $q->where('heure_debut', '>=', $seance->heure_debut)
                            ->where('heure_debut', '<', $seance->heure_fin);
                        })
                        ->orWhere(function ($q) use ($seance) {
                            $q->where('heure_fin', '>', $seance->heure_debut)
                                ->where('heure_fin', '<=', $seance->heure_fin);
                        })
                        ->orWhere(function ($q) use ($seance) {
                            $q->where('heure_debut', '<=', $seance->heure_debut)
                                ->where('heure_fin', '>=', $seance->heure_fin);
                        });
                })
                ->exists();

            if ($profOccupied) {
                return false; // Professeur occupé pendant la séance
            }

            // Vérifier la disponibilité du groupe
            $groupOccupied = Seance::where('code_group', $seance->code_group)
                ->where(function ($query) use ($seance) {
                    $query->where('date', $seance->date)
                        ->where(function ($q) use ($seance) {
                            $q->where('heure_debut', '>=', $seance->heure_debut)
                                ->where('heure_debut', '<', $seance->heure_fin);
                        })
                        ->orWhere(function ($q) use ($seance) {
                            $q->where('heure_fin', '>', $seance->heure_debut)
                                ->where('heure_fin', '<=', $seance->heure_fin);
                        })
                        ->orWhere(function ($q) use ($seance) {
                            $q->where('heure_debut', '<=', $seance->heure_debut)
                                ->where('heure_fin', '>=', $seance->heure_fin);
                        });
                })
                ->exists();

            if ($groupOccupied) {
                return false; // Groupe occupé pendant la séance
            }

            return true; // Toutes les contraintes sont satisfaites
        }
}


