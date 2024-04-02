<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use Illuminate\Validation\Rule;

class OptionController extends Controller
{
    public function index() {
        $role = Option::where('category', 'role')->orderBy('name', 'ASC')->get();
        $position = Option::where('category', 'position')->orderBy('name', 'ASC')->get();
        $department = Option::where('category', 'department')->orderBy('name', 'ASC')->get();
        $campus = Option::where('category', 'campus')->orderBy('name', 'ASC')->get();
        $category = Option::where('category', 'category')->orderBy('name', 'ASC')->get();
        $status = Option::where('category', 'status')->orderBy('name', 'ASC')->get();


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

}
