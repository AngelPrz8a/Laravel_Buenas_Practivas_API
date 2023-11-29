<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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

        Category::factory()->create();
        
        $recipe = Recipe::factory(2)->create();

        $response = $this->getJson("/api/v1/recipes");
        $response->assertJsonCount(2,"data")
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            "data"=>[
                [
                "id",
                "type",
                "attributes"=>["title","description"],
                ]
            ]
        ]);
    }

    /**
    * SHOW TEST
    * Se crea un usuario y se actua como si estuviera autenticado por Sanctum
    * Se crean una tag 
    * Se dirige  la direccion para recibir un Json
    * Y se comprueba que tenga el registros y cumpla con la estructura
    */
    public function test_show(): void
    {
        Sanctum::actingAs(User::factory()->create());

        Category::factory()->create();

        $recipe = Recipe::factory()->create();

        $response = $this->getJson("/api/v1/recipes/".$recipe->id);
        $response->assertStatus(Response::HTTP_OK) //200
        ->assertJsonStructure([
            "data"=>[
                "id",
                "type",
                "attributes"=>["title","description"],
            ]
        ]);
    }

    /**
    * STORE TEST
    * Se crea un usuario y se actua como si estuviera autenticado por Sanctum
    * Se crean una tag y una categoria
    * Se configura los datos que tendra el nueva registro
    * Se dirige  la direccion para enviar un Json con los datos
    * Y se comprueba que hayan sido correctamente registrado
    */
    public function test_store(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $category = Category::factory()->create();
        $tag = Tag::factory()->create();

        $data = [
            "category_id"=>$category->id,
            "title"=> $this->faker->sentence,
            "description"=> $this->faker->paragraph,
            "ingredients"=> $this->faker->text,
            "instructions"=> $this->faker->text,
            "tags"=> $tag->id,
            "image"=>UploadedFile::fake()->image('avatar.jpg'),
        ];

        $response = $this->postJson("/api/v1/recipes/",$data);
        $response->assertStatus(Response::HTTP_CREATED); //201
    }

    /**
    * UPDATE TEST
    * Se crea un usuario y se actua como si estuviera autenticado por Sanctum
    * Se crean una receta y una categoria
    * Se configura los datos que actualizara el registro
    * Se dirige  la direccion para enviar un Json con los datos
    * Y se comprueba que hayan sido correctamente registrado y la BD tenga esos valores
    */
    public function test_update(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $category = Category::factory()->create();
        $recipe = Recipe::factory()->create();

        $data = [
            "category_id"=>$category->id,
            "title"=> "updated",
            "description"=> "updated",
            "ingredients"=> $this->faker->text,
            "instructions"=> $this->faker->text,
        ];

        $response = $this->putJson("/api/v1/recipes/".$recipe->id,$data);
        $response->assertStatus(Response::HTTP_OK); //201
        $this->assertDatabaseHas("recipes",[
            "title"=>"updated",
            "description"=>"updated",
        ]);
    }

    /**
    * DELETE TEST
    * Se crea un usuario y se actua como si estuviera autenticado por Sanctum
    * Se crean una tag 
    * Se dirige  la direccion para recibir un Json
    * Y se comprueba que ya no tenga el registros
    */
    public function test_destroy(): void
    {
        Sanctum::actingAs(User::factory()->create());

        Category::factory()->create();

        $recipe = Recipe::factory()->create();

        $response = $this->deleteJson("/api/v1/recipes/".$recipe->id);
        $response->assertStatus(Response::HTTP_NO_CONTENT); //204
    }
}
