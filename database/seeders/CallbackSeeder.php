<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Callback;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CallbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old = DB::table('mtrock.mr_callback')->get();
        Callback::query()->truncate();
        foreach ($old as $item) {
            $callback = new Callback();
            $callback->id = $item->id;
            $callback->name = $item->name;
            $callback->phone = $item->phone;
            $callback->comment = $item->comment ?: null;
            $callback->created_at = $item->create_time;
            $callback->updated_at = $item->create_time;
            $callback->answered_at = $item->status != 0 ? $item->create_time : null;
            $callback->save();
        }
    }
}
