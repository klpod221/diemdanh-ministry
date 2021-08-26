@extends('ministry.layouts.layout')

@section('main')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">list</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Danh sách môn học</h4>
                    <div class="toolbar">
                        <div class="row">
                            <form action="{{ route('subjectList') }}" class="navbar-form" role="search" method="get" id="searchForm">
                                <div class="col-xs-12">
                                    <div class="form-group form-search">
                                        <input name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" type="text" class="form-control" placeholder="Tìm kiếm">
                                        <span class="material-input"></span>
                                    </div>

                                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                        <i class="material-icons">search</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="material-datatables">
                        <div id="datatables_warapper" class="dataTables_warapper form-inline dt-bootstrap">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                                width="100%" style="width:100%">
                                <thead>
                                    <th>Mã môn học</th>
                                    <th>Tên môn học</th>
                                    <th>Thời lượng</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </thead>
                                <tfoot>
                                    <th>Mã môn học</th>
                                    <th>Tên môn học</th>
                                    <th>Thời lượng</th>
                                    <th class="text-right">Actions</th>
                                </tfoot>
                                <tbody>
                                    @foreach ($listSubject as $item)
                                        <tr>
                                            <td>{{ $item->subjectId }}</td>
                                            <td>{{ $item->subjectName }}</td>
                                            <td>{{ $item->timeLimit }}</td>
                                            <td class="text-right">
                                                <button class="btn btn-simple btn-warning btn-icon" data-toggle="modal" data-target="#editModalb{{ $item->subjectId }}">
                                                    <a><i class="material-icons">edit</i></a>
                                                </button>
                                            </td>
                                            <div class="modal fade" id="editModalb{{ $item->subjectId }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                <i class="material-icons">clear</i>
                                                            </button>
                                                            <h4 class="modal-title">Sửa thông tin môn học</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{ route('subjectEdit') }}" class="form-horizontal">
                                                                @csrf
                                                                <div class="row">
                                                                    <label class="col-md-4 label-on-left">Mã môn học</label>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group label-floating is-empty">
                                                                            <label class="control-label"></label>
                                                                            <input type="text" value="{{ $item->subjectId }}" class="form-control" disabled>
                                                                            <input type="text" value="{{ $item->subjectId }}" name="subjectId" hidden>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-md-4 label-on-left">Tên môn học</label>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group label-floating is-empty">
                                                                            <label class="control-label"></label>
                                                                            <input type="text" value="{{ $item->subjectName }}" name="subjectName" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-md-4 label-on-left">Thời lượng</label>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group label-floating is-empty">
                                                                            <label class="control-label"></label>
                                                                            <input type="number" value="{{ $item->timeLimit }}" name="timeLimit" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-md-4"></label>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group form-button">
                                                                            <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Thêm môn học</h4>
                    <form method="post" action="{{ route('subjectInsert') }}" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <label class="col-md-4 label-on-left">Mã môn học</label>
                            <div class="col-md-8">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="text" name="subjectId" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4 label-on-left">Tên môn học</label>
                            <div class="col-md-8">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="text" name="subjectName" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4 label-on-left">Thời lượng</label>
                            <div class="col-md-8">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="number" name="timeLimit" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4"></label>
                            <div class="col-md-8">
                                <div class="form-group form-button">
                                    <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
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

            $('a.navbar-brand').text('Danh sách môn học');
        });
    </script>
@endsection
