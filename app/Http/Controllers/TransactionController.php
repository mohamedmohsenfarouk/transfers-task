<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function index(Request $request)
    {
        try {

            $transactions = Transaction::select('*');

            if ($request->has('provider')) {
                $transactions->where('provider', $request->get('provider'));
            }

            if ($request->has('statusCode')) {
                if ($request->get('statusCode') == 'paid') {
                    $transactions->where('status', 'done')
                        ->orWhere('status', 1)
                        ->orWhere('status', 100);
                } elseif ($request->get('statusCode') == 'pending') {
                    $transactions->where('status', 'wait')
                        ->orWhere('status', 2)
                        ->orWhere('status', 200);
                } elseif ($request->get('statusCode') == 'reject') {
                    $transactions->where('status', 'nope')
                        ->orWhere('status', 3)
                        ->orWhere('status', 300);
                }
            }

            if ($request->has('currency')) {
                $transactions->where('currency', $request->get('currency'));
            }

            if ($request->has('amounteMin') && $request->has('amounteMax')) {
                $transactions->whereBetween('amount', [$request->get('amounteMin'), $request->get('amounteMax')]);
            }

            return response()->json([
                'status' => true,
                'transactions' => $transactions->get()
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 406);
        }
    }
}
