@extends('templates.templateusers')

@section('pageTitle', 'Detail Supplier')

@section('content')

    <div class="section">
        <div class="label">
            <div class="label-image">
                <img width="100%" src="../img/supplier/{{ $supply->suppImage }}" alt="">
            </div>
            <div class="label-text">
                <span>Supplier: </span><h2>{{ $supply->suppName }}</h2>
            </div>
        </div>
    </div>

    <div class="detail-supplier">
        <h1 class="title-section">Semua Produk</h1>
        <div class="section">
            
            @foreach ($products as $product)
            <div class="box">
                <div class="img-product">
                    <img src="../img/sayur_pic.jpg" alt="">
                </div>
                <div class="desc-product">
                    <h2 class="label-item">{{ $product->prdctName }}</h2>
                    <h3 class="label-price">Rp.{{ $product->prdctPrice }} / 250g</h3>
                    <a href="/product/{{ $product->id }}" class="btn-addtocart">Buy</a>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>

@endsection