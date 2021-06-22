@extends('ministry.layouts.layout')

@section('main')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">add</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Chỉnh sửa thông tin sinh viên {{ $studentId }}</h4>
                <form method="get" action="{{ route('editStudentStore') }}" class="form-horizontal">
                    <input type="hidden" name="studentId" value="{{ $studentId }}">
                    <div class="row">
                        <label class="col-sm-2 label-on-left"> Họ và tên</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating">
                                <label class="control-label"></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Giới tính</label>
                        <div class="col-sm-10 checkbox-radios">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="0" {{ ($student->gender == 0) ? 'checked' : '' }}> Nam
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="1" {{ ($student->gender == 1) ? 'checked' : '' }}> Nữ
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Ngày sinh</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating">
                                <label class="control-label"></label>
                                <input type="text" name="dateOfBirth" id="dateOfBirth" class="form-control dob" placeholder="YYYY-MM-DD" value="{{ $student->dateOfBirth }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Số điện thoại</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating">
                                <label class="control-label"></label>
                                <input type="number" name="phoneNumber" id="phoneNumber" class="form-control" value="{{ $student->phoneNumber }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Email</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating">
                                <label class="control-label"></label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $student->email }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Địa chỉ</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating">
                                <label class="control-label"></label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $student->address }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Chọn lớp học</label>
                        <div class="col-sm-10">
                            <div class="col-md-4">
                                <div class="form-group label-floating is-empty" id="class">
                                    <label class="control-label"></label>
                                    <select name="class" class="selectpicker" data-style="btn btn-rose btn-round" data-size="7" required>
                                        @foreach ($listClass as $item)
                                        <option {{ ($student->className == $item->className) ? ' selected="selected"' : '' }}
                                            value="{{ $item->classId }}">
                                            {{ $item->className }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="btn-submit" class="btn btn-rose">submit</button>
                    <a href="{{ route('classList') }}"class="btn btn-rose">back</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dob').datetimepicker({
                format: 'YYYY-MM-DD',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });

            document.getElementById('pathInput').value = "student";
            $('a.navbar-brand').text('Chỉnh sửa thông tin sinh viên');
        });
    </script>
@endsection
