<?php

namespace App\Models\Firebase;

class ReferentielFirebase extends FirebaseModel
{
    protected $fillable = [
        'code',
        'libelle',
        'description',
        'photo',
        'statut',
        'competences',
    ];

    protected $casts = [
        'competences' => 'array',
    ];

    public function createReferentiel(array $data)
    {
        return $this->create('referentiels', $data);
    }

    public function updateReferentiel(string $id, array $data)
    {
        return $this->update('referentiels', $id, $data);
    }

    public function deleteReferentiel(string $id)
    {
        return $this->delete('referentiels', $id);
    }

    public function getAllReferentiels()
    {
        return $this->getAll('referentiels');
    }

    public function getReferentielById(string $id)
    {
        return $this->find('referentiels', $id);
    }
}
