<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Option;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    use HasFactory;

    public function index () {
        $users = User::orderBy('first_name', 'ASC');

        $category = Option::where('category', 'category')->get();
        $position = Option::where('category', 'position')->get();
        $center = Option::where('category', 'center')->get();
        $department = Option::where('category', 'department')->get();

        if(request()->has('search')) {
            $users = $users->where('first_name', 'like', '%'. request()->get('search') .'%');
        }

        return view ('admin.users.index', ['user' => $users->Paginate(10), 'category' => $category, 'position' => $position, 'center' => $center, 'department' => $department]);

    }

    public function edit (string $id) {
        $user = User::findOrFail($id);

        $category = Option::where('category', 'category')->get();
        $position = Option::where('category', 'position')->get();
        $center = Option::where('category', 'center')->get();
        $department = Option::where('category', 'department')->get();

        return view('admin.users.edit', compact('user', 'position', 'department', 'category', 'center'));
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

        User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'position' => $request->input('position'),
            'department' => $request->input('department'),
            'role' => $request->input('role'),
            'center' => $request->input('center'),
            'password' => 'icmadmin1993'
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
