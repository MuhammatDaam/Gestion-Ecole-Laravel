<?php
namespace App\Http\Controllers;

use App\Services\Interfaces\PromotionServiceInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    protected $promotionService;

    public function __construct(PromotionServiceInterface $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    public function createPromotion(Request $request)
    {
        return $this->promotionService->createPromotion($request->all());
    }

    public function getActivePromotion()
    {
        return $this->promotionService->getActivePromotion();
    }

    public function deactivatePromotions()
    {
        return $this->promotionService->deactivateOtherPromotions();
    }

    public function getAllPromotions()
    {
        return $this->promotionService->getAllPromotions();
    }

    public function cloturer($id)
    {
        return $this->promotionService->cloturer($id);
    }

    public function getReferentielsActifs($id)
    {
        return $this->promotionService->getReferentielsActifs($id);
    }

    public function getStatsPromos($id)
    {
        return $this->promotionService->getStatsPromos($id);
    }

    public function updateEtat(Request $request, $id)
    {
        return $this->promotionService->updateEtat($request->input('etat'), $id);
    }

    public function addCompetenceToReferentiel($referentielId, Request $request)
    {
        return $this->promotionService->addCompetenceToReferentiel($referentielId, $request->all());
    }

    public function removeCompetenceFromReferentiel($referentielId, $competenceNom)
    {
        return $this->promotionService->removeCompetenceFromReferentiel($referentielId, $competenceNom);
    }

    public function addModuleToCompetence($referentielId, $competenceNom, Request $request)
    {
        return $this->promotionService->addModuleToCompetence($referentielId, $competenceNom, $request->all());
    }

    public function removeModuleFromCompetence($referentielId, $competenceNom, $moduleNom)
    {
        return $this->promotionService->removeModuleFromCompetence($referentielId, $competenceNom, $moduleNom);
    }

    public function getCompetencesByReferentiel($referentielId)
    {
        return $this->promotionService->getCompetencesByReferentiel($referentielId);
    }

    public function getModulesByReferentiel($referentielId)
    {
        return $this->promotionService->getModulesByReferentiel($referentielId);
    }

    public function updateReferentiel($id, Request $request)
    {
        return $this->promotionService->updateReferentiel($id, $request->all());
    }

    public function deleteReferentiel($id)
    {
        return $this->promotionService->deleteReferentiel($id);
    }

    public function findReferentiel($id)
    {
        return $this->promotionService->findReferentiel($id);
    }

    public function getAllActiveReferentiels($statut)
    {
        return $this->promotionService->getAllActiveReferentiels($statut);
    }

    public function archiveReferentiel($id)
    {
        return $this->promotionService->archiveReferentiel($id);
    }

    public function getArchivedReferentiels()
    {
        return $this->promotionService->getArchivedReferentiels();
    }

    public function uploadImageToStorage(Request $request)
    {
        return $this->promotionService->uploadImageToStorage($request->file('file_path'), $request->input('file_name'));
    }
}
