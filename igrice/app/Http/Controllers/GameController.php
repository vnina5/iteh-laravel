<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\GameResource;


class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        // return new GameResource($games);
        return $games;
    }

    public function getByCategory($cat_id)
    {
        $games = Game::get()->where('categoryID', $cat_id);

        if(is_null($games)){
            return response()->json('Games with this category does not exist!');
        }

        return $games;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Game $game)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'price'=>'required|Integer',
            // 'category'=>'required',
            // 'userID'=>'required'


        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $game->name = $request->name;
        $game->description = $request->description;
        $game->price = $request->price;
        $game->userID = Auth::user()->id;
        $game->categoryID = $request->categoryID;

        $game->save();

        return response()->json(['Igrica je sacuvana!', new GameResource($game)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return new GameResource($game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'string|max:255',
            'description'=>'string',
            'price'=>'Integer',
            // 'categoryID'=>'required',
            // 'userID'=>'required'


        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $game->name = $request->name;
        $game->description = $request->description;
        $game->price = $request->price;
        $game->userID = Auth::user()->id;
        $game->categoryID = $request->categoryID;

        $result=$game->update();

        if($result==false){
            return response()->json('Difficulty with updating!');
        }
        return response()->json(['Igrica je izmenjena!',new GameResource($game)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        // $game = Game::get()->where('id', $id);
        $game->delete();

        return response()->json('Igrica je obrisana!');
        // return response()->json('Igrica '.$auto->model .' je obrisana!');
    }


    public function getForUser (Request $request){
    
        $games = Game::get()->where('userID', Auth::user()->id);
    
        if (count($games) == 0) {
            return 'You do not have saved books!';
        }
    
        $myGame = array();
        foreach ($games as $g) {
            array_push($myGame, new GameResource($g));
        }
    
        return $myGame;
    }


}
