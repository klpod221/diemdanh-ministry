<?php

namespace App\Imports;

use App\Models\ClassModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Throwable;

class ClassImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function headingRow(): int
    {
        return 1;
    }

    public function model(array $row)
    {
        return new ClassModel([
            'className' => $row['ten_lop'],
            'majorId' => $row['chuyen_nganh'],
            'courseId' => $row['nien_khoa'],
            'classStatus' => 0
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    // public function onError(Throwable $error)
    // {
    // }
}
