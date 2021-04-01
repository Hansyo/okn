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
        return view('genres.index', ["items" => Auth::user()->genres()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        // フィールドのチェック
        $request->validate([
            'name' => 'required',
        ]);

        $user = Auth::user();
        // ユーザがデータを所持しているかを確認する
        if($request->filled('parent')) $user->genres()->findOrFail($request->parent);
        $genre = $user->genres()->create($request->all());
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
        if($genre->user != Auth::id()) return \App::abort(404);
        return view('genres.show', ["item" => $genre, "childs" => Auth::user()->genres()->where('parent', $genre->id)->pluck('id')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        if($genre->user != Auth::id()) return \App::abort(404);
        return view('genres.edit', ["item" => $genre, "genres" => Auth::user()->genres()->get()]);
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
        // 正規ユーザーか確認
        if($genre->user != Auth::id()) return \App::abort(404);

        // フィールドのチェック
        $validated = $request->validate([
            'name' => 'required',
        ]);

        // ユーザがデータを所持しているかを確認する
        if($request->filled('parent')) Auth::user()->genres()->findorFail($request->parent);
        // ワンラインアップデート
        $genre->update($request->all());
        return redirect()->route('genres.show', $genre->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        if($genre->user != Auth::id()) return \App::abort(404);
        $genre->delete();
        return redirect()->route('genres.index');
    }
}
