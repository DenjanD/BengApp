<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\sale_detail;
use App\Spare_parts;

class SalesController extends Controller
{
    //
    public function read(){
        $data = Sales::all();

        return response()->json(['data' => $data],200);
    }

    public function read_details(){
        $data = sale_detail::join('sales','sales.sale_id','=','sale_details.sale_id')
                            ->join('spare_parts','spare_parts.spart_id','=','sale_details.spart_id')
                            ->select('id','sale_details.sale_id','spare_parts.name','sale_details.quantity','total_price','sold_date')
                            ->get();
        return response()->json($data,200);
    }   

    public function add(Request $request){
        $saleData = $request->input('saleData');
        $totalBill = $request->input('totalBill');
        date_default_timezone_set('Asia/Jakarta');
        $newSale = new Sales([
            'total_bill' => $totalBill,
            'sold_date' => date('Y-m-d')
        ]);

        if ($newSale->save()) {
            return $this->add_detail($saleData,$newSale->sale_id);
        }
    }

    public function add_detail($saleDatas,$newSaleId){
        foreach ($saleDatas as $sd) {
            $newDetail = new sale_detail([
                'sale_id' => $newSaleId,
                'spart_id' => $sd['spartCode'],
                'quantity' => $sd['spartBuyQty'],
                'total_price' => $sd['spartPrice']*$sd['spartBuyQty']
            ]);
            if ($newDetail->save()) {
                $updateSpQty = Spare_parts::where('spart_id', $newDetail->spart_id)->first();
                $updateSpQty->quantity = $updateSpQty->quantity-$newDetail->quantity;
                $updateSpQty->update();
            }
        }
        return response()->json(['Details has been saved'], 200);
    }

    //UNUSED DELSOON
    /*public function add(Request $request){
        $this->validate($request, [
            'spart' => 'required',
            'quantity' => 'required|digits_between:1,11'
        ]);

        $spart_price = Spare_parts::where('spart_id', $request->input('spart'))->get(['price', 'quantity'])->toArray();
        
        //get array data from object received
        foreach ($spart_price as $sp) {
            $thisprice = $sp['price'];
            $thisquantity = $sp['quantity'];
        }
        if ($thisquantity < 1 || $thisquantity - $request->input('quantity') < 0) {
            return response()->json(['msg' => 'Spare part out of stock'], 200);
        }

        $total_price = $thisprice * $request->input('quantity');
        
        $sold_date = date('Y-m-d');

        $sale = new Sales([
            'spart' => $request->input('spart'),
            'quantity' => $request->input('quantity'),
            'total_price' => $total_price,
            'sold_date' => $sold_date
        ]);

        if ($sale->save()) {
            $updateSpQty = Spare_parts::where('spart_id', $request->input('spart'))->first();
            $updateSpQty->quantity = $updateSpQty->quantity-$request->input('quantity');
            $updateSpQty->update();

            return response()->json(['msg' => 'Spare part sale saved'], 200);
        }
        return response()->json(['msg' => 'Error during saving'], 404);
    }
*/
    public function getspart(Request $request) {
        $spart = Spare_parts::where('spart_id', $request->input('spartid'))->first();

            if ($spart == '') {
                $spartData = [
                    'spartName' => 'N/A',
                    'spartPrice' => 'N/A',
                    'spartQty' => 'N/A'
                ];
                return response()->json(['spartData' => $spartData], 200);
            }

            $spartName = $spart->name;
            $spartPrice = $spart->price;
            $spartQty = $spart->quantity;

        $spartData = [
            'spartName' => $spartName,
            'spartPrice' => $spartPrice,
            'spartQty' => $spartQty
        ];

        return response()->json(['spartData' => $spartData], 200);
    }

}