@extends('templates.templateusers')

@section('pageTitle', 'Checkout')

@section('content')

    <div id="transaction" class="section">
            
        <form action="" method="POST">
            <div class="form-product">
                <div class="shipping-address">
                    <h3>Alamat Pengiriman</h3>
                    <div class="form-control">
                        <label for="recipientName">Nama Penerima</label>
                        <input type="text" name="recipientName" required>
                    </div>

                    <div class="form-control">
                        <label for="recipientName">No. Telepon</label>
                        <input type="text" name="recipientName" required>
                    </div>

                    <div class="form-control">
                        <label for="recipientName">Alamat</label>
                        <textarea name="recipientName" required></textarea>
                    </div>

                    <div class="form-control">
                        <label for="recipientName">Kota</label>
                        <select name="" id="" required>
                            <option value="" selected disabled>Kota</option>
                            <option value="kudus">Kudus</option>
                            <option value="pati">Pati</option>
                            <option value="demak">Demak</option>
                            <option value="semarang">Semarang</option>
                        </select>
                    </div>
                </div>

                <div class="payment-detail">
                    
                    <h3>Rincian Pembayaran</h3>
                    <ul>
                        <li><span>Total Belanja</span><span>Rp. 50.000</span></li>
                        <li><b>Total Pembayaran</b> <span>Rp. 50.000</span></li>
                    </ul>
                    <button type="submit">Kirim</button>
                </div>

            </div>
        </form>

    </div>

@endsection