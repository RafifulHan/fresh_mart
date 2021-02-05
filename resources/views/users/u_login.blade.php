@extends('templates.templateusers')


{{-- @section('links')
<link rel="stylesheet" href="../css/u_style.css">
@endsection --}}

@section('pageTitle', 'Login')

@section('content')

    @if ( Session::has('msg-success') )
    <div class="alert-success">
        <div class="alert-text-success">
            <h4>{{ Session::get('msg-success') }}</h4>
            <span><img src="../img/doubleTick.png" alt=""></span>
        </div>
    </div>
    <?php Session::forget('msg-success'); ?>
    @endif

    @if ( Session::has('msg-failed') )
    <div class="alert-failed">
        <div class="alert-text-failed">
            <h4>{{ Session::get('msg-failed') }}</h4>
            <span><img src="../img/cancel.png" alt=""></span>
        </div>
    </div>
    <?php Session::forget('msg-failed'); ?>
    @endif

    @if ( Session::has('msg-logged') )
    <div class="alert-success">
        <div class="alert-text-success">
            <h4>{{ Session::get('msg-logged') }}</h4>
            <span><img src="../img/doubleTick.png" alt=""></span>
        </div>
    </div>
    <?php Session::forget('msg-logged'); ?>
    @endif

    <div id="users-login">
        <div class="section">
            <form action="/login/process" method="post">
                @csrf

                <h1>Login</h1>

                <div class="form-control">
                    <label for="usrNameorEmail">Nama Pengguna / Email</label>
                    <input type="text" name="usrNameorEmail" value="{{ old('usrNameorEmail') }}" required>
                </div>

                <div class="form-control">
                    <label for="usrPassword">Kata Sandi</label>
                    <input type="password" name="usrPassword" value="{{ old('usrPassword') }}" required>
                </div>

                <button type="submit" class="btn-login">Login</button>

                <span>Belum Punya Akun?<a href="/register">Daftar Di Sini</a></span>
            </form>
        </div>
    </div>

<script>

    // ALERT 

    const alertFailed = document.querySelector('.alert-failed');
    const alertSuccess = document.querySelector('.alert-success');

    setTimeout(function(){
        alertSuccess.style.display = 'none';
    }, 2000)

    setTimeout(function(){
        alertFailed.style.display = 'none';
    }, 2000);

</script>
@endsection