@extends('ministry.layouts.layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">list</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Danh sách phân công</h4>
                    <div class="toolbar">
                        <button class="btn btn-simple btn-warning btn-icon" data-toggle="modal"
                            data-target="#addAssignment">
                            <a type="button" class="btn btn-round btn-rose">Phân công</a>
                        </button>
                        <div class="modal fade" id="addAssignment" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <i class="material-icons">clear</i>
                                        </button>
                                        <h4 class="modal-title">Phân công</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('createAssignment') }}"
                                            class="form-horizontal">
                                            @csrf
                                            <div class="row">
                                                <label class="col-md-2 label-on-left">Giảng viên</label>
                                                <div class="col-md-8">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label"></label>
                                                        <select name="teacherId" class="selectpicker"
                                                            data-style="select-with-transition" data-size="7">
                                                            @foreach ($teacherList as $item)
                                                                <option value="{{ $item->teacherId }}">{{ $item->name }}
                                                                    - {{ $item->phoneNumber }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-2 label-on-left">Môn học</label>
                                                <div class="col-md-8">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label"></label>
                                                        <select name="subjectId" class="selectpicker"
                                                            data-style="select-with-transition" data-size="7">
                                                            @foreach ($subjectList as $item)
                                                                <option value="{{ $item->subjectId }}">
                                                                    {{ $item->subjectId }} - {{ $item->subjectName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-2 label-on-left">Lớp học</label>
                                                <div class="col-md-8">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label"></label>
                                                        <select name="classId" class="selectpicker"
                                                            data-style="select-with-transition" data-size="7">
                                                            @foreach ($classList as $item)
                                                                <option value="{{ $item->classId }}">{{ $item->classId }}
                                                                    - {{ $item->className }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3"></label>
                                                <div class="col-md-9">
                                                    <div class="form-group form-button">
                                                        <button type="submit" class="btn btn-fill btn-rose">Thêm</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="material-datatables">
                        <div id="datatables_warapper" class="dataTables_warapper form-inline dt-bootstrap">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                                width="100%" style="width:100%">
                                <thead>
                                    <th>Mã</th>
                                    <th>Tên giảng viên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Lớp học</th>
                                    <th>Mã môn học</th>
                                    <th>Tên môn học</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </thead>
                                <tfoot>
                                    <th>Mã</th>
                                    <th>Tên giảng viên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Lớp học</th>
                                    <th>Mã môn học</th>
                                    <th>Tên môn học</th>
                                    <th class="text-right">Actions</th>
                                </tfoot>
                                <tbody>
                                    @foreach ($assignmentList as $item)
                                        <tr>
                                            <td>{{ $item->assignmentId }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phoneNumber }}</td>
                                            <td>{{ $item->className }}</td>
                                            <td>{{ $item->subjectId }}</td>
                                            <td>{{ $item->subjectName }}</td>
                                            <td class="text-right">
                                                <button class="btn btn-simple btn-warning btn-icon" data-toggle="modal"
                                                    data-target="#editModalb{{ $item->assignmentId }}">
                                                    <a><i class="material-icons">edit</i></a>
                                                </button>
                                            </td>
                                            <div class="modal fade" id="editModalb{{ $item->assignmentId }}"
                                                tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">
                                                                <i class="material-icons">clear</i>
                                                            </button>
                                                            <h4 class="modal-title">Sửa thông tin phân công</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{ route('assignmentEdit') }}"
                                                                class="form-horizontal">
                                                                @csrf
                                                                <div class="row">
                                                                    <label class="col-md-3 label-on-left">Mã phân công</label>
                                                                    <div class="col-md-9">
                                                                        <div class="form-group label-floating is-empty">
                                                                            <label class="control-label"></label>
                                                                            <input type="text"
                                                                                value="{{ $item->assignmentId }}"
                                                                                class="form-control" disabled>
                                                                            <input type="text"
                                                                                value="{{ $item->assignmentId }}"
                                                                                name="assignmentId" hidden>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-md-3 label-on-left">Giảng viên</label>
                                                                    <div class="col-md-9">
                                                                        <div class="form-group label-floating is-empty">
                                                                            <label class="control-label"></label>
                                                                            <select name="teacherId" class="selectpicker"
                                                                                data-style="select-with-transition"
                                                                                data-size="7">
                                                                                @foreach ($teacherList as $item)
                                                                                    <option
                                                                                        value="{{ $item->teacherId }}">
                                                                                        {{ $item->name }} -
                                                                                        {{ $item->phoneNumber }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-md-3 label-on-left">Môn học</label>
                                                                    <div class="col-md-9">
                                                                        <div class="form-group label-floating is-empty">
                                                                            <label class="control-label"></label>
                                                                            <select name="subjectId" class="selectpicker"
                                                                                data-style="select-with-transition"
                                                                                data-size="7">
                                                                                @foreach ($subjectList as $item)
                                                                                    <option
                                                                                        value="{{ $item->subjectId }}">
                                                                                        {{ $item->subjectId }} -
                                                                                        {{ $item->subjectName }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-md-3 label-on-left">Lớp học</label>
                                                                    <div class="col-md-9">
                                                                        <div class="form-group label-floating is-empty">
                                                                            <label class="control-label"></label>
                                                                            <select name="classId" class="selectpicker"
                                                                                data-style="select-with-transition"
                                                                                data-size="7">
                                                                                @foreach ($classList as $item)
                                                                                    <option value="{{ $item->classId }}">
                                                                                        {{ $item->classId }} -
                                                                                        {{ $item->className }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-md-3"></label>
                                                                    <div class="col-md-9">
                                                                        <div class="form-group form-button">
                                                                            <button type="submit"
                                                                                class="btn btn-fill btn-rose">Sửa</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        </div>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 20, 30, 50, -1],
                    [10, 20, 30, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Tìm kiếm",
                }

            });

            var table = $('#datatables').DataTable();

            $('.card .material-datatables label').addClass('form-group');

            $('a.navbar-brand').text('Danh sách phân công');
        });
    </script>
@endsection
