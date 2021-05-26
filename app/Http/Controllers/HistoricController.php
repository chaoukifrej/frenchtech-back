<?php

namespace App\Http\Controllers;

use App\Historic;
use Illuminate\Http\Request;

class HistoricController extends Controller
{
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
}
