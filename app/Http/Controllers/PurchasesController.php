<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Http\Controllers\SparePartController;
use App\Exports\PurchaseExport;
use Maatwebsite\Excel\Facades\Excel;

class PurchasesController extends Controller
{
    protected $sp;
    //
    public function __construct(){
        $this->sp = new SparePartController();
    }

    public function read(){
        //$data = Purchase::all();
        $data = Purchase::join('spare_parts','spart','=','spart_id')
                        ->join('suppliers','supplier','=','supplier_id')
                        ->select('purchase_id','spare_parts.name AS spart','suppliers.name AS supplier','purchase_date','purchases.quantity','purchases.price AS buyPrice')
                        ->get();

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

    public function export(Request $request) {
        $getStartDate = $request->startDate2;
        $getEndDate = $request->endDate2;
        $getSupplier = $request->selSupplier;
        $getSpartCat = $request->selSpartCat;

        $exportFilter = [
            'startDate' => $getStartDate,
            'endDate' => $getEndDate,
            'supplier' => $getSupplier,
            'spartCat' => $getSpartCat
        ];

        return Excel::download(new PurchaseExport($exportFilter), 'Data Pembelian.xlsx');
    }
}
