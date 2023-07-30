<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProviderController extends Controller
{
    /**
     * Save providers data from json to database.
     */
    public function index()
    {
        try {
            $json_files_path = ['json/DataProviderW.json', 'json/DataProviderX.json', 'json/DataProviderY.json'];
            foreach ($json_files_path as $path) {
                $content = json_decode(file_get_contents($path));

                $provider = explode(".", explode("/", $path)[1])[0];

                foreach ($content as $key => $value) {
                    if ($key == "amount" || $key == "transactionAmount") {
                        $amount = $value;
                    }
                    if ($key == "currency" || $key == "Currency") {
                        $currency = $value;
                    }
                    if ($key == "phone" || $key == "senderPhone") {
                        $phone = $value;
                    }
                    if ($key == "status" || $key == "transactionStatus") {
                        $status = $value;
                    }
                    if ($key == "created_at" || $key == "transactionDate") {
                        $created_at = $value;
                    }
                    if ($key == "id" || $key == "transactionIdentification") {
                        $provider_id = $value;
                    }
                }
                DB::table('transactions')->insert([
                    'provider' => $provider,
                    'amount' => $amount,
                    'currency' => $currency,
                    'phone' => $phone,
                    'status' => $status,
                    'created_at' => $created_at,
                    'provider_id' => $provider_id,
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Providers Data Saved!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 406);
        }
    }
}
