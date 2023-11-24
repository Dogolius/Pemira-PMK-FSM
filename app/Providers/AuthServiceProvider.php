<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();
        // Gate Admin & Voter
        Gate::define('admin', function(User $user){
            return $user->is_admin == true;
        });
        Gate::define('voter', function(User $user){
            return $user->is_admin == false;
        });

        // Gate alreadyVote dan yetToVote
        Gate::define('alreadyVote', function(User $user){
            return $user->has_voted == true;
        });
        Gate::define('yetToVote', function(User $user){
            return $user->has_voted == false;
        });
    }
}
