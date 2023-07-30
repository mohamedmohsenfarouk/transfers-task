<?php

namespace Tests;

class TransactionTest extends TestCase
{
    /**
     * /transactions [GET]
     */
    public function testShouldReturnAllTransactions()
    {
        $parameters = [
            "provider" => "DataProviderX",
            "statusCode" => "paid",
            "amounteMin" => "200",
            "amounteMax" => "500",
            "currency" => "USD"
        ];

        $this->get("api/v1/transactions", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'status',
            'transactions' => [
                '*' =>
                [
                    'id',
                    'provider',
                    'amount',
                    'currency',
                    'phone',
                    'status',
                    'provider_id',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);
    }
}
