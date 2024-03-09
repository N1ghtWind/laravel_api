<?php

namespace App\Filters\V1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CustomerFilter
{

    protected $allowedParams = [
        'postalCode' => ['eq', 'gt', 'lt'],
        'city' => ['eq', 'like'],
        'state' => ['eq', 'like'],
        'address' => ['eq', 'like'],
        'name' => ['eq', 'like'],
        'type' => ['eq', 'like'],
        'email' => ['eq', 'like'],
    ];

    protected $columnMap = [
        'postalCode' => 'zip',
        'city' => 'city',
        'state' => 'state',
        'address' => 'address',
        'name' => 'name',
        'type' => 'type',
        'email' => 'email',
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

            foreach($operators as $operator) {
               if(isset($query[$operator])) {
                   $queryReturn[] = [$column, $this->operatorMap[$operator], $query[$operator]];
               }
            }
        }
        return $queryReturn;
    }
}
