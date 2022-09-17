<?php

namespace App\Http\Controllers;

use App\Models\CashTransactions as Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index()
    {
        $data['title'] = "Transaction List";
        $data['transactions'] = Transactions::latest()->get();
        return view('admin.transactions.list', $data);
    }
}
