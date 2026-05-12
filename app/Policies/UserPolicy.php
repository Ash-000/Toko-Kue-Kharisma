<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Hanya admin yang bisa melihat list user
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Hanya admin yang bisa melihat detail user
     */
    public function view(User $user, User $model): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Hanya admin yang bisa membuat user baru
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Hanya admin yang bisa edit user
     * Admin tidak bisa edit sesama admin (hanya bisa edit role 'user')
     */
    public function update(User $user, User $model): bool
    {
        return $user->role === 'admin' && $model->role !== 'admin';
    }

    /**
     * Hanya admin yang bisa hapus user biasa
     */
    public function delete(User $user, User $model): bool
    {
        return $user->role === 'admin' && $model->role !== 'admin';
    }
}
