<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    use HasFactory;

    public function index () {
        $users = User::orderBy('name', 'ASC');

        if(request()->has('search')) {
            $users = $users->where('name', 'like', '%'. request()->get('search') .'%');
        }

        return view ('admin.users.index', ['user' => $users->Paginate(10)]);

    }

    public function edit (string $id) {
        $user = User::findOrFail($id);

        $position_option = ['faculty'=>'Faculty', 'lecturer'=>'Lecturer', 'registrar'=>'Registrar'];
        $department_option = ['registration'=>'Registration Office', 'faculty'=>'Faculty Office', 'technical_support'=>'Technical Support Office'];
        $role_option = ['admin'=>'admin', 'user'=>'user'];
        $center_option = ['icm'=>'ICM', 'alabang'=>'Alabang', 'cavite'=>'Cavite', 'taguig'=>'Taguig'];

        return view('admin.users.edit', compact('user', 'position_option', 'department_option', 'role_option', 'center_option'));
    }

    public function update(Request $request, string $id) {
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());
            return redirect()->route('user.index')->with('userUpdated', 'User Updated Successfully');
        } catch (ModelNotFoundException $e) {

            return redirect()->route('admin.user.index')->with('errorNotFound', 'User not Found');
        }
    }

    public function store (Request $request) {

        $validated = request()->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        // $name = $request->input('name');
        // $email = $request->input('email');
        // $position = $request->input('position');
        // $department = $request->input('department');
        // $role = $request->input('role');
        // $center = $request->input('center');

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'position' => $request->input('position'),
            'department' => $request->input('department'),
            'role' => $request->input('role'),
            'center' => $request->input('center'),
            'password' => 'password'
        ]);

        return redirect()->back()->with('success', 'User Added Successfully');
    }

    public function isActivated(string $id) {

        $user = User::findOrFail($id);

        $newStatus = $user->status === 'activated' ? 'deactivated' : 'activated';
        $user->update(['status' => $newStatus]);

        return redirect()->back()->with('statusChanged', 'User Status Changed');
    }
}
