<?php

namespace App\Exports;

use App\Models\ClassModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClassExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('classlist')
            ->select('className', 'majorName', 'course')
            ->get();
    }

    public function headings(): array
    {
        return ['Tên lớp', 'Chuyên ngành', 'Niên khóa'];
    }
}
