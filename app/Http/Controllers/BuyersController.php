<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use DB;

class BuyersController extends Controller
{

    public function addToCart(Request $req){

        if( $req->session()->has('usrLogged') ){

            $usrName = $req->session()->get('usrLogged');
            $user = DB::table('tb_users')->where('usrName', $usrName)->first();
            $usrId = $user->id;

            DB::table('tb_cart')->insert([
                'usrId' => $req->usrId,
                'prdctId' => $req->prdctId,
                'suppId' => $req->suppId,
                'totalPrice' => $req->totalPrice
            ]);

            $usrTotalCart = DB::table('tb_cart')->where('usrId', '=', $usrId)->count();

            echo $usrTotalCart;
            DB::table('tb_users')->where('id', $usrId)->update([
                'usrTotalCart' => $usrTotalCart
            ]);

            $usersController = new UsersController();
            $usersController->globalUsrTotalCart($req);

            return back();
        }else{

            return back()->with('msg-failed', 'Anda Harus Login');
        }

    }


    public function cart($id, Request $req){

        $usersController = new UsersController;
        $usersController->globalUsrTotalCart($req);

        if($req->session()->get('usrTotalCart') >= 1){
            $cart = DB::table('tb_cart')->where('id', $id)->first();
            $product = DB::table('tb_products')->where('id', $cart->prdctId)->first();

            $supply = DB::table('tb_supplier')->where('id', $cart->suppId)->first();

            $usersController = new UsersController();
            $usrDataCart = $usersController->globalUsrDataCart($req);
    
            return view('users.u_editcart', compact('supply', 'product', 'usrDataCart'));
        }else{
            return redirect('/');
        }
    }

    public function editCart(Request $req){

        DB::table('tb_buyers')->where('id', $req->buyerId)->update([
            'byrsName' => $req->buyerName,
            'byrsTelp' => $req->buyerTelp,
            'byrsAddress' => $req->buyerAddress,
            'byrsPayment' => $req->buyerPayment,
            'sendDate' => $req->sendDate,
            'prdctTotalSize' => $req->prdctTotalSize
        ]);

        return back()->with('msg-success', 'Data Berhasil Disimpan');
    }

    public function deleteCart($id, Request $req){

        DB::table('tb_cart')->where('id', $id)->delete();

        $userController = new UsersController;
        $userController->globalUsrTotalCart($req);

        return back()->with('msg-success', 'Berhasil DiHapus');
    }


    public function checkout(Request $req){

        $userController = new UsersController;
        $usrDataCart = $userController->globalUsrDataCart($req);

        return view('users.u_transaction', compact('usrDataCart'));
    }
}
