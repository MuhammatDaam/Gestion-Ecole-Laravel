<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAuthEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $password;
    protected $nom;
    protected $prenom;
    protected $qrCodeService;
    protected $pdfService;

    public function __construct($email, $password, $nom, $prenom, $qrCodeService, $pdfService)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->qrCodeService = $qrCodeService;
        $this->pdfService = $pdfService;
    }

    public function handle()
    {
        // Logique pour envoyer l'email d'authentification
        Mail::send('emails.auth', [
            'email' => $this->email,
            'password' => $this->password,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'qrCode' => $this->qrCodeService->generateQrCode($this->email),
            'pdf' => $this->pdfService->generatePdf($this->email),
        ], function ($message) {
            $message->to($this->email)->subject('Votre compte a été créé');
        });
    }
}
