<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        Blade::directive('convert', function ($money) {
            if ($money == null || $money == 0) {
                return "Rp -";
            }

            return "Rp " . "<?php echo number_format($money, 0, ',', '.'); ?>";
        });
    }
}
