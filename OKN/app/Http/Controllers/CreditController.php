<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Prophecy\Call\Call;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Credit::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('credits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credit = new Credit;
        $user = User::find(Auth::id());
        $credit->credit = $request->credit;
        if($user->payment()->where('payment', $request->payment)->exist())
            $credit->payment = $request->payment;
        else
            return view('credits.create', ['request'=>$request, 'error'=>'Payment Not Found.']);
        $user->credit()->save($credit);
        return redirect('credits/'.$credit->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(Credit $credit)
    {
        //
        return ["credit" => $credit];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function edit(Credit $credit)
    {
        return view('credits.edit', ["credit" => $credit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credit $credit)
    {
        $credit = new Credit;
        $user = User::find(Auth::id());
        $credit->credit = $request->credit;
        if($user->payment()->where('payment', $request->payment)->exist())
            $credit->payment = $request->payment;
        else
            return view('credits.edit', ['request'=>$request, 'error'=>'Payment Not Found.']);
        $credit->save();
        return redirect('credits/'.$credit->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
        //
        $credit->delete();
    }
}
