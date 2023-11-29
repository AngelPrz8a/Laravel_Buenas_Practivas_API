<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create(["email"=>"correo@prueba.com"]); //1 usuario con email especifico
        \App\Models\User::factory(29)->create(); //29 Usarios

        \App\Models\Category::factory(12)->create(); // 12 Categorias
        \App\Models\Recipe::factory(100)->create(); // 100 recetas
        \App\Models\Tag::factory(40)->create();  // 40 etiquetas

        //Many to Many
        $recipes = \App\Models\Recipe::all();
        $tags = \App\Models\Tag::all();

        foreach($recipes as $recipe){
            //Cada receta tendra entre 2 a 4 etiquetas aleatorias
            //La funcion tags() en el modelo recipes, define la relacion muchos de tags
            $recipe->tags()->attach($tags->random(rand(2,4)));
        }

    }
}
