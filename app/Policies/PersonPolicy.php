<?php

namespace App\Policies;

use App\User;
use App\Person;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any people.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
    }

    /**
     * Determine whether the user can view the person.
     *
     * @param \App\User   $user
     * @param \App\Person $person
     *
     * @return mixed
     */
    public function view(User $user, Person $person)
    {
        return ($user->hasRole('super|admin')) || ($user->can('read persons') && $user->client_id === $person->client_id) || $user->person_id === $person->id;
    }

    /**
     * Determine whether the user can create people.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->hasRole('super|admin')) || $user->can('create persons');
    }

    /**
     * Determine whether the user can update the person.
     *
     * @param \App\User   $user
     * @param \App\Person $person
     *
     * @return mixed
     */
    public function update(User $user, Person $person)
    {
        return ($user->hasRole('super|admin')) || ($user->can('update persons') && $user->client_id === $person->client_id) || $user->person_id === $person->id;
    }

    /**
     * Determine whether the user can delete the person.
     *
     * @param \App\User   $user
     * @param \App\Person $person
     *
     * @return mixed
     */
    public function delete(User $user, Person $person)
    {
        return ($user->hasRole('super|admin')) || ($user->can('delete persons') && $user->client_id === $person->client_id) || $user->person_id === $person->id;
    }

    /**
     * Determine whether the user can restore the person.
     *
     * @param \App\User   $user
     * @param \App\Person $person
     *
     * @return mixed
     */
    public function restore(User $user, Person $person)
    {
        return ($user->hasRole('super|admin')) || ($user->can('delete persons') && $user->client_id === $person->client_id) || $user->person_id === $person->id;
    }

    /**
     * Determine whether the user can permanently delete the person.
     *
     * @param \App\User   $user
     * @param \App\Person $person
     *
     * @return mixed
     */
    public function forceDelete(User $user, Person $person)
    {
        return ($user->hasRole('super|admin')) || ($user->can('delete persons') && $user->client_id === $person->client_id) || $user->person_id === $person->id;
    }
}
