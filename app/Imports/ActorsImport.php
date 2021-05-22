<?php

namespace App\Imports;

use App\Actor;
use Maatwebsite\Excel\Concerns\ToModel;

class ActorsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Actor([
            //
        ]);
    }
}
