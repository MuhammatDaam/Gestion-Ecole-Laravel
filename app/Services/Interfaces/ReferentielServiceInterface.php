<?php

namespace App\Services\Interfaces;

interface ReferentielServiceInterface
{
    public function createReferentiel(array $data);
    public function updateReferentiel(string $id, array $data);
    public function deleteReferentiel(string $id);
    public function getAllReferentiel();
    public function getReferentielByLibelle(string $libelle);
    public function getReferentielByCode(string $code);
    public function getReferentielByEtat(string $etat);
    public function getReferentielById(string $id);
    public function getArchivedReferentiels();
}
