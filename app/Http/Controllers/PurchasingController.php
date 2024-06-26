<?php

namespace App\Http\Controllers;

use App\Models\Purchasing;
use App\Models\PurchasingDetail;
use App\Models\User;
use App\Models\Product;
use PDF;
use App\Exports\PurchasingsExport;
use App\Imports\PurchasingsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchasings = Purchasing::all();
        return view('purchasings.index', compact('purchasings'));
    }

    public function report(Request $request)
    {
        $purchasings = Purchasing::query();
        if ($request->startDate && $request->endDate) {
            $purchasings->whereBetween('date_purchase', [$request->startDate , $request->endDate]);
        }
        $purchasings = $purchasings->get();
        return view('purchasings.report', compact('purchasings'));
    }


    public function reportPdf(Request $request)
    {
        $purchasings = Purchasing::query();
        if ($request->startDate && $request->endDate) {
            $purchasings->whereBetween('date_purchase', [$request->startDate , $request->endDate]);
        }
        $purchasings = $purchasings->get();
        $pdf = PDF::loadview('purchasings.reportPdf', ['purchasings' => $purchasings]);
    	return $pdf->stream('laporan-pembelian.pdf');
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = User::all();
        $admins = User::all();

        return view('purchasings.create', compact('vendors', 'admins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_trans' => 'required',
            'vendor_id' => 'required',
            'admin_id' => 'required',
            'date_purchase' => 'required',
            'grand_total' => 'required',
            'jml' => 'required',
        ]);

        // dd($request->all());

        DB::beginTransaction();
        try {
            $data = $request->all();
            // dd($data);
            $purchase = new Purchasing();
            $purchase->code_trans = $data['code_trans'];
            $purchase->vendor_id = $data['vendor_id'];
            $purchase->admin_id = $data['admin_id'];
            $purchase->date_purchase = $data['date_purchase'];
            $purchase->grand_total = $data['grand_total'];
            $purchase->save();

            for ($i = 1; $i <= $request->jml; $i++) {
                $product = Product::find($data['id_product'.$i]);
                if($data['qty'.$i] > $product->qty){
                    return redirect()->route('purchasings.create')
        ->withErrors('Oops !, data not available');
                }
                $detail = new PurchasingDetail();
                $detail->code_trans =  $data['code_trans'];
                $detail->product_id =  $data['id_product'.$i];
                $detail->product_name =  $data['product_name'.$i];
                $detail->Purchasing_price =  $data['price'.$i];
                $detail->qty =  $data['qty'.$i];
                $detail->sub_total =  $data['sub_total'.$i];
                $detail->id_purchase =  $purchase->id;
                $detail->save();

            $product->qty += $data['qty'.$i];
            $product->save();
            }

            DB::commit();

            return redirect()->route('purchasings.index')
        ->withSuccess('Great! You have successfully created Purchasing');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(purchasing $purchasing)
    {
        // return view('purchasings.print', compact('purchasing'));
        $pdf = PDF::loadview('purchasings.print', ['purchasing' => $purchasing]);
    	return $pdf->stream('nota-pembelian.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchasing = Purchasing::findOrFail($id);
        $vendors = User::all();
        $admins = User::all();
        return view('purchasings.edit', compact('purchasing', 'vendors', 'admins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code_trans' => 'required',
            'vendor_id' => 'required',
            'admin_id' => 'required',
            'date_purchase' => 'required',
            'grand_total' => 'required',
            'jml' => 'required',
        ]);
    
        DB::beginTransaction();
        try {
            $purchase = Purchasing::findOrFail($id);
            $data = $request->all();
    
            // Update main purchasing record
            $purchase->code_trans = $data['code_trans'];
            $purchase->vendor_id = $data['vendor_id'];
            $purchase->admin_id = $data['admin_id'];
            $purchase->date_purchase = $data['date_purchase'];
            $purchase->grand_total = $data['grand_total'];
            $purchase->save();
    
            // Clear existing details before re-adding
            PurchasingDetail::where('id_purchase', $purchase->id)->delete();
    
            // Re-add details
            for ($i = 1; $i <= $request->jml; $i++) {
                $product = Product::find($data['id_product'.$i]);
                if ($data['qty'.$i] > $product->qty) {
                    return redirect()->route('purchasings.edit', $id)
                        ->withErrors('Oops! Product ' . $product->name . ' is out of stock.');
                }
                $detail = new PurchasingDetail();
                $detail->code_trans = $data['code_trans'];
                $detail->product_id = $data['id_product'.$i];
                $detail->product_name = $data['product_name'.$i];
                $detail->Purchasing_price = $data['price'.$i];
                $detail->qty = $data['qty'.$i];
                $detail->sub_total = $data['sub_total'.$i];
                $detail->id_purchase = $purchase->id;
                $detail->save();
    
                // Update product quantity
                $product->qty += $data['qty'.$i];
                $product->save();
            }
    
            DB::commit();
    
            return redirect()->route('purchasings.index')
                ->withSuccess('Great! You have successfully updated Purchasing');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchasing $purchasing)
    {
        PurchasingDetail::where('id_purchase', $purchasing->id)->delete();
        $purchasing->delete();
        return redirect()->route('purchasings.index')
        ->withSuccess('Great! You have successfully deleted '.$purchasing->code_trans);
    }

    public function export() 
    {
        return Excel::download(new PurchasingsExport, 'purchasings.xlsx');
    }

    public function import() 
    {
        Excel::import(new PurchasingsImport,request()->file('file'));
               
        return redirect()->route('purchasings.index')
        ->withSuccess('Great! You have successfully imported ');
    }

}