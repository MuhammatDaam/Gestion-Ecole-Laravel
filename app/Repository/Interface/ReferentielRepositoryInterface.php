<?php

namespace App\Repository\Interface;

interface ReferentielRepositoryInterface
{
    public function create(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function getAll();
    public function getByLibelle(string $libelle);
    public function getByCode(string $code);
    public function getByEtat(string $etat);
    public function getById(string $id);
    public function getArchived();
}
