<?php

namespace App\Exports;

use App\Purchase;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchaseExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $exportFilter;

    public function __construct($dataFilter){
        $this->exportFilter = $dataFilter;
    }

    public function collection()
    {
        //
        $startDate = $this->exportFilter['startDate'];
        $endDate = $this->exportFilter['endDate'];
        $supplier = $this->exportFilter['supplier'];
        $spartCat = $this->exportFilter['spartCat'];

        if ($supplier == '--- Pilih Supplier ---') {
            $supplier = '';
        }

        if ($spartCat == '--- Pilih Kategori Spare Part ---') {
            $spartCat = '';
        }

        if ($startDate == null && $endDate != null) {
            $exportData = DB::table('purchases')
            ->select('spare_parts.name AS spart','suppliers.name AS supplier','purchase_date','purchases.quantity','purchases.price','brand','spare_parts_categories.name')
            ->join('spare_parts','spart','=','spart_id')
            ->join('suppliers','supplier','=','supplier_id')
            ->join('spare_parts_categories','category','=','sp_category_id')
            ->where('suppliers.name','like','%'.$supplier.'%')
            ->where('spare_parts_categories.name','like','%'.$spartCat.'%')
            ->where('purchase_date','<',$endDate)
            ->get();
        }

        else if ($startDate != null && $endDate == null) {
            $exportData = DB::table('purchases')
            ->select('spare_parts.name AS spart','suppliers.name AS supplier','purchase_date','purchases.quantity','purchases.price','brand','spare_parts_categories.name')
            ->join('spare_parts','spart','=','spart_id')
            ->join('suppliers','supplier','=','supplier_id')
            ->join('spare_parts_categories','category','=','sp_category_id')
            ->where('suppliers.name','like','%'.$supplier.'%')
            ->where('spare_parts_categories.name','like','%'.$spartCat.'%')
            ->where('purchase_date','>',$startDate)
            ->get();
        }

        else if ($startDate == null && $endDate == null) {
            $exportData = DB::table('purchases')
            ->select('spare_parts.name AS spart','suppliers.name AS supplier','purchase_date','purchases.quantity','purchases.price','brand','spare_parts_categories.name')
            ->join('spare_parts','spart','=','spart_id')
            ->join('suppliers','supplier','=','supplier_id')
            ->join('spare_parts_categories','category','=','sp_category_id')
            ->where('suppliers.name','like','%'.$supplier.'%')
            ->where('spare_parts_categories.name','like','%'.$spartCat.'%')
            ->get();
        }

        else {
            $exportData = DB::table('purchases')
            ->select('spare_parts.name AS spart','suppliers.name AS supplier','purchase_date','purchases.quantity','purchases.price','brand','spare_parts_categories.name')
            ->join('spare_parts','spart','=','spart_id')
            ->join('suppliers','supplier','=','supplier_id')
            ->join('spare_parts_categories','category','=','sp_category_id')
            ->where('suppliers.name','like','%'.$supplier.'%')
            ->where('spare_parts_categories.name','like','%'.$spartCat.'%')
            ->whereBetween('purchase_date',[$startDate,$endDate])
            ->get();
        }
    
        return $exportData;
    }

    public function headings(): array {
        return [
            'Nama Barang',
            'Supplier',
            'Tanggal Pembelian',
            'Jumlah',
            'Harga',
            'Merek',
            'Kategori'
        ];
    }
}
