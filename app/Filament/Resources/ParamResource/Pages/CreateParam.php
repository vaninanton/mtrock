<?php

declare(strict_types=1);

namespace App\Filament\Resources\ParamResource\Pages;

use App\Filament\Resources\ParamResource;
use Filament\Resources\Pages\CreateRecord;

class CreateParam extends CreateRecord
{
    protected static string $resource = ParamResource::class;
}
