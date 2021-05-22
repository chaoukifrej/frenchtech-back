<?php

namespace App\Http\Controllers;

use App\Exports\ActorsExport;
use App\Exports\ActorsExportPublic;
use App\Exports\ActorsExportPrivate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ActorsExportController extends Controller
{
    public function export()
    {
        return new ActorsExport;
    }
    public function exportPublic()
    {
        return new ActorsExportPublic;
    }
    public function exportPrivate()
    {
        return new ActorsExportPrivate;
    }
}
