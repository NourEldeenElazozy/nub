<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\currency;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = currency::latest()->get();
        return view('admin.banks.index', compact('sections'));
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
        $valid = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'الإسم مطلوب',
        ]);
        try {

            currency::create($valid);
            toast('تمت العملية بنجاح', 'success');
        } catch (Exception $e) {
        }

        return back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $valid = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'الإسم مطلوب',
        ]);
        $id = Crypt::decrypt($id);
        try {
            $section = currency::findOrFail($id);

            $section->update($valid);
            toast('تمت العملية بنجاح', 'success');
        } catch (Exception $e) {
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $id =  Crypt::decrypt($id);
            $section = currency::findOrFail($id);
            $section->destroy($id);
            toast('تم الحذف ', 'success');
        } catch (\Exception $e) {
            toast('حدث خطأ', 'error');
        }
        return back();
    }
}
