<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...
            if (Auth::user()->role == 'admin') {
                $event->menu->add([
                    'text' => 'Главная',
                    'url' => 'admin',
                ]);
                $event->menu->add([
                    'text' => 'Локация',
                    'url' => 'admin/location',
                ]);
                $event->menu->add([
                    'text' => 'Пользователи',
                    'url' => 'admin/users',
                ]);
            }else {
                $event->menu->add([
                    'text' => 'Главная',
                    'url' => 'user',
                ]);
            }

        });
    }
}
