<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://127.0.0.1:8000/css/u_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet"> 
    @yield('links')
    <title>@yield('pageTitle') - Fresh Ingredients</title>
</head>
<body>

    @if ( Session::has('msg-success') )
    <div class="alert-success">
        <div class="alert-text-success">
            <h4>{{ Session::get('msg-success') }}</h4>
            <span><img src="../img/doubleTick.png" alt=""></span>
        </div>
    </div>
    <?php Session::forget('msg-success'); ?>
    @endif

<section id="sidebar-nav">
    <aside>
        <h2>Menu</h2>
        <ul>
            <li><a href="/">beranda</a></li>
            <li><a href="/products">products</a></li>
            <li><a href="/login">login</a></li>
        </ul>
    </aside>
</section>

<header>
    <nav class="section">

        <div class="btn-menu">
            <img src="http://localhost/ProjectBinar/public/img/ic_menu.svg" alt="">
        </div>
        <div class="ic-img">
            <img src="http://localhost/ProjectBinar/public/img/ic_freshmart.png" alt="">
        </div>

        <section>
            <div class="btn">
                @if( Session::has('usrLogged') )
                    <div id="btn-usrLogged" class="btn-login">
                        <img src="http://localhost/ProjectBinar/public/img/ic_user.png" alt="">
                        <span>{{ Session::get('usrLogged') }}</span>
                    </div>
                @else
                    <span id="btn-usrLogged"></span>
                    <a href="/login" class="btn-login">
                        <img src="http://localhost/ProjectBinar/public/img/ic_user.png" alt="">
                        <span>login</span>
                    </a>
                @endif

                <div class="btn-logout">
                    <a href="/logout">Logout</a>
                </div>
            </div>

            <div class="cart">
                <img src="http://localhost/ProjectBinar/public/img/ic_cart.png" alt="">
                @if ( Session::has('usrLogged') && Session::has('usrTotalCart') )
                    <span class="indicateOrder">{{ Session::get('usrTotalCart') }}</span>
                @else
                    <span class="indicateOrder">0</span>
                @endif
            </div>
        </section>
    </nav>
</header>

<section id="sidebar-cart">
    <div id="cart-menu">
        <h2>List Keranjang</h2>
        <ul>
            <li>
                @if ( Session::has('usrLogged') && Session::get('usrTotalCart') >= 1 )
                    @foreach ($usrDataCart[0]['prdctsName'] as $key => $data)
                    <div class="cart-item">
                        <a href="/cart/{{ $usrDataCart[0]['cartId'][$key] }}" class="list-item">
                            <div>{{ $data }} - <span>{{ $usrDataCart[0]['suppName'][$key] }}</span></div>
                        </a>
                        <a href="/deletecart/{{ $usrDataCart[0]['cartId'][$key] }}" class="btn-delete"><img width="100%" src="../img/ic_delete.png" alt=""></a>
                    </div>
                    @endforeach
                @else
                    <div class="empty-cart">
                        <img width="100%" src="http://127.0.0.1:8000/img/empty_cart.png" alt="">
                        <h3>Oops, Keranjangmu masih kosong</h3>
                        <button class="btn-close">lanjut belanja</button>
                    </div>
                @endif
            </li>
        </ul>
        
        @if ( Session::has('usrLogged') && Session::get('usrTotalCart') >= 1 )
            <a href="/checkout" class="btn-checkout">checkout</a>
        @endif
    </div>
</section>

    @yield('content')

<footer>
    <p>Copyright 2020 &copy; frozenfood.com</p>
</footer>    
    
<script type="text/javascript">

window.addEventListener('DOMContentLoaded', function(event) {

    const btnUsrLogged = document.querySelector('#btn-usrLogged');
    const btnLogout = document.querySelector('.btn-logout');

    const btnMenu = document.querySelector('.btn-menu');
    const aside = document.querySelector('#sidebar-nav aside');
    const sidebarNav = document.querySelector('section#sidebar-nav');

    const cart = document.querySelector('.cart');
    const sidebarCart = document.querySelector('section#sidebar-cart');
    const cartMenu = document.querySelector('#cart-menu');

    btnUsrLogged.addEventListener('mouseover', function(){
        btnLogout.style.display = 'block';
    });

    btnLogout.addEventListener('mouseleave', function(){
        btnLogout.style.display = 'none';
    });


    btnMenu.addEventListener('click', function(){
        sidebarNav.style.width = '100vw';
        aside.style.transform= 'translateX(100%)';
        document.body.style.overflow = 'hidden';
    });

    sidebarNav.addEventListener('click', function(){
        this.style.width = '0';
        aside.style.transform= 'translateX(-100%)';
        document.body.style.overflow = 'auto';
    });

    cart.addEventListener('click', function(){
        sidebarCart.style.width = '100vw';
        cartMenu.style.transform= 'translateX(-100%)';
        document.body.style.overflow = 'hidden';
    });

    sidebarCart.addEventListener('click', function(){
        this.style.width = '0';
        cartMenu.style.transform= 'translateX(100%)';
        document.body.style.overflow = 'auto';
    });

    // ALERT 

    const alertFailed = document.querySelector('.alert-failed');
    const alertSuccess = document.querySelector('.alert-success');

    setTimeout(function(){
        alertSuccess.style.display = 'none';
    }, 2000)

    setTimeout(function(){
        alertFailed.style.display = 'none';
    }, 2000);

});
</script>
</body>
</html>