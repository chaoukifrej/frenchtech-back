<?php

namespace App\Http\Controllers;

use App\Actor;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class ActorController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = Actor::all();

        return response()->json(['body' => ['actors' => $actors]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // in RegisterController
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        //$startup_number = Actor::count('')
        $start_up_total = Actor::where('category', 'like', 'startUp')->get()->count();
        $funds_total = (int) Actor::sum('funds');
        $employees_number_total = (int) Actor::sum('employees_number');
        $jobs_number_total = (int) Actor::sum('jobs_available_number');
        $women_number_total = (int) Actor::sum('women_number');
        $revenues_total = (int) Actor::sum('revenues');

        return response()->json(['body' => [
            'start_up_total' => $start_up_total,
            'funds_total' => $funds_total,
            'employees_number_total' => $employees_number_total,
            'jobs_number_total' => $jobs_number_total,
            'women_number_total' => $women_number_total,
            'revenues_total' => $revenues_total
        ]], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function edit(Actor $actor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actor $actor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        //
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function getConnectedActor()
    {
        $data = Actor::where('id', Auth::user()->id)->first();
        return response()->json(['body' => ['actor' => $data]], 200);
    }
}
