<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\DB;


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
        //Get Current Numbers
        $dmca = DB::table('downloadAttempts')
            ->select()
            ->where('salesId', '=', $request->get('salesId'))
            ->get();
        $daily = 1;

        //Add Current to new daily number
        $lifetime = $dmca[0]->downloadAttempts + $daily;

        //Update database
        DB::table('downloadAttempts')->where('salesId', '=', $request->get('salesId'))->update($lifetime);

        return 200;

       /* $get = new Transaction();
        $get = Transaction->where('salesId', $request->get('salesId'))->firstOrFail();

        if($get->downloadAttempts <= 3) {
            $filename = $request->get('filename');
            $filePath = public_path('storage/' . $filename);
            return response()->download($filePath, $request->get('filename'));
        }else {
            return 403;
        }*/
    }
}
