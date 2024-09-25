<?php
namespace App\Services\Interfaces;

interface PromotionServiceInterface
{
    public function createPromotion(array $data);
    public function getActivePromotion();
    public function deactivateOtherPromotions();
    public function getAllPromotions();
    public function cloturer($id);
    public function getReferentielsActifs($id);
    public function getStatsPromos($id);
    public function updateEtat($newEtat, $id);
    public function addCompetenceToReferentiel(string $referentielId, array $competenceData);
    public function removeCompetenceFromReferentiel(string $referentielId, string $competenceNom);
    public function addModuleToCompetence(string $referentielId, string $competenceNom, array $moduleData);
    public function removeModuleFromCompetence(string $referentielId, string $competenceNom, string $moduleNom);
    public function getCompetencesByReferentiel(string $referentielId);
    public function getModulesByReferentiel(string $referentielId);
    public function updateReferentiel(string $id, array $data);
    public function deleteReferentiel(string $id);
    public function findReferentiel(string $id);
    public function getAllActiveReferentiels($statut);
    public function archiveReferentiel(string $id);
    public function getArchivedReferentiels();
    public function uploadImageToStorage($filePath, $fileName);
}
