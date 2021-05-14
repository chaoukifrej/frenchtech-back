<?php

namespace App\Http\Controllers;

use App\Actor;
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
        $total_actors = Actor::where('category', 'like', 'startUp')->get()->count();
        $total_funds = (int) Actor::sum('funds');
        $total_jobs_available = (int) Actor::sum('jobs_available_number');
        $total_women_number = (int) Actor::sum('women_number');
        $total_revenues = (int) Actor::sum('revenues');

        // Function Schedule
        Historic::create([
            'total_actors' => $total_actors,
            'total_funds' => $total_funds,
            'total_jobs_available' => $total_jobs_available,
            'total_women_number' => $total_women_number,
            'total_revenues' => $total_revenues,
        ]);

        return response()->json([
            'total_actors' => $total_actors,
            'total_funds' => $total_funds,
            'total_jobs_available' => $total_jobs_available,
            'total_women_number' => $total_women_number,
            'total_revenues' => $total_revenues,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Historic  $historic
     * @return \Illuminate\Http\Response
     */
    public function show(Historic $historic)
    {
        //
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
