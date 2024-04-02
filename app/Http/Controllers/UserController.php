<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Option;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use HasFactory;

    public function index () {
        $users = User::orderBy('first_name', 'ASC');

        $category = Option::where('category', 'category')->get();
        $position = Option::where('category', 'position')->get();
        $campus = Option::where('category', 'campus')->get();
        $department = Option::where('category', 'department')->get();

        $search = request()->get('search');

        if(request()->has('search')) {
            $users = $users->where('first_name', 'like', '%'. $search .'%')->orWhere('last_name', 'like', '%' . $search . '%');
        }

        return view ('admin.users.index', ['user' => $users->Paginate(10), 'category' => $category, 'position' => $position, 'campus' => $campus, 'department' => $department]);

    }

    public function edit (string $id) {
        $user = User::findOrFail($id);

        $category = Option::where('category', 'category')->get();
        $position = Option::where('category', 'position')->get();
        $campus = Option::where('category', 'campus')->get();
        $department = Option::where('category', 'department')->get();

        return view('admin.users.edit', compact('user', 'position', 'department', 'category', 'campus'));
    }

    public function update(Request $request, string $id) {

        $existingUser = User::where('first_name', $request->input('first_name'))->where('last_name', $request->input('last_name'))->first();

        if($existingUser) {
            return redirect()->back()->with('failed', 'User Already Exist');
        } else {
            try {
                $user = User::findOrFail($id);
                $user->update($request->all());
                return redirect()->route('user.index')->with('userUpdated', 'User Updated Successfully');
            } catch (ModelNotFoundException $e) {

                return redirect()->route('admin.user.index')->with('errorNotFound', 'User not Found');
            }
        }
    }

    public function store (Request $request) {

        $existingUser = User::where('first_name', $request->input('first_name'))->where('last_name', $request->input('last_name'))->first();

        if($existingUser) {
            return redirect()->back()->with('failed', 'User Already Exist');
        } else {
            User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'position' => $request->input('position'),
                'department' => $request->input('department'),
                'role' => $request->input('role'),
                'campus' => $request->input('campus'),
                'password' => 'icmadmin1993'
            ]);

            return redirect()->back()->with('success', 'User Added Successfully');
        }


    }

    public function isActivated(string $id) {

        $user = User::findOrFail($id);

        $newStatus = $user->status === 'activated' ? 'deactivated' : 'activated';
        $user->update(['status' => $newStatus]);

        return redirect()->back()->with('statusChanged', 'User Status Changed');
    }



    public function updateProfile(Request $request, string $id) {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),

            ]);
            return redirect()->back()->with('profileUpdated', 'User Updated Successfully');

        } catch (ModelNotFoundException $e) {

            return redirect()->back()->with('errorNotFound', 'User not Found');
        }
    }

    public function updateProfilePassword(Request $request, string $id) {

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::findOrFail($id);

        if(!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('passwordMismatch', 'Incorrect Current Password');
        }

        $user->update([
            'password' => $request->input('password_confirmation'),
        ]);

        return redirect()->back()->with('passwordChanged', 'Password Updated');
    }

    public function changePassword(string $id) {
        $user = User::findOrFail($id);

        return view('auth.change-password', compact('user'));
    }
    
    public function updatePassword(Request $request, string $id) {

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'password' => $request->input('password_confirmation'),
            'password_changed' => 1,
        ]);

        if(auth()->user()->role == 'admin') 
        {
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully');
        } else if(auth()->user()->role == 'user') 
        {
            return redirect()->route('user.dashboard')->with('success', 'Logged in successfully');
        }

        
    }
}
