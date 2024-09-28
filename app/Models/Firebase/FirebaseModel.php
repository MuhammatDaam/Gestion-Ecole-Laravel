<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Model;
use App\Facades\FirebaseFacade;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;
use Kreait\Firebase\Auth;

class FirebaseModel 
{
    protected $database;
    protected $auth;
    protected $storage;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(env('FIREBASE_CREDENTIALS'))
            ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));

        $this->database = $factory->createDatabase();
        $this->auth = $factory->createAuth();
        $this->storage = $factory->createStorage();
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function create($path, $data)
    {
        try {
            $reference = $this->database->getReference($path);
            $key = $reference->push()->getKey();
            $reference->getChild($key)->set($data);
            return $key;
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création dans Firebase : ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function find($path, $id)
    {
        try {
            $reference = $this->database->getReference($path . '/' . $id);
            return $reference->getValue();
        } catch (\Exception $e) {
            Log::error('Erreur lors de la recherche dans Firebase : ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // public function update($path, $id, $data)
    // {
    //     try {
    //         $reference = $this->database->getReference($path . '/' . $id);
    //         $reference->update($data);
    //         return response()->json(['success' => 'Mise à jour réussie']);
    //     } catch (\Exception $e) {
    //         Log::error('Erreur lors de la mise à jour dans Firebase : ' . $e->getMessage());
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function update($path, $id, $data)
    {
        // Log avant d'envoyer à Firebase
        Log::info('Données envoyées à Firebase pour mise à jour', ['path' => $path, 'id' => $id, 'data' => $data]);
    
        try {
            // Vérifier que les données ne sont pas vides avant la mise à jour
            if (empty($data)) {
                throw new \Exception('Les données doivent être un tableau non vide.');
            }
    
            $reference = $this->database->getReference($path . '/' . $id);
            $reference->update($data);
    
            return response()->json(['success' => 'Mise à jour réussie']);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour dans Firebase : ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function delete($path, $id)
    {
        try {
            $reference = $this->database->getReference($path . '/' . $id);
            $reference->remove();
            return response()->json(['success' => 'Suppression réussie']);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression dans Firebase : ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAll($path)
    {
        try {
            $reference = $this->database->getReference($path);
            $data = $reference->getValue();
            return $data ? $data : [];
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des données : ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function findUserByEmail(string $email)
    {
        $users = $this->getAll('users');
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }

    public function findUserByPhone(string $telephone)
    {
        $users = $this->getAll('users');
        foreach ($users as $user) {
            if (isset($user['telephone']) && $user['telephone'] === $telephone) {
                return $user;
            }
        }
        return null;
    }

    public function createUserWithEmailAndPassword($email, $password)
    {
        try {
            $user = $this->auth->createUser(['email' => $email, 'password' => $password]);
            return $user->uid;
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'utilisateur Firebase : ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la création de l\'utilisateur dans Firebase'], 500);
        }
    }

    public function uploadImageToStorage($filePath, $fileName)
    {
        try {
            $bucket = $this->storage->getBucket();
            $file = fopen($filePath, 'r');
            $bucket->upload($file, ['name' => $fileName]);
            $object = $bucket->object($fileName);
            $url = $object->signedUrl(new \DateTime('tomorrow'));
            Log::info('Image téléchargée avec succès sur Firebase Storage : ' . $url);
            return $url;
        } catch (\Exception $e) {
            Log::error('Erreur lors du téléchargement de l\'image dans Firebase Storage : ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
