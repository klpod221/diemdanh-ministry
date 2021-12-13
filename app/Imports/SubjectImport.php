<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class SubjectImport implements ToModel, WithHeadingRow, WithChunkReading, SkipsOnError
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
        return new Subject([
            'subjectId' => $row['ma'],
            'subjectName' => $row['ten_mon_hoc'],
            'timeLimit' => $row['thoi_luong']
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function onError(Throwable $error)
    {
    }
}
