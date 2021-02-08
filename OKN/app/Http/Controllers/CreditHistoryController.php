<?php

namespace App\Http\Controllers;

use App\Models\CreditHistory;
use App\Models\Credit;
use Illuminate\Http\Request;

class CreditHistoryController extends Controller
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
        return view('creditHistories.create');
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
            $creditHistory = new CreditHistory;
            $credit = Credit::findOrFail($request->credit_id);
            $user = Auth::user();
            $creditHistory->date = $request->date;
            $creditHistory->amount = $request->amount;
            $creditHistory->memo = $request->memo;
            $credit->history()->save($creditHistory);
            $credit->credit += $creditHistory->amount;
            $credit->save();
        }catch(ModelNotFoundException $e){
            return view('creditHistories.create', ['request' => $request, 'error' => 'Credit Not found.']);
        }
        return redirect('creditHistories/'.$creditHistory->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CreditHistory  $creditHistory
     * @return \Illuminate\Http\Response
     */
    public function show(CreditHistory $creditHistory)
    {
        //
        return ['creditHistory' => $CreditHistory];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CreditHistory  $creditHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditHistory $creditHistory)
    {
        //
        return view('creditHistories.edit', ['creditHistory' => $creditHistory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CreditHistory  $creditHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreditHistory $creditHistory)
    {
        //
        try{
            $creditHistory = new CreditHistory;
            $credit = Credit::findOrFail($request->credit_id);
            $user = Auth::user();
            if ($user->payment()->where('id', $credit->payment_id)->exists())
                $creditHistory->credit_id = $request->credit_id;
            else
                return view('creditHistories.edit', ['request' => $request, 'error' => 'Credit Not found.']);
            $creditHistory->date = $request->date;
            $money_change = $creditHistory->amount - $request->amount;
            $creditHistory->amount = $request->amount;
            $creditHistory->memo = $request->memo;
            $credit->history()->save($creditHistory);
            $credit->credit -= $money_change;
            $credit->save();
        }catch(ModelNotFoundException $e){}
        return redirect('creditHistorys/'.$creditHistory->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CreditHistory  $creditHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditHistory $creditHistory)
    {
        //
        $creditHistory->delete();
    }
}
