<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActorsImportController extends Controller
{
    public function store(Request $request)
    {

        $excelName = 'excel.xlsx';
        $path = $request->file('excel')->storeAs('excel', $excelName, 'local');
        $excelUrl = url("/" . $excelName);
        return response()->json(['status' => "successfully uploaded"], 200);
    }
}
