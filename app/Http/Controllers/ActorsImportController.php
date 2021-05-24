<?php

namespace App\Http\Controllers;

use App\Imports\ActorsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ActorsImportController extends Controller
{
    public function template()
    {
        return response()->download(\public_path("storage/templateActeurs.xlsx"), 'template.xlsx', ['Content-Type' => 'application/xlsx']);
    }

    public function store(Request $request)
    {
        $file = $request->file('excel')->storeAs('excel', "excel.xlsx", 'local');
        //Excel::import(new ActorsImport, $file);
        $import = new ActorsImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return response()->json(['errors' => $import->failures()], 206);
        } else {
            return response()->json(['status' => "success"], 200);
        }
    }
}
