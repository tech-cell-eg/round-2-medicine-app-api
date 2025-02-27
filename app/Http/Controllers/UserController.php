<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyPhoneRequest;
use App\Models\User;
use App\Notifications\Notifications;
use Hash;
use Illuminate\Http\Request;
use Notification;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function verifyPhoneOtp(VerifyPhoneRequest $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->phone_otp === $request->phone_otp) {

            $user->update(['phone_otp' => null]);
            return response()->json(['message' => 'Phone verified successfully']);

        } else {

            return response()->json(['message' => 'Invalid OTP'], 400);
        }
    }


    public function index()
    {
        $users = User::paginate(10); // جلب كل المستخدمين مع التقسيم لصفحات
        return view('users', compact('users'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('create_users', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6',
            'role' => 'required|string',
            'permissions' => 'nullable|array',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
    
        if ($request->role === 'admin' && $request->has('permissions')) {
            $user->permissions()->sync($request->permissions);
        }
    
        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }
    

    public function show(User $user)
    {
        return view('user_details', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load('permissions');
        return view('edit_user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'permissions' => 'nullable|array',
        ]);


        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        if ($user->role === 'admin') {
            $user->syncPermissions($request->permissions ?? []);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    public function destroy(User $user)
    {
        try {
            
            $user->permissions()->detach();

            
            $user->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}



