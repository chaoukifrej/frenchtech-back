<?php

namespace App\Http\Controllers;

use App\Historic;
use Illuminate\Http\Request;

class HistoricController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Historic  $historic
     * @return \Illuminate\Http\Response
     */
    public function show(Historic $historic)
    {
        try {
            $historic = Historic::all();

            return response()->json(['body' => ['historic' => $historic]], 200);
        } catch (\Throwable $th) {
            return response()->json(['body' => $th], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Historic  $historic
     * @return \Illuminate\Http\Response
     */
    public function edit(Historic $historic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Historic  $historic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Historic $historic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Historic  $historic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Historic $historic)
    {
        //
    }
}
