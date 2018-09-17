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
        $transaction->storeId = $request->get('storeId');
        $transaction->downloadAttempts = 0;

        $transaction->save();

        return 200;
    }

    //Download Video
    public function Download(Request $request) {
        $download = new Transaction();
        $download = $download->where('salesId', $request->get('salesId'))->increment('downloadAttempts');
        return 200;

       /* $get = new Transaction();
        $get = $get->where('salesId', $request->get('salesId'))->get();

        if($get->downloadAttempts <= 3) {
            $filename = $request->get('filename');
            $filePath = public_path('storage/' . $filename);
            return response()->download($filePath, $request->get('filename'));
        }else {
            return 403;
        }*/
    }
}
