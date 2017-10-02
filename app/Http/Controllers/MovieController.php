<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class MovieController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function getList(Request $request){

        $movies = Movie::where(function ($query) use ($request) {
            if ($request->has("keyword")) {
                $query->where("title", "LIKE", "%" . $request->keyword . "%")
                    ->orWhere("writer", "LIKE", "%" . $request->keyword . "%")
                    ->orWhere("director", "LIKE", "%" . $request->keyword . "%")
                    ->orWhere("description", "LIKE", "%" . $request->keyword . "%");
            }
        })->orderBy('updated_at', 'desc')->paginate(10);

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

    public function createRecord(){
        return view('create');
    }

    public function saveRecord(Request $request){

        $movie = new Movie();

        $movie->title = $request->title;
        $movie->writer = $request->writer;
        $movie->director = $request->director;
        $movie->movie_length = $request->movie_length;
        $movie->movie_year = $request->movie_year;
        $movie->description = $request->description;
        $movie->imdb_url = $request->imdb_url;
        $movie->imdb_rank = $request->imdb_rank;
        $movie->created_at = Carbon::now();

        if($movie->save()){
            return Response::json('OK. Movie has been created.', 200);
        }else{
            return Response::json([
                'error' => [
                    'message' => 'Can not add a movie.'
                ]
            ], 404);
        }




    }

    public function editRecord ($id){
        $movie = Movie::findOrFail($id);
        return view('edit', compact('movie'));
    }

    public function updateRecord(Request $request, $id){

        $movie = Movie::find($id);

        $movie->title = $request->title;
        $movie->writer = $request->writer;
        $movie->director = $request->director;
        $movie->movie_length = $request->movie_length;
        $movie->movie_year = $request->movie_year;
        $movie->description = $request->description;
        $movie->imdb_url = $request->imdb_url;
        $movie->imdb_rank = $request->imdb_rank;
        $movie->created_at = Carbon::now();
        $movie->save();

        return Response::json('OK. Movie has been updated.', 200);
    }

    public function deleteRecord(Request $request){

        $movie = Movie::find($request->movieId);

        if(!$movie){
            return Response::json([
                'error' => [
                    'message' => 'Movie does not exist.'
                ]
            ], 404);
        }

        $movie->delete();

        return Response::json('OK. Movie has been deleted.', 200);
    }

}
