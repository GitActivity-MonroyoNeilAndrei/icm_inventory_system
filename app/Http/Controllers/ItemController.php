<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Option;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Illuminate\Validation\Rule;

use App\Imports\ItemImport;
use Maatwebsite\Excel\Facades\Excel;


class ItemController extends Controller
{
    use HasFactory;

    public function index()
    {
        // $item = Item::with('addedByUser')->paginate(10);
        $item = Item::orderBy('name', 'ASC')->where('condition', 'new')->orwhere('condition', 'operational/working');
        $transaction = Transaction::all();


        $category = Option::where('category', 'Category')->get();
        $department = Option::where('category', 'Department')->get();

        $search = request()->get('search');

        if(request()->has('search')) {
            $item = $item->where('name', 'like', '%'. $search .'%');
        }

        return view('admin.items.index', ['item' => $item->paginate(15), 'category' => $category, 'transaction' => $transaction, 'search' => $search, 'department' => $department]);
    }

    public function indexUnavailable()
    {
        // $item = Item::with('addedByUser')->paginate(10);
        $item = Item::orderBy('name', 'ASC')->where('condition', 'for repair')->orwhere('condition', 'condemn');
        $transaction = Transaction::all();

        $category = Option::where('category', 'Category')->get();
        $department = Option::where('category', 'Department')->get();

        $search = request()->get('search');

        if(request()->has('search')) {
            $item = $item->where('name', 'like', '%'. $search .'%');
        }

        return view('admin.items.indexUnavailable', ['item' => $item->paginate(15), 'category' => $category, 'transaction' => $transaction, 'search' => $search, 'department' => $department]);

    }

    public function store(Request $request)
    {

        $date = Carbon::now();

        $date_today = $date->format('Y-m-d');

        $name = $request->input('name');
        $category = $request->input('category');
        $serial_no = $request->input('serial_no');
        $model = $request->input('model');
        $description = $request->input('description');
        $additional_details = $request->input('additional_details');
        $status = $request->input('status');
        $condition = $request->input('condition');
        $location = $request->input('location');
        $added_by = auth()->user()->id;
        $date_acquisition = $request->input('date_acquisition');
        $date_added = $date_today;

        $item = Item::firstOrCreate(
            ['name' => $name, 'category' => $category, 'serial_no' => $serial_no, 'model' => $model, 'description' => $description, 'additional_details' => $additional_details, 'location' => $location],
            ['status' => $status, 'condition' => $condition, 'added_by' => $added_by, 'date_acquisition' => $date_acquisition, 'date_added' => $date_added]
        );

        if (!$item->wasRecentlyCreated) {
            return redirect()->back()->with('failed', 'Item already exists');
        }

        return redirect()->back()->with('success', 'Item added Successfully');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);

        $department = Option::where('category', 'Department')->get();

        if (auth()->user()->role === 'admin') {
            return view('admin.items.edit', compact('item', 'department'));
        } else if (auth()->user()->role === 'user') {
            return view('user.items.edit', compact('item', 'department'));
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

    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file',
                'mimes:csv,txt',
            ],
        ]);

        Excel::import(new ItemImport, $request->file('import_file'));

        return redirect()->back()->with('status', 'Imported Successfully');
    }


}
