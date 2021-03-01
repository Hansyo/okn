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
        return view('stores.index', ["stores" => Auth::user()->stores()->get()]);
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
        //
        $store = new Store;
        $user = Auth::user();
        $store->name = $request->name;
        $store->memo = $request->memo;
        $store->parent = $request->parent;
        $store->genre = $request->genre;
        $user->stores()->save($store);
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
        if($store->user_id != Auth::id()) return \App::abort(404);
        return view('stores.show', ["item" => $store, "childs" => $user->stores()->where('parent', $store->id)->pluck('id')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        if($store->user_id != Auth::id()) return \App::abort(404);
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
        if($store->user_id != Auth::id()) return \App::abort(404);
        $store->name = $request->name;
        $store->memo = $request->memo;
        $store->parent = $request->parent;
        $store->genre = $request->genre;
        $store->save();
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
        if($store->user_id != Auth::id()) return \App::abort(404);
        $store->delete();
        return redirect()->route('stores.index');
    }
}
