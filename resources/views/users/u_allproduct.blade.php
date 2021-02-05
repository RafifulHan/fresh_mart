@extends('templates.templateusers')

@section('pageTitle', 'Produk')

@section('content')

    <div class="product">
        <h1 class="title-section">Semua Produk</h1>
        <div class="section">

            @foreach ($products as $product)
                <div class="box">
                    <div class="img-product">
                        <img src="./img/sayur_pic.jpg" alt="">
                    </div>
                    <div class="desc-product">
                        <h2 class="label-item">{{ $product->prdctName }}</h2>
                        <h3 class="label-price">Rp.{{ $product->prdctPrice }}/250g</h3>
                        <a href="/product/{{ $product->id }}" class="btn-addtocart">Buy</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection