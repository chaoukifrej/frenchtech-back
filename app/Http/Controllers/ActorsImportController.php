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
        Excel::import(new ActorsImport, $file);
        return response()->json(['status' => 'success'], 200);
    }
    /*
    public function test()
    {

        $adress = '324 boulevard de la madeleine Nice 06000';
        $url = 'https://api-adresse.data.gouv.fr/search/?q=' . $adress;
        $client = new \GuzzleHttp\Client();
        $request = $client->get($url);
        $response = $request->getBody();
        $response =  json_decode($response);
        echo $response->features[0]->geometry->coordinates[1];
        //echo $response->features[0]->properties->y;
        echo json_encode($response);
    } */
}
