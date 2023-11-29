<?php

namespace Tests\Feature\Api\V1;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /**
    * INDEX TEST
    * Se cra un usuario y se actua como si estuviera autenticado por Sanctum
    * Se crean 2 tags 
    * Se dirige  la direccion para recibir un Json
    * Y se comprueba que tenga 2 registros y cumplan con la estructura
    */
    public function test_index(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $tags = Tag::factory(2)->create();

        $response = $this->getJson("/api/v1/tags");
        $response->assertJsonCount(2,"data")
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            "data"=>[
                [
                "id",
                "type",
                "attributes"=>["name"],
                "relationships"=>[
                    "recipes"=>[]
                    ],
                ]
            ]
        ]);
    }

    /**
    * INDEX SHOW
    * Se crea un usuario y se actua como si estuviera autenticado por Sanctum
    * Se crean una tag 
    * Se dirige  la direccion para recibir un Json
    * Y se comprueba que tenga el registros y cumpla con la estructura
    */
    public function test_show(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $tag = Tag::factory()->create();

        $response = $this->getJson("/api/v1/tags/".$tag->id);
        $response->assertStatus(Response::HTTP_OK) //200
        ->assertJsonStructure([
            "data"=>[
                "id",
                "type",
                "attributes"=>["name"],
                "relationships"=>[
                    "recipes"=>[]
                ],
            ]
        ]);
    }
}
