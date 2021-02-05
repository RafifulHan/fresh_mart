<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SupplierController extends Controller
{
    
    public function detailSupplier($id, Request $req){

        $supply = DB::table('tb_supplier')->where('id', $id)->first();
        $products = DB::table('tb_products')->where('supplierId', $supply->id)->get();

        $userController = new UsersController;
        $usrDataCart = $userController->globalUsrDataCart($req);
        
        return view('users.u_detailsupplier', compact('supply', 'products', 'usrDataCart'));
    }
}
