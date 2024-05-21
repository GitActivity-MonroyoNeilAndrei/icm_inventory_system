<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use Illuminate\Validation\Rule;

class OptionController extends Controller
{
    public function index() {
        $role = Option::where('category', 'role')->orderBy('status', 'DESC')->orderBy('name', 'ASC')->get();
        $position = Option::where('category', 'position')->orderBy('status', 'DESC')->orderBy('name', 'ASC')->get();
        $department = Option::where('category', 'department')->orderBy('status', 'DESC')->orderBy('name', 'ASC')->get();
        $campus = Option::where('category', 'campus')->orderBy('status', 'DESC')->orderBy('name', 'ASC')->get();
        $category = Option::where('category', 'category')->orderBy('status', 'DESC')->orderBy('name', 'ASC')->get();
        $status = Option::where('category', 'status')->orderBy('status', 'DESC')->orderBy('name', 'ASC')->get();


        return view('admin.settings.index', compact('role', 'position', 'department', 'campus', 'category', 'status'));
    }

    public function show () {
        //
    }

    public function store(Request $request) {

        $request->validate([
            'name'=>[Rule::unique('options', 'name')], 
        ],
        [
            'name.unique' => "Option Already Exist",
        ]
    );

        Option::create($request->all());
        return redirect()->back()->with('success', 'Option Added Successfully');

    }

    public function destroy($id) {
        $option = Option::findOrFail($id);

        $option->delete();

        return redirect()->route('option.index')->with('optionDeleted', 'Option Deleted Successfully');
    }

    public function isEnable(string $id) {

        $option = Option::findOrFail($id);

        $newStatus = $option->status === 'enable' ? 'disable' : 'enable';
        $option->update(['status' => $newStatus]);

        return redirect()->back()->with('statusChanged', "Option Successfully $newStatus");
    }

}
