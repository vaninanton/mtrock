<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Callback;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Propaganistas\LaravelPhone\Exceptions\NumberParseException;
use Propaganistas\LaravelPhone\PhoneNumber;

class CallbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oldCallbacks = DB::table('mtrock.mr_callback')->get([
            'id',
            'name',
            'phone',
            'comment',
            'create_time',
            'status',
        ]);

        $result = $oldCallbacks->map(fn ($oldCallback) => [
            'id' => $oldCallback->id,
            'name' => $oldCallback->name,
            'phone' => $this->phoneFormat($oldCallback->phone),
            'comment' => $oldCallback->comment ?: null,
            'created_at' => $oldCallback->create_time,
            'updated_at' => $oldCallback->create_time,
            'answered_at' => $oldCallback->status != 0 ? $oldCallback->create_time : null,
        ]);

        Schema::disableForeignKeyConstraints();
        Callback::query()->truncate();
        Callback::insert($result->toArray());
        Schema::enableForeignKeyConstraints();
    }

    private function phoneFormat($phone): ?string
    {
        try {
            $phone = new PhoneNumber($phone, ['RU', 'UK', 'BY']);

            return $phone->formatE164();
        } catch (NumberParseException) {
        }

        return null;
    }
}
