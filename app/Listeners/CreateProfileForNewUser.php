<?php

namespace App\Listeners;

use App\Actions\Profile\CreateNewProfile;
use App\Events\UserRegisteredEvent;

class CreateProfileForNewUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredEvent $e): void
    {
        CreateNewProfile::make()->handle($e->user, [
            'given_name' => $e->data['given_name'],
            'family_name' => $e->data['family_name'],
            'name' => $e->data['given_name'].' '.$e->data['family_name'],
            'contact_number' => $e->data['contact_number'],
        ]);
    }
}
