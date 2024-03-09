<?php

namespace App\Http\Requests\V1;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
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
            'name' => 'required',
            'type' =>  ['required', Rule::in(Customer::$types)],
            'email' => ['required', 'email', 'unique:customers,email'],
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'postalCode' => 'required',
        ];
    }

    // prepareForValidation
    protected function prepareForValidation()
    {
        $this->merge([
            'zip' => $this->postalCode
        ]);
    }
}
