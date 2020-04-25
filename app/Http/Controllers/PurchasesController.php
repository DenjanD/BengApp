<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Http\Controllers\SparePartController;

class PurchasesController extends Controller
{
    protected $sp;
    //
    public function __construct(){
        $this->sp = new SparePartController();
    }

    public function read(){
        $data = Purchase::all();

        return response()->json(['data' => $data]);
    }

    public function add(Request $request){
        $newPurchase = $this->sp->add($request);
        
        $this->validate($request, [
            'supplier' => 'required',
            'quantity' => 'required|digits_between:1,11',
            'buyPrice' => 'required|digits_between:1,11'
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $purchaseDate = date('Y-m-d');

        $purchase = new Purchase([
            'spart' => $newPurchase,
            'supplier' => $request->input('supplier'),
            'purchase_date' => $purchaseDate,
            'quantity' => $request->input('quantity'),
            'price' => $request->input('buyPrice')
        ]);

        if ($purchase->save()) {
            return response()->json(['msg' => 'Spare part has been added'], 200);
        }
        return response()->json(['msg' => 'Error during adding spare part'], 404);
    }
}
