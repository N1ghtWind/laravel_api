<?php

namespace App\Http\Requests\V1;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            '*.customerId' =>  ['required', 'exists:customers,id'],
            '*.amount' =>  ['required', 'numeric'],
            '*.status' =>  ['required', Rule::in(Customer::$types)],
            '*.billedDate' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            '*.paidDate' => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
        ];
    }

    // prepareForValidation
    protected function prepareForValidation()
    {
        $datas = [];

        foreach ($this->toArray() as $key => $obj) {
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $obj['billed_date'] = $obj['billedDate'] ?? null;
            $obj['paid_date'] = $obj['paidDate'] ?? null;

            $datas[] = $obj;
        }

        $this->merge($datas);
    }
}
