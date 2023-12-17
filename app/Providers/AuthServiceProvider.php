<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Domain\File\Models\File;
use Domain\File\Policies\FilePolicy;
use Domain\Folder\Models\Folder;
use Domain\Folder\Policies\FolderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Folder::class => FolderPolicy::class,
        File::class => FilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
