<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = user::latest()->get();
        return view('admin.users.index', compact('users'));
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
            'email' => 'required|email',
            'password' => 'required',
            'avatar' =>    'required|mimes:png,jpg,jpeg',
            'phone' => 'required|numeric',
            'address' => 'required',
        ], [
            'name.required' => 'الإسم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'password.required' => 'الرمز السري مطلوب',
            'avatar.required' => 'الصورة مطلوبة',
            'email.email' => 'البريد الالكتروني غير صالح',
            'phone.required' => ' رقم الهاتف مطلوب',
            'avatar.mimes' => 'صيغة الصورة غير صالحة',
        ]);
        try {

            $file = time() . uniqid() . $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('assets/Images/users/'), $file);
            user::create([
                'name' => $request->name,
                'password' => $request->password,
                'email' =>    $request->email,
                'avatar' =>    $file,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            toast('تمت العملية بنجاح', 'success');
        } catch (user $e) {
            toast('حدث خطأ غير متوقع', 'error');
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $valid = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'avatar' =>    'mimes:png,jpg,jpeg',
            'phone' => 'required|numeric',
            'address' => 'required',
        ], [
            'name.required' => 'الإسم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.email' => 'البريد الالكتروني غير صالح',
            'phone.required' => ' رقم الهاتف مطلوب',
            'avatar.mimes' => 'صيغة الصورة غير صالحة',
        ]);
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        try {

            if ($request->has('avatar')) {
                $file = time() . uniqid() . $request->avatar->getClientOriginalName();
                $request->avatar->move(public_path('assets/images/users/'), $file);
            } else {
                $file = $user->avatar;
            }
            $password = $request->filled('password') ? $request->password : $user->password;

            $user->update([
                'name' => $request->name,
                'password' => $password,
                'email' =>    $request->email,
                'avatar' =>    $file,
                'phone' => $request->phone,
                'address' => $request->address,
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
        $user = User::findOrFail($id);
        try {
            $user->delete($id);
            toast('تم الحذف بنجاح', 'success');
        } catch (Exception $e) {
            toast('حدث خطأ غير متوقع', 'error');
        }
        return back();
    }
}
