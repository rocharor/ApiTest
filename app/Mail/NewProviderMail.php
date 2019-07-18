<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Data\Entities\ProviderEntity;
use App\Data\Utils\CryptCustom;

class NewProviderMail extends Mailable
{
    use Queueable, SerializesModels;

    private $providerEntity;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ProviderEntity $providerEntity)
    {
        $this->providerEntity = $providerEntity;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->providerEntity->getEmail())
            ->subject('E-mail de validação')
            ->view('email.mailActiveProvider')
            ->with([
                'name' => $this->providerEntity->getName(),
                'token' => CryptCustom::cryptCustom($this->providerEntity->getId())
            ]);
    }
}
