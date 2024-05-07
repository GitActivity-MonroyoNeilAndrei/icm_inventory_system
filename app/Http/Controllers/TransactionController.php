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
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    public function index() {

        // $transaction = Transaction::query()->Paginate(10);
        $transaction = Transaction::query();

        $this->filter($transaction);

        $user = User::orderBy('first_name', 'ASC')->get();
        $item = Item::orderBy('name', 'ASC')->get();

        $option = Option::all();

        $this->search($transaction);

        $transaction->orderBy('transactions.transaction_date', 'DESC');

        if(auth()->user()->role == 'admin') {
            return view('admin.transactions.index', ['transaction' => $transaction->paginate(15),
            'user' => $user,
            'item' => $item,
            'option' => $option,
            'selectedIssuedTo' => request()->get('issued_to', []),
            'selectedIssuedBy' => request()->get('issued_by', []),
            'selectedStatus' => request()->get('status', []),
            'selectedItem' => request()->get('item', []),
            'selectedCondition' => request()->get('condition', []),
            'selectedCategory' => request()->get('category', []),
            'selectedLocation' => request()->get('location', []),
            'addedDateStart' => request()->get('added_date_start'),
            'addedDateEnd' => request()->get('added_date_end'),
            'acquiredDateStart' => request()->get('acquired_date_start'),
            'acquiredDateEnd' => request()->get('acquired_date_end'),
            'search' => request()->get('search')
        ]);
        } else if(auth()->user()->role == 'operational head') {
            return view('op.transactions.index', ['transaction' => $transaction->paginate(15),
            'user' => $user,
            'item' => $item,
            'option' => $option,
            'selectedIssuedTo' => request()->get('issued_to', []),
            'selectedIssuedBy' => request()->get('issued_by', []),
            'selectedStatus' => request()->get('status', []),
            'selectedItem' => request()->get('item', []),
            'selectedCondition' => request()->get('condition', []),
            'selectedCategory' => request()->get('category', []),
            'selectedLocation' => request()->get('location', []),
            'addedDateStart' => request()->get('added_date_start'),
            'addedDateEnd' => request()->get('added_date_end'),
            'acquiredDateStart' => request()->get('acquired_date_start'),
            'acquiredDateEnd' => request()->get('acquired_date_end'),
            'search' => request()->get('search')
        ]);
        }

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
            ['item' => $item, 'issued_to' => $issued_to, 'issued_by' => $issued_by, 'condition' => $condition, 'transaction_status' => $status, 'created_at' => Carbon::today()->toDateString()]
        );

        if(!$transaction->wasRecentlyCreated) {
            return redirect()->route('transaction.index')->with('failed', 'Transaction Already Exist');
        }

        $itemSelected = Item::findOrFail($item);

        $itemSelected->update([
            'status' => $request->input('status'),
            'condition' => $request->input('condition')
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
        } else if (auth()->user()->role === 'operational head') {
            return view('op.transactions.edit', compact('transaction', 'user', 'item', 'status'));
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

        $transaction->join('items', 'transactions.item', '=', 'items.id');
        $transaction->join('users', 'transactions.issued_to', '=', 'users.id');


        if (request()->has('issued_to')) {
            $transaction->whereIn('issued_to', request()->get('issued_to'));
        }

        if (request()->has('issued_by')) {
            $transaction->whereIn('issued_by', request()->get('issued_by'));
        }

        if (request()->has('status')) {
            $transaction->whereIn('transactions.transaction_status', request()->get('status'));
        }

        if (request()->has('condition')) {
            $transaction->whereIn('items.condition', request()->get('condition'));
        }

        if (request()->has('category')) {
            $transaction->whereIn('items.category', request()->get('category'));
        }

        if (request()->has('location')) {
            $transaction->whereIn('items.category', request()->get('location'));
        }

        if (request()->has('added_date_start') && request()->has('added_date_end') && request()->input('added_date_start') && request()->input('added_date_end')) {
            $startDate =  request()->get('added_date_start');
            $endDate = request()->get('added_date_end');

            $transaction->whereBetween('transactions.transaction_date', [$startDate, $endDate]);
        }

        if (request()->has('acquired_date_start') && request()->has('acquired_date_end') && request()->input('acquired_date_start') && request()->input('acquired_date_end') ) {
            $startDate = request()->get('acquired_date_start');
            $endDate = request()->get('acquired_date_end');

            $transaction->whereBetween('items.date_acquisition', [$startDate, $endDate]);
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
    
        $transaction->join('users as issued_to_user', 'transactions.issued_to', 'issued_to_user.id');
        $transaction->join('users as issued_by_user', 'transactions.issued_by', 'issued_by_user.id');
    

        $this->filter($transaction);


        $search = request()->get('search');

        if(request()->has('search')) {
            $transaction->where('users.first_name', 'like', '%' . $search . '%');
        }


        $transaction->select([
            'transaction_date',
            DB::raw("CONCAT(issued_to_user.first_name, ' ', issued_to_user.last_name) as issued_to"),
            DB::raw("CONCAT(issued_by_user.first_name, ' ', issued_by_user.last_name) as issued_by"),
            'name',
            'transactions.transaction_status',
            'transactions.condition',
        ]);
    
        $transaction->orderBy('transactions.transaction_date', 'DESC');
        
        return Excel::download(new TransactionsExport($transaction), 'transactions.csv');
    }
}
