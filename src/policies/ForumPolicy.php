<?php

namespace Cybersquid\Forum\Policies;

use App\User;
use Cybersquid\Forum\Models\Forum;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Forum $item)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Forum $item)
    {
        return true;
    }

    public function delete(User $user, Forum $item)
    {
        return false;
    }

    public function restore(User $user, Forum $item)
    {
        return false;
    }

    public function forceDelete(User $user, Forum $item)
    {
        return false;
    }
}
