<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oldBrands = DB::table('mtrock.mr_store_producer')->get();
        $result = $oldBrands->map(fn ($oldBrand) => [
            'id' => $oldBrand->id,
            'slug' => $oldBrand->slug,
            'title' => $oldBrand->name,
            'image' => $this->getImage($oldBrand->image),
            'short_description' => $this->getShortDescription($oldBrand->short_description),
            'description' => $this->getDescription($oldBrand->description),
            'position' => $oldBrand->sort ?: 0,
            'deleted_at' => $oldBrand->status == 1 ? null : today(),
        ]);

        Schema::disableForeignKeyConstraints();
        Brand::query()->truncate();
        Brand::insert($result->toArray());
        Schema::enableForeignKeyConstraints();
    }

    private function getImage(?string $image): ?string
    {
        if (empty($image)) {
            return null;
        }

        return 'store/brand/'.$image;
    }

    private function getShortDescription(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return strip_tags($value);
    }

    private function getDescription(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return str_replace('https://mountain-rock.ru/', '/', $value);
    }
}
