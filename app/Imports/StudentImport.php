<?php

namespace App\Imports;

use App\Models\StudentModel;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function headingRow() : int
    {
        return 1;
    }

    public function model(array $row)
    {
        return new StudentModel([
            
        ]);
    }
}
