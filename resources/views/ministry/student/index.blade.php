@extends('ministry.layouts.layout')

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">list</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Danh sách sinh viên</h4>
                <a href="{{ route('createStudent') }}" type="button" class="btn btn-round btn-rose">Thêm sinh viên</a>
                <div class="toolbar">
                    <div class="row">
                        <form action="{{ route('studentList') }}" class="navbar-form" role="search" method="get" id="searchForm">
                            <div class="col-xs-2" onclick="clearClassSelect()">
                                <select name="searchCourse" onchange="submit()" class="selectpicker" data-style="btn btn-rose btn-round" data-size="7">
                                    <option value="" selected>Niên khóa</option>
                                    @foreach ($listCourse as $item)
                                    <option value="{{ $item->courseId }}"
                                        @if (isset($course) && $course == $item->courseId)
                                            selected="selected"
                                        @else
                                            @if (isset($_GET["searchCourse"]) && $_GET["searchCourse"] == $item->courseId)
                                                selected="selected"
                                            @endif
                                        @endif>
                                        K{{ $item->courseId }} - {{ $item->schoolYear }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-2" onclick="clearClassSelect()">
                                <select name="searchMajor" onchange="submit()" class="selectpicker" data-style="btn btn-rose btn-round" data-size="7">
                                    <option value="" selected>Chuyên ngành</option>
                                    @foreach ($listMajor as $item)
                                    <option value="{{ $item->majorName }}"
                                        @if (isset($major) && $major == $item->majorName)
                                            selected="selected"
                                        @else
                                            @if (isset($_GET["searchMajor"]) && $_GET["searchMajor"] == $item->majorName)
                                                selected="selected"
                                            @endif
                                        @endif>
                                        {{ $item->majorName }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <select name="searchClass" id="classSelect" onchange="submit()" class="selectpicker" data-style="btn btn-rose btn-round" data-size="7">
                                    <option value="" selected>Lớp học</option>
                                    @foreach ($listClass as $item)
                                    <option value="{{ $item->className }}"
                                        @if (isset($_GET["searchClass"]) && $_GET["searchClass"] == $item->className)
                                            selected="selected"
                                        @endif>
                                        {{ $item->className }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <select name="searchGender" onchange="submit()" class="selectpicker" data-style="btn btn-rose btn-round" data-size="7">
                                    <option value="" selected>Giới tính</option>
                                    <option value="0" @if (isset($_GET["searchGender"]) && $_GET["searchGender"] == 0) selected="selected" @endif>Nam</option>
                                    <option value="1" @if (isset($_GET["searchGender"]) && $_GET["searchGender"] == 1) selected="selected" @endif>Nữ</option>
                                </select>
                            </div>

                            <div class="col-xs-4">
                                <div class="form-group form-search">
                                    <input name="search" onchange="submit()" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" type="text" class="form-control" placeholder="Tìm kiếm mã hoặc tên sinh viên">
                                    <span class="material-input"></span>
                                </div>

                                <button type="submit" onclick="submit()" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>

                                <a href="#" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">clear</i>
                                    <div class="ripple-container"></div>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="material-datatables">
                    <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <th>Mã sinh viên</th>
                                <th>Họ và tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Lớp học</th>
                                <th>Chuyên ngành</th>
                                <th>Niên khóa</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </thead>
                            <tfoot>
                                <th>Mã sinh viên</th>
                                <th>Họ và tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Lớp học</th>
                                <th>Chuyên ngành</th>
                                <th>Niên khóa</th>
                                <th class="text-right">Actions</th>
                            </tfoot>
                            <tbody>
                                @foreach ($listStudent as $item)
                                    <tr>
                                        <td>{{ $item->studentId }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ ($item->gender == 0) ? 'Nam' : 'Nữ' }}</td>
                                        <td>{{ $item->dateOfBirth }}</td>
                                        <td>{{ $item->className }}</td>
                                        <td>{{ $item->majorName }}</td>
                                        <td>K{{ $item->course }}</td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-simple btn-infor btn-icon" data-toggle="modal" data-target="#student{{ $item->studentId }}Info"><i class="material-icons">source</i></button>
                                            <a href="{{ route('editStudent', ['studentId'=>$item->studentId]) }}" class="btn btn-simple btn-warning btn-icon"><i class="material-icons">edit</i></a>
                                            <button class="btn btn-simple btn-danger btn-icon" data-toggle="modal" data-target="#smallAlertModal{{ $item->studentId }}">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <div class="modal fade" id="smallAlertModal{{ $item->studentId }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-small ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h5>Thao tác không thể hoàn tác!!!<br>Bạn có chắc chắn muốn xóa? </h5>
                                                        </div>
                                                        <div class="modal-footer text-center">
                                                            <button class="btn btn-danger" onclick="window.location.href='{{ route('deleteStudent', ['studentId' => $item->studentId]) }}'">Yes</button>
                                                            <button class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Student Information --}}
                                        <div class="modal fade" id="student{{ $item->studentId }}Info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            <i class="material-icons">clear</i>
                                                        </button>
                                                        <h3 class="modal-title">Thông tin sinh viên {{ $item->studentId }}</Thông>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <label class="col-sm-3 label-on-left"><h4> Họ tên: </h4></label>
                                                                <label class="col-sm-9 label-on-right"><h4> {{ $item->name }} </h4></label>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-3 label-on-left"><h4> Giới tính: </h4></label>
                                                                <label class="col-sm-9 label-on-right"><h4> {{ ($item->gender == 0) ? 'Nam' : 'Nữ' }} </h4></label>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-3 label-on-left"><h4> Ngày sinh: </h4></label>
                                                                <label class="col-sm-9 label-on-right"><h4> {{ $item->dateOfBirth }} </h4></label>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-3 label-on-left"><h4> Lớp học: </h4></label>
                                                                <label class="col-sm-9 label-on-right"><h4> {{ $item->className }} </h4></label>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-3 label-on-left"><h4> Số điện thoại: </h4></label>
                                                                <label class="col-sm-9 label-on-right"><h4> {{ $item->phoneNumber }} </h4></label>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-3 label-on-left"><h4> Email: </h4></label>
                                                                <label class="col-sm-9 label-on-right"><h4> {{ $item->email }} </h4></label>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-3 label-on-left"><h4> Địa chỉ: </h4></label>
                                                                <label class="col-sm-9 label-on-right"><h4> {{ $item->address }} </h4></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('editStudent', ['studentId'=>$item->studentId]) }}" type="button" class="btn btn-defaut">Chỉnh sửa</a>
                                                        <button type="button" class="btn btn-danger btn-defaut" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Student Information --}}
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
    function clearClassSelect()
    {
        document.getElementById('classSelect').value = '';
    }

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

        $('a.navbar-brand').text('Danh sách sinh viên');
    });
</script>
@endsection
