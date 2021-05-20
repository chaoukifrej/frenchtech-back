<?php

namespace App\Http\Controllers;

use App\Exports\ActorsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ActorsExportController extends Controller
{
    public function export()
    {
        return new ActorsExport;
    }
}
