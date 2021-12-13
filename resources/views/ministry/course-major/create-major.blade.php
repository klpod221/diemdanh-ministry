@extends('ministry.layouts.layout')

@section('main')
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">add</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Thêm chuyên ngành</h4>
                <form method="post" action="{{ route('majorStore') }}">
                    @csrf
                    <div class="form-group label-floating">
                        <label class="control-label">Mã chuyên ngành</label>
                        <input type="text" name="majorId" class="form-control" value="{{ isset($_GET['majorId']) ? $_GET['majorId'] : '' }}" onkeyup="this.value = this.value.toUpperCase();" required>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Tên chuyên ngành</label>
                        <input type="text" name="majorName" id="majorName" class="form-control" value="{{ isset($_GET['majorName']) ? $_GET['majorName'] : '' }}" onchange="upperFirstCase()" required>
                    </div>
                    <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                    <a href="{{ route('courseMajorList') }}" class="btn btn-fill btn-rose">Back</a>
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
                <h4 class="card-title">Thêm chuyên ngành bằng file</h4>
                <form action="{{ route('majorImport') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input id="major-file" type="file" name="major_file" accept=".xlsx, .xls, .csv, .ods" required>
                    <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorCode4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-small ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                </div>
                <div class="modal-body text-center">
                    <h5>Chuyên ngành đã từng tồn tại!<br></h5>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn btn-danger" id="btn-restore">Khôi phục</button>
                    <button class="btn btn-success" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('majorStore') }}" id="restore" hidden>
        @csrf
        <input type="text" name="majorId" value="{{ isset($_GET['majorId']) ? $_GET['majorId'] : '' }}" required>
        <input type="text" name="majorName" value="{{ isset($_GET['majorName']) ? $_GET['majorName'] : '' }}" required>
        <input type="text" name="restore" value="true">
    </form>
@endsection

@section('script')
<script type="text/javascript">
    function upperFirstCase()
    {
        var input = document.getElementById('majorName').value;
        var value = input[0].toUpperCase();
        for (i = 1; i < input.length; i++)
        {
            value += input[i];
        }
        document.getElementById('majorName').value = value;
    }

    $(document).ready(function() {

        var error = {{ isset($_GET['error']) ? $_GET['error'] : '0' }};
        if(error == 3)
        {
            demo.showNotification('top','center','error3');
        }

        if(error == 4)
        {
            console.log("hello");
            $('#errorCode4').addClass('in');
            $('#errorCode4').css({"display": "block", "padding-right": "16px"});
        }

        $('button[data-dismiss=modal]').click(function(){
            $('#errorCode4').css({"display": "none"});
        });

        $('#btn-restore').click(function(){
            $('#restore').submit();
        })

        $('a.navbar-brand').text('Thêm chuyên ngành');
    });
</script>
@endsection
