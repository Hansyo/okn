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
        return view('paymentGenres.index', ["items" => Auth::user()->paymentGenres()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('paymentGenres.create', ['paymentGenres' => Auth::user()->paymentGenres()->get()]);
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
        $paymentGenre->parent = $request->parent;
        $user->paymentGenres()->save($paymentGenre);
        return redirect()->route('paymentGenres.show', $paymentGenre->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentGenre  $paymentGenre
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentGenre $paymentGenre)
    {
        if($paymentGenre->user_id != Auth::id()) return \App::abort(404);
        return view('paymentGenres.show', ["item" => $paymentGenre, "childs" => Auth::user()->paymentGenres()->where('parent', $paymentGenre->id)->pluck('id')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentGenre  $paymentGenre
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentGenre $paymentGenre)
    {
        if($paymentGenre->user_id != Auth::id()) return \App::abort(404);
        return view('paymentGenres.edit', ["item" => $paymentGenre, "paymentGenres" => Auth::user()->paymentGenres()->get()]);
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
        // なりすまし防止
        if($paymentGenre->user_id != Auth::id()) return \App::abort(404);
        $paymentGenre->name = $request->name;
        $paymentGenre->memo = $request->memo;
        $paymentGenre->parent = $request->parent;
        $paymentGenre->save();
        return redirect()->route('paymentGenres.show', $paymentGenre->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentGenre  $paymentGenre
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentGenre $paymentGenre)
    {
        // なりすまし防止
        if($paymentGenre->user_id != Auth::id()) return \App::abort(404);
        $paymentGenre->delete();
        return redirect()->route('paymentGenres.index');
    }

}
