<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActorsImportController extends Controller
{
    public function store(Request $request)
    {
        $excel = $request->excelFile; //Base64
        \Storage::disk('public')->put("excel.xlsx", base64_decode($excel));
        $excelUrl = ENV('APP_URL') . '/storage/excel.xlsx'; //url complete


        return response()->json(['acces' => $excelUrl], 200);
    }
    public function storeMe(Request $request)
    {

        $excelName = 'excel.xlsx';
        $path = $request->file('excel')->storeAs('excel', $excelName, 'local');
        $excelUrl = url("/" . $excelName);
        return response()->json(['status' => "successfully uploaded"], 200);


        /* $excel = $request->excelFile; //Base64
        \Storage::disk('public')->put("excel.xlsx", base64_decode($excel));
        $excelUrl = ENV('APP_URL') . '/storage/excel.xlsx'; //url complete */
        //return response()->json(['acces' => $excelUrl], 200);
    }
}
