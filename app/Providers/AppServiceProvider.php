<?php

namespace App\Providers;

use App\Models\Evidence;
use App\Models\Post;
use App\Models\User;
use App\Observers\EvidenceObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\PostObserver;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Post::observe(PostObserver::class);
        Evidence::observe(EvidenceObserver::class);

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::after(function ($user, $ability) {
            return $user->hasRole('Super Administrador') ? true : null;
        });

        // Gate::define('authorPost', function ($user, $post) {
        //     return $user->id === $post->user_id;
        // });
        // Gate::define('authorEvidence', function (User $user, Evidence  $evidencia) {
        //     return $user->hotel->idHotel === $evidencia->id_hotel;
        // });
    }
}
