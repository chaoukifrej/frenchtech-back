<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Buffer;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $admins = Admin::all();
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
        return response()->json(['body' => ['admins' => $admins]], 200);
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
        try {
            Validator::make($request->all(), [
                'firstname' => ['required', 'string'],
                'lastname' => ['required', 'string'],
                'email' => ['required', 'unique:admins', 'email', 'string'],
            ])->validate();
            $newAdmin = Admin::create([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'email' => $request['email']
            ]);

            return response()->json(["success" => ["true", $newAdmin]], 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => $th], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        try {
            $admin = Admin::find($request->id);

            Validator::make(
                $request->all(),
                [
                    'firstname' => ['string'],
                    'lastname' => ['string'],
                    'email' => ['email']
                ],
            )->validate();

            if (!isset($request->firstname)) {
                $admin->firstname =  $admin->firstname;
            } else {
                $admin->firstname = $request->firstname;
            }

            if (!isset($request->lastname)) {
                $admin->lastname =  $admin->lastname;
            } else {
                $admin->lastname = $request->lastname;
            }

            if (!isset($request->email)) {
                $admin->email =  $admin->email;
            } else {
                $admin->email = $request->email;
            }

            $admin->save();

            return response()->json(["success" => ["true " => $admin]], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Admin $admin)
    {
        try {
            $a = Admin::find($request->id);

            if ($a) {
                if ($a->id == 1) {
                    return response()->json(["body" => "L'administrateur principale ne peut etre supprime"], 200);
                }
                if ($a->id != 1) {

                    $a->delete();
                    return response()->json(["body" => "L'administateur est delete"], 200);
                }
            } else {
                return response()->json(["Body" => "Administrateur introuvable"], 401);
            }
        } catch (\Throwable $th) {
            return response()->json(["body" => $th], 401);
        }
    }
}
