<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Blade::directive('money', function ($expression) {
            $params = explode(',', $expression, 2);
            $params[1] = intval($params[1] ?? 0);

            return sprintf('<?php echo number_format(%s, %s, \'.\', \'&nbsp;\'); ?>&nbsp;₽', ...$params);
        });
    }
}
