<?php

namespace App\Http\Controllers;

use App\Models\Payment;
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payments.create');
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
            $payment = new Payment;
            $user = Auth::user();
            $payment->name = $request->name;
            if($request->filled('paymentGenre_id'))
                $payment->paymentGenre_id = $user->PaymentGenre()->findOrFail($request->paymentGenre_id)->id;
            $payment->memo = $request->memo;
            $user->payment()->save($payment);
            if($request->filled('parent')) {
                $parent = $user->payment()->findOrFail($request->parent);
                $parent->child()->attach($payment->id);
            }
        }catch(Exception $e){}
        return redirect('payments/'.$payment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
        return ["payment" => $payment];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('payments.edit');
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
        //
        try{
            $payment = new Payment;
            $payment->name = $request->name;
            if($request->filled('paymentGenre_id'))
                $payment->paymentGenre_id = $user->PaymentGenre()->findOrFail($request->paymentGenre_id)->id;
            $payment->memo = $request->memo;
            if($request->filled('parent')) {
                $parent = $user->payment()->findOrFail($request->parent);
                $parent->child()->attach($payment->id);
            }
            $payment->save();
        }catch(Exception $e){}
        return redirect('payments/'.$payment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
        $payment->delete();
    }
}
