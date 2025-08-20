<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determina si el usuario puede ver la lista de usuarios.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin === true; 
    }

    /**
     * Determina si el usuario puede ver un usuario específico.
     */
    public function view(User $user, User $model): bool
    {
        return $user->is_admin || $user->id === $model->id;
    }

    /**
     * Determina si el usuario puede actualizar un usuario.
     */
    public function update(User $user, User $model): bool
    {
        return $user->is_admin || $user->id === $model->id;
    }

    /**
     * Determina si el usuario puede eliminar un usuario.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->is_admin;
    }
}