<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Buffer;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\ActorValidateMail;
use Illuminate\Support\Facades\Mail;


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
        try {
            $actors = Actor::all();
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
        return response()->json(['body' => ['actors' => $actors]], 200);
    }

    public function bufferWithId(Request $request)
    {
        try {
            $buffer = Buffer::find($request->id);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
        return response()->json(['body' => ['actor' => $buffer]], 200);
    }

    public function getAllInfosActors()
    {
        try {
            $actors = Actor::all();
            $actors->makeVisible(['funds', 'employees_number', 'jobs_available_number', 'women_number', 'revenues',]);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
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

        try {
            $buffer = Buffer::find($request->id);

            $newActor = Actor::create([
                'logo' => $buffer->logo,
                'name' => $buffer->name,
                'adress' => $buffer->adress,
                'postal_code' => $buffer->postal_code,
                'city' => $buffer->city,
                'longitude' => $buffer->longitude,
                'latitude' => $buffer->latitude,
                'email' => $buffer->email,
                'facebook' => $buffer->facebook,
                'linkedin' => $buffer->linkedin,
                'twitter' => $buffer->twitter,
                'website' => $buffer->website,
                'phone' => $buffer->phone,
                'category' => $buffer->category,
                'associations' => $buffer->associations,
                'description' => $buffer->description,
                'activity_area' => $buffer->activity_area,
                'funds' => $buffer->funds,
                'employees_number' => $buffer->employees_number,
                'jobs_available_number' => $buffer->jobs_available_number,
                'women_number' => $buffer->women_number,
                'revenues' => $buffer->revenues,
            ]);

            if ($newActor) {

                $newActor->save();

                $buffer = Buffer::destroy($request->id);

                return response()->json(["message" => "Buffer validate"], 200);
            } else {
                return response()->json(["message" => "Nothing finded"], 401);
            }

            return response()->json(['Message' => ["Actor created" => $buffer->id]], 200);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        try {
            $start_up_total = Actor::where('category', 'like', 'startUp')->get()->count();
            $funds_total = (int) Actor::sum('funds');
            $employees_number_total = (int) Actor::sum('employees_number');
            $jobs_number_total = (int) Actor::sum('jobs_available_number');
            $women_number_total = (int) Actor::sum('women_number');
            $revenues_total = (int) Actor::sum('revenues');
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
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

        try {

            $actor = Actor::find($request->id);



            if (!isset($request->name)) {
                $actor->name = $actor->name;
            } else {
                $actor->name = $request->name;
            }
            if (!isset($request->adress)) {
                $actor->adress = $actor->adress;
            } else {
                $actor->adress = $request->adress;
            }
            if (!isset($request->postal_code)) {
                $actor->postal_code = $actor->postal_code;
            } else {
                $actor->postal_code = $request->postal_code;
            }
            if (!isset($request->city)) {
                $actor->city = $actor->city;
            } else {
                $actor->city = $request->city;
            }
            if (!isset($request->email)) {
                $actor->email = $actor->email;
            } else {
                $actor->email = $request->email;
            }
            if (!isset($request->phone)) {
                $actor->phone = $actor->phone;
            } else {
                $actor->phone = $request->phone;
            }
            if (!isset($request->category)) {
                $actor->category = $actor->category;
            } else {
                $actor->category = $request->category;
            }
            if (!isset($request->associations)) {
                $actor->associations = $actor->associations;
            } else {
                $actor->associations = $request->associations;
            }
            if (!isset($request->description)) {
                $actor->description = $actor->description;
            } else {
                $actor->description = $request->description;
            }
            if (!isset($request->facebook)) {
                $actor->facebook = $actor->facebook;
            } else {
                $actor->facebook = $request->facebook;
            }
            if (!isset($request->linkedin)) {
                $actor->linkedin = $actor->linkedin;
            } else {
                $actor->linkedin = $request->linkedin;
            }
            if (!isset($request->twitter)) {
                $actor->twitter = $actor->twitter;
            } else {
                $actor->twitter = $request->twitter;
            }
            if (!isset($request->website)) {
                $actor->website = $actor->website;
            } else {
                $actor->website = $request->website;
            }
            if (!isset($request->activity_area)) {
                $actor->activity_area = $actor->activity_area;
            } else {
                $actor->activity_area = $request->activity_area;
            }
            if (!isset($request->funds)) {
                $actor->funds = $actor->funds;
            } else {
                $actor->funds = $request->funds;
            }
            if (!isset($request->employees_number)) {
                $actor->employees_number = $actor->employees_number;
            } else {
                $actor->employees_number = $request->employees_number;
            }
            if (!isset($request->women_number)) {
                $actor->women_number = $actor->women_number;
            } else {
                $actor->women_number = $request->women_number;
            }
            if (!isset($request->revenues)) {
                $actor->revenues = $actor->revenues;
            } else {
                $actor->revenues = $request->revenues;
            }

            $actor->save();
            return response()->json(["body" => $actor], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $actors = Actor::all();
            $deletActor = Actor::find($request->id)->delete();
            return response()->json(['body' => ['Actor deleted' => $deletActor, "Actor" => $actors]], 200);
        } catch (\Throwable $th) {
            return response()->json(['body' => $th], 401);
        }
    }

    /**
     * SEND DELETE DEMANDE
     */
    public function sendDelete()
    {

        try {
            $id = Auth::user()->id;
            $actor = Actor::find($id);

            $send = Buffer::create([
                'actor_id' => $id,
                'type_of_demand' => 'delete',
                'name' => $actor->name,
                'email' => $actor->email,
                'logo' => $actor->logo,
                'adress' => $actor->adress,
                'postal_code' => $actor->postal_code,
                'city' => $actor->city,
                'longitude' => $actor->longitude,
                'latitude' => $actor->latitude,
                'phone' => $actor->phone,
                'category' => $actor->category,
                'associations' => $actor->associations,
                'description' => $actor->description,
                'facebook' => $actor->facebook,
                'twitter' => $actor->twitter,
                'linkedin' => $actor->linkedin,
                'website' => $actor->website,
                'activity_area' => $actor->activity_area,
                'funds' => $actor->funds,
                'employees_number' => $actor->employees_number,
                'jobs_available_number' => $actor->jobs_available_number,
                'women_number' => $actor->women_number,
                'revenues' => $actor->revenues,
            ]);
            return response()->json(["body" => ["Message" => "succès", $send]], 201);
        } catch (\Throwable $th) {
            return response()->json(["Body" => ["Message" => $th]], 401);
        }
    }

    /**
     * SEND UPDATE DEMANDE
     */
    public function sendUpdate(Request $request)
    {

        try {
            $id = Auth::user()->id;
            $actor = Actor::find($id);
            if (!empty($request->logo)) {
                $image_64 = $request->logo; //Base64
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);
                $imageName = \Str::random(10) . '.' . $extension; //nom
                \Storage::disk('public')->put($imageName, base64_decode($image));
                $LogoUrl = ENV('APP_URL') . '/storage/' . $imageName; //url complete
            } else {
                $LogoUrl = $actor->logo;
            }




            $send = Buffer::create([
                'actor_id' => $id,
                'type_of_demand' => 'update',
                'logo' => $LogoUrl,
                'name' => $request->name,
                'adress' => $request->adress,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'email' => $request->email,
                'phone' => $request->phone,
                'category' => $request->category,
                'associations' => $request->associations,
                'description' => $request->description,
                'facebook' => $request->facebook,
                'linkedin' => $request->linkedin,
                'twitter' => $request->twitter,
                'website' => $request->website,
                'activity_area' => $request->activity_area,
                'funds' => $request->funds,
                'jobs_available_number' => $request->jobs_available_number,
                'employees_number' => $request->employees_number,
                'women_number' => $request->women_number,
                'revenues' => $request->revenues,
                'jobs_available_number' => $request->jobs_available_number
            ]);



            if ($send) {
                return response()->json(["body" => ["Message" => "succès", $send]], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(["Body" => ["Message" => $th]], 401);
        }
    }
    /**
     * FUNCTION SUPPRESSION SUITE A LA DEMANDE
     */
    public function deleteDemande(Request $request)
    {

        try {
            $actor = Actor::find($request->id);
            $buffer = Buffer::where('actor_id', $actor->id)->first();
            $buffer->delete();
            $actor->delete();
            return response()->json(["body" => "success"], 201);
        } catch (\Throwable $th) {
            return response()->json(["body" => ["error" => $th]], 401);
        }
    }

    /**
     * FUNCTION MODIFICATION SUITE A LA DEMANDE
     */
    public function updateDemande(Request $request)
    {

        try {
            $buffer = Buffer::find($request->id);
            $actor = Actor::find($buffer->actor_id);

            $actor->name = $buffer->name;
            $actor->adress = $buffer->adress;
            $actor->postal_code = $buffer->postal_code;
            $actor->name = $buffer->name;
            $actor->adress = $buffer->adress;
            $actor->postal_code = $buffer->postal_code;
            $actor->city = $buffer->city;
            $actor->email = $buffer->email;
            $actor->phone = $buffer->phone;

            $actor->category = $buffer->category;

            $actor->associations = $buffer->associations;

            $actor->description = $buffer->description;

            $actor->facebook = $buffer->facebook;

            $actor->linkedin = $buffer->linkedin;

            $actor->twitter = $buffer->twitter;

            $actor->website = $buffer->website;

            $actor->activity_area = $buffer->activity_area;

            $actor->funds = $buffer->funds;

            $actor->employees_number = $buffer->employees_number;

            $actor->women_number = $buffer->women_number;

            $actor->revenues = $buffer->revenues;

            $actor->save();

            $buffer->delete();

            return response()->json(["body" => $buffer, $actor], 201);
        } catch (\Throwable $th) {
            return response()->json(["body" => ["error" => $th]], 401);
        }
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function getConnectedActor()
    {
        try {
            $data = Actor::where('id', Auth::user()->id)->first();
            $data->makeVisible(['funds', 'employees_number', 'jobs_available_number', 'women_number', 'revenues',])
                ->makeHidden(['created_at', 'updated_at']);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
        return response()->json(['body' => ['actor' => $data]], 200);
    }
}
