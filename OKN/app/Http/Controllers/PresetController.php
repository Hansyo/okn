<?php

namespace App\Http\Controllers;

use App\Models\Preset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresetController extends Controller
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
            $receipt->name = $request->name;
            $receipt->price = $request->price;
            $receipt->memo = $request->memo;
            if($request->filled('genre_id'))$receipt->genre_id = $user->genre()->findOrFail($request->genre_id)->id;
            if($request->filled('store_id')) $receipt->store_id = $user->store()->findOrFail($request->store_id)->id;
            if($request->filled('payment_id')) $receipt->payment_id = $user->payment()->findOrFail($request->payment_id)->id;
            $user->receipt()->save($receipt);
        }catch (Exception $e) {
        }
        return redirect('receipts/'.$receipt->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Preset  $preset
     * @return \Illuminate\Http\Response
     */
    public function show(Preset $preset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Preset  $preset
     * @return \Illuminate\Http\Response
     */
    public function edit(Preset $preset)
    {
        //
        return view('receipts.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Preset  $preset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preset $preset)
    {
        //
        try {
            $user = Auth::user();
            $receipt = new Receipt;
            $receipt->name = $request->name;
            $receipt->price = $request->price;
            $receipt->memo = $request->memo;
            if($request->filled('genre_id'))$receipt->genre_id = $user->genre()->findOrFail($request->genre_id)->id;
            if($request->filled('store_id')) $receipt->store_id = $user->store()->findOrFail($request->store_id)->id;
            if($request->filled('payment_id')) $receipt->payment_id = $user->payment()->findOrFail($request->payment_id)->id;
            $receipt->save();
        }catch (Exception $e) {
        }
        return redirect('receipts/'.$receipt->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Preset  $preset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preset $preset)
    {
        //
        $preset->delete();
    }
}
