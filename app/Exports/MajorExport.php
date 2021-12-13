<?php

namespace App\Exports;

use App\Models\MajorModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MajorExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('major')->select('majorId', 'majorName')->where('majorStatus', 0)->get();
    }

    public function headings(): array
    {
        return ['Mã', 'Tên chuyên ngành'];
    }
}
