<?php

namespace App\Exports;

use App\Models\Selling;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SellingsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Selling::select("id","code_trans", "date_sell", "cashier_id", "customer_id", "product_status", "grand_total")->get();
    }

    public function headings(): array
    {
        return ["ID","Code Transaksi", "Tanggal Penjualan", "Cashier", "Customer", "Total", "Grand Total"];
    }
}
