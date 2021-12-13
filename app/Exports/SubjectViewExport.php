<?php

namespace App\Exports;

use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SubjectViewExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        $listSubject = DB::table('subject')->get();

        return view('ministry.subject.index', [
            'listSubjects' => $listSubject
        ]);
    }
}
