@extends('ministry.layouts.layout')

@section('main')
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">edit</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Sửa chuyên ngành {{ $majorName }}</h4>
                <form method="post" action="{{ route('majorEditStore') }}">
                    @csrf
                    <div class="form-group label-floating">
                        <label class="control-label">Mã chuyên ngành</label>
                        <input disabled type="text" class="form-control" value="{{ $majorId }}">
                        <input hidden type="text" name="majorId" value="{{ $majorId }}">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Tên chuyên ngành</label>
                        <input type="text" name="majorName" id="majorName" class="form-control" value="{{ $majorName }}" onchange="upperFirstCase()" required>
                    </div>
                    <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                    <a href="{{ route('courseMajorList') }}" class="btn btn-fill btn-rose">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">    
    $(document).ready(function() {
        var error = {{ isset($_GET['error']) ? $_GET['error'] : '0' }};
        if(error != "0")
        {
            demo.showNotification('top','center','error2');
        }
        document.getElementById('pathInput').value="major";
        $('a.navbar-brand').text('Sửa chuyên ngành');
    });
</script>
@endsection