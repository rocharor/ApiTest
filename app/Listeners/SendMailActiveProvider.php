<?php

namespace App\Listeners;

use App\Events\NewProvider;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NewProviderMail;
use Illuminate\Support\Facades\Mail;

class SendMailActiveProvider
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewProvider  $event
     * @return void
     */
    public function handle(NewProvider $event)
    {
        Mail::send(new NewProviderMail($event->providerEntity));
    }
}
