<?php

namespace App\Imports;

use Throwable;
use App\Models\StudentModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StudentImport implements ToModel, WithHeadingRow, WithChunkReading
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
        $listStudent = DB::table('student')->get();
        $count = 10000 + count($listStudent);
        $studentId = "XLU" . $count;

        $result = DB::table('class')->select('classId')->where('className', $row['lop_hoc'])->first();
        $class = (array) $result;
        $classId = $class['classId'];
        return new StudentModel([
            'studentId' => $studentId,
            'name' => $row['ho_ten'],
            'gender' => ($row['gioi_tinh'] == 'Nam') ? 1 : 0,
            'dateOfBirth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh'])->format('Y-m-d'),
            'phoneNumber' => $row['so_dien_thoai'],
            'email' => $row['email'],
            'address' => $row['dia_chi'],
            'classId' => $classId,
            'studentStatus' => 0
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
