<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Achivement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AchivementPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Achivement');
    }

    public function view(AuthUser $authUser, Achivement $achivement): bool
    {
        return $authUser->can('View:Achivement');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Achivement');
    }

    public function update(AuthUser $authUser, Achivement $achivement): bool
    {
        return $authUser->can('Update:Achivement');
    }

    public function delete(AuthUser $authUser, Achivement $achivement): bool
    {
        return $authUser->can('Delete:Achivement');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Achivement');
    }

    public function restore(AuthUser $authUser, Achivement $achivement): bool
    {
        return $authUser->can('Restore:Achivement');
    }

    public function forceDelete(AuthUser $authUser, Achivement $achivement): bool
    {
        return $authUser->can('ForceDelete:Achivement');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Achivement');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Achivement');
    }

    public function replicate(AuthUser $authUser, Achivement $achivement): bool
    {
        return $authUser->can('Replicate:Achivement');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Achivement');
    }

}