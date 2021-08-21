@extends('ministry.layouts.layout')

@section('main')
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">edit</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Sửa lớp học {{ $className }}</h4>
                <form method="post" action="{{ $classId }}/store">
                    @csrf
                    <select name="majorId" class="selectpicker" data-style="select-with-transition" title="Chuyên ngành" data-size="10" required>
                        @foreach ($listMajor as $item)
                            <option @if ($item->majorId == $majorId) { selected } @endif
                                value="{{ $item->majorId }}">{{ $item->majorName }}</option>
                        @endforeach
                    </select>
                    <select name="courseId" class="selectpicker" data-style="select-with-transition" title="Niên khóa" data-size="10" required>
                        @foreach ($listCourse as $item)
                            <option @if ($item->courseId == $courseId) { selected } @endif
                                value="{{ $item->courseId }}">K{{ $item->courseId }} - {{ $item->schoolYear }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                    <a href="{{ route('classList') }}"class="btn btn-fill btn-rose">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">    
    $(document).ready(function() {
        document.getElementById('pathInput').value="class";
        $('a.navbar-brand').text('Sửa lớp học');
    });
</script>
@endsection