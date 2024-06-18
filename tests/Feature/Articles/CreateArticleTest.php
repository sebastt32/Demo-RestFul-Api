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
            route('api.articles.store'),
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

    /**
     * @test
     */
    public function title_is_required(): void
    {

        $response = $this->postJson(
            route('api.articles.store'),
            [
                'data' => [
                    'type' => 'articles',
                    'attributes' => [
                        'slug' => 'Nuevo-Articulo',
                        'content' => 'Contenido del articulo',
                    ],
                ]
            ]
        );

        $response->assertJsonValidationErrors('data.attributes.title');
    }
    /**
     * @test
     */

    public function slug_is_required(): void
    {

        $response = $this->postJson(
            route('api.articles.store'),
            [
                'data' => [
                    'type' => 'articles',
                    'attributes' => [
                        'title' => 'Nuevo Artículo',
                        'content' => 'Contenido del articulo',
                    ],
                ]
            ]
        );

        $response->assertJsonValidationErrors('data.attributes.slug');
    }

    /**
     * @test
     */
    public function content_is_required(): void
    {


        $response = $this->postJson(
            route('api.articles.store'),
            [
                'data' => [
                    'type' => 'articles',
                    'attributes' => [
                        'title' => 'Nuevo Artículo',
                        'slug' => 'Nuevo-Articulo',
                    ],
                ]
            ]
        );




        $response->assertJsonValidationErrors('data.attributes.content');
    }

    /** @test */
    public function title_must_be_at_least_4_characters(): void
    {

        $response = $this->postJson(
            route('api.articles.store'),
            [
                'data' => [
                    'type' => 'articles',
                    'attributes' => [
                        'title' => 'Nue',
                        'slug' => 'Nuevo-Articulo',
                        'content' => 'Contenido del articulo',
                    ],
                ]
            ]
        );

        $response->assertJsonValidationErrors('data.attributes.title');
    }
}
