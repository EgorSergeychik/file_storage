<?php

namespace Domain\SharedFile\Policies;

use Domain\File\Models\File;
use Domain\SharedFile\Models\SharedFile;
use Domain\User\Models\User;

class SharedFilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, File $file): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, File $file): bool
    {

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, File $file): bool
    {

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, File $file): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, File $file): bool
    {
        //
    }

    public function unshare(User $user, SharedFile $sharedFile): bool
    {
        return $user->id === $sharedFile->user_id
            || $user->id === $sharedFile->file->user_id;
    }
}
