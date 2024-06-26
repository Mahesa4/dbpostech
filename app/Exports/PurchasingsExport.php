<?php

namespace App\Exports;

use App\Models\Purchasing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchasingsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Purchasing::select("id","code_trans", "date_purchase", "vendor_id", "admin_id", "purchase_status", "grand_total")->get();
    }

    public function headings(): array
    {
        return ["ID","Code Transaksi", "Tanggal Pembelian", "Vendor", "Admin", "Total", "Grand Total"];
    }
}
