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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('incomeGenre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $incomeGenre = new IncomeGenre;
        $user = Auth::user();
        $incomeGenre->name = $request->name;
        $incomeGenre->memo = $request->memo;
        $user->incomeGenre()->save($incomeGenre);
        if($request->filled('parent')) {
            try{
                $parent = $user->incomeGenre()->findOrFail($request->parent);
                $parent->child()->attach($incomeGenre->id);
            }catch(ModelNotFoundException $e){}
        }
        return redirect('incomeGenres/'.$incomeGenre->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IncomeGenre  $incomeGenre
     * @return \Illuminate\Http\Response
     */
    public function show(IncomeGenre $incomeGenre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IncomeGenre  $incomeGenre
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomeGenre $incomeGenre)
    {
        return view('incomeGenre.edit', ["incomeGenre" => $incomeGenre]);
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
        //
        $incomeGenre->name = $request->name;
        $incomeGenre->memo = $request->memo;
        if($request->filled('parent')) {
            try{
                $parent = $user->incomeGenre()->findOrFail($request->parent);
                $parent->child()->attach($incomeGenre->id);
            }catch(ModelNotFoundException $e){}
        }
        $incomeGenre->save();
        return redirect('incomeGenres/'.$incomeGenre->id);
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
        $incomeGenre->delete();
    }
}
