<?php

declare(strict_types=1);

namespace App\Support\IdeHelper;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;

class MyModelHook implements ModelHookInterface
{
    public function run(ModelsCommand $command, Model $model): void
    {
        if (!array_key_exists('phone', $model->getCasts())) {
            return;
        }

        $command->setProperty('phone', PhoneNumber::class, true, true, 'Номер телефона');
    }
}
