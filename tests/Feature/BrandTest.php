<?php

use App\Models\Brand;
use function Pest\Laravel\get;

test('Страница списка брендов возвращает 200', function () {
    Brand::factory(10)->create();

    get('/store/brand')
        ->assertStatus(200);
});

test('Страница несуществующего бренда возвращает 404', function () {
    get('/store/brand/not_existent_brand')
        ->assertStatus(404);
});

test('Страница существующего бренда возвращает 200', function () {
    $brand = Brand::factory()->create();
    get('/store/brand/'.$brand->slug)
        ->assertStatus(200);
});

test('Удаленный бренд возвращает 404', function () {
    $brand = Brand::factory()->deleted()->create();
    get('/store/brand/'.$brand->slug)
        ->assertStatus(404);
});
