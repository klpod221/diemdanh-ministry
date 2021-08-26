<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $assignmentList = DB::table('assignmentlist')->where('status','0')->get();
        $teacherList = DB::table('teacherlist')->get();
        $subjectList = DB::table('subject')->get();
        $classList = DB::table('classlist')->get();

        return view('ministry.assignment.index',[
            'assignmentList' => $assignmentList,
            'teacherList' => $teacherList,
            'subjectList' => $subjectList,
            'classList' => $classList
        ]);
    }

    public function create(Request $request)
    {
        $classId = $request->get('classId');
        $subjectId = $request->get('subjectId');
        $teacherId = $request->get('teacherId');

        $assignment = new Assignment();
        $assignment->classId = $classId;
        $assignment->subjectId = $subjectId;
        $assignment->teacherId = $teacherId;
        $assignment->status = 0;
        $assignment->save();

        return redirect()->route('assignmentList');
    }

    public function edit(Request $request)
    {
        $assignmentId = $request->get('assignmentId');
        $classId = $request->get('classId');
        $subjectId = $request->get('subjectId');
        $teacherId = $request->get('teacherId');

        $assignment = Assignment::where('assignmentId','=',"$assignmentId")->first();
        $assignment->classId = $classId;
        $assignment->subjectId = $subjectId;
        $assignment->teacherId = $teacherId;
        $assignment->save();

        return redirect()->route('assignmentList');
    }
}
