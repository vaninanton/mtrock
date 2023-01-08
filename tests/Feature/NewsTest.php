<?php

use App\Models\News;
use function Pest\Laravel\get;

test('Страница с новостями возвращает 200', function () {
    News::factory(10)->create();

    get('/news')
        ->assertStatus(200);
});

test('Страница просмотра новости возвращает 200', function () {
    $news = News::factory()->create();

    get('/news/'.$news->slug.'.html')
        ->assertStatus(200);
});
