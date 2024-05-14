<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Senders;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Senders::latest()->get();
        return view('admin.sections.index', compact('sections'));
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

            Senders::create($valid);
            toast('تمت العملية بنجاح', 'success');
        } catch (Exception $e) {
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $section)
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
            $section = Senders::findOrFail($id);

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
            $section = Senders::findOrFail($id);
            $section->destroy($id);
            toast('تم الحذف ', 'success');
        } catch (\Exception $e) {
            toast('حدث خطأ', 'error');
        }
        return back();
    }
}
