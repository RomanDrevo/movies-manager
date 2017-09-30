<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Response;

class MovieController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function getList(){
        $movies = Movie::all();

        return Response::json([
            'data' => $movies->toArray()
        ], 200);
    }

    public function showRecord($id){

        $movie = Movie::find($id);

        if(!$movie){
            return Response::json([
                'error' => [
                    'message' => 'Movie does not exist.'
                ]
            ], 404);
        }

        return Response::json([
            'data' =>$movie->toArray()
        ], 200);
    }

    public function saveRecord(){

    }

    public function deleteRecord(){

    }
}
