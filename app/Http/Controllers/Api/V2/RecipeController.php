<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecipeController extends Controller
{
    public function index(){

        $search= Recipe::orderBy("id","DESC")
        ->with("category", "tags", "user")
        ->paginate();

        return RecipeResource::collection($search);
    }
    
}
