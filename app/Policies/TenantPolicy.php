<?php

namespace App\Policies;

use App\User;
use App\Tenant;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tenants.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('read tenants');
    }

    /**
     * Determine whether the user can view the tenant.
     *
     * @param \App\User   $user
     * @param \App\Tenant $tenant
     *
     * @return mixed
     */
    public function view(User $user, Tenant $tenant)
    {
        return $user->can('read tenants');
    }

    /**
     * Determine whether the user can create tenants.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create tenants');
    }

    /**
     * Determine whether the user can update the tenant.
     *
     * @param \App\User   $user
     * @param \App\Tenant $tenant
     *
     * @return mixed
     */
    public function update(User $user, Tenant $tenant)
    {
        return $user->hasRole('super') || $user->can('update tenants') && $user->tenant_id === $tenant->id;
    }

    /**
     * Determine whether the user can delete the tenant.
     *
     * @param \App\User   $user
     * @param \App\Tenant $tenant
     *
     * @return mixed
     */
    public function delete(User $user, Tenant $tenant)
    {
        //return $user->tenant_id === $tenant->id;
        return $user->can('delete tenants');
    }

    /**
     * Determine whether the user can restore the tenant.
     *
     * @param \App\User   $user
     * @param \App\Tenant $tenant
     *
     * @return mixed
     */
    public function restore(User $user, Tenant $tenant)
    {
        return $user->can('delete tenants');
    }

    /**
     * Determine whether the user can permanently delete the tenant.
     *
     * @param \App\User   $user
     * @param \App\Tenant $tenant
     *
     * @return mixed
     */
    public function forceDelete(User $user, Tenant $tenant)
    {
        return $user->can('delete tenants');
    }
}
