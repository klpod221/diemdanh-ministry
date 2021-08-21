@extends('ministry.layouts.layout')

@section('main')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">list</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Danh sách niên khóa</h4>
                <div class="toolbar">
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-rose" data-toggle="modal" data-target="#alerCourse">Thêm khóa</button>
                            <div class="modal fade" id="alerCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-small ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <h5>Thao tác không thể hoàn tác!!!<br>Bạn có chắc chắn muốn thêm? </h5>
                                        </div>
                                        <div class="modal-footer text-center">
                                            <button class="btn btn-danger" onclick="window.location.href='{{ route('createCourse') }}'">Yes</button>
                                            <button class="btn btn-success" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="material-datatables">
                    <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <table id="datatablesCourse" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <th>Niên khóa</th>
                                <th>Năm học</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </thead>
                            <tfoot>
                                <th>Niên khóa</th>
                                <th>Năm học</th>
                                <th class="text-right">Actions</th>
                            </tfoot>
                            <tbody>
                                @foreach ($listCourse as $item)
                                    <tr>
                                        <td>K{{ $item->courseId }}</td>
                                        <td>{{ $item->schoolYear }}</td>
                                        <td class="text-right">
                                            <a href="class?searchCourse={{ $item->courseId }}" class="btn btn-simple btn-infor btn-icon edit"><i class="material-icons">source</i></a>
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">list</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Danh sách chuyên ngành</h4>
                <div class="toolbar">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('createMajor') }}" type="button" class="btn btn-rose">Thêm chuyên ngành</a>
                        </div>
                    </div>
                </div>
                <div class="material-datatables">
                    <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <table id="datatablesMajor" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <th>Mã chuyên ngành</th>
                                <th>Tên chuyên ngành</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </thead>
                            <tfoot>
                                <th>Mã chuyên ngành</th>
                                <th>Tên chuyên ngành</th>
                                <th class="text-right">Actions</th>
                            </tfoot>
                            <tbody>
                                @foreach ($listMajor as $item)
                                    <tr>
                                        <td>{{ $item->majorId }}</td>
                                        <td>{{ $item->majorName }}</td>
                                        <td class="text-right">
                                            <a href="class?searchMajor={{ $item->majorName }}" class="btn btn-simple btn-infor btn-icon"><i class="material-icons">source</i></a>
                                            <a href="major/edit/{{ $item->majorId }}" class="btn btn-simple btn-warning btn-icon"><i class="material-icons">edit</i></a>
                                            {{-- <button type="button" class="btn btn-simple btn-danger btn-icon" data-toggle="modal" data-target="#alerMajor{{ $item->majorId }}"><i class="material-icons">close</i></button>
                                            <div class="modal fade" id="alerMajor{{ $item->majorId }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-small ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h5>Thao tác không thể hoàn tác!!!<br>Bạn có chắc chắn muốn xóa? </h5>
                                                        </div>
                                                        <div class="modal-footer text-center">
                                                            <button class="btn btn-danger" onclick="window.location.href='major/delete/{{ $item->majorId }}'">Yes</button>
                                                            <button class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
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
        $('#datatablesCourse').DataTable({
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

        $('#datatablesMajor').DataTable({
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
    
        $('a.navbar-brand').text('Niên khóa và Chuyên ngành');
    });
</script>
@endsection