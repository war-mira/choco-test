<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeExtensionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->defineFormatPhone();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function defineFormatPhone()
    {
        Blade::directive('formatPhone', function ($expression) {

            return "<?php echo \App\Helpers\FormatHelper::phone($expression); ?>";
        });
    }
}
