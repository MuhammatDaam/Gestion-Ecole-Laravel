<?php

namespace App\Http\Controllers;

use App\Facades\FirebaseFacade;
use Illuminate\Http\Request;
use Firebase;

class FirebaseController extends Controller
{
    // Endpoint pour récupérer des données Firebase
    public function getData()
    {
        $database = FirebaseFacade::getDatabase();
        $reference = $database->getReference('/');
        $data = $reference->getValue();
        return response()->json(['data' => $data], 200);
    }

    // Endpoint pour poster des données dans Firebase
    public function postData(Request $request)
    {
        $database = FirebaseFacade::getDatabase();
        $newData = $request->all();
        
        $reference = $database->getReference('/')
                              ->push($newData);

        return response()->json(['message' => 'Data saved successfully'], 201);
    }
}
