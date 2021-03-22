<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\CreditHistory;
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
        return view('incomes.index', ["items" => Auth::user()->incomes()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('incomes.create', [
            'payments' => $user->payments()->get(),
            'incomeGenres' => $user->incomeGenres()->get(),
        ]);
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
            $income->amount = $request->amount;
            $income->date = $request->date;
            $income->payment = $request->payment;
            $income->incomeGenre = $request->incomeGenre;
            $user->incomes()->save($income);
            { // CreditHistoryに登録する。
                $hist = new CreditHistory;
                $hist->date   = $request->date;
                $hist->amount = $request->amount;
                $hist->memo   = route('incomes.show', $income->id);
                $hist->user   = Auth::id();

                $payment = $user->payments()->findOrFail($request->payment);
                $credit = $payment->credits()->first();
                $credit->credit += $hist->amount;
                $credit->save();
                $credit->histories()->save($hist);
                $income->creditHistory = $hist->id;
                $income->save();
            }
        }catch(Exception $e) {}
        return redirect()->route('incomes.show', $income->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        if($income->user != Auth::id()) return \App::abort();
        return view('incomes.show', ["item" => $income]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
       
        if($income->user != Auth::id()) return \App::abort();
        $user = Auth::user();
        return view('incomes.edit', [
            'item' => $income,
            'payments' => $user->payments()->get(),
            'incomeGenres' => $user->incomeGenres()->get(),
        ]);
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
        if($income->user != Auth::id()) return \App::abort();
        $user = Auth::user();
        $old_amount = $income->amount;
        $income->amount = $request->amount;
        $income->date = $request->date;
        $income->incomeGenre = $request->incomeGenre;
        if($old_amount != $request->amount){
            $hist = $income->history()->first();
            $credit = $hist->credits()->first();
            $hist->date = $request->date;
            $hist->amount = $request->amount;
            $credit->credit -= $old_amount - $request->amount;
            $credit->save();
            $hist->save();
        }
        $income->save();
        return redirect()->route('incomes.show', $income->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        if($income->user != Auth::id()) return \App::abort();
        $hist = $income->history()->first();
        if($hist != null){
            $credit = $hist->credits()->first();
            $credit->credit += -1 * $hist->amount;
            $credit->save();
            $hist->delete();
        }
        $income->delete();
        return redirect()->route('incomes.index');
    }
}
