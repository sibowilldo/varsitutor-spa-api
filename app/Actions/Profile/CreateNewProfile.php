<?php

namespace App\Actions\Profile;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateNewProfile
{
    use AsAction;

    public function handle(User $user, array $details): void
    {
        $user->profile()->create($details);
    }
}
