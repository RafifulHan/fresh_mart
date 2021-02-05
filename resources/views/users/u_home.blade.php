@extends('templates.templateusers')

@section('pageTitle', 'Beranda')

@section('assets')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
@endsection

@section('content')

    <div id="banner">
        <div class="section">
            <div class="showcase-text">
                <h1>fresh <span class="hightlight-green">ingredients</span></h1>
                <p class="desc_banner">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem porro accusantium explicabo officia. Culpa veniam, inventore officia delectus adipisci quidem deserunt dolores reiciendis quod nulla fugiat quaerat ex, tempora optio!</p>
                <a href="" class="btn-order">Order</a>
            </div>
        </div>        
    </div>

    <div class="product" id="products">
        <h1 class="title-section">Semua Produk</h1>
        <div class="section">

            <?php $maxItem = 0 ?>

            @foreach ($products as $key => $product)
    
            @if( $product->id % 4 === 0 && $maxItem < 5 )
            
            <?php $maxItem++ ?>

            <div class="box">
                <div class="img-product">
                    <img src="http://localhost/ProjectBinar/public/img/bawang_pic.jpg" alt="">
                </div>
                <div class="desc-product">
                    <h2 class="label-item">{{ $product->prdctName }}</h2>
                    <h3 class="label-price">Rp.{{ $product->prdctPrice }}/kg</h3>
                    <a href="/product/{{ $product->id }}" class="btn-addtocart">Buy</a>
                </div>
            </div>

            @endif

            @endforeach
        </div>
    </div>

    <div class="product">
        <h1 class="title-section">Sayur</h1>
        <div class="section vegetation">

            @foreach ($catVegetation as $product)
                
            <div class="box">
                <div class="img-product">
                    <img src="./img/sayur_pic.jpg" alt="">
                </div>
                <div class="desc-product">
                    <h2 class="label-item">{{ $product->prdctName }}</h2>
                    <h3 class="label-price">Rp.{{ $product->prdctPrice }}/kg</h3>
                    <a href="/product/{{ $product->id }}" class="btn-addtocart">Buy</a>
                </div>
            </div>

            @endforeach

            <a href="/category/{{ $catVegetation[0]->prdctCategory }}" class="btn-look">Lihat Semua</a>

        </div>
    </div>

    <div class="product">
        <h1 class="title-section">Daging dan Telur</h1>
        <div class="section">

            @foreach ($catBeefEgg as $product)
                <div class="box">
                    <div class="img-product">
                        <img src="./img/sayur_pic.jpg" alt="">
                    </div>
                    <div class="desc-product">
                        <h2 class="label-item">{{ $product->prdctName }}</h2>
                        <h3 class="label-price">Rp.{{ $product->prdctPrice }}/kg</h3>
                        <a href="/product/{{ $product->id }}" class="btn-addtocart">Buy</a>
                    </div>
                </div>
            @endforeach

            <a href="/category/{{ $catBeefEgg[0]->prdctCategory }}" class="btn-look">Lihat Semua</a>

        </div>
    </div>

    <div id="supplier">
        <h1 class="title-section">Supplier</h1>
        <div class="section">
            
            @foreach( $supplier as $supply )
            
            <a href="/supplier/{{ $supply->id }}" class="box">
                <img src="../img/supplier/{{ $supply->suppImage }}" alt="">
                <p class="desc-supplier">Fresh, Organic & Imported</p>
            </a>

            @endforeach

        </div>
    </div>

@endsection