<?php

namespace Cybersquid\Forum\Policies;

use App\User;
use Cybersquid\Forum\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Category $item)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Category $item)
    {
        return true;
    }

    public function delete(User $user, Category $item)
    {
        return false;
    }

    public function restore(User $user, Category $item)
    {
        return false;
    }

    public function forceDelete(User $user, Category $item)
    {
        return false;
    }
}
