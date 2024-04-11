<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Option;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;

class TransactionController extends Controller
{
    public function index() {

        // $transaction = Transaction::query()->Paginate(10);
        $transaction = Transaction::query();

        $this->filter($transaction);

        $user = User::orderBy('first_name', 'ASC')->get();
        $item = Item::orderBy('name', 'ASC')->get();

        $status = Option::where('category', 'status')->orderBy('name', 'ASC')->get();

        $this->search($transaction);

        $transaction->orderBy('id', 'DESC');

        return view('admin.transactions.index', ['transaction' => $transaction->paginate(15),
            'user' => $user,
            'item' => $item,
            'status' => $status,
            'selectedIssuedTo' => request()->get('issued_to', []),
            'selectedIssuedBy' => request()->get('issued_by', []),
            'selectedStatus' => request()->get('status', []),
            'selectedItem' => request()->get('item', []),
            'selectedCondition' => request()->get('condition', []),
            'search' => request()->get('search')

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


        $transaction = Transaction::firstOrCreate(
            ['item' => $item, 'issued_to' => $issued_to, 'issued_by' => $issued_by, 'condition' => $condition, 'status' => $status]
        );


        if(!$transaction->wasRecentlyCreated) {
            return redirect()->route('transaction.index')->with('failed', 'Transaction Already Exist');
        }

        $itemSelected = Item::findOrFail($id);

        $itemSelected->update([
            'status' => $request->input('status')
        ]);

        return redirect()->route('transaction.index')->with('success', 'Transaction Added Successfully');
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

    public function search($transaction) {

        $search = request()->get('search');

        if(request()->has('search')) {

            $transaction->whereHas('IssuedToUser', function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%');
            });
        }
    }

    public function exportCSV(Request $request)
    {

        $transaction = DB::table('transactions');

        $this->filter($transaction);

        $transaction = DB::table('transactions')
        ->select(
            'transactions.transaction_date',
            'items.name as item_name',
            DB::raw("CONCAT(users_issued_to.first_name, ' ', users_issued_to.last_name) as issued_to_name"),
            DB::raw("CONCAT(users_issued_by.first_name, ' ', users_issued_by.last_name) as issued_by_name"),
            'transactions.status',
            'transactions.condition'
        )
        ->join('items', 'transactions.item', '=', 'items.id')
        ->join('users as users_issued_to', 'transactions.issued_to', '=', 'users_issued_to.id')
        ->join('users as users_issued_by', 'transactions.issued_by', '=', 'users_issued_by.id')
        ->orderBy('transactions.id', 'DESC');
    
    


        // $this->search($transaction);

        // Download the results as a CSV file
        return Excel::download(new TransactionsExport($transaction), 'transactions.csv');
    }
}
