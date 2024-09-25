<?php
namespace App\Repository\Interface;

interface PromotionRepositoryInterface
{
    public function create(array $promotionData);
    public function getAllPromotions();
    public function find(string $id);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function getActivePromotion();
    public function deactivateOtherPromotions();
    public function findReferentielById(string $id);
    public function getCompetencesByReferentiel(string $referentielId);
    public function getModulesByReferentiel(string $referentielId);
    public function getAllStatut(string $statut);
    public function softDelete(string $id);
    public function getArchived();
    public function uploadImageToStorage($filePath, $fileName);
}
