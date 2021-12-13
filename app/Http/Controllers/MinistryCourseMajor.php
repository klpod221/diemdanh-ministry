<?php

namespace App\Http\Controllers;

use App\Exports\MajorExport;
use App\Imports\MajorImport;
use App\Models\ClassModel;
use App\Models\MajorModel;
use App\Models\CourseModel;
use App\Models\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MinistryCourseMajor extends Controller
{
    public function index()
    {
        $listCourse = DB::table('course')->get();
        $listMajor = DB::table('major')->where('majorStatus', '=', 0)->get();
        return view('ministry.course-major.index', [
            'listCourse' => $listCourse,
            'listMajor' => $listMajor
        ]);
    }

    public function createCourse()
    {
        $listCourse = DB::table('course')->get();
        $num = count($listCourse);
        $startYear = 2021 + $num;
        $endYear = $startYear + 3;
        $schoolYear = $startYear . '-' . $endYear;

        $course = new CourseModel();
        $course->schoolYear = $schoolYear;
        $course->save();

        return redirect('ministry/course-major');
    }

    public function createMajor()
    {
        return view('ministry.course-major.create-major');
    }

    public function majorStore(Request $request)
    {
        $majorId = $request->majorId;
        $majorName = $request->majorName;

        $restore = $request->restore;
        if ($restore == 'true') {
            $major = MajorModel::where('majorId', '=', "$majorId")->first();
            $major->majorStatus = 0;
            $major->majorName = $majorName;
            $major->save();

            $listClass = DB::table('class')->where('majorId', '=', "$majorId")->get();
            foreach ($listClass as $item) {
                $class = ClassModel::where('majorId', '=', "$majorId")->where('classStatus', '=', 1)->first();
                $class->classStatus = 0;
                $class->save();
            }

            $listStudent = DB::table('student')
                ->join('class', 'student.classId', '=', 'class.classId')
                ->where('majorId', '=', "$majorId")
                ->get();
            foreach ($listStudent as $item) {
                $student = StudentModel::where('classId', '=', "$item->classId")->where('studentStatus', '=', 1)->first();
                $student->studentStatus = 0;
                $student->save();
            }

            return redirect('ministry/course-major');
        }

        $findMajor = DB::table('major')->where('majorId', '=', "$majorId")->get();

        if (count($findMajor) > 0) {
            $check = false;
            foreach ($findMajor as $item) {
                if ($item->majorStatus == 1) {
                    $check = true;
                }
            }

            if ($check) {
                return redirect("ministry/course-major/create-major?majorId=$majorId&majorName=$majorName&error=4");
            } else {
                return redirect("ministry/course-major/create-major?majorId=$majorId&majorName=$majorName&error=3");
            }
        } else {
            $major = new MajorModel();
            $major->majorId = $majorId;
            $major->majorName = $majorName;
            $major->majorStatus = 0;
            $major->save();

            return redirect('ministry/course-major');
        }
    }

    public function majorEdit($majorId)
    {
        $listMajor = DB::table('major')->where('majorStatus', '=', 0)->where('majorId', '=', "$majorId")->get();
        foreach ($listMajor as $item) {
            $majorId = $item->majorId;
            $majorName = $item->majorName;
        }

        return view('ministry.course-major.major-edit', [
            'majorId' => $majorId,
            'majorName' => $majorName
        ]);
    }

    public function majorEditStore(Request $request)
    {
        $majorId = $request->majorId;
        $majorName = $request->majorName;

        $findMajor = DB::table('major')->where('majorStatus', '=', 0)->where('majorName', '=', "$majorName")->get();

        if (count($findMajor) > 0) {
            return redirect("ministry/major/edit/$majorId?error=2");
        } else {
            $major = MajorModel::where('majorId', '=', "$majorId")->first();
            $major->majorName = $request->get('majorName');
            $major->save();
            return redirect('ministry/course-major');
        }
    }

    public function majorDelete($majorId)
    {
        $major = MajorModel::where('majorId', '=', "$majorId")->first();
        $major->majorStatus = 1;
        $major->save();

        $listClass = DB::table('class')->where('majorId', '=', "$majorId")->get();
        foreach ($listClass as $item) {
            $class = ClassModel::where('majorId', '=', "$majorId")->where('classStatus', '=', 0)->first();
            $class->classStatus = 1;
            $class->save();
        }

        $listStudent = DB::table('student')
            ->join('class', 'student.classId', '=', 'class.classId')
            ->where('majorId', '=', "$majorId")
            ->get();
        foreach ($listStudent as $item) {
            $student = StudentModel::where('classId', '=', "$item->classId")->where('studentStatus', '=', 0)->first();
            $student->studentStatus = 1;
            $student->save();
        }

        return redirect('ministry/course-major');
    }

    public function majorExport()
    {
        return Excel::download(new MajorExport, 'MajorList.xlsx');
    }

    public function majorImport()
    {
        $import = Excel::import(new MajorImport, request()->file('major_file'));
        return redirect('ministry/course-major');
    }
}
