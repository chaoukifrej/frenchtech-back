<?php

namespace App\Http\Controllers;

use App\Exports\BuffersExportRegister;
use App\Exports\BuffersExportModify;
use App\Exports\BuffersExportDelete;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BuffersExportController extends Controller
{
    public function exportRegister()
    {
        return new BuffersExportRegister;
    }
    public function exportModify()
    {
        return new BuffersExportModify;
    }
    public function exportDelete()
    {
        return new BuffersExportDelete;
    }
}
