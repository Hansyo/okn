<?php

namespace App\Http\Controllers;

use App\Models\PaymentGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentGenreController extends Controller
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
        return view('paymentGenres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paymentGenre = new PaymentGenre;
        $user = Auth::user();
        $paymentGenre->name = $request->name;
        $paymentGenre->memo = $request->memo;
        $user->paymentGenre()->save($paymentGenre);
        if($request->filled('parent')) {
            try{
                $parent = $user->paymentGenre()->findOrFail($request->parent);
                $parent->child()->attach($paymentGenre->id);
            }catch(ModelNotFoundException $e){}
        }
        return redirect('paymentGenres/'.$paymentGenre->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentGenre  $paymentGenre
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentGenre $paymentGenre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentGenre  $paymentGenre
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentGenre $paymentGenre)
    {
        //
        return view('paymentGenres.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentGenre  $paymentGenre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentGenre $paymentGenre)
    {
        $user = Auth::user();
        $paymentGenre->name = $request->name;
        $paymentGenre->memo = $request->memo;
        if($request->filled('parent')) {
            try{
                $parent = $user->paymentGenre()->findOrFail($request->parent);
                $parent->child()->attach($paymentGenre->id);
            }catch(ModelNotFoundException $e){}
        }
        $paymentGenre->save();
        return redirect('paymentGenres/'.$paymentGenre->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentGenre  $paymentGenre
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentGenre $paymentGenre)
    {
        $paymentGenre->delete();
    }
}
