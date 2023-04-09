<?php

declare(strict_types=1);

namespace App\Filament\Resources\CallbackResource\Pages;

use App\Filament\Resources\CallbackResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCallback extends CreateRecord
{
    protected static string $resource = CallbackResource::class;
}
