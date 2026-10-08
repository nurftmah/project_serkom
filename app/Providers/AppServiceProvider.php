<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Profil;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $profil = Profil::first();

        View::share('profil', $profil);
        View::share('profils', $profil);
        View::share('profilSidebar', $profil);
    }
}