<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReferentielController;
use App\Http\Controllers\UserFirebaseController;


// Route::middleware('auth:api')->group(function () {


Route::prefix('v1/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('v1')->group(function () {
    Route::post('/users', [UserFirebaseController::class, 'create']);
    Route::get('/users', [UserFirebaseController::class, 'getAllUsers']);
    Route::patch('/users/{id}', [UserFirebaseController::class, 'updateUser']);
    Route::delete('/users/{id}', [UserFirebaseController::class, 'deleteUser']);
    Route::get('/users/{id}', [UserFirebaseController::class, 'findUser']);
    Route::get('/users/email/{email}', [UserFirebaseController::class, 'findUserByEmail']);
    Route::get('/users/libelle/{libelle}', [UserFirebaseController::class, 'findUserByLibelle']);
    Route::get('/users/role/{role}', [UserFirebaseController::class, 'getUsersByRole']);
    Route::post('/users/email-password', [UserFirebaseController::class, 'createUserWithEmailAndPassword']);
    Route::post('/users/upload-image', [UserFirebaseController::class, 'uploadImageToStorage']);
});

// });

// // Ajouter la ligne de code suivante à la définition des routes dans le fichier routes/api.php
// Route::prefix('v1')->group(function () {
//     Route::post('/users', [UserFirebaseController::class, 'create'])->middleware('role:admin');
//     Route::get('/users', [UserFirebaseController::class, 'getAllUsers'])->middleware('role:admin,manager');
//     Route::patch('/users/{id}', [UserFirebaseController::class, 'updateUser'])->middleware('role:admin');
// });


Route::prefix('v1')->middleware('auth:api')->group(function () {
    
    // Routes pour les Référentiels
    Route::prefix('referentiels')->group(function () {
        // Créer un référentiel avec ses compétences et modules
        Route::post('/', [ReferentielController::class, 'create']);
        
        // Obtenir tous les référentiels
        Route::get('/', [ReferentielController::class, 'index']);
        
        // Obtenir un référentiel par son ID avec ses compétences et modules
        Route::get('/{id}', [ReferentielController::class, 'show']);
        
        // Mettre à jour un référentiel et gérer les compétences et modules
        Route::patch('/{id}', [ReferentielController::class, 'update']);
        
        // Supprimer un référentiel (suppression logique)
        Route::delete('/{id}', [ReferentielController::class, 'delete']);
        
        // Lister les référentiels archivés (supprimés logiquement)
        Route::get('/archive', [ReferentielController::class, 'archived']);
    });

    // Routes pour les Promotions
    Route::prefix('promotions')->group(function () {
        // Créer une promotion
        Route::post('/', [PromotionController::class, 'create']);
        
        // Récupérer toutes les promotions
        Route::get('/', [PromotionController::class, 'getAllPromotions']);
        
        // Trouver une promotion par ID
        Route::get('/{id}', [PromotionController::class, 'find']);
        
        // Mettre à jour une promotion
        Route::put('/{id}', [PromotionController::class, 'update']);
        
        // Supprimer une promotion
        Route::delete('/{id}', [PromotionController::class, 'delete']);
        
        // Récupérer la promotion active
        Route::get('/active', [PromotionController::class, 'getActivePromotion']);
        
        // Désactiver les autres promotions
        Route::put('/deactivate-others', [PromotionController::class, 'deactivateOtherPromotions']);
        
        // Récupérer les promotions selon le statut
        Route::get('/status/{statut}', [PromotionController::class, 'getAllStatut']);
        
        // Archiver une promotion (suppression logique)
        Route::patch('/{id}/archive', [PromotionController::class, 'softDelete']);
        
        // Récupérer les promotions archivées
        Route::get('/archived', [PromotionController::class, 'getArchived']);
        
        // Télécharger une image pour une promotion
        Route::post('/upload-image', [PromotionController::class, 'uploadImageToStorage']);
        
        // Routes liées aux référentiels dans le contexte des promotions
        Route::prefix('referentiel')->group(function () {
            // Trouver un référentiel par ID
            Route::get('/{id}', [PromotionController::class, 'findReferentielById']);
            
            // Récupérer les compétences d'un référentiel
            Route::get('/{id}/competences', [PromotionController::class, 'getCompetencesByReferentiel']);
            
            // Récupérer les modules d'un référentiel
            Route::get('/{id}/modules', [PromotionController::class, 'getModulesByReferentiel']);
        });
    });
});


// Route::prefix('v1')->group(function () {
//     // Créer un référentiel avec ses compétences et modules
//     Route::post('referentiels', [ReferentielController::class, 'create']); // Adapter vers 'create'

//     // Obtenir tous les référentiels
//     Route::get('referentiels', [ReferentielController::class, 'index']); // OK

//     // Obtenir un référentiel par son ID avec ses compétences et modules
//     Route::get('referentiels/{id}', [ReferentielController::class, 'show']); // OK

//     // Mettre à jour un référentiel et gérer les compétences et modules
//     Route::patch('referentiels/{id}', [ReferentielController::class, 'update']); // OK

//     // Supprimer un référentiel (soft delete)
//     Route::delete('referentiels/{id}', [ReferentielController::class, 'delete']); // Adapter vers 'delete'

//     // Lister les référentiels archivés (soft deleted)
//     Route::get('archive/referentiels', [ReferentielController::class, 'archived']); // OK
// });


// Route::prefix('v1/promotions')->group(function () {
//     Route::post('/', [PromotionController::class, 'create']); // Créer une promotion
//     Route::get('/', [PromotionController::class, 'getAllPromotions']); // Récupérer toutes les promotions
//     Route::get('/{id}', [PromotionController::class, 'find']); // Trouver une promotion par ID
//     Route::put('/{id}', [PromotionController::class, 'update']); // Mettre à jour une promotion
//     Route::delete('/{id}', [PromotionController::class, 'delete']); // Supprimer une promotion
//     Route::get('/active', [PromotionController::class, 'getActivePromotion']); // Récupérer la promotion active
//     Route::put('/deactivate-others', [PromotionController::class, 'deactivateOtherPromotions']); // Désactiver les autres promotions
//     Route::get('/referentiel/{id}', [PromotionController::class, 'findReferentielById']); // Trouver un référentiel par ID
//     Route::get('/referentiel/{id}/competences', [PromotionController::class, 'getCompetencesByReferentiel']); // Récupérer les compétences d'un référentiel
//     Route::get('/referentiel/{id}/modules', [PromotionController::class, 'getModulesByReferentiel']); // Récupérer les modules d'un référentiel
//     Route::get('/status/{statut}', [PromotionController::class, 'getAllStatut']); // Récupérer les promotions selon le statut
//     Route::patch('/{id}/archive', [PromotionController::class, 'softDelete']); // Archiver une promotion (soft delete)
//     Route::get('/archived', [PromotionController::class, 'getArchived']); // Récupérer les promotions archivées
//     Route::post('/upload-image', [PromotionController::class, 'uploadImageToStorage']); // Télécharger une image
// });






Route::get('/firebase/data', [FirebaseController::class, 'getData']);
Route::post('/firebase/data', [FirebaseController::class, 'postData']);