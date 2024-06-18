<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_create_articles(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->postJson(
            route('api.articles.create'),
            [
                'data' => [
                    'type' => 'articles',
                    'attributes' => [
                        'title' => 'Nuevo Artículo',
                        'slug' => 'Nuevo-Articulo',
                        'content' => 'Contenido del articulo',
                    ],
                ]
            ]
        );

        $response->assertCreated();
        $article = Article::first();
        $response->assertHeader(
            'location',
            route('api.articles.show', $article)
        );
        $response->assertExactJson([
            'data' => [
                'type' => 'articles',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => 'Nuevo Artículo',
                    'slug' => 'Nuevo-Articulo',
                    'content' => 'Contenido del articulo',
                ],
                'links' => [
                    'self' => route('api.articles.show', $article)
                ]
            ]
        ]);
    }
}
