<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
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
        return view('income.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $income = new Income;
            $user = Auth::user();
            $income->price = $request->price;
            $income->date = $request->date;
            if($request->filled('incomeGenre_id'))
                $income->incomeGenre_id = $user->income()->findOrFail($request->incomeGenre_id)->id;
            $user->income()->save($income);
        }catch(Exception $e){}
        return redirect('incomes/'.$income->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
        try{
            $income = new Income;
            $income->price = $request->price;
            $income->date = $request->date;
            if($request->filled('incomeGenre_id'))
                $income->incomeGenre_id = $user->income()->findOrFail($request->incomeGenre_id)->id;
        }catch(Exception $e){}
        $income->save();
        return redirect('incomes/'.$income->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
        $income->delete();
    }
}
