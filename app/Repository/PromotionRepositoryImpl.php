<?php

namespace App\Repository;

use App\Facades\PromotionFirebaseFacade; // Importation de la façade
use App\Repository\Interface\PromotionRepositoryInterface;

class PromotionRepositoryImpl implements PromotionRepositoryInterface
{
    /**
     * Crée une promotion avec les données fournies.
     *
     * @param array $promotionData
     * @return mixed
     */
    public function create(array $promotionData)
    {
        return PromotionFirebaseFacade::createPromotion($promotionData);
    }

    /**
     * Récupère toutes les promotions.
     *
     * @return mixed
     */
    public function getAllPromotions()
    {
        return PromotionFirebaseFacade::getAllPromotions();
    }

    /**
     * Trouve une promotion par son identifiant.
     *
     * @param string $id
     * @return mixed
     */
    public function find(string $id)
    {
        return PromotionFirebaseFacade::findReferentiel($id);
    }

    /**
     * Met à jour une promotion avec les données fournies.
     *
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function update(string $id, array $data)
    {
        return PromotionFirebaseFacade::updateReferentiel($id, $data);
    }

    /**
     * Supprime une promotion par son identifiant.
     *
     * @param string $id
     * @return mixed
     */
    public function delete(string $id)
    {
        return PromotionFirebaseFacade::deleteReferentiel($id);
    }

    /**
     * Récupère la promotion active.
     *
     * @return mixed
     */
    public function getActivePromotion()
    {
        return PromotionFirebaseFacade::getActivePromotion();
    }

    /**
     * Désactive toutes les autres promotions sauf l'actuelle.
     *
     * @return mixed
     */
    public function deactivateOtherPromotions()
    {
        return PromotionFirebaseFacade::deactivateOtherPromotions();
    }

    /**
     * Trouve un référentiel par son identifiant.
     *
     * @param string $id
     * @return mixed
     */
    public function findReferentielById(string $id)
    {
        return PromotionFirebaseFacade::findReferentiel($id);
    }

    /**
     * Récupère les compétences associées à un référentiel.
     *
     * @param string $referentielId
     * @return mixed
     */
    public function getCompetencesByReferentiel(string $referentielId)
    {
        return PromotionFirebaseFacade::getCompetencesByReferentiel($referentielId);
    }

    /**
     * Récupère les modules associés à un référentiel.
     *
     * @param string $referentielId
     * @return mixed
     */
    public function getModulesByReferentiel(string $referentielId)
    {
        return PromotionFirebaseFacade::getModulesByReferentiel($referentielId);
    }

    /**
     * Récupère toutes les promotions en fonction de leur statut.
     *
     * @param string $statut
     * @return mixed
     */
    public function getAllStatut(string $statut)
    {
        return PromotionFirebaseFacade::getAllActiveReferentiels($statut);
    }

    /**
     * Effectue une suppression logique (soft delete) d'une promotion.
     *
     * @param string $id
     * @return mixed
     */
    public function softDelete(string $id)
    {
        return PromotionFirebaseFacade::archiveReferentiel($id);
    }

    /**
     * Récupère tous les référentiels archivés.
     *
     * @return mixed
     */
    public function getArchived()
    {
        return PromotionFirebaseFacade::getArchivedReferentiels();
    }

    /**
     * Télécharge une image vers le stockage.
     *
     * @param string $filePath
     * @param string $fileName
     * @return mixed
     */
    public function uploadImageToStorage($filePath, $fileName)
    {
        return PromotionFirebaseFacade::uploadImageToStorage($filePath, $fileName);
    }
}
