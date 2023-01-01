<?php

namespace App\Providers;

use App\Http\ViewComposers\RecentlyViewedProductsViewComposer;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
        Model::preventLazyLoading();

        Blade::directive('money', function ($expression) {
            $params = explode(',', $expression, 2);
            $params[1] = intval($params[1] ?? 0);

            return sprintf('<?php echo number_format(%s, %s, \'.\', \'&nbsp;\'); ?>&nbsp;₽', ...$params);
        });

        View::composer('product', RecentlyViewedProductsViewComposer::class);

        Route::bind('category_path', function ($path) {
            $slugs = explode('/', $path);
            $categories = Category::whereIn('slug', $slugs)->get()->keyBy('slug');
            $parent = null;
            foreach ($slugs as $slug) {
                $category = $categories->get($slug);
                if (! $category) {
                    throw (new ModelNotFoundException())->setModel(Category::class);
                }
                if ($parent && $category->parent_id != $parent->getKey()) {
                    abort(404);
                }
                $parent = $category;
            }

            return $category;
        });
    }
}
