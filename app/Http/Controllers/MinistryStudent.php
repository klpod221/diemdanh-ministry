<?php

namespace App\Http\Controllers;

use App\Models\StudentModel;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MinistryStudent extends Controller
{
    public function index(Request $request)
    {
        $listCourse = DB::table('course')->orderBy('courseId', 'desc')->get();
        $listMajor = DB::table('major')->where('majorStatus', '=', 0)->get();
        $listClass = DB::table('class')->where('classStatus', '=', 0)->get();

        $search = $request->get('search');
        $searchCourse = $request->get('searchCourse');
        $searchMajor = $request->get('searchMajor');
        $searchClass = $request->get('searchClass');
        $searchGender = $request->get('searchGender');

        if ($searchClass == '' && ($searchCourse != '' || $searchMajor != '')) {
            if ($searchCourse != '') {
                if ($searchMajor != '') {
                    $listClass = DB::table('classlist')->where('majorName', '=', "$searchMajor")->where('course', '=', "$searchCourse")->get();
                } else {
                    $listClass = DB::table('classlist')->where('course', '=', "$searchCourse")->get();
                }
            } else {
                $listClass = DB::table('classlist')->where('majorName', '=', "$searchMajor")->get();
            }
        }

        $listStudent = DB::table('studentlist')->get();
        if ($searchClass == '') {
            if ($searchCourse != '') {
                if ($searchMajor != '') {
                    if ($searchGender != '') {
                        if ($search != '') {
                            $listStudent = DB::table('studentlist')
                                ->where('course', '=', "$searchCourse")
                                ->where('majorName', '=', "$searchMajor")
                                ->where('gender', '=', "$searchGender")
                                ->whereRaw("(studentId like '%$search%' OR name like '%$search%')")
                                ->get();
                        } else {
                            $listStudent = DB::table('studentlist')
                                ->where('course', '=', "$searchCourse")
                                ->where('majorName', '=', "$searchMajor")
                                ->where('gender', '=', "$searchGender")
                                ->get();
                        }
                    } else {
                        if ($search != '') {
                            $listStudent = DB::table('studentlist')
                                ->where('course', '=', "$searchCourse")
                                ->where('majorName', '=', "$searchMajor")
                                ->whereRaw("(studentId like '%$search%' OR name like '%$search%')")
                                ->get();
                        } else {
                            $listStudent = DB::table('studentlist')
                                ->where('course', '=', "$searchCourse")
                                ->where('majorName', '=', "$searchMajor")
                                ->get();
                        }
                    }
                } else {
                    if ($searchGender != '') {
                        if ($search != '') {
                            $listStudent = DB::table('studentlist')
                                ->where('course', '=', "$searchCourse")
                                ->where('gender', '=', "$searchGender")
                                ->whereRaw("(studentId like '%$search%' OR name like '%$search%')")
                                ->get();
                        } else {
                            $listStudent = DB::table('studentlist')
                                ->where('course', '=', "$searchCourse")
                                ->where('gender', '=', "$searchGender")
                                ->get();
                        }
                    } else {
                        if ($search != '') {
                            $listStudent = DB::table('studentlist')
                                ->where('course', '=', "$searchCourse")
                                ->whereRaw("(studentId like '%$search%' OR name like '%$search%')")
                                ->get();
                        } else {
                            $listStudent = DB::table('studentlist')
                                ->where('course', '=', "$searchCourse")
                                ->get();
                        }
                    }
                }
            } else {
                if ($searchMajor != '') {
                    if ($searchGender != '') {
                        if ($search != '') {
                            $listStudent = DB::table('studentlist')
                                ->where('majorName', '=', "$searchMajor")
                                ->where('gender', '=', "$searchGender")
                                ->whereRaw("(studentId like '%$search%' OR name like '%$search%')")
                                ->get();
                        } else {
                            $listStudent = DB::table('studentlist')
                                ->where('majorName', '=', "$searchMajor")
                                ->where('gender', '=', "$searchGender")
                                ->get();
                        }
                    } else {
                        if ($search != '') {
                            $listStudent = DB::table('studentlist')
                                ->where('majorName', '=', "$searchMajor")
                                ->whereRaw("(studentId like '%$search%' OR name like '%$search%')")
                                ->get();
                        } else {
                            $listStudent = DB::table('studentlist')
                                ->where('majorName', '=', "$searchMajor")
                                ->get();
                        }
                    }
                } else {
                    if ($searchGender != '') {
                        if ($search != '') {
                            $listStudent = DB::table('studentlist')
                                ->where('gender', '=', "$searchGender")
                                ->whereRaw("(studentId like '%$search%' OR name like '%$search%')")
                                ->get();
                        } else {
                            $listStudent = DB::table('studentlist')
                                ->where('gender', '=', "$searchGender")
                                ->get();
                        }
                    } else {
                        if ($search != '') {
                            $listStudent = DB::table('studentlist')
                                ->whereRaw("(studentId like '%$search%' OR name like '%$search%')")
                                ->get();
                        } else {
                            $listStudent = DB::table('studentlist')
                                ->get();
                        }
                    }
                }
            }
        } else {
            $findClass = DB::table('classlist')->where('className', '=', "$searchClass")->get();
            foreach ($findClass as $item) {
                $course = $item->course;
                $major = $item->majorName;
            }

            if ($searchGender != '') {
                if ($search != '') {
                    $listStudent = DB::table('studentlist')
                        ->where('className', '=', "$searchClass")
                        ->where('gender', '=', "$searchGender")
                        ->whereRaw("(studentId like '%$search%' OR name like '%$search%')")
                        ->get();

                    return view('ministry.student.index', [
                        'listStudent' => $listStudent,
                        'listCourse' => $listCourse,
                        'listMajor' => $listMajor,
                        'listClass' => $listClass,
                        'course' => $course,
                        'major' => $major
                    ]);
                } else {
                    $listStudent = DB::table('studentlist')
                        ->where('className', '=', "$searchClass")
                        ->where('gender', '=', "$searchGender")
                        ->get();

                    return view('ministry.student.index', [
                        'listStudent' => $listStudent,
                        'listCourse' => $listCourse,
                        'listMajor' => $listMajor,
                        'listClass' => $listClass,
                        'course' => $course,
                        'major' => $major
                    ]);
                }
            } else {
                if ($search != '') {
                    $listStudent = DB::table('studentlist')
                        ->where('className', '=', "$searchClass")
                        ->whereRaw("(studentId like '%$search%' OR name like '%$search%')")
                        ->get();

                    return view('ministry.student.index', [
                        'listStudent' => $listStudent,
                        'listCourse' => $listCourse,
                        'listMajor' => $listMajor,
                        'listClass' => $listClass,
                        'course' => $course,
                        'major' => $major
                    ]);
                } else {
                    $listStudent = DB::table('studentlist')
                        ->where('className', '=', "$searchClass")
                        ->get();

                    return view('ministry.student.index', [
                        'listStudent' => $listStudent,
                        'listCourse' => $listCourse,
                        'listMajor' => $listMajor,
                        'listClass' => $listClass,
                        'course' => $course,
                        'major' => $major
                    ]);
                }
            }
        }

        return view('ministry.student.index', [
            'listStudent' => $listStudent,
            'listCourse' => $listCourse,
            'listMajor' => $listMajor,
            'listClass' => $listClass
        ]);
    }

    public function create()
    {
        $listCourse = DB::table('course')->orderBy('courseId', 'desc')->get();
        $listMajor = DB::table('major')->where('majorStatus', '=', 0)->get();
        $listClass = DB::table('class')->where('classStatus', '=', 0)->get();
        return view('ministry.student.create', [
            'listCourse' => $listCourse,
            'listMajor' => $listMajor,
            'listClass' => $listClass
        ]);
    }

    public function createStore(Request $request)
    {
        $listStudent = DB::table('student')->get();
        $count = 10000 + count($listStudent);
        $studentId = "XLU" . $count;
        $student = new StudentModel();
        $student->studentId = $studentId;
        $student->name = $request->get('name');
        $student->gender = $request->get('gender');
        $student->dateOfBirth = $request->get('dateOfBirth');
        $student->phoneNumber = $request->get('phoneNumber');
        $student->email = $request->get('email');
        $student->address = $request->get('address');
        $student->classId = $request->get('class');
        $student->studentStatus = 0;
        $student->save();

        return redirect('ministry/student');
    }

    public function edit(Request $request)
    {
        $studentId = $request->get('studentId');
        $listClass = DB::table('class')->where('classStatus', '=', 0)->get();
        $student = DB::table('studentlist')->where('studentId', '=', "$studentId")->first();
        return view('ministry.student.edit', [
            'listClass' => $listClass,
            'student' => $student,
            'studentId' => $studentId
        ]);
    }

    public function editStore(Request $request)
    {
        $studentId = $request->get('studentId');

        $student = StudentModel::where('studentId', '=', "$studentId")->first();
        $student->name = $request->get('name');
        $student->gender = $request->get('gender');
        $student->dateOfBirth = $request->get('dateOfBirth');
        $student->phoneNumber = $request->get('phoneNumber');
        $student->email = $request->get('email');
        $student->address = $request->get('address');
        $student->classId = $request->get('class');
        $student->studentStatus = 0;
        $student->save();

        return redirect('ministry/student');
    }

    public function delete(Request $request)
    {
        $studentId = $request->get('studentId');
        $student = StudentModel::where('studentId', '=', "$studentId")->first();
        $student->studentStatus = 1;
        $student->save();
        return redirect('ministry/student');
    }

    public function studentExport()
    {
        return Excel::download(new StudentExport, 'StudentList.xlsx');
    }

    public function studentImport()
    {
        $import = Excel::import(new StudentImport, request()->file('student_file'));
        return redirect('ministry/student');
    }
}
