@extends('ministry.layouts.layout')

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">list</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Danh sách giảng viên</h4>
                <div class="toolbar">

                </div>
                <div class="material-datatables">
                    <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </thead>
                            <tfoot>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th class="text-right">Actions</th>
                            </tfoot>
                            <tbody>
                                @foreach ($listTeacher as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ ($item->gender == 0) ? 'Nam' : 'Nữ' }}</td>
                                    <td>{{ $item->dateOfBirth }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phoneNumber }}</td>
                                    <td class="text-right">
                                        action
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

        $('a.navbar-brand').text('Danh sách giảng viên');
    });
</script>
@endsection
