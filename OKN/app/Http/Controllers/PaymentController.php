<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('payments.index', ["items" => Auth::user()->payments()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payments.create', ['paymentGenres' => Auth::user()->paymentGenres()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
        ]);
        // ユーザがデータを所持しているかを確認する
        if($request->filled('paymentGenre')) {
            $user->paymentGenres()->findOrFail($request->paymentGenre);
        }

        $payment = $user->payments()->create($request->all());
        if(! $request->filled('noCredit')) {
            $credit = new Credit;
            $credit->credit = 0;
            $credit->user = Auth::id();
            $payment->credits()->save($credit);
        }
        return redirect()->route('payments.show', $payment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        if($payment->user != Auth::id()) return \App::abort(404);
        return view('payments.show', ["item" => $payment, "credit" => $payment->credits()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        if($payment->user != Auth::id()) return \App::abort(404);
        return view('payments.edit', ["item" => $payment, "paymentGenres" => Auth::user()->paymentGenres()->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        if($payment->user != Auth::id()) return \App::abort(404);
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
        ]);
        // ユーザがデータを所持しているかを確認する
        if($request->filled('paymentGenre')) {
            $user->paymentGenres()->findOrFail($request->paymentGenre);
        }
        $payment->update($request->all());
        return redirect()->route('payments.show', $payment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        if($payment->user != Auth::id()) return \App::abort(404);
        $payment->delete();
        return redirect()->route('payments.index');
    }
}
