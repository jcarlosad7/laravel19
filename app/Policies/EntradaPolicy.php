<?php

namespace App\Policies;

use App\Models\Entrada;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntradaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any entradas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the entrada.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Entrada  $entrada
     * @return mixed
     */
    public function view(User $user, Entrada $entrada)
    {
        //
    }

    /**
     * Determine whether the user can create entradas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the entrada.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Entrada  $entrada
     * @return mixed
     */
    public function update(User $user, Entrada $entrada)
    {
        return $user->id==$entrada->user_id;
    }

    /**
     * Determine whether the user can delete the entrada.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Entrada  $entrada
     * @return mixed
     */
    public function delete(User $user, Entrada $entrada)
    {
        return $user->id==$entrada->user_id;
    }

    /**
     * Determine whether the user can restore the entrada.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Entrada  $entrada
     * @return mixed
     */
    public function restore(User $user, Entrada $entrada)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the entrada.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Entrada  $entrada
     * @return mixed
     */
    public function forceDelete(User $user, Entrada $entrada)
    {
        //
    }
}
