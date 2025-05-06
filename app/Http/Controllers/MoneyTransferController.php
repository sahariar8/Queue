<?php

namespace App\Http\Controllers;

use App\Jobs\MoneyTransferJob;
use Illuminate\Http\Request;

class MoneyTransferController extends Controller
{
    public function index()
    {
        return view('money-transfer');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Process the money transfer logic here
        dispatch(new MoneyTransferJob($request->amount));
        return redirect()->back()->with('success', 'Money transfer is being processed!');
    }
}
