<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index()
    {
        return Character::all();
    }
    public function show(Character $character)
    {
        return $character;
    }
    public function store(Request $request)
    {
        $character = Character::create($request->all());

        return response()->json($character, 201);
    }
    public function update(Request $request, Character $character)
    {
        $character->update($request->all());

        return response()->json($character, 200);
    }
    public function delete(Character $character)
    {
        $character->delete();

        return response()->json(null, 204);
    }
}
