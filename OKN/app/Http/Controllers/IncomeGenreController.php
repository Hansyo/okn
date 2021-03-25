<?php

namespace App\Http\Controllers;

use App\Models\IncomeGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('incomeGenres.index', ["items" => Auth::user()->incomeGenres()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('incomeGenres.create', ["incomeGenres" => Auth::user()->incomeGenres()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $user = Auth::user();
        if($request->filled('parent')) $user->incomeGenres()->findorFail($request->parent);
        $incomeGenre = $user->incomeGenres()->create($request->all());
        return redirect()->route('incomeGenres.show', $incomeGenre->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IncomeGenre  $incomeGenre
     * @return \Illuminate\Http\Response
     */
    public function show(IncomeGenre $incomeGenre)
    {
        if($incomeGenre->user != Auth::id()) return \App::abort(404);
        return view('incomeGenres.show', ["item" => $incomeGenre, "childs" => Auth::user()->incomeGenres()->where('parent','=',$incomeGenre->id)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IncomeGenre  $incomeGenre
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomeGenre $incomeGenre)
    {
        if($incomeGenre->user != Auth::id()) return \App::abort(404);
        return view('incomeGenres.edit', ["item" => $incomeGenre, "incomeGenres" => Auth::user()->incomeGenres()->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IncomeGenre  $incomeGenre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncomeGenre $incomeGenre)
    {
        if($incomeGenre->user != Auth::id()) return \App::abort(404);
        $request->validate([
            'name' => 'required',
        ]);
        if($request->filled('parent')) Auth::user()->incomeGenres()->findorFail($request->parent);
        $incomeGenre->update($request->all());
        return redirect()->route('incomeGenres.show', $incomeGenre->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IncomeGenre  $incomeGenre
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomeGenre $incomeGenre)
    {
        //
        if($incomeGenre->user != Auth::id()) return \App::abort(404);
        $incomeGenre->delete();
        return redirect()->route('incomeGenres.index');
    }
}
