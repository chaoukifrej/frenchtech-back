<?php

namespace App\Http\Controllers;

use App\Buffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return response()->json(['body' => ['buffers' =>  $buffers]], 200);
    }

    /**
     * Display list demande update for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateDemande()
    {
        try {
            $buffers = Buffer::where('type_of_demand',  "update")->get();

            return response()->json(["body" => ["buffers" => $buffers]], 201);
        } catch (\Throwable $th) {
            return response()->json(["body" => ["response" => $th]], 401);
        }
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
    public function update(Request $request, Buffer $buffer, Validator $validator)
    {

        try {
            $buffer = Buffer::find($request->id);

            $request->validate([
                'logo' => ['string'],
                'name' => ['string', 'max:64'],
                'adress' => ['string', 'max:64'],
                'postal_code' => ['integer', 'max:5'],
                'city' => ['string', 'max:64'],

                'email' => ['string', 'email', 'max:64', 'unique:actors'],
                'phone' => ['string', 'max:20'],
                'category' => ['string', 'max:64'],
                'associations' => ['nullable', 'string', 'max:64'],
                'description' => ['string'],

                'facebook' => ['nullable', 'string'],
                'twitter' => ['nullable', 'string'],
                'linkedin' => ['nullable', 'string'],
                'website' => ['nullable', 'string'],

                'activity_area' => ['string', 'max:64'],
                'funds' => ['numeric'],
                'employees_number' => ['integer'],
                'jobs_available_number' => ['integer'],
                'women_number' => ['integer'],
                'revenues' => ['numeric'],
            ]);


            if (!isset($request->name)) {
                $buffer->name = $buffer->name;
            } else {
                $buffer->name = $request->name;
            }
            if (!isset($request->adress)) {
                $buffer->adress = $buffer->adress;
            } else {
                $buffer->adress = $request->adress;
            }
            if (!isset($request->postal_code)) {
                $buffer->postal_code = $buffer->postal_code;
            } else {
                $buffer->postal_code = $request->postal_code;
            }
            if (!isset($request->city)) {
                $buffer->city = $buffer->city;
            } else {
                $buffer->city = $request->city;
            }
            if (!isset($request->email)) {
                $buffer->email = $buffer->email;
            } else {
                $buffer->email = $request->email;
            }
            if (!isset($request->phone)) {
                $buffer->phone = $buffer->phone;
            } else {
                $buffer->phone = $request->phone;
            }
            if (!isset($request->category)) {
                $buffer->category = $buffer->category;
            } else {
                $buffer->category = $request->category;
            }
            if (!isset($request->associations)) {
                $buffer->associations = $buffer->associations;
            } else {
                $buffer->associations = $request->associations;
            }
            if (!isset($request->description)) {
                $buffer->description = $buffer->description;
            } else {
                $buffer->description = $request->description;
            }
            if (!isset($request->facebook)) {
                $buffer->facebook = $buffer->facebook;
            } else {
                $buffer->facebook = $request->facebook;
            }
            if (!isset($request->linkedin)) {
                $buffer->linkedin = $buffer->linkedin;
            } else {
                $buffer->linkedin = $request->linkedin;
            }
            if (!isset($request->twitter)) {
                $buffer->twitter = $buffer->twitter;
            } else {
                $buffer->twitter = $request->twitter;
            }
            if (!isset($request->website)) {
                $buffer->website = $buffer->website;
            } else {
                $buffer->website = $request->website;
            }
            if (!isset($request->activity_area)) {
                $buffer->activity_area = $buffer->activity_area;
            } else {
                $buffer->activity_area = $request->activity_area;
            }
            if (!isset($request->funds)) {
                $buffer->funds = $buffer->funds;
            } else {
                $buffer->funds = $request->funds;
            }
            if (!isset($request->employees_number)) {
                $buffer->employees_number = $buffer->employees_number;
            } else {
                $buffer->employees_number = $request->employees_number;
            }
            if (!isset($request->women_number)) {
                $buffer->women_number = $buffer->women_number;
            } else {
                $buffer->women_number = $request->women_number;
            }
            if (!isset($request->revenues)) {
                $buffer->revenues = $buffer->revenues;
            } else {
                $buffer->revenues = $request->revenues;
            }

            $buffer->save();

            return response()->json(['success' => ["true", $buffer]], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 401);
        }
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
