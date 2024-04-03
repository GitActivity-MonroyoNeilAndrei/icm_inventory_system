<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Option;
use App\Models\User;
use App\Models\Item;





class TransactionController extends Controller
{
    public function index() {

        // $transaction = Transaction::query()->Paginate(10);
        $transaction = Transaction::orderBy('id', 'DESC');


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

        return view('admin.transactions.index', ['transaction' => $transaction->paginate(10), 'user' => $user, 'item' => $item, 'status' => $status]);
    }

    public function add($id) {
        $user = User::orderBy('first_name', 'ASC')->get();

        $item = Item::findOrFail($id);


        return view('admin.transactions.create', compact('user', 'item' ));
    }

    public function storeTxn(Request $request, $id) {
        $transaction = $request->all();

        Transaction::create($transaction);

        $item = Item::findOrFail($id);

        $item->update([
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
}
