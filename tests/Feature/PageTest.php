<?php

use App\Models\Page;
use function Pest\Laravel\get;

test('Главная страница возвращает 200')
    ->get('/')
    ->assertStatus(200);

test('Существующая страница возвращает 200', function () {
    $page = Page::factory()->create();
    get('/'.$page->slug.'.html')
        ->assertStatus(200);
});

test('Несуществующая страница возвращает 404')
    ->get('/testing_not_existent_page.html')
    ->assertStatus(404);

test('Удаленная страница возвращает 404', function () {
    Page::factory()->deleted()->create([
        'slug' => 'testing_soft_deleted_page',
    ]);

    get('/testing_soft_deleted_page.html')
        ->assertStatus(404);
});
