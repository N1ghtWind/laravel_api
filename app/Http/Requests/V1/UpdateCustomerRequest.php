<?php

namespace App\Http\Requests\V1;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
       // request method
        $request_method = $this->method();

        // if it equals to put

        if($request_method == 'PUT') {
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
        else {
            return [
                'name' => ['sometimes', 'required'],
                'type' =>  ['sometimes','required', Rule::in(Customer::$types)],
                'email' => ['sometimes','required', 'email', 'unique:customers,email'],
                'address' => ['sometimes','required'],
                'city' => ['sometimes','required'],
                'phone' => ['sometimes','required'],
                'country' => ['sometimes','required'],
                'postalCode' => ['sometimes','required'],
            ];
        }


    }

    protected function prepareForValidation()
    {
        if($this->postalCode) {
            $this->merge([
                'zip' => $this->postalCode
            ]);
        }
    }
}
