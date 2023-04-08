<?php

declare(strict_types=1);

namespace App\Support\IdeHelper;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Illuminate\Database\Eloquent\Model;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;

class ModelHooks implements \Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface
{
    /** Use reflection to find LaravelAttributes on class methods, then apply properties with IDE Helper. */
    public function run(ModelsCommand $command, Model $model): void
    {
        collect(
            (new ReflectionClass($model::class))->getMethods(ReflectionMethod::IS_PROTECTED)
        )->mapWithKeys(fn (ReflectionMethod $method) => [
            $method->getName() => collect($method->getAttributes(
                LaravelAttribute::class,
                ReflectionAttribute::IS_INSTANCEOF
            ))->transform(fn (ReflectionAttribute $attribute) => $attribute->newInstance())->first(),
        ])->filter()->each(
            fn (LaravelAttribute $attribute, string $method) => $attribute->apply($command, $method)
        );
    }
}
