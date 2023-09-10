<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;
use Carbon\Carbon;

class CarbonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Carbon::setLocale('id');
        Blade::directive('carbon', function ($expression) {
            return "<?php echo Carbon\Carbon::parse($expression)->format('d F Y'); ?>";
        });
    }

    public function register()
    {
        //
    }
}
