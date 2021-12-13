<?php

namespace App\Exports;

use App\Models\StudentModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        return DB::table('studentlist')
            ->select('studentId', 'name', DB::raw("CASE gender WHEN 0 THEN 'Nam' WHEN 1 THEN 'Nữ' END AS gender"), 'dateOfBirth', 'phoneNumber', 'email', 'address', 'className', 'majorName', 'course')
            ->get();
    }

    public function headings(): array
    {
        return ['Mã', 'Họ tên', 'Giới tính', 'Ngày sinh', 'Số điện thoại', 'Email', 'Địa chỉ', 'Lớp học', 'Chuyên ngành', 'Niên khóa'];
    }
}
