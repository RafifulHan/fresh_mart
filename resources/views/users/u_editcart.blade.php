@if(isset($buyer->id))

@extends('templates.templateusers')

@section('pageTitle', 'Edit Pesanan')
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

    <div id="edit-cart" class="section">

            <div class="preview-product">
                <img src="http://localhost/ProjectBinar/public/img/bawang_pic.jpg" alt="">
            </div>

            <form action="/editcart" method="POST">
                @csrf
                <input type="hidden" name="buyerId" value="{{ $cart->id }}">

                <div class="desc-detailproduct">
                    <h1 class="product-title">{{ $product->prdctName }}</h1>

                    <div class="form-product">
                        <div class="form-one">

                            <div class="form-control">
                                <label for="suppName">Supplier</label>
                                <input type="text" style="text-transform: capitalize" name="supplierName" value="{{ $supply->suppName }}" disabled>
                                <input type="hidden" name="suppName" value="{{ $supply->suppName }}" disabled>
                            </div>
    
                            <div class="form-control">
                                <label for="pricePerSize">Harga / 250 gram</label>
                                <input id="pricePerSize" type="number" name="pricePerSize" value="{{ $product->prdctPrice }}" disabled>
                            </div>
                        </div>

                        <div class="form-two">

                            <div class="form-control">
                                <label for="prdctTotalSize">Jumlah (Gram)</label>
                                <div class="addSize">
                                    <button type="button" class="btn-minSize">-</button>
                                    <input id="productSize" type="number" name="prdctTotalSize" value="{{ $buyer->prdctTotalSize }}" readonly>
                                    <button type="button" class="btn-plusSize">+</button>
                                </div>
                            </div>

                            <div class="form-control">
                                <label for="buyerPayment">Total Harga</label>
                                <input id="totalPrice" type="number" name="buyerPayment" value="{{ $buyer->byrsPayment }}" readonly>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn-addToCart">Simpan</button>
                </div>
            </form>

        </div>
    </div>

<script>

    const inputPrice = document.querySelector("#totalPrice");
    const inputProductSize = document.querySelector("#productSize");
    const btnPlusSize = document.querySelector(".btn-plusSize");
    const btnMinSize = document.querySelector(".btn-minSize");
    const pricePerSize = document.querySelector("#pricePerSize").value;

    let productSize = parseInt(inputProductSize.value);
    let totalPrice = 0;
    let totalItem = 0;

    btnPlusSize.addEventListener('click', function(){
        productSize += 250;

        inputProductSize.value = productSize;
        totalItem = productSize / 250;
        totalPrice = parseInt(totalItem) * parseInt(pricePerSize);
        inputPrice.value = totalPrice;
    });

    btnMinSize.addEventListener('click', function(){

        if( productSize != 250 ){
            productSize -= 250;
        }

        inputProductSize.value = productSize;
        totalItem = productSize / 250;
        totalPrice = parseInt(totalItem) * parseInt(pricePerSize);
        inputPrice.value = totalPrice;

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

</script>
@endsection

@else
    <?php
    
        header('Location: http://127.0.0.1:3232/');

    ?>
@endif