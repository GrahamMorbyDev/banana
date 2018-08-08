<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionContoller extends Controller
{
    //Store Transaction
    public function Store(Request $request) {
        $transaction = new Transaction();

        $transaction->salesId = $request->get('salesId');
        $transaction->filename = $request->get('filename');
        $transaction->purchaseDate = $request->get('purchaseDate');
        $transaction->customerEmail = $request->get('customerEmail');
        $transaction->downloadAttempts = 0;

        $transaction->save();

        return 200;
    }
}
