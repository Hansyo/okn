<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\User;
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
        //return view('genres.index', ['genres' => Genre::all()]);
        if(!Auth::check()) return redirect('login'); //確認
        return view('genres.index', ["genres" => Auth::user()->genres()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::check()) return redirect('login'); //確認
        return view('genres.create', ['genres' => Auth::user()->genres()->get() ]);
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
        $genre->parent = $request->parent;
        $user->genres()->save($genre);
        return redirect()->route('genres.show', $genre->id);
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
        if(!Auth::check()) return \App::abort(404);
        $user = Auth::user();
        if(! $user->genres()->where('id', '=', $genre->id)->exists())
            return \App::abort(404);
        return view('genres.show', ["genre" => $genre, "childs" => $user->genres()->where('parent', $genre->id)->pluck('id')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit', ["genre" => $genre, "genres" => Auth::user()->genres()->get()]);
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
        // 処理が間違ってる
        $genre->name = $request->name;
        $genre->memo = $request->memo;
        if($request->filled('parent')) {
            try{
                $user = Auth::user();
                $parent = $user->genres()->findOrFail($request->parent);
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
        return redirect('genres');
    }
}
