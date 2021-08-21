<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MinistryClass extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $searchCourse = $request->get('searchCourse');
        $searchMajor = $request->get('searchMajor');

        $listCourse = DB::table('course')->orderBy('courseId','desc')->get();
        $listMajors = DB::table('major')->where('majorStatus','=',0)->get();

        if($search == '')
        {
            if($searchCourse == '')
            {
                if($searchMajor == '')
                { 
                    $listClass = DB::select("SELECT * FROM classlist");
                }
                else
                {
                    $listClass = DB::select("SELECT * FROM classlist WHERE majorName = '$searchMajor'");
                }
            }
            else
            {
                if($searchMajor == '')
                { 
                    $listClass = DB::select("SELECT * FROM classlist WHERE course = $searchCourse");
                }
                else
                {
                    $listClass = DB::select("SELECT * FROM classlist WHERE (course = $searchCourse) AND (majorName = '$searchMajor')");
                }
            }
        }
        else
        {
            if($searchCourse == '')
            {
                if($searchMajor == '')
                { 
                    $listClass = DB::select("SELECT * FROM classlist WHERE ((classId like '%$search%') OR (className like '%$search%'))");
                }
                else
                {
                    $listClass = DB::select("SELECT * FROM classlist WHERE ((classId like '%$search%') OR (className like '%$search%')) AND majorName = '$searchMajor'");
                }
            }
            else
            {
                if($searchMajor == '')
                { 
                    $listClass = DB::select("SELECT * FROM classlist WHERE ((classId like '%$search%') OR (className like '%$search%')) AND course = $searchCourse");
                }
                else
                {
                    $listClass = DB::select("SELECT * FROM classlist WHERE ((classId like '%$search%') OR (className like '%$search%')) AND (course = $searchCourse) AND (majorName = '$searchMajor')");
                }
            }
        }

        return view('ministry.class.index',[
            'listClass' => $listClass,
            'listCourse' => $listCourse,
            'listMajor' => $listMajors
        ]);
    }
    
    public function create()
    {
        $listCourse = DB::table('course')->orderBy('courseId','desc')->get();
        $listMajors = DB::table('major')->where('majorStatus','=',0)->get();
        return view('ministry.class.create',[
            'listCourse' => $listCourse,
            'listMajor' => $listMajors
        ]);
    }

    public function createStore(Request $request)
    {
        $courseId = $request->get('courseId');
        $majorId = $request->get('majorId');
        
        if ($courseId < 10)
        {
            $course = 'K0' . $courseId;
        }
        else
        {
            $course = 'K' . $courseId;
        }

        $dbNum = DB::table('class')->where('courseId','=',"$courseId")->Where('majorId','=',"$majorId")->get();
        $num = '';
        if(count($dbNum) < 10)
        {
            if(count($dbNum) == 0)
            {
                $num = '01';
            }
            else
            {
                $num = '0' . (count($dbNum)+1);
            }
        }
        else
        {
            $num = count($dbNum);
        }

        $className = $majorId . $num . $course;

        $class = new ClassModel();
        $class->className = $className;
        $class->majorId = $majorId;
        $class->courseId = $courseId;
        $class->classStatus = 0;
        $class->save();

        return redirect('ministry/class');
    }

    public function edit($classId)
    {
        $listClass = DB::table('class')->Where('classId','=',"$classId")->get();
        $listCourse = DB::table('course')->orderBy('courseId','desc')->get();
        $listMajors = DB::table('major')->where('majorStatus','=',0)->get();
        foreach ($listClass as $item) {
            $majorId = $item->majorId;
            $courseId = $item->courseId;
            $className = $item->className;
        }
        return view('ministry.class.edit',[
            'listCourse' => $listCourse,
            'listMajor' => $listMajors,
            'classId' => $classId,
            'majorId' => $majorId,
            'courseId' => $courseId,
            'className' => $className
        ]);
    }

    public function editStore($classId, Request $request)
    {
        $courseId = $request->get('courseId');
        $majorId = $request->get('majorId');
        
        if ($courseId < 10)
        {
            $course = 'K0' . $courseId;
        }
        else
        {
            $course = 'K' . $courseId;
        }

        $dbNum = DB::table('class')->where('courseId','=',"$courseId")->Where('majorId','=',"$majorId")->get();
        $num = '';
        if(count($dbNum) < 10)
        {
            if(count($dbNum) == 0)
            {
                $num = '01';
            }
            else
            {
                $num = '0' . (count($dbNum)+1);
            }
        }
        else
        {
            $num = count($dbNum);
        }

        $className = $majorId . $num . $course;

        $class = ClassModel::where('classId','=',"$classId")->first();
        $class->className = $className;
        $class->majorId = $request->get('majorId');
        $class->courseId = $request->get('courseId');
        $class->save();

        return redirect('ministry/class');
    }   

    public function delete($classId)
    {
        $class = ClassModel::where('classId','=',"$classId")->first();
        $class->classStatus = 1;
        $class->save();

        $listStudent = DB::table('student')
        ->join('class','student.classId','=','class.classId')
        ->where('student.classId','=',"$classId")
        ->get();
        
        foreach ($listStudent as $item) {
            $student = StudentModel::where('classId','=',"$item->classId")->where('studentStatus','=',0)->first();
            $student->studentStatus = 1;
            $student->save();
        }
        return redirect('ministry/class');
    }
}
