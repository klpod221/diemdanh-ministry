@extends('login.layout')

@section('main')
<form action="/ministry/login-process" method="post" id="validateForm">
    @csrf
    <div class="card card-login card-hidden">
        <div class="card-header text-center" data-background-color="rose">
            <p><h4 class="card-title">Giáo vụ</h4><p>
        </div>
        <div class="card-content">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">email</i>
                </span>
                <div class="form-group label-floating">
                    <label class="control-label">Email address</label>
                    <input class="form-control" name="email" id="email" type="email" required/>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock_outline</i>
                </span>
                <div class="form-group label-floating">
                    <label class="control-label">Password</label>
                    <input class="form-control" name="password" id="password" type="password" required/>
                </div>
            </div>
        </div>
        <div class="footer text-center">
            <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Let's go</button>
        </div>
    </div>
    @method('post')
</form>
@if (Session::has('error'))
    <input type="hidden" id="error" value="{{ Session::get('error') }}"/>
@endif
@endsection
@section('script')
<script>
    $( document ).ready(function()
    {
        var error = document.getElementById('error').value;
        console.log(error);
        switch (error) {
            case 1:
                demo.showNotification('top','center','error1');
                break;
            case 4:
                demo.showNotification('top','center','error4');
                break;
            default:
                break;
        }
    });
</script>
@endsection
