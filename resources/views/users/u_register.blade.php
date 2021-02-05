@extends('templates.templateusers')

@section('pageTitle', 'Register')

@section('content')

    @if ( Session::has('msg') )
    <div class="alert-success">
        <div class="alert-text-success">
            <h4>{{ Session::get('msg') }}</h4>
            <span><img src="../img/doubleTick.png" alt=""></span>
        </div>
    </div>
    <?php Session::forget('msg'); ?>
    @endif


    <div id="users-register">
        <div class="section">
            <form action="/register/process" method="post">
                @csrf

                <h1>Register</h1>

                <div class="form-control">
                    <label for="usrName">Nama Pengguna</label>
                    <input type="text" name="usrName" required>
                </div>

                <div class="form-control">
                    <label for="usrEmail">Email</label>
                    <input type="email" name="usrEmail" required>
                </div>

                <div class="form-control">
                    <label for="usrPassword">Kata Sandi</label>
                    <input type="password" name="usrPassword" required>
                </div>

                <div class="form-control">
                    <label for="usrTelephone">Nomor Telepon</label>
                    <input type="number" name="usrTelephone" required>
                </div>

                <button type="submit" class="btn-register">Register</button>

                <span>Sudah Punya Akun?<a href="/login">Sign In Di Sini</a></span>
            </form>
        </div>
    </div>


<script>

    const alertSuccess = document.querySelector('.alert-success');

    setTimeout(function(){
        alertSuccess.style.display = 'none';
    }, 2000)

</script>
@endsection