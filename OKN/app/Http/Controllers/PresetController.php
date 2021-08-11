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
        // フィールドのチェック
        $request->validate([
            'name' => 'required',
        ]);

        $user = Auth::user();
        // ユーザがデータを所持しているかを確認する
        if($request->filled('genre')) $user->genres()->findOrFail($request->genre);
        if($request->filled('store')) $user->stores()->findOrFail($request->store);
        if($request->filled('payment')) $user->payments()->findOrFail($request->payment);

        // 保存はワンタッチでできる
        $preset = $user->presets()->create($request->all());
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
        $request->validate([
            'name' => 'required',
        ]);

        $user = Auth::user();
        // ユーザがデータを所持しているかを確認する
        if($request->filled('genre')) $user->genres()->findOrFail($request->genre);
        if($request->filled('store')) $user->stores()->findOrFail($request->store);
        if($request->filled('payment')) $user->payments()->findOrFail($request->payment);
        $preset->update($request->all());
        return redirect()->route('presets.show', $preset->id);
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
