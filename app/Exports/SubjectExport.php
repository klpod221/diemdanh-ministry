<?php

namespace App\Exports;

use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SubjectExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('subject')->get();
    }

    public function headings(): array
    {
        return ['Mã', 'Tên môn học', 'Thời lượng'];
    }
}
