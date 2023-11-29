<?php

namespace Tests\Feature\Api\V2;

use App\Models\User;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_v2()//: void
    {
        Sanctum::actingAs(User::factory()->create());

        Category::factory()->create();
        
        $recipes = Recipe::factory(5)->create();

        $response = $this->getJson("/api/v2/recipes");
        $response->assertJsonCount(5,"data")
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            "data"=>[],
            "links"=>[],
            "meta"=>[],
        ]);
    }

}
