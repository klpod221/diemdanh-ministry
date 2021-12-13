@extends('ministry.layouts.layout')

@section('main')
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">add</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Thêm lớp học</h4>
                <form method="post" action="class-create/store">
                    @csrf
                    <select name="majorId" class="selectpicker" data-style="select-with-transition" title="Chuyên ngành" data-size="10" required>
                        @foreach ($listMajor as $item)
                            <option value="{{ $item->majorId }}">{{ $item->majorName }}</option>
                        @endforeach
                    </select>
                    <select name="courseId" class="selectpicker" data-style="select-with-transition" title="Niên khóa" data-size="10" required>
                        @foreach ($listCourse as $item)
                            <option value="{{ $item->courseId }}">K{{ $item->courseId }} - {{ $item->schoolYear }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                    <a href="{{ route('classList') }}"class="btn btn-fill btn-rose">Back</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">add</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Thêm lớp học bằng file</h4>
                    <form action="{{ route('classImport') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="class-file" type="file" name="class_file" accept=".xlsx, .xls, .csv, .ods" required>
                        <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                    </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('a.navbar-brand').text('Thêm lớp học');
    });
</script>
@endsection
