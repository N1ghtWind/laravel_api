<?php

namespace App\Filters\V1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class InvoicesFilter
{
    // $table->id();
    //         $table->foreignId('customer_id')->constrained();
    //         $table->integer('amount');
    //         $table->string('status');
    //         // billed_date, paid_date
    //         $table->date('billed_date');
    //         $table->date('paid_date')->nullable();
    //         $table->timestamps();
    protected $allowedParams = [
        'customerId' => ['eq'],
        'amount' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'status' => ['eq', 'like', 'ne'],
        'billedDate' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'paidDate' => ['eq', 'gt', 'lt', 'gte', 'lte'],
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
        'amount' => 'amount',
        'status' => 'status',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
    ];


    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
        'like' => 'like',

    ];

    public function transform(Request $request)
    {
        $queryReturn = [];

        foreach ($this->allowedParams as $params => $operators) {
            $query = $request->query($params);

            if (!isset($query)) {
                continue;
            }
            // query = ['gt', '30']
            // operators = ['eq', 'lt']
            // params = 'postalCode'

            $column = $this->columnMap[$params] ?? $params;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $queryReturn[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $queryReturn;
    }
}
