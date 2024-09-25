<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Facades\ReferentielFirebaseFacade;
use App\Models\Referentiel;
use App\Services\Interfaces\ReferentielServiceInterface;

class ReferentielFirebaseService implements ReferentielServiceInterface
{
    public function createReferentiel(array $data)
    {
        $path = 'referentiels'; // Chemin où les données doivent être stockées

        return ReferentielFirebaseFacade::create($path,$data);
    }

    // public function updateReferentiel(string $id, array $data)
    // {
    //     $path = 'referentiels';
    //     return ReferentielFirebaseFacade::update($path,$id, $data);
    // }

    public function updateReferentiel(string $id, array $data)
{
    $path = 'referentiels';

    // Log pour vérifier les données reçues
    Log::info('Données reçues pour updateReferentiel', ['id' => $id, 'data' => $data]);

    // Traitement spécifique pour la photo si présente
    if (isset($data['photo']) && $data['photo'] instanceof \Illuminate\Http\UploadedFile) {
        // Gestion de l'upload de l'image
        $data['photo'] = ReferentielFirebaseFacade::uploadImageToStorage($data['photo']);
        Log::info('Photo uploadée avec succès', ['photo' => $data['photo']]);
        
    }

    // Vérification des données avant de les envoyer à Firebase
    if (empty($data)) {
        Log::error('Les données à mettre à jour sont toujours vides après traitement.');
        return response()->json(['error' => 'Aucune donnée à mettre à jour.'], 400);
    }

    // Log avant la mise à jour dans Firebase
    Log::info('Mise à jour du référentiel avec les données finales', ['path' => $path, 'id' => $id, 'data' => $data]);

    return ReferentielFirebaseFacade::update($path, $id, $data);
}

    


    public function deleteReferentiel(string $id)
    {
        return ReferentielFirebaseFacade::delete($id);
    }

    public function getAllReferentiel()
    {
        $path = 'referentiels'; // Spécifiez le chemin correct pour les référentiels

        return ReferentielFirebaseFacade::getAll($path);
    }

    public function getReferentielByLibelle(string $libelle)
    {
        $referentiels = $this->getAllReferentiel();
        return array_filter($referentiels, function($referentiel) use ($libelle) {
            return $referentiel['libelle'] === $libelle;
        });
    }

    public function getReferentielByCode(string $code)
    {
        $referentiels = $this->getAllReferentiel();
        return array_filter($referentiels, function($referentiel) use ($code) {
            return $referentiel['code'] === $code;
        });
    }

    public function getReferentielByEtat(string $etat)
    {
        $referentiels = $this->getAllReferentiel();
        return array_filter($referentiels, function($referentiel) use ($etat) {
            return $referentiel['statut'] === $etat;
        });
    }

    public function getReferentielById(string $id)
    {
        $path = 'referentiels';
        return ReferentielFirebaseFacade::find($path,$id);
    }

    public function getArchivedReferentiels()
    {
        $referentiels = $this->getAllReferentiel();
        return array_filter($referentiels, function($referentiel) {
            return $referentiel['statut'] === 'archivé';
        });
    }
}
