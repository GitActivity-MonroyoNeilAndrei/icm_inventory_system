<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Option;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\CSV;

class TransactionController extends Controller
{
    public function index() {

        // $transaction = Transaction::query()->Paginate(10);
        $transaction = Transaction::query();

        $this->filter($transaction);

        $user = User::orderBy('first_name', 'ASC')->get();
        $item = Item::orderBy('name', 'ASC')->get();

        $status = Option::where('category', 'status')->orderBy('name', 'ASC')->get();

        $search = request()->get('search');

        if(request()->has('search')) {
            $transaction = $transaction->where('issued_to', 'like', '%'. $search .'%');

            $transaction = Transaction::with('IssuedToUser')
                ->whereHas('IssuedToUser', function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'ASC');
        }

        return view('admin.transactions.index', ['transaction' => $transaction->paginate(15),
            'user' => $user,
            'item' => $item,
            'status' => $status,
            'selectedIssuedTo' => request()->get('issued_to', []),
            'selectedIssuedBy' => request()->get('issued_by', []),
            'selectedStatus' => request()->get('status', []),
            'selectedItem' => request()->get('item', []),
            'selectedCondition' => request()->get('condition', []),

        ]);
    }

    public function add($id) {
        $user = User::orderBy('first_name', 'ASC')->get();

        $item = Item::findOrFail($id);


        return view('admin.transactions.create', compact('user', 'item' ));
    }

    public function storeTxn(Request $request, $id) {


        $item = $request->input('item');
        $issued_to = $request->input('issued_to');
        $issued_by = $request->input('issued_by');
        $condition = $request->input('condition');
        $status = $request->input('status');


        $existing_txn = Transaction::where('item', $item)
        ->where('issued_to', $issued_to)
        ->where('issued_by', $issued_by)
        ->where('condition', $condition)
        ->where('status', $status)
        ->first();

        if($existing_txn){
            return redirect()->route('transaction.index')->with('failed', 'Transaction Already Exist');

        } else {

            $transaction = $request->all();

            Transaction::create($transaction);

            $item = Item::findOrFail($id);

            $item->update([
                'status' => $request->input('status')
            ]);

            return redirect()->route('transaction.index')->with('success', 'Transaction Added Successfully');
        }

    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        $user = User::orderBy('first_name', 'ASC')->get();
        $item = Item::orderBy('name', 'ASC')->get();

        $status = Option::where('category', 'status')->orderBy('name', 'ASC')->get();


        if (auth()->user()->role === 'admin') {
            return view('admin.transactions.edit', compact('transaction', 'user', 'item', 'status'));
        } else if (auth()->user()->role === 'user') {
            return view('user.transactions.edit', compact('transaction', 'user', 'item', 'status'));
        }
    }

    public function update(Request $request, $id)
    {

        $transaction = Transaction::findOrFail($id);

        $transaction->update($request->all());

        if (auth()->user()->role === 'admin') {
            return redirect()->route('transaction.index')->with('TransactionUpdated', 'Item Updated Successfully');
        } else if (auth()->user()->role === 'user') {
            return redirect()->route('transaction.index')->with('TransactionUpdated', 'Item Updated Successfully');
        }
    }


    public function filter ($transaction) {
        $transaction->orderBy('id', 'DESC');

        if (request()->has('issued_to')) {
            $transaction->whereIn('issued_to', request()->get('issued_to'));
        }

        if (request()->has('issued_by')) {
            $transaction->whereIn('issued_by', request()->get('issued_by'));
        }

        if (request()->has('status')) {
            $transaction->whereIn('status', request()->get('status'));
        }

        if (request()->has('item')) {
            $transaction->whereIn('item', request()->get('item'));
        }

        if (request()->has('condition')) {
            $transaction->whereIn('condition', request()->get('condition'));
        }
    }

    public function exportCSV()
    {
        // Retrieve transactions data
        $transactions = Transaction::all();

        // Define CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="transactions.csv"',
        ];

        // Prepare CSV data
        $csvData = CSV::from($transactions)->toString();

        // Output CSV data as a response
        return response($csvData, 200, $headers);
    }

}
