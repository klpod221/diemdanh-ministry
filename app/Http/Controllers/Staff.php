<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Staff extends Controller
{
    public function ministryList(Request $request)
    {
        $listMinistry = DB::table('ministrylist')->get();
        return view('ministry.staff.ministry-list',[
            'listMinistry' => $listMinistry
        ]);
    }

    public function teacherList(Request $request)
    {
        $listTeacher = DB::table('teacherlist')->get();
        return view('ministry.staff.teacher-list',[
            'listTeacher' => $listTeacher
        ]);
    }
}
