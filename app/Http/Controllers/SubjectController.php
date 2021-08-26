<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function subjectList(Request $request)
    {
        $listSubject = DB::table('subject')->get();

        $search = $request->get('search');
        if($search != '')
        {
            $listSubject = DB::table('subject')->whereRaw("(subjectId like '%$search%') OR (subjectName like '%$search%') OR (timeLimit like '%$search')")->get();
        }
        return view('ministry.subject.index',[
            'listSubject' => $listSubject
        ]);
    }

    public function insert(Request $request)
    {
        $subjectId = $request->get('subjectId');
        $subjectName = $request->get('subjectName');
        $timeLimit = $request->get('timeLimit');

        $subject = new Subject();
        $subject->subjectId = $subjectId;
        $subject->subjectName = $subjectName;
        $subject->timeLimit = $timeLimit;
        $subject->save();

        return redirect()->route('subjectList');
    }

    public function edit(Request $request)
    {
        $subjectId = $request->get('subjectId');
        $subjectName = $request->get('subjectName');
        $timeLimit = $request->get('timeLimit');

        $subject = Subject::where('subjectId', $subjectId)->first();
        $subject->subjectName = $subjectName;
        $subject->timeLimit = $timeLimit;
        $subject->save();

        return redirect()->route('subjectList');
    }
}
