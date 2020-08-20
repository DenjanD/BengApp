<?php

namespace App\Exports;

use App\Sales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $exportFilter;

    public function __construct($dataFilter) {
        $this->exportFilter = $dataFilter;
    }

    public function collection()
    {
        $startDate = $this->exportFilter['startDate'];
        $endDate = $this->exportFilter['endDate'];
        $brand = $this->exportFilter['brand'];
        $spartCat = $this->exportFilter['spartCat'];
        $supplier = $this->exportFilter['supplier'];

        if ($brand == '--- Pilih Merek ---') {
            $brand = '';
        }

        if ($spartCat == '--- Pilih Kategori Barang ---') {
            $spartCat = '';
        }

        if ($supplier == '--- Pilih Supplier ---') {
            $supplier = '';
        }

        if ($startDate == null && $endDate != null) {
            $exportData = DB::table('sales')
            ->select('spare_parts.name AS spart','brand','spare_parts_categories.name AS spartCat','suppliers.name AS supplier','sale_details.quantity','total_bill','sold_date')
            ->join('sale_details','sales.sale_id','=','sale_details.sale_id')
            ->join('spare_parts','spare_parts.spart_id','=','sale_details.spart_id')
            ->join('purchases','spart','=','spare_parts.spart_id')
            ->join('suppliers','supplier','=','supplier_id')
            ->join('spare_parts_categories','category','=','sp_category_id')
            ->where('brand','like','%'.$brand.'%')
            ->where('spare_parts_categories.name','like','%'.$spartCat.'%')
            ->where('suppliers.name','like','%'.$supplier.'%')
            ->where('sold_date','<=',$endDate)
            ->get();
        }

        else if ($endDate == null && $startDate != null) {
            $exportData = DB::table('sales')
            ->select('spare_parts.name AS spart','brand','spare_parts_categories.name AS spartCat','suppliers.name AS supplier','sale_details.quantity','total_bill','sold_date')
            ->join('sale_details','sales.sale_id','=','sale_details.sale_id')
            ->join('spare_parts','spare_parts.spart_id','=','sale_details.spart_id')
            ->join('purchases','spart','=','spare_parts.spart_id')
            ->join('suppliers','supplier','=','supplier_id')
            ->join('spare_parts_categories','category','=','sp_category_id')
            ->where('brand','like','%'.$brand.'%')
            ->where('spare_parts_categories.name','like','%'.$spartCat.'%')
            ->where('suppliers.name','like','%'.$supplier.'%')
            ->where('sold_date','>=',$startDate)
            ->get();
        }

        else if ($startDate == null && $endDate == null) {
            $exportData = DB::table('sales')
            ->select('spare_parts.name AS spart','brand','spare_parts_categories.name AS spartCat','suppliers.name AS supplier','sale_details.quantity','total_bill','sold_date')
            ->join('sale_details','sales.sale_id','=','sale_details.sale_id')
            ->join('spare_parts','spare_parts.spart_id','=','sale_details.spart_id')
            ->join('purchases','spart','=','spare_parts.spart_id')
            ->join('suppliers','supplier','=','supplier_id')
            ->join('spare_parts_categories','category','=','sp_category_id')
            ->where('brand','like','%'.$brand.'%')
            ->where('spare_parts_categories.name','like','%'.$spartCat.'%')
            ->where('suppliers.name','like','%'.$supplier.'%')
            ->get();
        }

        else {
            $exportData = DB::table('sales')
            ->select('spare_parts.name AS spart','brand','spare_parts_categories.name AS spartCat','suppliers.name AS supplier','sale_details.quantity','total_bill','sold_date')
            ->join('sale_details','sales.sale_id','=','sale_details.sale_id')
            ->join('spare_parts','spare_parts.spart_id','=','sale_details.spart_id')
            ->join('purchases','spart','=','spare_parts.spart_id')
            ->join('suppliers','supplier','=','supplier_id')
            ->join('spare_parts_categories','category','=','sp_category_id')
            ->where('brand','like','%'.$brand.'%')
            ->where('spare_parts_categories.name','like','%'.$spartCat.'%')
            ->where('suppliers.name','like','%'.$supplier.'%')
            ->whereBetween('sold_date',[$startDate,$endDate])
            ->get();
        }

        return $exportData;
    }

    public function headings(): array {
        return [
            'Nama Barang',
            'Merek',
            'Kategori',
            'Supplier',
            'Jumlah Barang',
            'Total',
            'Tanggal Penjualan'
        ];
    }
}
