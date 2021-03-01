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
        return view('presets.index', ["items" => Auth::user()->presets()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('presets.create', [
            "genres" => Auth::user()->genres()->get(),
            "stores" => Auth::user()->stores()->get(),
            "payments" => Auth::user()->payments()->get(),
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
            $user = Auth::user();
            $preset = new Preset;
            $preset->name = $request->name;
            $preset->price = $request->price;
            $preset->memo = $request->memo;
            $preset->genre = $request->genre;
            $preset->store = $request->store;
            $preset->payment = $request->payment;
            $user->presets()->save($preset);
        return redirect()->route('presets.show', $preset->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Preset  $preset
     * @return \Illuminate\Http\Response
     */
    public function show(Preset $preset)
    {
        if($preset->user != Auth::id()) return \App::abort(404);
        return view('presets.show', ["item" => $preset]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Preset  $preset
     * @return \Illuminate\Http\Response
     */
    public function edit(Preset $preset)
    {
        if($preset->user != Auth::id()) return \App::abort(404);
        return view('presets.edit', [
            "item" => $preset,
            "genres" => Auth::user()->genres()->get(),
            "stores" => Auth::user()->stores()->get(),
            "payments" => Auth::user()->payments()->get(),
        ]);
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
        if($preset->user != Auth::id()) return \App::abort(404);
        $preset->name = $request->name;
        $preset->price = $request->price;
        $preset->memo = $request->memo;
        $preset->genre = $request->genre;
        $preset->store = $request->store;
        $preset->payment = $request->payment;
        $preset->save();
        return redirect()->route('presets.show', ["item" => $preset]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Preset  $preset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preset $preset)
    {
        if($preset->user != Auth::id()) return \App::abort(404);
        $preset->delete();
        return redirect()->route('presets.index');
    }
}
