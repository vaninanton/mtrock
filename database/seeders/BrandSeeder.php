<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'Alexika',
            'Fire-Maple',
            'Canadian Camper',
            'KSL',
            'Normal',
            'Nova Tour',
            'Outdoor Project',
            'Salewa',
            'Sol',
            'Tengu',
            'Tramp',
            'Deuter',
            'Tatonka',
            'Petzl',
            'Kovea',
            'TSL Sport Equipment',
            'Y-Scoo',
            'RedFox',
            'La Sportiva',
            'Asolo',
            'Razor',
            'PRIMUS',
            'Marmot',
            'Grivel',
            'Dragon',
            'Bula',
            'Easy Camp',
            'Indiana',
            'Wmotion',
            'Hello Wood',
            'BESTWAY',
            'MGP',
            'Totem',
            'Rock Empire',
            'Vertigo',
            'BTrace',
            '​Space Scooter',
            'Black Diamond',
            'Dusters',
            'GoPro',
            '​Globe',
            'Tasmanian Tiger',
            'AceCamp',
            'Wildo',
            'Osprey',
            'Helios',
            'Slamm',
            'ETHIC',
            'Phoenix',
            'Blunt',
            'Grit Scooters',
            'Ergate',
            'High Peak',
            'Masters',
            'Ortovox',
            'Hagan',
            'Julbo',
            'Leatherman',
            'Dakine',
            'Fischer',
            'Jetboil',
            '​HEAD',
            'Exped',
            'Bask (Баск)',
            'NZ (Новая Земля)',
            'FHM',
            'Маяк',
            'MSR',
            '​Therm-a-Rest',
            'Platypus',
            'Evoc',
            'Newboler',
            'Widesea',
        ];
        foreach ($items as $brand) {
            Brand::factory()
                ->create([
                    'title' => $brand,
                    'slug' => Str::slug($brand, '-'),
                ]);
        }
    }
}
