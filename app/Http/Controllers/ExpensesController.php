<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FundTransaction;

class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $transactionsData = [];
        $transactions = FundTransaction::all();
        $outcome = FundTransaction::where('type', 0)->sum('amount');
        $income = FundTransaction::where('type', 1)->sum('amount');
        $revenue = $income - $outcome;
        foreach ($transactions as $transaction) {
            $transactionsData[] = [
                'trans_type' => $transaction->type,
                'trans_amount' => $transaction->amount,
                'trans_desc' => $transaction->description
            ];
        }
        $data = [
            'revenue' => $revenue,
            'income' => $income,
            'outcome' => $outcome,
            'transactions' => $transactionsData
        ];
        return response()->json($data);
    }
    public function addTransaction(Request $request)
    {
        $type = $request->type;
        $amount = $request->amount;
        $desc = $request->desc;

        $new_transaction = new FundTransaction([
            'type' => $type,
            'amount' => $amount,
            'description' => $desc
        ]);
        $new_transaction->save();

        return redirect()->route('expenses');
    }
}
