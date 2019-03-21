<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    protected $loggedUser;

    public function __construct()
    {
        $this->loggedUser = auth()->user();
    }

    public function index()
    {
        if($this->loggedUser->type == 'admin') {
            return Character::all();
        }
        if(empty(Character::where('user_id', $this->loggedUser->id)->where('active', true)->get()->toArray())){
            return response()->json([
                'error' => 'Characters not found',
            ], 404);
        }
        return response()->json(Character::where('user_id', $this->loggedUser->id)->where('active', true)->get(), 200);

    }

    public function show(Character $character)
    {
        //check if it is my character
        if($this->loggedUser->id != $character->user_id){
            return response()->json([
                'error' => 'This is not your character',
            ], 403);
        }
        if($character->active){
            return $character;
        }
        return response()->json([
            'error' => 'Character not found',
        ], 404);
    }
    public function store(Request $request)
    {
        $post = $request->all();
        $post['user_id'] = $this->loggedUser->id;
        if(Character::where('nick_name', $post['nick_name'])->first()){
            return response()->json([
                'error' => 'nickname used',
            ], 400);
        }
        $character = Character::create($post);
        return response()->json($character, 201);
    }
    public function update(Request $request, Character $character)
    {
        //check if it is my character
        if($this->loggedUser->id != $character->user_id){
            return response()->json([
                'error' => 'This is not your character',
            ], 403);
        }
        ///check if nickname is unique
        if(Character::where('nick_name', $request->all()['nick_name'])->first()){
            return response()->json([
                'error' => 'nickname used',
            ], 400);
        }
        $character->update($request->all());

        return response()->json($character, 200);
    }
    public function delete(Character $character)
    {
        //check if it is my character
        if($this->loggedUser->id != $character->user_id){
            return response()->json([
                'error' => 'This is not your character',
            ], 403);
        }
        $character->update(['active' => false]);

        return response()->json(null, 204);
    }
}
