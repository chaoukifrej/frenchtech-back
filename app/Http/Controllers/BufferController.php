<?php

namespace App\Http\Controllers;

use App\Buffer;
use Illuminate\Http\Request;

class BufferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $buffers = Buffer::all();
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
        return response()->json(['body' => ['buffers' => $buffers]], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buffer  $buffer
     * @return \Illuminate\Http\Response
     */
    public function show(Buffer $buffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buffer  $buffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buffer $buffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buffer  $buffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $buffers = Buffer::all();
            $deletBuffer = Buffer::find($request->id)->delete();
            return response()->json(['body' => ['Buffer deleted' => $deletBuffer, "Buffers" => $buffers]], 200);
        } catch (\Throwable $th) {
            return response()->json(['body' => $th], 401);
        }
    }
}
