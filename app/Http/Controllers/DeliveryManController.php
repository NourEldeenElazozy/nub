<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Exception;
use App\Models\deliveryMan;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Credits;
use App\Models\Senders;
use App\Models\currency;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;

class DeliveryManController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mans = Credits::latest()->get();
        $senders  = Senders ::all();
        $currencies  = Currency::all();
        return view('admin.mans.index', compact('mans','senders', 'currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {



            Credits::create($request->all());
            toast('تمت العملية بنجاح', 'success');
        } catch (Credits $e) {
            toast('حدث خطأ غير متوقع', 'error');
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(deliveryMan $man)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(deliveryMan $man)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $man = Credits::findOrFail($id);
    try {
        $man->update([
            'sender_id' => $request->sender_id,
            'credit_number' => $request->credit_number,
            'importer_name' => $request->importer_name,
            'issue_date' => $request->issue_date,
            'credit_amount' => $request->credit_amount,
            'currency_id' => $request->currency_id,
            'expiry_date' => $request->expiry_date,
            'account_number' => $request->account_number,
            'authorized_by' => $request->authorized_by,
            'goods_origin' => $request->goods_origin,
            'purpose_of_transfer' => $request->purpose_of_transfer,
            'manufacturing_statement' => $request->manufacturing_statement,
            'financing_method' => $request->financing_method,
            'beneficiary_name' => $request->beneficiary_name,
            'credit_status' => $request->credit_status
        ]);

        toast('تمت العملية بنجاح', 'success');
    } catch (Exception $e) {
        toast('حدث خطأ غير متوقع', 'error');
    }
    return back();
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $man = Credits::findOrFail($id);
        try {
            $man->delete($id);
            toast('تم الحذف بنجاح', 'success');
        } catch (Exception $e) {
            toast('حدث خطأ غير متوقع', 'error');
        }
        return back();
    }
}
