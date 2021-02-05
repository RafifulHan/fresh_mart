<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{

    public function globalUsrTotalCart($req){   

        if( $req->session()->has('usrLogged') ){
            $usrName = $req->session()->get('usrLogged');
            $user = DB::table('tb_users')->where('usrName', $usrName)->first();

            $usrId = $user->id;       
            $usrTotalCart = DB::table('tb_cart')->where('usrId', '=', $usrId)->count();
            
            $req->session()->put('usrTotalCart', $usrTotalCart);
        }

        return true;
    }

    public function globalUsrDataCart($req){

        if( $req->session()->has('usrLogged') ){
            $usrName = $req->session()->get('usrLogged');
            $user = DB::table('tb_users')->where('usrName', $usrName)->first();

            $usrId = $user->id;
            $carts = DB::table('tb_cart')->where('usrId', $usrId)->get();

            $usrDataCart[0]['prdctsName'] = [];
            $usrDataCart[0]['suppName'] = [];
            $usrDataCart[0]['cartId'] = [];

            foreach( $carts as $key => $cart ){

                $product = DB::table('tb_products')->where('id', $cart->prdctId)->first();
                $supply = DB::table('tb_supplier')->where('id', $cart->suppId)->first();

                array_push($usrDataCart[0]['prdctsName'], $product->prdctName);
                array_push($usrDataCart[0]['suppName'], $supply->suppName);
                array_push($usrDataCart[0]['cartId'], $cart->id);
            }

            // print_r($usrDataCart);
            
            return $usrDataCart;
        }

    }
    
    public function home(Request $req){

        $catVegetation = []; 
        $catBeefEgg = [];

        $products = DB::table('tb_products')->get();
        $catVegetation = DB::table('tb_products')->where( 'prdctCategory', 'vegetation' )->paginate(4);
        $catBeefEgg = DB::table('tb_products')->where( 'prdctCategory', 'beeforegg' )->paginate(4);

        $supplier = DB::table('tb_supplier')->paginate(5);

        UsersController::globalUsrTotalCart($req);
        $usrDataCart = UsersController::globalUsrDataCart($req);

        return view('users.u_home', compact('products', 'catVegetation', 'catBeefEgg', 'usrDataCart', 'supplier'));
    }

    public function allProduct(Request $req){

        $products = DB::table('tb_products')->get();

        $usrDataCart = UsersController::globalUsrDataCart($req);

        return view('users.u_allproduct', compact('products', 'usrDataCart'));
    }

    public function product($id, Request $req){

        $product = DB::table('tb_products')->whereId($id)->first();
        $supply = DB::table('tb_supplier')->where('id', $product->supplierId)->first();
        
        $username = strtolower($req->session()->get('usrLogged'));
        $user = DB::table('tb_users')->where('usrName', $username)->first();

        // echo $product;

        $usrDataCart = UsersController::globalUsrDataCart($req);
        return view('users.u_detailproduct', compact('product', 'usrDataCart', 'supply', 'user'));
    }

    public function login(Request $req){
        $usrDataCart = UsersController::globalUsrDataCart($req);

        return view('users.u_login', compact('usrDataCart'));
    }

    public function register(Request $req){
        $usrDataCart = UsersController::globalUsrDataCart($req);

        return view('users.u_register', compact('usrDataCart'));
    }

    public function registerProcess(Request $req){

        DB::table('tb_users')->insert([
            'usrName' => $req->usrName,
            'usrPassword' => $req->usrPassword,
            'usrEmail' => $req->usrEmail,
            'usrTelephone' => $req->usrTelephone,
        ]);

        UsersController::globalUsrTotalCart($req);

        return back()->with('msg', 'Berhasil Registrasi');
    }

    public function loginProcess(Request $req){

        if( $req->session()->has('usrLogged') ){
            return back()->with('msg-logged', 'Sudah Login');
        }

        $usrName = strtolower($req->usrNameorEmail);
        $usrPass = strtolower($req->usrPassword);

        $globalUser = "";

        $users = DB::table('tb_users')->where('usrName', $usrName)
                    ->orWhere('usrEmail', $usrName)
                    ->get();
                
        foreach( $users as $user ){

            if( strtolower($user->usrName) === $usrName || strtolower($user->usrEmail) === $usrName ){
                if( strtolower($user->usrPassword) === $usrPass ){

                    $globalUser = $user->usrName;
                    $req->session()->put('usrLogged', $globalUser);
                    UsersController::globalUsrTotalCart($req);

                    if( strtolower($user->role) == 0 ){
                        return back()->with('msg-success', 'Berhasil Login');
                    }else{
                        return redirect('/admin');
                    }
                }
                else{
                    return back()->with('msg-failed', 'Password Salah');
                }

            }else{
                return back()->with('msg-failed', 'Username Salah');
            }

        }

        return back()->with('msg-failed', 'Anda Belum Registrasi');
    }


    public function logout(Request $req){

        $req->session()->forget('usrLogged');
        $req->session()->forget('usrTotalCart');

        return redirect('/');
    }


    public function categoryProduct($category, Request $req){

        $categoryName;
        $products = DB::table('tb_products')->where('prdctCategory', $category)->get();

        if( $category === "vegetation" ){
            $categoryName = "Sayuran";
        }else if( $category === "beeforegg" ){
            $categoryName = "Daging dan Telur";
        }

        $usrDataCart = UsersController::globalUsrDataCart($req);

        return view('users.u_categoryproduct', compact('products', 'categoryName', 'usrDataCart'));
    }

}
