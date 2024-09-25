<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\ReferentielFirebaseService;

class ReferentielController extends Controller
{
    protected $referentielService;

    public function __construct(ReferentielFirebaseService $referentielService)
    {
        $this->referentielService = $referentielService;
    }

    public function create(Request $request)
    {
        // $data = $request->validate([
        //     'code' => 'required|string',
        //     'libelle' => 'required|string',
        //     'description' => 'nullable|string',
        //     'photo' => 'nullable|image',
        //     'statut' => 'required|string',
        //     'competences' => 'nullable|array',
        // ]);

        return $this->referentielService->createReferentiel($request->all());
    }

    // public function update($id, Request $request)
    // {
    //     $data = $request->validate([
    //         'code' => 'nullable|string',
    //         'libelle' => 'nullable|string',
    //         'description' => 'nullable|string',
    //         'photo' => 'nullable|image',
    //         'statut' => 'nullable|string',
    //         'competences' => 'nullable|array',
    //     ]);

    //     return $this->referentielService->updateReferentiel($id, $data);
    // }

    public function update($id, Request $request)
    {
        // Log des données brutes reçues
        Log::info('Données brutes reçues pour mise à jour', ['input' => $request->all()]);

        // Validation des données
        // $data = $request->validate([
        //     'code' => 'nullable|string,',
        //     'libelle' => 'nullable|string',
        //     'description' => 'nullable|string',
        //     'photo' => 'nullable|image',
        //     'statut' => 'nullable|string',
        //     'competences' => 'nullable|array',
        // ]);
        dd($request->all());

        // Log des données validées
        Log::info('Données validées après validation', ['data' => $data]);

        // Nettoyage des données : suppression des valeurs nulles ou vides
        $data = array_filter($data, function ($value) {
            return $value !== null && $value !== '';
        });

        // Log après nettoyage
        Log::info('Données après nettoyage', ['data' => $data]);

        // Vérification des données avant mise à jour
        if (empty($data)) {
            Log::error('Aucune donnée à mettre à jour après le nettoyage.');
            return response()->json(['error' => 'Aucune donnée à mettre à jour.'], 400);
        }

        return $this->referentielService->updateReferentiel($id, $data);
    }



    public function delete($id)
    {
        return $this->referentielService->deleteReferentiel($id);
    }

    public function index()
    {
        return $this->referentielService->getAllReferentiel();
    }

    public function show($id)
    {
        return $this->referentielService->getReferentielById($id);
    }

    public function findByLibelle($libelle)
    {
        return $this->referentielService->getReferentielByLibelle($libelle);
    }

    public function findByCode($code)
    {
        return $this->referentielService->getReferentielByCode($code);
    }

    public function findByEtat($etat)
    {
        return $this->referentielService->getReferentielByEtat($etat);
    }

    public function archived()
    {
        return $this->referentielService->getArchivedReferentiels();
    }
}
