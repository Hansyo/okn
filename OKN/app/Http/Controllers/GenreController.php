<?php

namespace App\Http\Controllers;

use App\Genre;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Genre::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $genre = new Genre;
        $user = Auth::user();
        $genre->name = $request->name;
        $genre->memo = $request->memo;
        $user->genre()->save($genre);
        if($request->filled('parent')) {
            try{
                $parent = $user->genre()->findOrFail($request->parent);
                $parent->child()->attach($genre->id);
            }catch(ModelNotFoundException $e){}
        }
        return redirect('genres/'.$genre->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        //
        return ["genre" => $genre, "parent" => $genre->parent()->get(), "child" => $genre->child()->get()];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit', ["genre" => $genre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        //
        $genre->name = $request->name;
        $genre->memo = $request->memo;
        if($request->filled('parent')) {
            try{
                $parent = $user->genre()->findOrFail($request->parent);
                $parent->child()->attach($genre->id);
            }catch(ModelNotFoundException $e){}
        }
        $genre->save();
        return redirect('genres/'.$genre->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        //
        $genre->delete();
    }
}