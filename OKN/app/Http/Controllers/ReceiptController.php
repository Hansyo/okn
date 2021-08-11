<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\CreditHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('receipts.index', ["items" => Auth::user()->receipts()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('receipts.create', [
            'genres' => $user->genres()->get(),
            'stores' => $user->stores()->get(),
            'payments' => $user->payments()->get(),
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
        // フィールドのチェック
        $request->validate([
            'purchase' => 'required|date',
            'amount' => 'required|integer',
        ]);
        $user = Auth::user();
        // ユーザがデータを所持しているかを確認する
        if($request->filled('genre')) $user->genres()->findOrFail($request->genre);
        if($request->filled('store')) $user->stores()->findOrFail($request->store);
        if($request->filled('payment')) $user->payments()->findOrFail($request->payment);

        $receipt = $user->receipts()->create($request->all());
        if($request->filled('payment')){
            $hist = new CreditHistory;
            $hist->date   = $request->purchase;
            $hist->amount = -1 * $request->amount;
            $hist->memo   = route('receipts.show', $receipt->id);
            $hist->user   = Auth::id();

            $payment = $user->payments()->findOrFail($request->payment);
            $credit = $payment->credits()->first();
            $credit->credit += $hist->amount;
            $credit->save();
            $credit->histories()->save($hist);
            $receipt->creditHistory = $hist->id;
            $receipt->save();
        }

        return redirect()->route('receipts.show', $receipt->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        if($receipt->user != Auth::id()) return \App::abort(404);
        return view('receipts.show', ["item" => $receipt]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        if($receipt->user != Auth::id()) return \App::abort(404);
        $user = Auth::user();
        return view('receipts.edit', ["item" => $receipt,
            'genres' => $user->genres()->get(),
            'stores' => $user->stores()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        if($receipt->user != Auth::id()) return \App::abort(404);
        // フィールドのチェック
        $request->validate([
            'purchase' => 'required|date',
            'amount' => 'required|integer',
        ]);
        $user = Auth::user();
        // ユーザがデータを所持しているかを確認する
        if($request->filled('genre')) $user->genres()->findOrFail($request->genre);
        if($request->filled('store')) $user->stores()->findOrFail($request->store);
        if($request->filled('payment')) $user->payments()->findOrFail($request->payment);
        $old_amount = $receipt->amount;
        if($receipt->payment != null && $old_amount != $request->amount){
            $hist = $receipt->creditHistory()->first();
            $credit = $hist->credits()->first();
            $hist->date = $request->purchase;
            $hist->amount = -1 * $request->amount;
            $credit->credit += $old_amount - $request->amount;
            $credit->save();
            $hist->save();
        }
        $receipt->update($request->all());
        return redirect()->route('receipts.show', $receipt->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        if($receipt->user != Auth::id()) return \App::abort(404);
        $hist = $receipt->creditHistory()->first();
        if($hist != null){
            $credit = $hist->credits()->first();
            $credit->credit += -1 * $hist->amount;
            $credit->save();
            $hist->delete();
        }
        $receipt->delete();
        return redirect('receipts');
    }
}
