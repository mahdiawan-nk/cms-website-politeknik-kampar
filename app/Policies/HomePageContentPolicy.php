<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\HomePageContent;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomePageContentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:HomePageContent');
    }

    public function view(AuthUser $authUser, HomePageContent $homePageContent): bool
    {
        return $authUser->can('View:HomePageContent');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:HomePageContent');
    }

    public function update(AuthUser $authUser, HomePageContent $homePageContent): bool
    {
        return $authUser->can('Update:HomePageContent');
    }

    public function delete(AuthUser $authUser, HomePageContent $homePageContent): bool
    {
        return $authUser->can('Delete:HomePageContent');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:HomePageContent');
    }

    public function restore(AuthUser $authUser, HomePageContent $homePageContent): bool
    {
        return $authUser->can('Restore:HomePageContent');
    }

    public function forceDelete(AuthUser $authUser, HomePageContent $homePageContent): bool
    {
        return $authUser->can('ForceDelete:HomePageContent');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:HomePageContent');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:HomePageContent');
    }

    public function replicate(AuthUser $authUser, HomePageContent $homePageContent): bool
    {
        return $authUser->can('Replicate:HomePageContent');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:HomePageContent');
    }

}