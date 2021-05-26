<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class VerifConnection extends Controller
{
    public function checkActor()
    {
        return response()->json(['true'], 200);
    }
    public function checkAdmin()
    {
        return response()->json(['true'], 200);
    }
}
