<?php

namespace Cybersquid\Forum\Policies;

use \Cybersquid\Forum\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user, User $item)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, User $item)
    {
        return true;
    }

    public function delete(User $user, User $item)
    {
        return false;
    }

    public function restore(User $user, User $item)
    {
        return false;
    }

    public function forceDelete(User $user, User $item)
    {
        return false;
    }
}
