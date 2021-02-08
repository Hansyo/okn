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
        //
        return ['Receipts' => Auth::user()->receipt()->get()];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('receipts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $receipt = new Receipt;
            $receipt->purchase = $request->purchase;
            $receipt->amount = $request->amount;
            $receipt->memo = $request->memo;
            $receipt->genre_id = $user->genre()->findOrFail($request->genre_id)->id;
            if($request->filled('store_id')) $receipt->store_id = $user->store()->findOrFail($request->store_id)->id;
            if($request->filled('payment_id')){
                $payment = $user->payment()->findOrFail($request->payment_id);
                $receipt->payment_id = $payment->id;
                $hist = new CreditHistory;
                $hist->date = $request->purchase;
                $hist->amount = -1 * $request->amount;
                $hist->memo = url('receipts/').$receipt->id;
                $payment->credit()->history()->save($hist);
                $payment->credit()->amount += $hist->amount;
                $payment->credit()->save();
            }
            $user->receipt()->save($receipt);
        }catch (Exception $e) {
        }
        return redirect('receipts/'.$receipt->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        return view('receipts/'.$receipt->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
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
        //
        try {
            $user = Auth::user();
            $receipt->purchase = $request->purchase;
            $receipt->amount = $request->amount;
            $receipt->memo = $request->memo;
            $receipt->genre_id = $user->genre()->findOrFail($request->genre_id)->id;
            if($request->filled('store_id')) $receipt->store_id = $user->store()->findOrFail($request->store_id)->id;
            if($request->filled('payment_id')){
                $payment = $user->payment()->findOrFail($request->payment_id);
                $receipt->payment_id = $payment->id;
                $hist = new CreditHistory;
                $hist->date = $request->purchase;
                $hist->amount = -1 * $request->amount;
                $hist->memo = url('receipts/').$receipt->id;
                $payment->credit()->history()->save($hist);
                $payment->credit()->amount += $hist->amount;
                $payment->credit()->save();
            }
            $user->receipt()->save($receipt);
        }catch (Exception $e) {
        }
        return redirect('receipts/'.$receipt->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
        $receipt->delete();
    }
}
