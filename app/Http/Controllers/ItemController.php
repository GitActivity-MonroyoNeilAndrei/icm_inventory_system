<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    use HasFactory;

    public function index()
    {
        $item = Item::paginate(10);

        if (auth()->user()->role === 'admin') {
            return view('admin.items.index', compact('item'));
        } else if (auth()->user()->role === 'user') {
            return view('user.items.index', compact('item'));
        }
    }

    public function store(Request $request)
    {

        // Item::create($request->all());

        $date = Carbon::now();

        $date_today = $date->format('Y-m-d');

        $item_id = $request->input('item_id');
        $name = $request->input('name');
        $category = $request->input('category');
        $serial_no = $request->input('serial_no');
        $model = $request->input('model');
        $description = $request->input('description');
        $additional_details = $request->input('additional_details');
        $status = $request->input('status');
        $added_by = 1;
        $date_acquisition = $request->input('date_acquisition');
        $date_added = $date_today;
        $csv_file = $request->input('csv_file');


        Item::create([
            'item_id' => $item_id,
            'name' => $name,
            'category' => $category,
            'serial_no' => $serial_no,
            'model' => $model,
            'description' => $description,
            'additional_details' => $additional_details,
            'status' => $status,
            'added_by' => $added_by,
            'date_acquisition' => $date_acquisition,
            'date_added' => $date_added,
            'csv_file' => $csv_file
        ]);

        return redirect()->back()->with('success', 'Item added Successfully');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);

        if (auth()->user()->role === 'admin') {
            return view('admin.items.edit', compact('item'));
        } else if (auth()->user()->role === 'user') {
            return view('user.items.edit', compact('item'));
        }
    }

    public function update(Request $request, $id)
    {

        $item = Item::findOrFail($id);

        $item->update($request->all());

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.item.index')->with('itemUpdated', 'Item Updated Successfully');
        } else if (auth()->user()->role === 'user') {
            return redirect()->route('user.item.index')->with('itemUpdated', 'Item Updated Successfully');
        }
    }
}
