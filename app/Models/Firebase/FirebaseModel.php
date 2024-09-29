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
        $pathfirebase = json_decode(base64_decode("ewogICJ0eXBlIjogInNlcnZpY2VfYWNjb3VudCIsCiAgInByb2plY3RfaWQiOiAiZ2VzdGlvbi1l
Y29sZS1sYXJhdmVsIiwKICAicHJpdmF0ZV9rZXlfaWQiOiAiMDkwYzcxMjZmYjA3OWNjOGE2Mzlk
ZDRjOGEzNTM1ZWRmYjFlYTdiNyIsCiAgInByaXZhdGVfa2V5IjogIi0tLS0tQkVHSU4gUFJJVkFU
RSBLRVktLS0tLVxuTUlJRXZnSUJBREFOQmdrcWhraUc5dzBCQVFFRkFBU0NCS2d3Z2dTa0FnRUFB
b0lCQVFDOUZ3NmNkUDgyZ1IvbVxucmNlbHZkeWdXb01sZkFsMld5ck9SU01CbU44MUl3L21oY1I2
UEpCUE9FVGhDcFZGSktsbThjYVNCMG4zVmJqdVxuaUk0d1FFTWtaQ0VKanRXR2Z5NGJDbHdxV1Fh
WEhUMDk4eXBtNGZKekVENGVWczVxanNBcHl5WDRneWtuR0dKZFxuWEgvTmNrVVhrczZETVhXdFlN
cEhUZldXTWc5bFRDY2c5MzFKRzBNZXoyb3FWVm80bTFXVWQ5UjN5ZENsTGQ3Z1xuMGlTNnpJNm5I
V3pvZlN5Lzd1Qi94MzgxSW1USzNHRzIxVTg5L3Y4VHd2bFBnNHhySnBDemtHTFFta0F6alVDWFxu
SURBNGw3UlhMU1kzNUJmWTN2bmUwTUczeGxuQW5kVm41cmpENW51aS83RmppL1RqM1FYdGZFOUZz
TWp3L1hoMVxuRy9UVytzeURBZ01CQUFFQ2dnRUFId1BRcURZQ2hIQ2lpR1k1cUlSZlUwZjFXZWto
N2pGZThJMWpoQWdNbUgwalxuUndicTVyZlhYYjhYZ1NnSXV0b2NGU0FVRjNDdG42MkdVMDIvc01k
aG0rNzJna2hVMnFZeXJFbkRPMGoxN1VSa1xuL3F2TGFTdW5abHNrTFRyRXliS1hiMk44VzJvOERr
Y1FIMHNrUlZENFp6anp1WTRieEsvckRjNEtPYlFGVlhKalxuSVM4eTFqWjdOZFVxVmVjcDdlb254
Y3hDU2xZdnpIWGVSUUhocHNyVURnanhEaFlzVVhTNWk0aGpuQ0NVblNvS1xuNjlzTDJDQkVGZndm
ZjQ3MUsvb2FucU95djlpL2dSbkdKd1A0WlN1V2pvODIwSlEwblNiVFlrUWo0MEVtRTdwaVxuUHFt
YTNvRnphVkFzZlArc205bDE1YXN4L0RMZmt2cG5yM2pGNHNBR2VRS0JnUUQxTEx0U2c2OUVtTHNF
bzVBZ1xuY1pDWHVFaWVNUG5ZcGgxallycGh1cmZndkZLZjkxTkhieldrRTFqQkpSOTBqRzN5NU5a
MG51ZDFpLytoMU81YVxucjh0YjFxSEFBT2Y5TkZpVEFTWmhON1E0VkNPWnNkSmU4ZzN0SDROb0VX
c0IxUjk2UTVVWmcyM25idm5yclM3UlxuNXZpOERNTU00WWVUcm9mUURQYllNNU8xYXdLQmdRREZj
R01VaytFQzZQK2RLekNLVklCY0diS3VVM2g3RzA0WlxuTDl0VHhKZGJNdVJ5ZmVTeEE2NUxBUkJm
TWVKRk5jNTlLTTFjaldVTTJqM1Z1dVY3TSsvdzc4ay92VlhCY2xJMlxuOGJodExnUy9wN0FzaXNL
angvUW5BRTRHZDJGM3laSG9xV215eHczZ3BLMTdrbXhLMm94OURhWUpjN1FqZkRZc1xueGh1NFlG
ZHpTUUtCZ0hWWUpvUDB3UU5jOGszakZ3MWdMV3RnYVdsRldaK215ZlFTZ2RCYXRMMWNoVk5JNWRR
UFxuMXlXam1OeEFyMUJ5RWdHcUl6YUlBNUlRSXBiTE9oV3ZnKzU5eU1jRDZBVVpjN2RRV3BVM093
dW13YTlERzhRVFxucURTdzI0MElvU1dzWXJkNjl6YlIzOTFnRVVBS2tKa29LaTZmRVEvdU5aeXFj
UmhUekNWb2NpN25Bb0dCQU1JQ1xudU9uTWttdjRwczA3Vm54bm9xWmQvaTI5Q2dQMmhkek1JUHFF
a0xKbUpRTzRYOVB0cVFRODdHaU9yU2lUUWUvTVxuKzFkNS9aVU9rM3FGSitEVDNYQmxQOTJwWUM0
eDkwWFVhd1NtRnJaNXdlMVRBUVpOZ3NZY1Q0K2RHYUxLNk55MlxuTkk0ZmVheUlSWXpMQ2l6WDZ2
c3JRVC9DZVgzeEhZOExzTXVScC8wNUFvR0JBSy9ZcVB0ckQ2QS9PczVxOXJQYlxub0U4OHc2aUVC
SEhKM2Y4N1FVS0NUYkg1ZXZsZ0pHa3FRRWtvNEwzL0R1NVRCdXhCRzJQV3k2RVk5am95QXpYQ1xu
ZjNrMnYxTmNhLzJNdEFUSlBiWmJ5b1JDc1FkK2NPVUU3UHhHa1JVdno0emxxUGlzZU9Ea0pBMjlQ
REhXekRNN1xuMjNjZ1lqdkY0bGgxMmdZSFJCaDZsRndrXG4tLS0tLUVORCBQUklWQVRFIEtFWS0t
LS0tXG4iLAogICJjbGllbnRfZW1haWwiOiAiZmlyZWJhc2UtYWRtaW5zZGstMXluaWRAZ2VzdGlv
bi1lY29sZS1sYXJhdmVsLmlhbS5nc2VydmljZWFjY291bnQuY29tIiwKICAiY2xpZW50X2lkIjog
IjEwNzMzNjUyNDExOTE4MjE1MDc4NCIsCiAgImF1dGhfdXJpIjogImh0dHBzOi8vYWNjb3VudHMu
Z29vZ2xlLmNvbS9vL29hdXRoMi9hdXRoIiwKICAidG9rZW5fdXJpIjogImh0dHBzOi8vb2F1dGgy
Lmdvb2dsZWFwaXMuY29tL3Rva2VuIiwKICAiYXV0aF9wcm92aWRlcl94NTA5X2NlcnRfdXJsIjog
Imh0dHBzOi8vd3d3Lmdvb2dsZWFwaXMuY29tL29hdXRoMi92MS9jZXJ0cyIsCiAgImNsaWVudF94
NTA5X2NlcnRfdXJsIjogImh0dHBzOi8vd3d3Lmdvb2dsZWFwaXMuY29tL3JvYm90L3YxL21ldGFk
YXRhL3g1MDkvZmlyZWJhc2UtYWRtaW5zZGstMXluaWQlNDBnZXN0aW9uLWVjb2xlLWxhcmF2ZWwu
aWFtLmdzZXJ2aWNlYWNjb3VudC5jb20iLAogICJ1bml2ZXJzZV9kb21haW4iOiAiZ29vZ2xlYXBp
cy5jb20iCn0K"), true);
        $factory = (new Factory)
            ->withServiceAccount($pathfirebase)
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
