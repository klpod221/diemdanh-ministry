<?php

namespace App\Imports;

use App\Models\MajorModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class MajorImport implements ToModel, WithHeadingRow, WithChunkReading, SkipsOnError
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
        return new MajorModel([
            'majorId' => $row['ma'],
            'majorName' => $row['ten_chuyen_nganh'],
            'majorStatus' => 0
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
