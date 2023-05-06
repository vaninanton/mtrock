<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Category;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        setlocale(LC_TIME, 'Russian');

        Model::preventLazyLoading();
        Model::preventAccessingMissingAttributes();
        Paginator::useTailwind();

        Blade::directive('money', function ($expression) {
            $params = explode(',', $expression, 2);
            $params[1] = intval($params[1] ?? 0);

            return sprintf('<?php echo number_format(%s, %s, \'.\', \'&nbsp;\'); ?>&nbsp;₽', ...$params);
        });

        Route::bind('category_path', function ($path) {
            $slugs = explode('/', $path);
            $categories = Category::whereIn('slug', $slugs)->get()->keyBy('slug');
            $parent = null;
            foreach ($slugs as $slug) {
                $category = $categories->get($slug);
                if (!$category) {
                    throw (new ModelNotFoundException())->setModel(Category::class);
                }
                if ($parent && $category->parent_id != $parent->getKey()) {
                    abort(404);
                }
                $parent = $category;
            }

            return $category;
        });

        // Filament::serving(function () {
        //     Filament::registerNavigationGroups([
        //         NavigationGroup::make()
        //             ->label('Клиенты')
        //             ->icon('heroicon-s-users')
        //             ->collapsed(),
        //         NavigationGroup::make()
        //             ->label('Магазин')
        //             ->icon('heroicon-s-shopping-cart'),
        //     ]);
        // });
    }
}
