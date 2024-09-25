<?php

namespace App\Repository;

use App\Facades\ReferentielFirebaseFacade;
use App\Models\Firebase\ReferentielFirebase;
use App\Repository\Interface\ReferentielRepositoryInterface;

class ReferentielRepositoryImpl implements ReferentielRepositoryInterface
{
    protected $referentielPath = 'referentiels';

    public function create(array $data)
    {
        return ReferentielFirebaseFacade::createReferentiel($this->referentielPath,$data);
    }

    public function update(string $id, array $data)
    {
        return ReferentielFirebaseFacade::updateReferentiel($id, $data);
    }

    public function delete(string $id)
    {
        return ReferentielFirebaseFacade::deleteReferentiel($id);
    }

    public function getAll()
    {
        return ReferentielFirebaseFacade::getAllReferentiels($this->referentielPath);
    }

    public function getById(string $id)
    {
        return ReferentielFirebaseFacade::getReferentielById($id);
    }

    public function getByLibelle(string $libelle)
    {
        $referentiels = $this->getAll();
        return array_filter($referentiels, function ($referentiel) use ($libelle) {
            return stripos($referentiel['libelle'], $libelle) !== false; // Recherche insensible à la casse
        });
    }

    public function getByCode(string $code)
    {
        $referentiels = $this->getAll();
        return array_filter($referentiels, function ($referentiel) use ($code) {
            return $referentiel['code'] === $code;
        });
    }

    public function getByEtat(string $etat)
    {
        $referentiels = $this->getAll();
        return array_filter($referentiels, function ($referentiel) use ($etat) {
            return $referentiel['statut'] === $etat;
        });
    }

    public function getArchived()
    {
        return ReferentielFirebaseFacade::getByEtat('Archiver');
    }
}
