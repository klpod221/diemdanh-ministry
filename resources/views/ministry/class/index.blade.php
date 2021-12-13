@extends('ministry.layouts.layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">list</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Danh sách lớp học</h4>
                    <a href="{{ route('classCreate') }}" type="button" class="btn btn-round btn-rose">Thêm lớp học</a>
                    <a href="{{ route('classExport') }}" type="button" class="btn btn-round btn-blue">Xuất ra file</a>
                    <div class="toolbar">
                        <div class="row">
                            <form action="class" class="navbar-form" role="search" method="get" id="searchForm">
                                <div class="col-xs-4">
                                    <select name="searchCourse" class="selectpicker" data-style="btn btn-rose btn-round" data-size="7">
                                        <option value="" selected>Niên khóa</option>
                                        @foreach ($listCourse as $item)
                                            <option value="{{ $item->courseId }}"
                                                @if (isset($_GET["searchCourse"]) && $_GET["searchCourse"] == $item->courseId)
                                                    selected="selected"
                                                @endif>
                                                K{{ $item->courseId }} - {{ $item->schoolYear }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-4">
                                    <select name="searchMajor" class="selectpicker" data-style="btn btn-rose btn-round" data-size="7">
                                        <option value="" selected>Chuyên ngành</option>
                                        @foreach ($listMajor as $item)
                                            <option value="{{ $item->majorName }}"
                                                @if (isset($_GET["searchMajor"]) && $_GET["searchMajor"] == $item->majorName)
                                                    selected="selected"
                                                @endif>
                                                {{ $item->majorName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group form-search">
                                        <input name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" type="text" class="form-control" placeholder="Tìm kiếm mã lớp hoặc tên lớp">
                                        <span class="material-input"></span>
                                    </div>

                                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                        <i class="material-icons">search</i>
                                        <div class="ripple-container"></div>
                                    </button>

                                    <a href="{{ route('classList') }}" class="btn btn-white btn-round btn-just-icon">
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
                                    <th>Mã lớp</th>
                                    <th>Tên lớp</th>
                                    <th>Chuyên ngành</th>
                                    <th>Niên khóa</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </thead>
                                <tfoot>
                                    <th>Mã lớp</th>
                                    <th>Tên lớp</th>
                                    <th>Chuyên ngành</th>
                                    <th>Niên khóa</th>
                                    <th class="text-right">Actions</th>
                                </tfoot>
                                <tbody>
                                    @foreach ($listClass as $item)
                                        <tr>
                                            <td>{{ $item->classId }}</td>
                                            <td>{{ $item->className }}</td>
                                            <td>{{ $item->majorName }}</td>
                                            <td>K{{ $item->course }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('studentList', ['searchClass'=>$item->className]) }}" class="btn btn-simple btn-icon edit"><i class="material-icons">source</i></a>
                                                <a href="class-edit/{{ $item->classId }}" class="btn btn-simple btn-warning btn-icon"><i class="material-icons">edit</i></a>
                                                <button class="btn btn-simple btn-danger btn-icon" data-toggle="modal" data-target="#smallAlertModal{{ $item->classId }}">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <div class="modal fade" id="smallAlertModal{{ $item->classId }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-small ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <h5>Thao tác không thể hoàn tác!!!<br>Bạn có chắc chắn muốn xóa? </h5>
                                                            </div>
                                                            <div class="modal-footer text-center">
                                                                <button class="btn btn-danger" onclick="window.location.href='class/delete/{{ $item->classId }}'">Yes</button>
                                                                <button class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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

        $('a.navbar-brand').text('Danh sách lớp học');
    });
</script>
@endsection
