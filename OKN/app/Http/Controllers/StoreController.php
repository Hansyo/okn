<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('stores.index', ["items" => Auth::user()->stores()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('stores.create', ['stores' => Auth::user()->stores()->get() , 'genres' => Auth::user()->genres()->get()]);
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
        if($request->filled('parent')) $user->stores()->findOrFail($request->parent);
        if($request->filled('genre')) $user->genres()->findOrFail($request->genre);
        $store = $user->stores()->create($request->all());
        return redirect()->route('stores.show', $store->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
        if($store->user != Auth::id()) return \App::abort(404);
        return view('stores.show', ["item" => $store, "childs" => Auth::user()->stores()->where('parent', $store->id)->pluck('id')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        if($store->user != Auth::id()) return \App::abort(404);
        return view('stores.edit', ["item" => $store, "stores" => Auth::user()->stores()->get(), "genres" => Auth::user()->genres()->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
        if($store->user != Auth::id()) return \App::abort(404);
        // フィールドのチェック
        $request->validate([
            'name' => 'required',
        ]);

        $user = Auth::user();
        // ユーザがデータを所持しているかを確認する
        if($request->filled('parent')) $user->stores()->findOrFail($request->parent);
        if($request->filled('genre')) $user->genres()->findOrFail($request->genre);
        $store->update($request->all());
        return redirect()->route('stores.show', $store->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        if($store->user != Auth::id()) return \App::abort(404);
        $store->delete();
        return redirect()->route('stores.index');
    }
}
