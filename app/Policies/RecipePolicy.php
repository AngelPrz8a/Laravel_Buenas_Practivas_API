<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;

class RecipePolicy
{

    //Si el usuario que lo modifica es el mismo logueado
    public function update(User $user, Recipe $recipe): bool
    {
        return $user->id == $recipe->user_id;
    }

    //Si el usuario que lo elimina es el mismo logueado
    public function delete(User $user, Recipe $recipe):bool
    {
        return $user->id == $recipe->user_id;
    }

}
