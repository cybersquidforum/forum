<?php

namespace Cybersquid\Forum\Policies;

use App\User;
use Cybersquid\Forum\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Post $item)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Post $item)
    {
        return true;
    }

    public function delete(User $user, Post $item)
    {
        return false;
    }

    public function restore(User $user, Post $item)
    {
        return false;
    }

    public function forceDelete(User $user, Post $item)
    {
        return false;
    }
}
