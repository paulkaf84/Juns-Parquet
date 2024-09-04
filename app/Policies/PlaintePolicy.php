<?php

namespace App\Policies;

use App\Models\User;

class PlaintePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isChefOffice() || $user->isSecretaire();
    }
    public function create(User $user): bool
    {
        return $user->isSecretaire();
    }
}
